<?php

namespace App\Livewire;

use App\Models\booking;
use Livewire\Component;

class DetailBooking extends Component
{
    public $bookingId;

    public $total;
    public $booking;
    

    public function mount($id)
    {
        
        $this->bookingId = $id;
        $this->booking = booking::with(['sparepart_booking','detailBooking'])->where('id',$id)->first();
        $totalService = $this->booking->detailBooking->sum('harga');
        $totalSparepart = $this->booking->sparepart_booking->sum('harga');
        $this->total = $totalService + $totalSparepart;
       
    }
    public function render()
    {
        return view('livewire.detail-booking');
    }
}
