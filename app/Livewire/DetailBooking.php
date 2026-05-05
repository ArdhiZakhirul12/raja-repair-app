<?php

namespace App\Livewire;

use App\Models\booking;
use App\Models\dataService;
use App\Models\metodePembayaran;
use App\Models\pengeluaran;
use App\Models\sparepart;
use App\Models\teknisi;
use App\Models\pembayaranBooking;
use App\Services\WaService;
use Http;
use Livewire\Component;
use Livewire\WithFileUploads;

class DetailBooking extends Component
{
    use WithFileUploads;

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
    public $isModalBatal = false;
    public $isModalDokumen = false;
    public $isEditTeknisi = false;
    public $teknisis = [];
    public $selectedTeknisi;
    public $metode = [];
    public $metodeSelected;
    public $bayar;
    public $catatan;
    public $statusGaransi;

    public $pengeluaran;
    public $dokumen;
    public $selectedMetode;
    public $tanggal;
    public $referensi;
    public $keterangan;
    public $harga;
    public $jumlah;
    public $dokumenStatus ;
    public $total_dibayar;
    


    protected $rules = [
        'metodeSelected' => 'required',
        'bayar' => 'required|integer|min:1',
        'catatan' => 'nullable|min:1',
    ];

    public function mount($id)
    {
        
        $this->bookingId = $id;
        $this->booking = booking::with(['sparepart_booking', 'detailBooking','pembayaran_booking', 'pembayaran_booking.metodePembayaran'])->where('id', $id)->first();
        // dd($this->booking);
        if ($this->booking->pengeluaran){
            $this->dokumenStatus = 1;
        }elseif(count($this->booking->sparepart_booking) == 0) 
        {
            $this->dokumenStatus = 2;

        }else {
            $this->dokumenStatus = 0;
        }

        $this->total_dibayar = $this->booking->pembayaran_booking?->sum('jumlah');
        
        
        $this->serviceOld = $this->booking->detailBooking;
        $this->serviceId = $this->booking->detailBooking->pluck('data_service_id');
        $this->services = dataService::where('user_id', auth()->id())->whereNotIn('id', $this->serviceId)->get();
        $totalService = $this->booking->detailBooking->sum('harga');
        $totalSparepart = $this->booking->sparepart_booking->sum('harga');
        $this->total = $totalService + $totalSparepart - $this->booking->diskon;
        $this->addedServices = $this->booking->detailBooking;
        $this->addedServices = [];
        $teknisi = $this->booking->teknisi_id;
        $this->teknisis = teknisi::whereHas('cabang', function ($query) {
            $query->where('user_id', auth()->id());
        })->whereNot('id', $teknisi)->get();

        $this->metode = metodePembayaran::whereNot('id', 1)->get();
        if ($this->booking->garansi == '0') {
            $this->statusGaransi = 'Tidak garansi';
        } elseif ($this->booking->garansi == '1') {
            $this->statusGaransi = '14 hari';
        } elseif ($this->booking->garansi == '2') {
            $this->statusGaransi = '30 hari';
        } elseif ($this->booking->garansi == '3') {
            $this->statusGaransi = '90 hari';
        }
        $this->pengeluaran = pengeluaran::where('booking_id', $this->booking->id)->first();

    }
    public function redirectNow()
    {
        return redirect()->route('cs.spending.show', ['id' => $this->pengeluaran->id]);
    }

    public function updated($propertyName, $value)
    {
        if ($propertyName == 'harga' || $propertyName == 'bayar') {
            $value_format = str_replace('.', '', $value);
            $this->$propertyName = (int) $value_format;
        }
        // $value_format = str_replace('.', '', $value);

        // $this->$propertyName = (int) $value_format;

    }

    public function submitDokumen()
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
        $validated['metode_pembayaran_id'] = $validated['selectedMetode'];
        $validated['dokumen'] = $path;
        $validated['booking_id'] = $this->booking->id;
        $validated['harga'] = (int) str_replace('.', '', $validated['harga']);



