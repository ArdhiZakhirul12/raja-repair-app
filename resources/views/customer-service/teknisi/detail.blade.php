<x-app-layout>
    <p>jumlah service : {{$bookings->count()}}</p>
    <p>jumlah service garansi : {{$garansi->count()}}</p>
    <p>Total pendapatan : Rp{{number_format($total, 0, ',', '.')}}</p>
</x-app-layout>

{{-- $bookings bisa buat tabel seluruh servis --}}
{{-- $garansi bisa buat tabel servis garansi --}}