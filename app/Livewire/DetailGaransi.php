<?php

namespace App\Livewire;
use App\Models\booking;
use App\Models\claimGaransi;
use Livewire\Component;

class DetailGaransi extends Component
{
    public $booking;
    public $garansi;
    public function mount($id)
    {
        $booking = booking::where('user_id', auth()->id())->get();
        $this->garansi = claimGaransi::with('booking')->whereIn('booking_id', $booking->pluck('id'))->findOrFail($id);
    }
    public function render()
    {
        return view('livewire.detail-garansi');
    }
}
