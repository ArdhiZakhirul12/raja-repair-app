<?php

namespace App\Livewire;

use App\Models\booking;
use App\Models\dataService;
use App\Models\metodePembayaran;
use App\Models\sparepart;
use App\Models\teknisi;
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
    public $isModalDone = false;
    public $isEditTeknisi = false;
    public $teknisis = [];
    public $selectedTeknisi  ;
    public $metode = []  ;
    public $metodeSelected  ;
    public $bayar  ;
    public $catatan  ;

    protected $rules = [
        'metodeSelected' => 'required',
        'bayar' => 'required|numeric|min:1',
        'catatan' => 'nullable|min:1',
    ];

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
        $teknisi = $this->booking->teknisi_id;
        $this->teknisis = teknisi::where('user_id',auth()->id())->whereNot('id', $teknisi )->get();
        $this->metode = metodePembayaran::whereNot('id',1)->get();


    }

    public function editTeknisi()
    {
        if($this->selectedTeknisi == null){
            session()->flash('success', 'Pilih Teknisi Dengan benar !');
        } else{
            booking::where('id',$this->bookingId)->update(['teknisi_id' => $this->selectedTeknisi]);
            session()->flash('success', 'Berhasil memperbarui teknisi!');
            $this->isEditTeknisi = false;
        }

    }

    public function selesaikan()
    {
        $this->validate();

        $saveBooking = [
            'status' => 'selesai',
            'total' => $this->total,
            
        ];
        if ($this->catatan != null) {
            $saveBooking["keterangan"] = $this->catatan;
        }

        $save = booking::where('id',$this->bookingId)->update($saveBooking);

        teknisi::where('id',$this->booking->teknisi_id)->increment('servis');
        teknisi::where('id',$this->booking->customer_id)->increment('servis');
        
        $detailService = $this->booking->detailBooking;
        foreach ($detailService as $detail) {
            # code...
            dataService::where('id',$detail->data_service_id)->increment('booking');
        }
        $detailSparepart = $this->booking->sparepart_booking;
        foreach ($detailSparepart as $detail) {
            # code...
            sparepart::where('id',$detail->sparepart_id)->increment('terjual');
        }

        $kembalian = $this->total - $this->bayar;
        $this->isModalDone = false;

        session()->flash('doneMsg', 'Berhasil menyelesaikan servis! Kembalian Rp'.$kembalian);


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
