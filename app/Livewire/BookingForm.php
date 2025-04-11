<?php

namespace App\Livewire;
use App\Models\antrian;
use App\Models\booking;
use App\Models\customer;
use App\Models\dataService;
use App\Models\detailBooking;
use App\Models\hpMerk;
use App\Models\hpModel;
use App\Models\sparepart;
use App\Models\sparepart_booking;
use App\Models\teknisi;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


use Livewire\Component;

class BookingForm extends Component
{

    protected $listeners = ['refreshComponent' => '$refresh'];
    
    public $nohp;
    public $diskon;
    public $nama;
    public $alamat;
    public $no_hp_alternatif;
    public $teknisiId;
    public $kendala;
    public $merkHpId; // ID merk yang dipilih
    public $modelHpId; // ID model yang dipilih
    public $merks = []; // Daftar merk HP
    public $models = []; // Daftar model HP

    public $searchMerk = ''; // Pencarian merk
    public $searchModel = '';

    public $imei;
    public $service_id = [];
    public $harga_service = [];
    public $harga_sparepart = [];
    public $sparepart_id = [];
    public $services;
    public $spareparts;
    public $customer;
    public $teknisis;
    public $feedbackMessage;
    public $searchTeknisi = '';
    public $garansi = '0';
    public $teknisiName;
    public $no_antri;


    public function mount()
    {
        // Ambil daftar teknisi dari database
        $this->teknisis = teknisi::where('cabang_id', auth()->user()->cabang->id)
       
            ->get();
        $this->merks = hpMerk::where('user_id', auth()->id())->get();
        $this->models = HpModel::all();
        $this->services = dataService::where('user_id', auth()->id())->get();
        // $query = dataService::with('user');

        // if ($request->has('cabang') && !empty($request->cabang)) {
        //     $query->where('user_id', $request->cabang);
        // }
        // $services = $query->get()->unique('code');
        // $this->spareparts = sparepart::where('user_id', auth()->id())->get();
        $this->spareparts = sparepart::with('user')->get();

    }
    public function updatedNohp($value)
    {
        // Cari customer berdasarkan nomor HP
        $customer = customer::where('no_hp', $value)->first();

        if (isset($customer)) {
            $this->nama = $customer->nama;
            $this->alamat = $customer->alamat;
            $this->customer = $customer->id;
        } else {
            $this->feedbackMessage = "Pelanggan baru.";
        }
    }
    public function updatedMerkHpId($merkHpId)
    {
        // Cari customer berdasarkan nomor HP
        $this->models = hpModel::where('hp_merk_id', $merkHpId)->get();
        $this->modelHpId = null;
    }

    public function updated($propertyName, $value)
    {
        if($propertyName == 'diskon'){
            $value_format = str_replace('.', '', $value);
            $this->$propertyName = (int) $value_format;
        }
        // $value_format = str_replace('.', '', $value);

        // $this->$propertyName = (int) $value_format;
      
    }

