<?php

namespace App\Livewire;
use App\Models\booking;
use App\Models\claimGaransi;
use Livewire\Component;
use Http;


class DetailGaransi extends Component
{
    public $booking;
    public $garansi;
    public $isModal = 0;
    public $keterangan ;
    public function mount($id)
    {
        $booking = booking::whereHas('claimGaransi')->get();
        // dd($booking);
        $this->garansi = claimGaransi::with('booking')->whereIn('booking_id', $booking->pluck('id'))->findOrFail($id);
    }
    public function render()
    {
        return view('livewire.detail-garansi');
    }

    public function submit()
    {
        // dd(env('FONNTE_TOKEN'));

        $validated = $this->validate([
            'keterangan' => 'required'
        ]);

        claimGaransi::where('id',$this->garansi->id)->update([
            'keterangan' => $validated['keterangan'],
            'status' => 'selesai'
        ]);
        $message = "*📌 Nota Elektronik Claim Garansi*\n"
        ."🏠 *Raja Repair*\n"
        ."📍 Jl. Raya Kedung Turi No. 1, Kedung Turi, Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61257\n\n"
        
        ."🔖 *Kode Pemesanan:* {$this->garansi->booking->kode_pesanan}\n"
        ."👤 *Nama:* {$this->garansi->booking->customer->nama}\n"
        ."🛠 *Kendala:* {$this->garansi->kendala}\n"
        ."👨‍🔧 *Teknisi:* {$this->garansi->booking->teknisi->nama}\n"
        ."💳 *Catatan:* {$validated['keterangan']}\n"
        ."💰 *Total:* Rp. ".number_format(0, 0, ',', '.')."\n"
        
        ."Mohon mengisi review untuk kami di link berikut!"."\n"
        ."https://maps.app.goo.gl/4N8Vyt7oCazwiXbu5"."\n"
        ."🙏 Terima kasih telah menggunakan layanan kami.\n"
        ."Silakan hubungi kami jika ada pertanyaan lebih lanjut.\n"
        ."📞 *Raja Repair*";
        
    
        Http::withHeaders([
            'Authorization' => env('FONNTE_TOKEN')
        ])->post('https://api.fonnte.com/send', [
            'target' => $this->garansi->booking->customer->no_hp, // Ganti dengan nomor tujuan dari database atau input user
            'message' => $message,
            'countryCode' => '62',
        ]);
        $this->isModal = 0;
        
        // return response()->json(env('FONNTE_TOKEN'));
        $this->dispatch('print-claim-invoice');
        session()->flash('doneMsg', 'Berhasil menyelesaikan servis!');
    }
}
