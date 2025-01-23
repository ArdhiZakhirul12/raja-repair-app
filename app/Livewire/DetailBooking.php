<?php

namespace App\Livewire;

use App\Models\booking;
use App\Models\dataService;
use Livewire\Component;

class DetailBooking extends Component
{
    public $bookingId;

    public $total;
    public $booking;
    public $removeServiceId = [];
    public $serviceOld = [];
    public $serviceId = [];
    public $services = []; // List of all available services
    public $selectedService = null; // Service selected from dropdown
    public $addedServices = [];
    public $isModalOpen = false;

    
    public function mount($id)
    {

        $this->bookingId = $id;
        $this->booking = booking::with(['sparepart_booking', 'detailBooking'])->where('id', $id)->first();
        $this->serviceOld = $this->booking->detailBooking;
        $this->serviceId = $this->booking->detailBooking->pluck('data_service_id');
        $this->services = dataService::where('user_id', auth()->id())->whereNotIn('id', $this->serviceId)->get();
        $totalService = $this->booking->detailBooking->sum('harga');
        $totalSparepart = $this->booking->sparepart_booking->sum('harga');
        $this->total = $totalService + $totalSparepart;
        $this->addedServices = $this->booking->detailBooking;
        $this->addedServices = [];


    }
    public function rest()
    {;
        $this->serviceOld = $this->booking->detailBooking;
        $this->serviceId = $this->booking->detailBooking->pluck('data_service_id');
        $this->services = dataService::where('user_id', auth()->id())->whereNotIn('id', $this->serviceId)->get();
        $totalService = $this->booking->detailBooking->sum('harga');
        $totalSparepart = $this->booking->sparepart_booking->sum('harga');
        $this->total = $totalService + $totalSparepart;
        $this->addedServices = $this->booking->detailBooking;
        $this->addedServices = [];
    }
    public function addService()
    {
        if ($this->selectedService) {
            $service = collect($this->services)->firstWhere('id', $this->selectedService);
            $this->addedServices[] = $service;

        }
    }
    public function removeService($id)
    {
        $this->addedServices = array_filter($this->addedServices, fn($service) => $service['id'] !== $id);
    }
    public function removeServiceOld($id)
    {   $this->removeServiceId[] = $id;
        $this->serviceOld = $this->serviceOld->whereNotIn('id', $id);
    }

    public function save()
    {
        // dd($this->removeServiceId);
        $serviceIds = $this->addedServices;
        if ($serviceIds != null) {
            for ($i = 0; $i < count($serviceIds); $i++)
                \App\Models\detailBooking::create([
                    'booking_id' => $this->bookingId,
                    'data_service_id' => $serviceIds[$i]['id'],
                    'harga' => $serviceIds[$i]['harga'],
                ]);
        }
        $servId = $this->removeServiceId;
        if($servId != null){
                \App\Models\detailBooking::whereIn('id',$servId)->delete();
        }
        $this->rest();
        session()->flash('success', 'Berhasil mengupdate servis!');

        $this->isModalOpen = false; // Close modal after saving
    }
    public function render()
    {
        return view('livewire.detail-booking');
    }
}
