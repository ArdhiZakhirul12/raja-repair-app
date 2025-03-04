<?php

namespace App\Livewire;

use App\Models\antrian;
use App\Models\booking;
use App\Models\claimGaransi;
use Carbon\Carbon;
use Livewire\Component;


class ClaimGaransiCreate extends Component
{
    public $nota;
    public $noHp;
    public $feedbackMessage;
    public $oldBooking;
    public $isFind = 0;
    public $isWaranty = 0;
    public $warantyMsg;
    public $kendala;
    public function render()
    {
        return view('livewire.claim-garansi-create');
    }

    public function submit()
    {
        $validated = $this->validate([
            'nota' => 'required|min:10',
            'noHp' => [
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
        ]);

        $booking = booking::with('customer', 'detailBooking', 'sparepart_booking', 'teknisi')->where('kode_pesanan', $validated['nota'])->first();

        // dd($booking->customer->no_hp);
        if (isset($booking)) {
            if ($booking->customer->no_hp == $validated['noHp']) {
                $this->oldBooking = $booking;
                $this->feedbackMessage = "Ditemukan";
                $this->isFind = 1;
                $waranty = $this->warantyCheck($booking);
                $this->isWaranty = $waranty[0];
                $this->warantyMsg = $waranty[1];
            } else {
                $this->feedbackMessage = "Data Tidak Ditemukan atau Salah !";
            }

        } else {
            $this->feedbackMessage = "Data Tidak Ditemukan atau Salah !";
        }
    }

    public function warantyCheck($booking)
    {
        $warantyType = $booking->garansi;
        $date = Carbon::parse($booking->created_at);
        $now = now();
        if ($warantyType == 0) {
            $isWaranty = 0;
            $warantyMsg = 'tidak garansi';
            return [$isWaranty, $warantyMsg];
        } elseif ($warantyType == 1) {
            if ($now->diffInDays($date) <= 14) { // Cek apakah masih dalam 14 hari
                $isWaranty = 1;
                $warantyMsg = 'garansi masih berlaku';
            } else {
                $isWaranty = 0;
                $warantyMsg = 'garansi sudah habis';
            }
            return [$isWaranty, $warantyMsg];
        }elseif ($warantyType == 2) {
            if ($now->diffInDays($date) <= 30) { // Cek apakah masih dalam 30 hari
                $isWaranty = 1;
                $warantyMsg = 'garansi masih berlaku';
            } else {
                $isWaranty = 0;
                $warantyMsg = 'garansi sudah habis';
            }
            return [$isWaranty, $warantyMsg];
        }elseif ($warantyType == 1) {
            if ($now->diffInDays($date) <= 90) { // Cek apakah masih dalam 90 hari
                $isWaranty = 1;
                $warantyMsg = 'garansi masih berlaku';
            } else {
                $isWaranty = 0;
                $warantyMsg = 'garansi sudah habis';
            }
            return [$isWaranty, $warantyMsg];
        }
    }

    public function claim()
    {
        $validated = $this->validate([
            'kendala' => 'required'
        ]);
        $no_antri = antrian::where('user_id',auth()->id())->first()?->ditangani;
        $claimCreate = claimGaransi::create([
            'booking_id' => $this->oldBooking->id,
            'status' => 'diproses',
            'kendala' => $validated['kendala'],
            'no_antrian' => $no_antri,
            'keterangan' => ''
        ]);
        booking::where('id', $this->oldBooking->id)->increment('claim');
        $this->isFind = 0;
        $this->reset();
        // session()->flash('inputData', $claimCreate);
        session()->flash('message', 'Booking berhasil dibuat.');
        $this->dispatch('print-claim-spk');
        
    }

}
