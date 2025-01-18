<?php

namespace App\Livewire;
use App\Models\customer;
use App\Models\hpMerk;
use App\Models\hpModel;
use App\Models\teknisi;

use Livewire\Component;

class BookingForm extends Component
{
    public $nohp;
    public $nama;
    public $alamat;
    public $teknisi_id;
    public $kendala;
    public $merkHp;
    public $modelHp;

    public $customers = [];
    public $teknisis;
    public $feedbackMessage;
    public $searchTeknisi = '';

    public function mount()
    {
        // Ambil daftar teknisi dari database
        $this->teknisis = teknisi::where('user_id', auth()->id())->get();
        $this->merkHp =  hpMerk::where('user_id', auth()->id())->get();
        
        
    }
    public function updatedNohp($value)
    {
        // Cari customer berdasarkan nomor HP
        $customer = customer::where('no_hp', $value)->first();

        if ($customer) {
            $this->nama = $customer->nama;
            $this->alamat = $customer->alamat;
        } else {
            $this->nama = '';
            $this->alamat = '';
            $this->feedbackMessage = "Pelanggan baru.";
        }
    }

    public function submit()
    {
        $this->validate([
            'nohp' => 'required|min:10',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kendala' => 'required|string',
        ]);

        // Simpan data booking (implementasikan logika penyimpanan)
        // Booking::create([...]);

        session()->flash('message', 'Booking berhasil dibuat.');
        $this->reset(); // Reset semua input
    }
    public function render()
    {
        return view('livewire.booking-form');
    }
}