        pengeluaran::create($validated);
        $this->metodePembayaran = metodePembayaran::all();
        $this->isModalDokumen = false;
        session()->flash('doneMsg', 'Berhasil menambahkan pengeluaran');
        $this->rest();
    }

    public function editTeknisi()
    {
        if ($this->selectedTeknisi == null) {
            session()->flash('success', 'Pilih Teknisi Dengan benar !');
        } else {
            booking::where('id', $this->bookingId)->update(['teknisi_id' => $this->selectedTeknisi]);
            session()->flash('success', 'Berhasil memperbarui teknisi!');
            $this->isEditTeknisi = false;
            $this->booking = Booking::with(['sparepart_booking', 'detailBooking'])->find($this->bookingId);
        }

    }

    public function selesaikan()
    {
        // dd($this->booking->customer->no_hp);
        
        $this->validate([
            'catatan' => 'string',
            'metodeSelected' => 'required',
            'bayar' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) {
                    $kurang_bayar = $this->total - $this->total_dibayar;
                    if ($value < $kurang_bayar) {
                        $fail('Jumlah bayar tidak boleh lebih kecil dari total.');
                    }
                },
            ],
        ]);
        // dd($this->total);
        $saveBooking = [
            'status' => 'selesai',
            'total' => $this->total,
            'metode_pembayaran_id' => $this->metodeSelected
        ];
        if ($this->catatan != null) {
            $saveBooking["keterangan"] = $this->catatan;
        }

        $save = booking::where('id', $this->bookingId)->update($saveBooking);

        teknisi::where('id', $this->booking->teknisi_id)->increment('servis');
        teknisi::where('id', $this->booking->customer_id)->increment('servis');

        $detailService = $this->booking->detailBooking;
        foreach ($detailService as $detail) {
            # code...
            dataService::where('id', $detail->data_service_id)->increment('booking');
        }
        $detailSparepart = $this->booking->sparepart_booking;
        foreach ($detailSparepart as $detail) {
            # code...
            sparepart::where('id', $detail->sparepart_id)->increment('terjual');
        }
        $kurang_bayar = $this->total - $this->total_dibayar;
        $kembalian = $this->bayar - $kurang_bayar;
     
        pembayaranBooking::create([
            'booking_id' => $this->bookingId,
            'metode_pembayaran_id' => $this->metodeSelected,
            'statuss' => 'pelunasan',
            'jumlah'=> $kurang_bayar,
            'nominal_bayar'=> $this->bayar,
            'kembalian' =>  $kembalian
        ]);
        $metodeNow = metodePembayaran::where('id', $this->metodeSelected)->first();
        $log = auth()->user();
        $message = "*📌 Nota Elektronik*\n"
            . "🏠 *Raja Repair {$log->cabang->nama}* \n"
            . "📍 {$log->cabang->alamat}\n\n"

            . "🔖 *Kode Pemesanan:* {$this->booking->kode_pesanan}\n"
            . "👤 *Nama:* {$this->booking->customer->nama}\n"
            . "🛠 *Kendala:* {$this->booking->kendala}\n"
            . "👨‍🔧 *Teknisi:* {$this->booking->teknisi->nama}\n"
            . "💳 *Pembayaran:* {$metodeNow->metode}\n"
            . "💰 *Total:* Rp. " . number_format($this->total, 0, ',', '.') . "\n"
            . "💵 *Bayar:* Rp. " . number_format($this->bayar, 0, ',', '.') . "\n"
            . "🔄 *Kembalian:* Rp. " . number_format($kembalian, 0, ',', '.') . "\n\n"

            . "Mohon mengisi review untuk kami di link berikut!" . "\n"
            . "{$log->cabang->link_map}" . "\n"
            . "🙏 Terima kasih telah menggunakan layanan kami.\n"
            . "Silakan hubungi kami jika ada pertanyaan lebih lanjut.\n"
            . "📞 *{$log->cabang->no_hp}*";
        $wa = new WaService();
        $wa->sendMessage($this->booking->customer->no_hp, $message);

        // Http::withHeaders([
        //     'Authorization' => "XXVYq31@7wamVjUqbFHt"
        // ])->post('https://api.fonnte.com/send', [
        //             'target' => $this->booking->customer->no_hp, // Ganti dengan nomor tujuan dari database atau input user
        //             'message' => $message,
        //             'countryCode' => '62',
        //         ]);

        // Redirect atau tampilkan notifikasi
        session()->flash('message', 'Pesan WA terkirim!');

        $kembalian = $kurang_bayar - $this->bayar;
        $this->isModalDone = false;
        // return response()->json(env('FONNTE_TOKEN'));
        return redirect()->route('print.nota', $this->bookingId);
        session()->flash('doneMsg', 'Berhasil menyelesaikan servis! Kembalian Rp' . $kembalian);

        // $this-> dispatch("print-invoice");


    }

    public function dibatalkan()
    {
        $this->validate([
            'catatan' => 'string',
        ]);
        $saveBooking = [
            'status' => 'dibatalkan',
        ];
        if ($this->catatan != null) {
            $saveBooking["keterangan"] = $this->catatan;
        }

        $save = booking::where('id', $this->bookingId)->update($saveBooking);
        $this->isModalBatal = false;

        session()->flash('doneMsg', 'Berhasil membatalkan servis!');

    }
    public function closeAndPrint()
    {
        $this->dispatch('print-invoice');
        $this->isModalDone = false;
        return redirect()->to(request()->header('Referer'));
    }

    public function rest()
    {
        ;
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
    {
        $this->removeServiceId[] = $id;
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
                    'harga' => (int) str_replace('.', '', $serviceIds[$i]['harga']),
                ]);
        }
        $servId = $this->removeServiceId;
        if ($servId != null) {
            \App\Models\detailBooking::whereIn('id', $servId)->delete();
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
