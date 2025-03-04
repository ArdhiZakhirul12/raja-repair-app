<?php

namespace App\Livewire;

use App\Models\booking;
use Livewire\Component;
use App\Models\rating as modelRating;

class Rating extends Component
{
    public $nota;
    public $rating;
    public $errorMessage;
    public $isValid = false;
    public $booking ;

    public function setRating($value)
    {
        $this->rating = $value;
        // dd($this->rating);
    }
    public function validateNota()
    {
        
        $this->validate([
            'nota' => 'required',
        ], [
            'nota.required' => 'Nota tidak boleh kosong.',
        ]);
        $exists = booking::where('kode_pesanan', $this->nota)->first();
        $this->booking = $exists;
        // dd($exists);
        if ($exists) {
            // Periksa apakah booking sudah dirating
            if ($exists->rating) {
                $this->isValid = false;
                session()->flash('error', 'Booking ini sudah dirating.');
            } else {
                $this->isValid = true;
                session()->flash('message', 'Silakan pilih rating.');
            }
        } else {
            $this->isValid = false;
            session()->flash('error', 'Kode pesanan tidak ditemukan.');
        }
         // Reset error message jika validasi berhasil
    }

    public function submit()
    {
        // Validasi
        
       if($this->rating == null){
        session()->flash('error', 'Rating harus diisi');
       } else{
        $user_id = $this->booking->teknisi->user_id;
        modelRating::create([
            'user_id' => $user_id,
            'booking_id' => $this->booking->id,
            'rating' => $this->rating
        ]);
        session()->flash('message', 'Terima kasih atas feedback Anda!');
       }
        // Simpan rating ke database (sesuaikan dengan model jika diperlukan)
        // RatingModel::create(['rating' => $this->rating]);

    }
    public function render()
    {
        return view('livewire.rating');
    }
}