    public function submit()
    {
        // dd($this->diskon);
        $validated = $this->validate([
            'nohp' => [
                'required',
                'numeric',
                'min:11',
                function ($attribute, $value, $fail) {
                    // Cek apakah nomor HP mengandung angka saja
                    if (!preg_match('/^08[0-9]+$/', $value)) {
                        $fail('Nomor HP harus dimulai dengan "08" dan hanya berisi angka.');
                    }
                },
            ],
            'nama' => 'required|min:3|string|max:255',
            'alamat' => 'required|string',
            'kendala' => 'required|string',
            'no_hp_alternatif' => [
                'required',
                'numeric',
                'min:11',
                function ($attribute, $value, $fail) {
                    // Cek apakah nomor HP mengandung angka saja
                    if (!preg_match('/^08[0-9]+$/', $value)) {
                        $fail('Nomor HP harus dimulai dengan "08" dan hanya berisi angka.');
                    }
                },
            ],
            'teknisiId' => 'required',
            'merkHpId' => 'required',
            'modelHpId' => 'required',
            'imei' => 'nullable',
            'service_id' => 'required',
            'sparepart_id' => 'nullable',
            'garansi' => 'nullable',
            'diskon' => 'nullable|integer',

        ]);

        // jika customer baru dibuatkan customer baru
        if ($this->customer == null) {
            $createCust = customer::create([
                'user_id' => auth()->id(),
                'no_hp' => $validated['nohp'],
                'nama' => $validated['nama'],
                'alamat' => $validated['alamat'],
                'servis' => 0
            ]);
            $this->customer = $createCust->id;
        }
        //membuat code pesanan

        $name = Auth::user()->cabang->nama;
        $consonants = preg_replace('/[aeiouAEIOU]/', '', $name);
        $cab = Str::substr($consonants, 0, 3);
        $tanggal = Carbon::now()->format('jn') . substr(Carbon::now()->format('Y'), 2);
        $jam = Carbon::now()->format('H');        // Jam (00-23)
        $menit = Carbon::now()->format('i');      // Menit (00-59)
        $milidetik = Carbon::now()->format('v');  // Milidetik (000-999)
        $teknisiName = teknisi::where('id', $validated['teknisiId'])->first()->nama;

        $angka = substr($jam, 1, 1) . substr($menit, 0, 2) . substr($milidetik, 0, 2);
        $lastBooking = Booking::where('user_id', Auth::id())->latest()->first();
        $nextNumber = 1;
        if ($lastBooking) {
            $lastKode = $lastBooking->kode_pesanan;
            $kodeParts = explode('-', $lastKode);
        
            if (count($kodeParts) === 3) {
                $lastTanggal = $kodeParts[1];
                $lastNumber = (int) $kodeParts[2];
        
                if ($lastTanggal === $tanggal) {
                    $nextNumber = $lastNumber + 1;
                }
            }
        }
        // dd($cab, $tanggal, $angka);
        $kode_pesanan = strtoupper( $cab .'-'. $tanggal.'-' . $nextNumber);
        // dd($kode_pesanan);
        $no_antri = antrian::where('user_id',auth()->id())->first()?->ditangani;
        if (!$no_antri) {
            session()->flash('message', 'Buka antrian terlebih dahulu.');
            return; // Hentikan eksekusi Livewire agar tidak lanjut ke bawah
        }
        if($this->diskon != 0){
            $diskonStatus = 1 ;
        }else{
            $diskonStatus = 0;
        }
        $discount = (int) str_replace('.', '', $this->diskon);

        //membuat booking
        $createBook = booking::create(([
            'kode_pesanan' => $kode_pesanan,
            'user_id' => auth()->id(),
            'teknisi_id' => $validated['teknisiId'],
            'customer_id' => $this->customer,
            'no_hp_alternatif' => $this->no_hp_alternatif,
            'hp_model_id' => $this->modelHpId,
            'imei' => $validated['imei'],
            'kendala' => $validated['kendala'],
            'garansi' => $this->garansi,
            'status' => 'diproses',
            'metode_pembayaran_id' => 1,
            'total' => 0,
            'claim' => 0,
            'keterangan' => 'belum ada keterangan',
            'nomor_antrian' => $no_antri,
            'diskon' => $discount,
            'diskon_status' => $diskonStatus
        ]));
        if ($this->service_id != null) {
            $serviceIds = $validated['service_id'];
            for ($i = 0; $i < count($serviceIds); $i++) {
                $service = dataService::where('id', $serviceIds[$i])->first();
                if($this->garansi == '0'){
                    $harga = $service->harga;
                }elseif($this->garansi == '1'){
                    $harga = $service->garansi_1;
                }elseif($this->garansi == '2'){
                    $harga = $service->garansi_2;
                }elseif($this->garansi == '3'){
                    $harga = $service->garansi_3;
                }
                // dd($harga);
                detailBooking::create([
                    'booking_id' => $createBook['id'],
                    'data_service_id' => $serviceIds[$i],
                    'harga' => $harga,
                ]);
            }
        }

        if ($this->sparepart_id != null) {
            $sparepartIds = $validated['sparepart_id'];
            for ($i = 0; $i < count($sparepartIds); $i++)
                sparepart_booking::create([
                    'booking_id' => $createBook['id'],
                    'sparepart_id' => $sparepartIds[$i],
                    'harga' => $this->harga_sparepart[$i],
                ]);
        }


        $this->reset(); // Reset semua input
        session()->flash('inputData', $createBook);
        session()->flash('message', 'Booking berhasil dibuat.');

        $this->dispatch('print-spk');
       
    }
    public function render()
    {
        return view('livewire.booking-form');
    }
}
