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
use App\Models\sparepartSale;
use App\Models\detailSale;
use App\Models\teknisi;
use App\Models\metodePembayaran;
use App\Models\pembayaranBooking;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateSale extends Component
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
    public $harga_beli_sparepart = [];
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
    public $metode_pembayaran;

    public $jumlah_bayar;
    public $nominal_bayar;
    public $metode_id;
    public $metode_nama;
    public $keterangan;


    public function mount()
    {
        // Ambil daftar teknisi dari database
        $this->teknisis = teknisi::where('cabang_id', auth()->user()->cabang->id)
       
            ->get();
        $this->merks = hpMerk::all();
        $this->models = HpModel::all();
        $this->services = dataService::where('user_id', auth()->id())->get();
        $this->teknisiName = "";
        $this->no_antri = antrian::where('user_id',auth()->id())->first()?->ditangani;
        if (!$this->no_antri) {
            session()->flash('message', 'Buka antrian terlebih dahulu.');
            return; // Hentikan eksekusi Livewire agar tidak lanjut ke bawah
        }
        // $query = dataService::with('user');

        // if ($request->has('cabang') && !empty($request->cabang)) {
        //     $query->where('user_id', $request->cabang);
        // }
        // $services = $query->get()->unique('code');
        // $this->spareparts = sparepart::where('user_id', auth()->id())->get();
        $this->spareparts = sparepart::with('user')->get();
        $this->metode_pembayaran = metodePembayaran::all();

    }
    public function updatedTeknisiId($value)
    {
        // Cari teknisi berdasarkan ID
        $teknisi = teknisi::find($value);
        if ($teknisi) {
            $this->teknisiName = $teknisi->nama;
        } else {
            $this->teknisiName = '';
        }
    }

    public function updatedNohp($value)
    {
        // Cari customer berdasarkan nomor HP
        $customer = customer::where('no_hp', $value)
                    ->where('user_id', auth()->id())
                    ->first();

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
    public function getTotalBayarProperty()
    {
        $totalService = is_array($this->harga_service) ? array_sum($this->harga_service) : 0;
        $totalSparepart = is_array($this->harga_sparepart) ? array_sum($this->harga_sparepart) : 0;

        return $totalService + $totalSparepart;
    }

    public function getKembalianProperty()
    {
        $totalSparepart = is_array($this->harga_sparepart) ? array_sum($this->harga_sparepart) : 0;
        $nominal = (int) preg_replace('/[^0-9]/', '', $this->nominal_bayar);

        if ($nominal < $totalSparepart) {
            return 0; // kalau kurang bayar, tidak ada kembalian
        }

        return $nominal - $totalSparepart;
    }

    public function submit()
    {
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

            'sparepart_id' => 'required',
            'metode_id' => 'required',
            'nominal_bayar' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) {
                    $total = is_array($this->harga_sparepart) ? array_sum($this->harga_sparepart) : 0;
                    $nominal = (int) str_replace('.', '', $value);
                    if ($nominal < $total) {
                        $fail('Jumlah bayar tidak boleh lebih kecil dari total.');
                    }
                },
            ],

        ]);
        
        // dd($this->harga_service, $this->harga_sparepart);

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
        $kode_pesanan = strtoupper( $cab .'SP-'. $tanggal.'-' . $nextNumber);
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
        if ($this->jumlah_bayar != null){
            $bayar = (int) str_replace('.', '', $this->jumlah_bayar);
        }else{
            $bayar = 0;
        }
        $total = is_array($this->harga_sparepart) ? array_sum($this->harga_sparepart) : 0;
        //membuat booking
        $totalSparepart = is_array($this->harga_sparepart) ? array_sum($this->harga_sparepart) : 0;
        $nominal = (int) preg_replace('/[^0-9]/', '', $this->nominal_bayar);

        if ($nominal < $totalSparepart) {
            $kembalian= 0; // kalau kurang bayar, tidak ada kembalian
        }
        $nominal = (int) str_replace('.', '', $this->nominal_bayar);
        $kembalian= $nominal - $totalSparepart;

        if($this->keterangan == null){
            $this->keterangan = 'belum ada keterangan';
        }
        $createBook = sparepartSale::create(([
            'kode_pesanan' => $kode_pesanan,
            'user_id' => auth()->id(),
            'customer_id' => $this->customer,
            'status' => 'selesai',
            'metode_pembayaran_id' => $this->metode_id,
            'total' => $total,
            'keterangan' => $this->keterangan,
            'kembalian' => $kembalian,
            'diskon' => 0,
            'diskon_status' => 'tidak_diskon',
            'nominal_bayar' => $nominal
        ]));

     
            $sparepartIds = $validated['sparepart_id'];
            for ($i = 0; $i < count($sparepartIds); $i++)
                detailSale::create([
                    'sparepart_sales_id' => $createBook['id'],
                    'sparepart_id' => $sparepartIds[$i],
                    'harga' => $this->harga_sparepart[$i],
                    'harga_beli' => $this->harga_beli_sparepart[$i],
                ]);
        


        $this->reset(); // Reset semua input
        session()->flash('inputData', $createBook);
        session()->flash('message', 'Booking berhasil dibuat.');
    return redirect()->route('print.sale', $createBook->id);    
        // $this->dispatch('print-spk');
       
    }
   
    public function render()
    {
        return view('livewire.create-sale');
    }
}
