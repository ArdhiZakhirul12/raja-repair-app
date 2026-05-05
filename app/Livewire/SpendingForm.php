<?php

namespace App\Livewire;

use App\Models\metodePembayaran;
use App\Models\pengeluaran;
use Livewire\Component;
use Livewire\WithFileUploads;

class SpendingForm extends Component
{
    use WithFileUploads;
    public $metodePembayaran;
    public $selectedMetode;
    public $tanggal;
    public $referensi;
    public $keterangan;
    public $harga ;
    public $jumlah;
    public $dokumen;
    
    public function mount()
    {
        $this->metodePembayaran = metodePembayaran::all();

    }
    public function render()
    {
        return view('livewire.spending-form');
    }

    public function submit()
    {
        
        $validated = $this->validate([
            'tanggal' => 'required|date',
            'referensi' => 'required|string',
            'selectedMetode' => 'required',
            'harga' => 'required|integer',
            'jumlah' => 'required',
            'keterangan' => 'required',
            'dokumen' => 'required|image|max:800'
        ]);
        $path = $validated['dokumen']->store('images/spending', 'public');

        $validated['user_id'] = auth()->id();
        $lastCounter = pengeluaran::max('id') ?? 0; // Ambil angka terbesar
        $angka = $lastCounter + 1;
        $tanggal = date('Ymd'); // Format tanggal (YYYYMMDD)
        $random = substr(md5(uniqid(mt_rand(), true)), 0, 5); // 5 karakter random
        $dokumen = "KBK{$angka}-{$tanggal}-{$random}";
        $validated['metode_pembayaran_id'] = $validated['selectedMetode'];
        $validated['dokumen'] = $path;
        $validated['booking_id'] = null;



        pengeluaran::create($validated);
        $this->reset();
        $this->metodePembayaran = metodePembayaran::all();
        session()->flash('doneMsg', 'Berhasil menambahkan pengeluaran');

    }
}
