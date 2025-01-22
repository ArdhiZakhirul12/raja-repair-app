<?php

namespace App\Livewire;

use App\Models\booking;
use Livewire\Component;

class DetailBooking extends Component
{
    public $bookingId;
    public $bookings;
    

    public function mount($id)
    {
        $this->bookingId = $id;
        $this->bookings = booking::with(['sparepart_booking','detailBooking'])->where('id',$id)->get();
       
    }
    public function render()
    {
        return view('livewire.detail-booking');
    }
}
