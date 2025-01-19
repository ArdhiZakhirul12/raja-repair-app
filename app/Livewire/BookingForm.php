<?php

namespace App\Livewire;
use App\Models\booking;
use App\Models\customer;
use App\Models\dataService;
use App\Models\detailBooking;
use App\Models\hpMerk;
use App\Models\hpModel;
use App\Models\sparepart;
use App\Models\sparepart_booking;
use App\Models\teknisi;

use Livewire\Component;

class BookingForm extends Component
{
    public $nohp;
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
    public $service_id;
    public $harga_service;
    public $harga_sparepart;
    public $sparepart_id;
    public $services;
    public $spareparts;
    public $customer;
    public $teknisis;
    public $feedbackMessage;
    public $searchTeknisi = '';
    public $garansi = '0';

    public function mount()
    {
        // Ambil daftar teknisi dari database
        $this->teknisis = teknisi::where('user_id', auth()->id())->get();
        $this->merks = hpMerk::where('user_id', auth()->id())->get();
        $this->models = HpModel::all();
        $this->services = dataService::where('user_id', auth()->id())->get();
        $this->spareparts = sparepart::where('user_id', auth()->id())->get();

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
            'teknisiId' => 'nullable',
            'merkHpId' => 'required',
            'modelHpId' => 'required',
            'imei' => 'nullable',
            'service_id' => 'required',
            'sparepart_id' => 'nullable',
            'garansi' => 'nullable',

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
        $dateTime = date("YmdHis"); // Waktu saat ini
        $random = bin2hex(random_bytes(3)); // 6 karakter random
        $kode_pesanan = "ORD" . $dateTime . $random;

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
            'keterangan' => 'belum ada keterangan'
        ]));
        if ($this->service_id != null) {
            $serviceIds = $validated['service_id'];
            for($i = 0; $i < count($serviceIds); $i++)
            detailBooking::create([
                'booking_id' => $createBook['id'],
                'data_service_id' => $serviceIds[$i],
                'harga' => $this->harga_service[$i],
            ]);
        }

        if ($this->sparepart_id != null) {
            $sparepartIds = $validated['sparepart_id'];
            for($i = 0; $i < count($sparepartIds); $i++)
            sparepart_booking::create([
                'booking_id' => $createBook['id'],
                'sparepart_id' => $sparepartIds[$i],
                'harga' => $this->harga_sparepart[$i],
            ]);
        }


        session()->flash('message', 'Booking berhasil dibuat.');
        $this->reset(); // Reset semua input
    }
    public function render()
    {
        return view('livewire.booking-form');
    }
}
