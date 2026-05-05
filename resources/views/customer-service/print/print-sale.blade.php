<div id="spk-print" style="width:80mm; padding:10px; font-family: monospace; text-align:center;">

    <!-- HEADER -->
    <div style="text-align:center;">
        <img src="{{ asset('images/logofix.png') }}" style="width:90px; margin:auto;">
        <h2 style="margin:5px 0;"></h2>
        <small>Manukan Kerto 6 No 1, Surabaya</small><br>
        <small>Telp. 085188648868</small>
    </div>

    <hr style="border-top:1px dashed #000; margin:10px 0;">

    <!-- INFO SALE -->
    <strong>{{ $sale->kode_pesanan }}</strong><br>
    <small>{{ $sale->created_at }}</small>

    <hr style="border-top:1px dashed #000; margin:10px 0;">

    <!-- CUSTOMER -->
    <table style="width:100%; font-size:12px;">
        <tr>
            <td>Customer</td>
            <td>: {{ $sale->customer->nama ?? '-' }}</td>
        </tr>
    </table>

    <hr style="border-top:1px dashed #000; margin:10px 0;">

    <!-- DETAIL SALE -->
    <div style="text-align:left; font-size:12px;">
        <strong>Detail Pembelian:</strong><br>

        @foreach($sale->detailSale as $item)
            <div style="display:flex; justify-content:space-between;">
                <span>{{ $item->sparepart->nama_sparepart }}</span>
                <span>Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
            </div>
        @endforeach
    </div>

    <hr style="border-top:1px dashed #000; margin:10px 0;">

    <!-- PEMBAYARAN -->
    <table style="width:100%; font-size:12px;">

        <tr>
            <td><strong>Total Tagihan</strong></td>
            <td style="text-align:right;">
               <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong> 
            </td>
        </tr>
        <tr>
            <td>Total Bayar</td>
            <td style="text-align:right;">
                Rp {{ number_format($sale->nominal_bayar, 0, ',', '.') }}
            </td>
        </tr>

        <tr>
            <td>Kembalian</td>
            <td style="text-align:right;">
                Rp {{ number_format($sale->kembalian, 0, ',', '.') }}
            </td>
        </tr>
    </table>

    <hr style="border-top:1px dashed #000; margin:10px 0;">

    <!-- STATUS -->
    @if($sale->kembalian >= 0)
        <div style="text-align:center; font-weight:bold; margin-top:5px;">
            ✔ LUNAS
        </div>
    @else
        <div style="text-align:center; font-weight:bold; margin-top:5px;">
            ⚠ BELUM LUNAS
        </div>
    @endif

    <hr style="border-top:1px dashed #000; margin:10px 0;">

    <h3 style="margin:5px 0;">TERIMA KASIH</h3>

</div>
<script>
window.addEventListener('load', () => {
    setTimeout(() => {
        window.print();
    }, 300); // kasih waktu render
});
</script>