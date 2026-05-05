<?php

namespace App\Console\Commands;
use App\Models\booking;
use App\Models\User;
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
        // var_dump($bookings);
        foreach ($bookings as $booking) {
            if ($booking->garansi == '1') {
                $newDate = $booking->updated_at->copy()->addDays(14);
            } elseif ($booking->garansi == '2') {
                $newDate = $booking->updated_at->copy()->addDays(30);
            } elseif ($booking->garansi == '3') {
                $newDate = $booking->updated_at->copy()->addDays(90);
            }


            if ($targetDate == (string) $newDate->format('Y-m-d')) {
                // var_dump($targetDate);
                $log = User::where('id', $booking->user_id)->first();
                $date = (string) $newDate->format('d F Y');
                $cleanNumber = preg_replace('/[^0-9]/', '', $log->cabang->no_hp);

                // Handle semua kemungkinan format:
                if (str_starts_with($cleanNumber, '0')) {
                    $formattedTo = 'wa.me/62' . substr($cleanNumber, 1);
                } elseif (str_starts_with($cleanNumber, '62')) {
                    $formattedTo = 'wa.me/' . $cleanNumber;
                } else {
                    $formattedTo = 'wa.me/' . $cleanNumber; // Untuk format internasional lain
                }
                $message = "*📢 Pengingat Garansi Servis*\n"
                    . "🏠 *Raja Repair {$log->cabang->nama}*\n"
                    . "📍 {$log->cabang->alamat}\n\n"

                    . "👤 *Nama:* {$booking->customer->nama}\n"
                    . "🛠 *History service:* {$booking->kendala}\n"
                    . "📅 *Masa Garansi Berakhir:* {$date}\n\n"

                    . "Jika masih ada kendala, segera claim garansimu atau hubungi kami sebelum masa garansi berakhir.\n"
                    . "📞 *{$formattedTo}*\n"
                    . "🙏 Terima kasih telah mempercayakan servis kepada kami.";

                $wa->sendMessage($booking->customer->no_hp, $message);
                $count = $count + 1;
            }
        }
        $wa->sendMessage('081238560827', "jumlah terkirim : {$count}");



        $this->info('Pengingat garansi berhasil dikirim.');
    }

}
