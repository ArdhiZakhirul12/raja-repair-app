<?php

namespace App\Console\Commands;
use App\Models\booking;
use App\Services\WaService;
use Carbon\Carbon;

use Illuminate\Console\Command;

class SendWarrantyReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'warranty:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kirim pengingat garansi 2 hari sebelum habis';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $wa = new WaService();
        $targetDate = Carbon::now()->addDays(2)->format('Y-m-d');
        $count = 0;
        $bookings = booking::where('status', 'selesai')->where('updated_at', '>=', Carbon::now()->subDays(90))->get();
        foreach ($bookings as $booking) {
            if ($booking->garansi == '1') {
                $newDate = $booking->updated_at->copy()->addDays(14);
            } elseif ($booking->garansi == '2') {
                $newDate = $booking->updated_at->copy()->addDays(30);
            } elseif ($booking->garansi == '3') {
                $newDate = $booking->updated_at->copy()->addDays(90);
            }
            // var_dump($targetDate);
            // var_dump((string)$newDate->format('Y-m-d'));
            if ($targetDate == (string)$newDate->format('Y-m-d')) {
                // var_dump($targetDate);
                $date = (string)$newDate->format('d F Y');
                $message = "Halo {$booking->customer_name}, garansi servis Anda akan berakhir pada {$date}. Jika masih ada kendala, segera hubungi kami.";
                $wa->sendMessage($booking->customer->no_hp, $message);
                $count + 1;
            }   
        }
        $wa->sendMessage('081238560827', "jumlah terkirim :{$count}");
        
        // $transactions = Transaction::whereDate('warranty_end', $targetDate)->get();

        // foreach ($bookings as $trx) {
        //     $message = "Halo {$trx->customer_name}, garansi servis Anda akan berakhir pada {$trx->warranty_end}. Jika masih ada kendala, segera hubungi kami.";
        //     $wa->sendMessage($trx->customer_phone, $message);
        // }

        $this->info('Pengingat garansi berhasil dikirim.');
    }

}
