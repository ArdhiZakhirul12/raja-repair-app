<?php

namespace App\Livewire;

use App\Models\booking;
use App\Models\dataService;
use App\Models\metodePembayaran;
use App\Models\sparepart;
use App\Models\teknisi;
use Http;
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
    public $statusGaransi;

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
        if($this->booking->garansi == '0'){
            $this->statusGaransi = 'Tidak garansi';
        } elseif($this->booking->garansi == '1'){
            $this->statusGaransi = '14 hari';
        } elseif($this->booking->garansi == '2'){
            $this->statusGaransi = '30 hari';
        } elseif($this->booking->garansi == '3'){
            $this->statusGaransi = '90 hari';

        }
        


    }

    public function editTeknisi()
    {
        if($this->selectedTeknisi == null){
            session()->flash('success', 'Pilih Teknisi Dengan benar !');
        } else{
            booking::where('id',$this->bookingId)->update(['teknisi_id' => $this->selectedTeknisi]);
            session()->flash('success', 'Berhasil memperbarui teknisi!');
            $this->isEditTeknisi = false;
            $this->booking = Booking::with(['sparepart_booking', 'detailBooking'])->find($this->bookingId);
        }

    }

    public function selesaikan()
    {
        // dd($this->booking->customer->no_hp);
        $this->validate();

        $saveBooking = [
            'status' => 'selesai',
            'total' => $this->total,
            'metode_pembayaran_id' => $this->metodeSelected
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

        $kembalian = $this->bayar - $this->total;
        $metodeNow = metodePembayaran::where('id',$this->metodeSelected)->first();

        $message = "*📌 Nota Elektronik*\n"
        ."🏠 *Raja Repair*\n"
        ."📍 Jl. Raya Kedung Turi No. 1, Kedung Turi, Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61257\n\n"
        
        ."🔖 *Kode Pemesanan:* {$this->booking->kode_pesanan}\n"
        ."👤 *Nama:* {$this->booking->customer->nama}\n"
        ."🛠 *Kendala:* {$this->booking->kendala}\n"
        ."👨‍🔧 *Teknisi:* {$this->booking->teknisi->nama}\n"
        ."💳 *Pembayaran:* {$metodeNow->metode}\n"
        ."💰 *Total:* Rp. ".number_format($this->total, 0, ',', '.')."\n"
        ."💵 *Bayar:* Rp. ".number_format($this->bayar, 0, ',', '.')."\n"
        ."🔄 *Kembalian:* Rp. ".number_format($kembalian, 0, ',', '.')."\n\n"
        
        ."Mohon mengisi review untuk kami di link berikut!"."\n"
        ."https://maps.app.goo.gl/4N8Vyt7oCazwiXbu5"."\n"
        ."🙏 Terima kasih telah menggunakan layanan kami.\n"
        ."Silakan hubungi kami jika ada pertanyaan lebih lanjut.\n"
        ."📞 *Raja Repair*";
    
    
        Http::withHeaders([
            'Authorization' => env('FONNTE_TOKEN')
        ])->post('https://api.fonnte.com/send', [
            'target' => $this->booking->customer->no_hp, // Ganti dengan nomor tujuan dari database atau input user
            'message' => $message,
            'countryCode' => '62',
        ]);
    
        // Redirect atau tampilkan notifikasi
        // session()->flash('message', 'Pesan WA terkirim!');

        $kembalian = $this->total - $this->bayar;
        $this->isModalDone = false;
        // return response()->json(env('FONNTE_TOKEN'));

        session()->flash('doneMsg', 'Berhasil menyelesaikan servis! Kembalian Rp'.$kembalian);
        // $this-> dispatch("print-invoice");


    }
    public function closeAndPrint()
    {
        $this->dispatch('print-invoice');
        $this->isModalDone = false;
        return redirect()->to(request()->header('Referer'));
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
