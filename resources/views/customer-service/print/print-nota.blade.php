<div id="spk-print" style="width:80mm; padding:10px; font-family: monospace; text-align:center;">

    <div style="text-align:center;">
        <img src="{{ asset('images/logofix.png') }}" style="width:120px; margin:auto;">
        <h2 style="margin:5px 0;"></h2>
        <small>Manukan Kerto 6 No 1, Surabaya</small><br>
        <small>Telp. 085188648868</small>
    </div>
    

    <hr style="border-top:1px dashed #000; margin:10px 0;">

    <strong>{{ $booking->kode_pesanan }}</strong><br>
    <small>{{ $booking->created_at }}</small>

    <hr style="border-top:1px dashed #000; margin:10px 0;">

    <table style="width:100%; font-size:12px;">
        <tr>
            <td>Nama</td>
            <td>: {{ $booking->customer->nama }}</td>
        </tr>
        <tr>
            <td>No HP</td>
            <td>: {{ $booking->customer->no_hp }}</td>
        </tr>
    </table>

    <hr style="border-top:1px dashed #000; margin:10px 0;">

    <div style="font-size:12px;">
        <strong>Kendala:</strong><br>
        {{ $booking->kendala }}
    </div>

    {{-- <hr style="border-top:1px dashed #000; margin:10px 0;"> --}}
    <hr style="border: none; border-top: 2px dashed rgba(0, 0, 0, 0.413); margin: 10px 0;">

<div style="font-size:12px; text-align:left; padding:0 5px;">

    <table style="width:100%;">
        <tr>
            <td>Total Tagihan</td>
            <td style="text-align:right;">
                Rp {{ number_format($total, 0, ',', '.') }}
            </td>
        </tr>

        <tr>
            <td>Total Dibayar</td>
            <td style="text-align:right;">
                Rp {{ number_format($totalBayar, 0, ',', '.') }}
            </td>
        </tr>

        <tr>
            <td style="font-weight:bold;">Sisa Bayar</td>
            <td style="text-align:right; font-weight:bold;">
                Rp {{ number_format($sisaBayar, 0, ',', '.') }}
            </td>
        </tr>
    </table>

</div>
@if($sisaBayar <= 0)
    <div style="text-align:center; font-weight:bold; margin-top:5px;">
        ✔ LUNAS
    </div>
@else
    <div style="text-align:center; font-weight:bold; margin-top:5px;">
        ⚠ BELUM LUNAS
    </div>
@endif

<hr style="border: none; border-top: 2px dashed rgba(0, 0, 0, 0.413); margin: 10px 0;">

    <h3>TERIMA KASIH</h3>

</div>