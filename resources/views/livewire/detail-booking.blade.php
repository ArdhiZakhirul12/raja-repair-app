<div>
    @if (session()->has('doneMsg'))
    <div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold">Notifikasi</h3>
                <button onclick="document.getElementById('popup').style.display='none'" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <p class="mt-4 text-gray-700">{{ session('doneMsg') }}</p>
            <div class="mt-6 flex justify-end">
                <button onclick="document.getElementById('popup').style.display='none'" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    Tutup
                </button>
            </div>
        </div>
    </div>
@endif

    @if (session('success'))
        <div id="notification"
            class="fixed top-5 right-5 bg-yellow-400 text-white px-6 py-3 rounded shadow-lg z-50 transition-opacity duration-10">
            <p>{{ session('success') }}</p>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const notification = document.getElementById('notification');
                if (notification) {
                    notification.classList.add('opacity-0');
                    setTimeout(() => {
                        notification.classList.remove('opacity-0');
                        notification.classList.add('opacity-100');
                    }, 100);

                    setTimeout(() => {
                        notification.classList.remove('opacity-100');
                        notification.classList.add('opacity-0');
                    }, 2000);

                    setTimeout(() => {
                        notification.remove();
                    }, 3000);
                }
            });
        </script>
        <style>
            #notification {
                transition: opacity 1s ease-in-out;
            }

            .opacity-0 {
                opacity: 0;
            }

            .opacity-100 {
                opacity: 1;
            }
        </style>
    @endif
    <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between my-2 sm:my-2">
            <h1 class="text-2xl md:text-2xl text-gray-800 dark:text-gray-100 font-bold">
                Detail Transaksi Servis
            </h1>
            @if ($booking->status == 'diproses')
                
            <div>
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                    wire:click="$set('isModalOpen', true)">
                    Edit Service
                </button>
                <button class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700"
                    wire:click="$set('isModalDone', true)">
                    Selesaikan
                </button>
            </div>
            @endif




            {{-- <button   class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700"
        onclick="document.getElementById('add-sparepart-modal').classList.remove('hidden')">
        Tambah Sparepart
    </button> --}}
        </div>
        <h1 class="mt-3 text-2md md:text-2md text-blue-700 dark:text-gray-100">
            #{{ $booking->kode_pesanan }}
            <span
                class=" 
                @if ($booking->status == 'diproses') bg-blue-500 text-white
                    text-md ml-4 px-2 py-1.5 rounded ">
                Diproses
                @elseif($booking->status == 'selesai') 
                    bg-green-500 text-white 
                    text-md ml-4     px-2 py-1.5 rounded">
                Selesai @endif 
                
            </span>
        </h1>      
        <h2 class="mt-1
                text-xs md:text-sm text-gray-500 dark:text-gray-100 ">
            Pesanan : {{ $booking->created_at }}
        </h2>

        <div class="flex mt-3">
            <div class="w-4/6 ">
                
                <div class="bg-white rounded shadow-md">
                    <div class="bg-white rounded shadow-md p-4    ">
                        <div class="flex items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="30" height="30" viewBox="0 0 30 30" fill="none">
            
                                <image id="image0_76_220" width="30" height="30"
                                    xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAADZUlEQVR4nO2dsWpUQRiFB8So+AQm+AKCjU9ha/EfUwhapZCIViZWW7gzmyApLFNIwNJOUPEF1CgBIWwQbJx/USNYSURItTLXILjJ7t69O5s7x50D0ywL+32HyT83xXCNycnJyUkr1xufTovV23D+rVj/E067Ka3AJNZvwvpblx9+PGUYc/X+5/OwfrvuMlF+vZdmZ86w7WSykrt/y260ZwxL4PROAqV1qyxxftGwRKx/R1u09ZuGJXB+r+7CUHn5PcOS+svSsZZhSd1FIRettZc4FTvaJBYWTnoBkHDSC4CEk14AJJz0AiDhpBcACSe9AEg46QVAwkkvABJOegGQcNILgISTXgAknPQCIOGkFwAJJ70ASDjpBUDCSS8AEk56AZBw0guAhJNeACSc9AIg4aQXAAknvQBIOOkFQMKZnMC1B7tnxemqOP0m1n+B1RV50j2RGme01CEg1l+A053Dv+tbKXFGzXELSFNv9L26YXU3Fc7oGVVAGu2Z8GceSoHTr2EXlrlTEkYFnN/o93u56J4UJfcUJFafDyq7/6jIo6Pbr7SDndwtW/bAUfHvbn6UD8MSRRdlO/8yXD4K35O1zhlYXR9esP8lLV0wQzJ1MxrOtwYVJ05foOkvlRsVuhPGyiQ4/4/D0OmzEiUOm8cb4YCcFGdyqSIgxZOHf1qp4JKjIgZnUqkqINXK/iArnYvHyZlMxhGQUcq2+niUURGTM4mMKyDDyq44KmJz1p4YAtK/7MqjYhKctSaWgDTaM2K9C/+Wi/XfYf3aOKNiUpy1hUUAJJz0AiDhpBcACSe9AEg46QVAwkkvABJOegGQcNILgISTXgAknPQCIOGkFwAJJ70ASDjpBUDCSS8AEk56AZBw0guAhJNeACSc9AIg4aQXAAknvQBIOOkFQMI5sgBIlmFJ3UUhF621l5h3tBtawj6svzu/qrNhSUuXis9y0XF3mbR0qXdEidXlXHTkoq80/bneosNnuejIRc+v6uyhHd3szOWiY48Oq8tHPN3cy0XHP6T2Q9nFQfhnJ4eSp/0w5H3hjTj9YVhSvLougdJQZVl9bVgS3g9Ye2Gu6urcNCwJ14rDK+sId/PWwvrWScOUgwOLp2yrW0c9q1OkuIPi/KI4fZPmAen3xOmrMC7odnJOTo6ZgvwGAxegPr5PH1wAAAAASUVORK5CYII=" />
            
                            </svg>
                            <h2 class="text-l font-semibold ">Data Handphone</h2>
                        </div>
                        <hr class="my-2">
                        <div id="keterangan" class="border-bottom pb-2 mb-3" >
                            <h2 class="mt-1
                                text-xs md:text-sm text-gray-500 dark:text-gray-100 ">
                                Merk HP : {{ $booking->hpModel->hpMerk->merk }}
                            </h2>
                            <h2 class="mt-1
                                text-xs md:text-sm text-gray-500 dark:text-gray-100 ">
                                Model HP : {{ $booking->hpModel->model }}
                            </h2>
                            <h2 class="mt-1
                                text-xs md:text-sm text-gray-500 dark:text-gray-100 ">
                                Imei : {{ $booking->imei }}
                            </h2>
                        </div>
                        <div class="flex items-center mb-2">
                
                            <h2 class="text-l text-blue-500">Rincian Servis</h2>
                        </div>
            
                              
                            <table class="min-w-full table-auto rounded-lg overflow-hidden">
                                <thead class="bg-blue-100">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-gray-500 font-semibold text-l">Code</th>
                                        <th class="px-4 py-2 text-left text-gray-500 font-semibold text-l">Servis/Sparepart</th>
                                        <th class="px-4 py-2 text-left text-gray-500 font-semibold text-l">Tipe Servis</th>
                                        <th class="px-4 py-2 text-left text-gray-500 font-semibold text-l">Harga</th>
                                    </tr>
                                </thead>
                                <tbody class="border-bottom">
                                       @foreach ($booking->detailBooking as $item)
                <tr class="">
                    <th class="px-4 py-2 text-gray-500">{{ $item->dataService->code }} </th>
                    <td class="px-4 py-2 text-gray-500">{{ $item->dataService->nama_servis }} </td>
                    <td class="px-4 py-2 text-gray-500">{{ $item->dataService->jenis_servis }} </td>
                    <td class="px-4 py-2 text-gray-500">Rp{{ number_format($item->harga, 0, ',', '.') }},- </td>
                </tr>
                @endforeach
                @foreach ($booking->sparepart_booking as $item)
                    <tr class="">
                        <th class="px-4 py-2 text-gray-500">{{ $item->sparepart->code }} </th>
                        <td class="px-4 py-2 text-gray-500">{{ $item->sparepart->nama_sparepart }} </td>
                        <td class="px-4 py-2 text-gray-500">Sparepart </td>
                        <td class="px-4 py-2 text-gray-500">Rp{{ number_format($item->harga, 0, ',', '.') }},- </td>
                    </tr>
                @endforeach
                <tr class="border-top ">
                    <td></td>
                    <td></td>
                    <td class="px-4 text-right">
                        <h2 class="text-l font-semibold">Total :</h2>
                    </td>
                    <td class="px-4 py-2">
                        <h2 class="text-l font-semibold">Rp{{ number_format($total, 0, ',', '.') }},-</h2>
                    </td>
                </tr>
                </tbody>
                </table>

    </div>
   
</div>

{{-- DESAI STRUK PEMBAYARAN --}}

<div class="bg-white rounded shadow-md p-4 my-3 w-4/6 " style="display:none" id="struk-pembayaran">
    <div class="struk-header">
        <div class="logo-center justify-center text-center">
            <img src="{{ asset('images/logo_raja.png') }}" alt="logo" class="w-20 h-20 mx-auto">
        </div>
        <div class="address-center text-center">
            <h1 class="text-2xl font-bold pb-3">Raja Servis HP</h1>
            <p class="text-sm pb-2">Jl. Raya Kedung Turi No. 1, Kedung Turi, Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur
                61257</p>
            <p class="text-sm font-bold">Telp. 0812-3456-7890</p>
        </div>
        <hr style="border: none; border-top: 2px dashed rgba(0, 0, 0, 0.413); margin: 20px 0;">
        <div class="text-center">
            <h3 class="text-l font-bold pb-3">#{{ $booking->kode_pesanan }}</h3>
            <h3 class="text-l ">Pemesanan: 12-20-2024</h3>
        </div>

        <hr style="border: none; border-top: 2px dashed rgba(0, 0, 0, 0.413); margin: 20px 0;">

        <div class="text-left">
            <p class="text-sm pb-2">Nama      : {{ $booking->customer->nama }}</p>
            <p class="text-sm pb-2">No.HP     : {{ $booking->customer->no_hp }}</p>
            <p class="text-sm pb-2">Kendala   : {{ $booking->kendala }}</p>
            <p class="text-sm pb-2">Teknisi   : {{ $booking->teknisi->nama }}</p>
            <p class="text-sm pb-2">Hp Teknisi: {{ $booking->teknisi->no_hp }}</p>
        </div>

     


        <hr style="border: none; border-top: 2px dashed rgba(0, 0, 0, 0.413); margin: 20px 0;">

        <div class="flex justify-center">
            <table class="rounded-lg overflow-hidden text-center">
            <thead class="border-b-2">
                <tr>
                <th class="px-4 py-2 text-left text-gray-500 font-semibold text-l">Code</th>
                <th class="px-4 py-2 text-left text-gray-500 font-semibold text-l">Servis/Sparepart</th>
                <th class="px-4 py-2 text-left text-gray-500 font-semibold text-l">Tipe</th>
                <th class="px-4 py-2 text-left text-gray-500 font-semibold text-l">Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($booking->detailBooking as $item)
                <tr>
                    <td class="px-4 py-2 text-gray-500">{{ $item->dataService->code }}</td>
                    <td class="px-4 py-2 text-gray-500">{{ $item->dataService->nama_servis }}</td>
                    <td class="px-4 py-2 text-gray-500">{{ $item->dataService->jenis_servis }}</td>
                    <td class="px-4 py-2 text-gray-500">Rp{{ number_format($item->harga, 0, ',', '.') }},-</td>
                </tr>
                @endforeach
                
                @foreach ($booking->sparepart_booking as $item)
                <tr>
                    <td class="px-4 py-2 text-gray-500">{{ $item->sparepart->code }}</td>
                    <td class="px-4 py-2 text-gray-500">{{ $item->sparepart->nama_sparepart }}</td>
                    <td class="px-4 py-2 text-gray-500">Sparepart</td>
                    <td class="px-4 py-2 text-gray-500">Rp{{ number_format($item->harga, 0, ',', '.') }},-</td>
                </tr>
                @endforeach
                
                <tr style="border-top: 2px dashed rgba(0, 0, 0, 0.14); margin: 20px 0;">
                <td><h2 class="text-l font-semibold mt-4">TOTAL :</h2></td>
                <td></td>
                <td class="px-4 text-right"></td>
                <td class="px-4 py-2">
                    <h2 class="text-l font-semibold mt-4">Rp{{ number_format($total, 0, ',', '.') }},-</h2>
                </td>
                </tr>
                
                <tr>
                <td>Bayar</td>
                <td></td>
                <td></td>
                <td class="px-4 py-2">Rp.sekian</td>
                </tr>
                
                <tr>
                <td>Kembali</td>
                <td></td>
                <td></td>
                <td class="px-4 py-2">Rp.sekian</td>
                </tr>
            </tbody>
            </table>
        </div>
        
        <hr style="border: none; border-top: 2px dashed rgba(0, 0, 0, 0.413); margin: 20px 0;">

        <div class="text-center">
            <p class="text-sm">Terima kasih telah mempercayakan servis handphone anda kepada kami</p>
            <p class="text-sm">Semoga handphone anda kembali normal dan berfungsi dengan baik</p></div>
    </div>
</div>




</div>
<div class="w-3/6 pl-4 ">

    <div class="bg-white rounded shadow-md p-4   mb-3">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30"
                height="30" viewBox="0 0 30 30" fill="none" class="mr-2">

                <image id="image0_76_221" width="30" height="30"
                    xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAFIUlEQVR4nO2dW2gcZRSAT70j3sUK3luf1Af1QXySKlqsSlGKS/acTVooGsEblpo9ZxrLKCqIPkhVhKCQdvc/G9k3KxXqrUXESlFUKlYRbQXFS9EH6yWmauTfbJqYmsskM/PP/jMfnJc87M7/8e+Z/3oCUFBQUFBQUFBQUFBQUBCNB4e6LuZ6Za0YekEUd4ji16L0Mxs6JIq/suJ++3dWfJgb5Ssjfny+CQd6T2RD97DiB6I0GiVY8Y1qo3yZ6zZkm1FYxIp3iKEDUQVPkf2HKFZcNyeTyJaeM1lx+0IET5H9Nxu61XW7MkW1XjmPFb+IS/LhsL8MQ/ez4sr1te7FkGdE6XRR/Cx2yUdKH2bFzX2N8jmQy5xsaFvikv8r/FupV66CPMGKq1OVPCH7p35DF0IeuO/VFcez4jdORNuXpaGdkAcCQ3e6kjwe1UZ5OfiOKO5yLVqUXgefWV/rXpwByTZ9HFrXLJ0BvhIo3uZa8kR4PINkxafcC273asWnwVdY8a0Mid4OvsKKe1wLnhRfgq+InZ25FzwWhg6Ar3BrGTMzoofBV9jQQeeCDwf+Ar7Chj53L3gs7LOAr3CMC/wxpI43wVdEcWOGRD8CviKN8tXOBbcjUFwGPsOG9rqWzIpfhWF4FPgMG3rWtWhRfA58JjB0nd2ldi26tVNer1wLviKGtrqWPEn2y+ArnKG1Djb0MfgKG3rPteCJwF3gK6I04F5wOww9D74iijc7FzwejfIK8BlWfMe1ZDb0rj3EAz7TX+teIoofOZOs+CEPdV0EeYEVNzmQvAnyBiuuTF10o3wL5I2wWTpOFH9ITbSh73oHeo+FPCJKnF6Pxnshz3dWxNC+FHLznnDHsmMgz1Qb5eVJLjR5v4AUBTb0UIK5OXDdvqzdynopAclD3k9MolJqlo6OeWw9kNtRxlyIS/ScvizPSCG6EO0V0oE9uu/FtSeLodDem2RDf7KhH+3LfYOhKyCrSIeJtiuB0x+hwBEx1ANZRDpItJU8+8wWR7jWfTlkiaBeuT4u0UG9ck0as1p7/He2Z7FpBDJVq0Oj1+mYoXG7w8E1JyT93FVDN80mmw19D1kgrFdOsYVN4pI8qYHbuFk61bVsewAfnDIKi4J65fYkryzbc3aBoVVJT8VnlG3oE3B3sRPvTvPAoz14zop9QaN89nxffLNdbZ5eNm6ENIugiC1WYminGPorLcH/0+gRm1Kqindt2Lz63EijC0PDVmYk2YY+DZulkyBJgnrlUrtMyYq7xdA/7uROE61nmvkG7RFDuCiyDe1LbMe9OtR1iSg9kaX7KjJ9OnlsXuPkuci2GxqxS7YvNUOrsnA4RpKWHEF2rFQVb7QnM12LkzQlpyk7HFxzmigOupYmMUu2pYAibRgnKbt/qOv8LNxFEdeSJ8uOu6qNKC1t1wl1Lk6yIHlMdLyji3bhqdjWIyStMPTkTO3iLT0X2GoH8/v8VqdbCnEihp5xLk097smtB6p1LxkrKexenvjaky32KoJzceq55PYZud+dy1NP08U4onSDa3nic0+eEI2Pdojkx2fryXZ9el6/EsX9iV/JEEOvdYDkrTMt7mdecku0w8s9MjfJw0GzdFZHS7a4rI4rc5PxSkfm5KlkfcTBhtZ1dE/udFixVkhOAVF6P/PpwpP/I3CwkJww7Zdg0ZPT2GIr0kUKSL3yQJGTM1OEpXjxLRhWfHua8fFvY7tEqHaNfeHflHPY0N627AE7obEVZ1oTEEf3Dv8FYD/aWmoSqxwAAAAASUVORK5CYII=" />

            </svg>
            <h2 class="text-l font-semibold">Data Pelanggan</h2>
        </div>
        <hr class="my-2">
        <div class="p-2 mt-1">

            {{-- <i class="fa-solid fa-user mr-3 text-blue-400"></i> --}}
            <p class="text-l ml-2 mb-3 text-blue-500">{{ $booking->customer->nama }}</p>


            <div class="flex mb-2">
                <div>
                    <div class="flex mb-2 mr-4">
                        <i class="fa-solid fa-phone mr-4 text-green-400"></i>

                        <p class="text-gray-400">{{ $booking->customer->no_hp }} </p>
                    </div>
                </div>

                <div>
                    <div class="flex mb-2">
                        <i class="fa-solid fa-phone mr-4 text-yellow-400"></i>
                        <p class="text-gray-400">{{ $booking->no_hp_alternatif }} </p>
                    </div>
                </div>


            </div>

            <div class="flex mb-2">
                <i class="fa-solid fa-location-dot text-red-500 mr-4"></i>
                <p class="text-gray-400">{{ $booking->customer->alamat }}
                </p>
            </div>

            {{-- <p>Pilih Teknisi</p> --}}


            <div class="flex mb-2 ">
                <i class="fa-solid fa-bars-progress text-orange-500 mr-3"></i>
                <p class="text-gray-400">{{ $booking->kendala }}</p>
            </div>


            <!-- Add more details as needed -->
        </div>
    </div>


    <div class="bg-white rounded shadow-md p-4 mb-3">
        <div class="flex items-center ">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30"
                height="30" fill="none">

                <image id="image0_26_74" width="30" height="30"
                    xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAFZUlEQVR4nO2dXWgkRRDHS7mIioqniF+gvijooyFbtblAFB9ERBCN+AXiJ6I+6IN4hy9RQbwTFdQz3rpVGz/eTnxRFBSVexHF84TDU0RBFLnTeDHZ7k3UqJeR2j1FcjuzO5udne7Z/kHBPsxHzT893V091RWAQCAQCAQCgUAgEAikJ9p50TGGcZsROmCFonZmBPcboa16bA+3CCgqYJzARwpOW5snBdKT1JKPEJrppx5uEVC6Fflfa54USE8Quo9EldGRrIVOusdQ0ODyZUZoX9ZCW6ZvDJeuhGFjcRbPs4xvdRSoX0L/dwy+ucDlc2EYaHDpUsM4l06gfglNkWWar9fKl0NRiSI4yjJuNox/rxVomcfPWnv88st0dlqhu72OYVptBjnTcDQUTWTDNBMrEuPmtedYwS1phU57HcO4XX2DomAZn+kQbKyoSNoi1Votn1bSCt3TdZiegiJgmB5L3TIHbEbwEfAZI3iF9ofWATE7vAmrpkpXgY80qni6Efo5bxFt12LjL+0GUx8Gvw/yFs+m70LeB5+wVbwmb9Fsr8blq8EHounJDUboq9wFk14Nv9ZnANexVbo7f7FofVajO8F1/G7N1LSkhS4nMIKYt0i2T1av4ii4SmKYLb4ZPgfOTumEDuYvEPVtXu3kOoit4oV5i2P7LfZLYxeAaxjB2wontNAt4BpGcEcBhX4BXMMw7iqg0B+CaxjBLwoo9F5wDc2BK6DQP4JrGMbfCyc042/gGukfgvQT00PerQHnTT8+pAYyEHqpMnpmEHYAQi+HLqM3Qtfh8mDIrRyMQfnoFfsro8draGqF6nlPv+ygjXGxmd20k47LXOgirmnYtG+j4I5MRdakQJ3E5/2gNn9bzjRBMghNgxFaCV0HadfxImSNDgRW8HkdGBx4haPBGi7ot8SBDIZx9OQ4k2nU8Pq8fDaCj3fyEVwjjcBGtxUzbtNsfAdyBF8vhNDNlFjGXYbxUSulKVPD88EhrEycZgV/9V5oy3gvOI5m/Xsv9PxrpZPAcZIyrMA1vHG0DfUqneKN/9446rv/3jjqu/9G6FA7R31I6o6mJze0n4bSIXCNuGXTpdmxM8BxmnsSYyJBcA3LuKedsw3GG8Bx6lW6Kabr+Ay82R2rJRxeGTsVHEV9s4Lfxgj9NHiW7f+drmm4JLj6oj6pb3F+16tUAjcT0fHzBLEjHVy0jIQTpSxiBu//RbR7nExEV2yVNnXakmyYKnn7qT508HHV8HgZXEY3sCe2FEGbZ1iu91YfklszTYMP6Dpv0qtpGO/Pzzd6IKlrU9/BJ6zghBV6L0bouYM8fmIerVk3AcUI/a76DD5Sn5nYGPfV3ORQ4tIKPhnTVSwtzk6eDD5jmZ6NnYFU8ZKB+SE40a6eU2Gq0GjWqInNBcHvtdUPZhkUf4jpMpa1tggUAcs0nTDKf5xlf92cZTB9kjDDeBiKVQeavkwIDj6a2z55QiZ5ggm7xXRzfeHqTptaedwI/Zkg9qcLlU3n9Ot+WrHRCu1OCEpWdNkAiogVvKdDoDBvGG9dT+jbSiEo3570ZfvwH/YuKDKmQ/h72HZbxmvTfDRoLd6XpuKWawee0pU3UWV0xAi90YXYzRZuBcUK3bFYo4t1BhPNTh6rpr+1poZWi7FMtdaxna+pCTNDU+Y4qoyOWKFXuxK7n8ZU8+HTWv+LwgpuMYJ/ZS2wDsKGSw/CMFOvUinLOkw6hXO6bM+gu5KGlO7T/zzRR4EP6Cxn6LqKbtDgoc50s5Zv6KVL0XO0gmRdyjcWLhDJivrMxMYGl68zTE9Ypnc0stRWagT/aJn+pn2W6e3mMVKa8n4FLhAIBAKBQADWyz+oAe9kkGkpgAAAAABJRU5ErkJggg==" />

            </svg>
            <h2 class="text-l font-semibold ">Teknisi</h2>
        </div>
        <hr class="my-2">
        <div class="flex mb-2">
            <i class="fa-solid fa- text-red-500 mr-4"></i>
            <p class="text-blue-500">{{ $booking->teknisi->nama }}
            </p>
        </div>
        <div class="flex mb-2">
            <i class="fa-solid fa-phone text-green-500 mr-4"></i>
            <p class="text-gray-500">{{ $booking->teknisi->no_hp }}
            </p>
        </div>

        @if ($isEditTeknisi == true)

            <select id="dataDropdown" name="dataDropdown"
                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                wire:model="selectedTeknisi">>
                <option selected>Pilih Teknisi</option>
                @foreach ($teknisis as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </select>
            <button class="bg-gray-500 text-white my-2 px-2 py-1 rounded hover:bg-gray-600"
                wire:click="$set('isEditTeknisi', false)">
                Batal
            </button>
            <button class="bg-yellow-400 text-white my-2 px-2 py-1 rounded hover:bg-yellow-500"
                wire:click="editTeknisi">
                Simpan
            </button>
        @else
        @if ($booking->status == 'diproses')

            <button class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600"
                wire:click="$set('isEditTeknisi', true)">
                Ubah Teknisi
            </button>
            @endif
        @endif


    </div>
</div>
<!-- Success Dialog -->
{{-- <div id="successDialog"
    class="hidden fixed top-20 right-10 bg-green-500 text-white p-4 rounded shadow-md transition-opacity duration-1000">
    Success! Data teknisi has been updated.
</div>

<script>
    function showSuccessDialog() {
        const dialog = document.getElementById('successDialog');
        dialog.classList.remove('hidden');
        setTimeout(() => {
            dialog.classList.add('hidden');
        }, 2000); // Hide after 2 seconds
    }
</script> --}}
</div>


</div>
@if ($isModalOpen)
    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 relative">
            <!-- Close Button -->
            <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700"
                wire:click="$set('isModalOpen', false)">
                ✕
            </button>

            <div class="flex mb-4 items-center">
                <i class="fa-solid fa-pen-to-square mr-2" style="color: #74C0FC;"></i>
                <h2 class="text-lg font-bold">Edit Detail Service</h2>
            </div>

            

            <!-- Select Service -->
            <div class="flex items-center mb-4">
                <div class="flex-grow">
                    <select wire:model="selectedService" required class="border rounded px-4 py-2 w-full">
                        <option value="" selected>-- Select Service --</option>
                        @foreach ($services as $service)
                            <option value="{{ $service['id'] }}">{{ $service['nama_servis'] }} -
                                Rp{{ $service['harga'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="ml-2">
                    <button wire:click="addService"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Add Service
                    </button>
                </div>
            </div>

            <!-- Services Table -->
            <table class="w-full table-auto border-collapse border border-gray-300 min-w-full rounded-lg overflow-hidden">
                <thead >
                    <tr class="bg-blue-100">
                        <th class="border px-4 py-2 text-left">Service Name</th>
                        <th class="border px-4 py-2 text-left">Price</th>
                        <th class="border px-4 py-2 text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($serviceOld as $service)
                        <tr>
                            <td class="border px-4 py-2">{{ $service->dataService->nama_servis }}</td>
                            <td class="border px-4 py-2">Rp{{ $service['harga'] }}</td>
                            <td class="border px-4 py-2 text-center">
                                
                                <button wire:click="removeServiceOld({{ $service['id'] }})"
                                    class=" text-white px-3 py-1 rounded ">
                                    <i class="fa-solid fa-trash-can" style="color: #ee5d5d;"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    @forelse($addedServices as $service)
                        <tr>
                            <td class="border px-4 py-2">{{ $service->nama_servis }}</td>
                            <td class="border px-4 py-2">Rp{{ $service['harga'] }}</td>
                            <td class="border px-4 py-2 text-center">
                                <button wire:click="removeService({{ $service['id'] }})"
                                    class=" text-white px-3 py-1 rounded">
                                    <i class="fa-solid fa-trash-can" style="color: #ee5d5d;"></i>
                                </button>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="3" class="border px-4 py-2 text-center text-gray-500">No services added
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Save Button -->
            <div class="mt-4 flex justify-end">
                <button class="bg-red-300 text-white px-4 py-2 rounded hover:bg-red-400 mr-2"
                wire:click="$set('isModalOpen', false)">
                Kembali
            </button>
                <button wire:click="save" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 mr-2">
                    Simpan
                </button>

            </div>

            <!-- Success Message -->
            @if (session()->has('message'))
                <div class="mt-4 p-2 bg-green-100 text-green-800 rounded">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </div>
@endif
@if ($isModalDone)
    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white w-11/12 max-w-3xl rounded-lg shadow-lg">
            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b px-6 py-4">
                <h2 class="text-lg font-bold">Kode Pesanan: <span class="text-blue-600">#{{ $booking->kode_pesanan }}</span></h2>
                <button class="text-gray-500 hover:text-red-600"  wire:click="$set('isModalDone', false)">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="p-6 space-y-6 overflow-y-auto max-h-[75vh]">
                <!-- Customer Data and Handphone Data Side by Side -->
                <div class="flex space-x-4">
                    <!-- Customer Data -->
                    <div class="w-1/2">
                        {{-- <h3 class="text-sm font-semibold mb-2">Data Customer</h3> --}}
                        <div class="flex items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20"
                                height="20" viewBox="0 0 20 20" fill="none" class="mr-2">
                
                                <image id="image0_76_221" width="20" height="20"
                                    xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAFIUlEQVR4nO2dW2gcZRSAT70j3sUK3luf1Af1QXySKlqsSlGKS/acTVooGsEblpo9ZxrLKCqIPkhVhKCQdvc/G9k3KxXqrUXESlFUKlYRbQXFS9EH6yWmauTfbJqYmsskM/PP/jMfnJc87M7/8e+Z/3oCUFBQUFBQUFBQUFBQUBCNB4e6LuZ6Za0YekEUd4ji16L0Mxs6JIq/suJ++3dWfJgb5Ssjfny+CQd6T2RD97DiB6I0GiVY8Y1qo3yZ6zZkm1FYxIp3iKEDUQVPkf2HKFZcNyeTyJaeM1lx+0IET5H9Nxu61XW7MkW1XjmPFb+IS/LhsL8MQ/ez4sr1te7FkGdE6XRR/Cx2yUdKH2bFzX2N8jmQy5xsaFvikv8r/FupV66CPMGKq1OVPCH7p35DF0IeuO/VFcez4jdORNuXpaGdkAcCQ3e6kjwe1UZ5OfiOKO5yLVqUXgefWV/rXpwByTZ9HFrXLJ0BvhIo3uZa8kR4PINkxafcC273asWnwVdY8a0Mid4OvsKKe1wLnhRfgq+InZ25FzwWhg6Ar3BrGTMzoofBV9jQQeeCDwf+Ar7Chj53L3gs7LOAr3CMC/wxpI43wVdEcWOGRD8CviKN8tXOBbcjUFwGPsOG9rqWzIpfhWF4FPgMG3rWtWhRfA58JjB0nd2ldi26tVNer1wLviKGtrqWPEn2y+ArnKG1Djb0MfgKG3rPteCJwF3gK6I04F5wOww9D74iijc7FzwejfIK8BlWfMe1ZDb0rj3EAz7TX+teIoofOZOs+CEPdV0EeYEVNzmQvAnyBiuuTF10o3wL5I2wWTpOFH9ITbSh73oHeo+FPCJKnF6Pxnshz3dWxNC+FHLznnDHsmMgz1Qb5eVJLjR5v4AUBTb0UIK5OXDdvqzdynopAclD3k9MolJqlo6OeWw9kNtRxlyIS/ScvizPSCG6EO0V0oE9uu/FtSeLodDem2RDf7KhH+3LfYOhKyCrSIeJtiuB0x+hwBEx1ANZRDpItJU8+8wWR7jWfTlkiaBeuT4u0UG9ck0as1p7/He2Z7FpBDJVq0Oj1+mYoXG7w8E1JyT93FVDN80mmw19D1kgrFdOsYVN4pI8qYHbuFk61bVsewAfnDIKi4J65fYkryzbc3aBoVVJT8VnlG3oE3B3sRPvTvPAoz14zop9QaN89nxffLNdbZ5eNm6ENIugiC1WYminGPorLcH/0+gRm1Kqindt2Lz63EijC0PDVmYk2YY+DZulkyBJgnrlUrtMyYq7xdA/7uROE61nmvkG7RFDuCiyDe1LbMe9OtR1iSg9kaX7KjJ9OnlsXuPkuci2GxqxS7YvNUOrsnA4RpKWHEF2rFQVb7QnM12LkzQlpyk7HFxzmigOupYmMUu2pYAibRgnKbt/qOv8LNxFEdeSJ8uOu6qNKC1t1wl1Lk6yIHlMdLyji3bhqdjWIyStMPTkTO3iLT0X2GoH8/v8VqdbCnEihp5xLk097smtB6p1LxkrKexenvjaky32KoJzceq55PYZud+dy1NP08U4onSDa3nic0+eEI2Pdojkx2fryXZ9el6/EsX9iV/JEEOvdYDkrTMt7mdecku0w8s9MjfJw0GzdFZHS7a4rI4rc5PxSkfm5KlkfcTBhtZ1dE/udFixVkhOAVF6P/PpwpP/I3CwkJww7Zdg0ZPT2GIr0kUKSL3yQJGTM1OEpXjxLRhWfHua8fFvY7tEqHaNfeHflHPY0N627AE7obEVZ1oTEEf3Dv8FYD/aWmoSqxwAAAAASUVORK5CYII=" />
                
                            </svg>
                            <h2 class="text-l font-semibold">Data Pelanggan</h2>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-md">
                            <p><span class="text-gray-400">Nama</span> <span class="ml-6">: {{ $booking->customer->nama }}</span></p>
                            <p><span class="text-gray-400">Alamat</span> <span class="ml-4">: {{ $booking->customer->alamat }}</span></p>
                            <p><span class="text-gray-400">Telepon</span> <span class="ml-2">: {{ $booking->customer->no_hp }}</span></p>
                        </div>
                    </div>

                    <!-- Handphone and Issue Data -->
                    <div class="w-1/2">
                        {{-- <h3 class="text-sm font-semibold mb-2">Data Handphone dan Kendala</h3> --}}
                        <div class="flex items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="20" height="20" viewBox="0 0 20 20" fill="none">
            
                                <image id="image0_76_220" width="20" height="20"
                                    xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAADZUlEQVR4nO2dsWpUQRiFB8So+AQm+AKCjU9ha/EfUwhapZCIViZWW7gzmyApLFNIwNJOUPEF1CgBIWwQbJx/USNYSURItTLXILjJ7t69O5s7x50D0ywL+32HyT83xXCNycnJyUkr1xufTovV23D+rVj/E067Ka3AJNZvwvpblx9+PGUYc/X+5/OwfrvuMlF+vZdmZ86w7WSykrt/y260ZwxL4PROAqV1qyxxftGwRKx/R1u09ZuGJXB+r+7CUHn5PcOS+svSsZZhSd1FIRettZc4FTvaJBYWTnoBkHDSC4CEk14AJJz0AiDhpBcACSe9AEg46QVAwkkvABJOegGQcNILgISTXgAknPQCIOGkFwAJJ70ASDjpBUDCSS8AEk56AZBw0guAhJNeACSc9AIg4aQXAAknvQBIOOkFQMKZnMC1B7tnxemqOP0m1n+B1RV50j2RGme01CEg1l+A053Dv+tbKXFGzXELSFNv9L26YXU3Fc7oGVVAGu2Z8GceSoHTr2EXlrlTEkYFnN/o93u56J4UJfcUJFafDyq7/6jIo6Pbr7SDndwtW/bAUfHvbn6UD8MSRRdlO/8yXD4K35O1zhlYXR9esP8lLV0wQzJ1MxrOtwYVJ05foOkvlRsVuhPGyiQ4/4/D0OmzEiUOm8cb4YCcFGdyqSIgxZOHf1qp4JKjIgZnUqkqINXK/iArnYvHyZlMxhGQUcq2+niUURGTM4mMKyDDyq44KmJz1p4YAtK/7MqjYhKctSaWgDTaM2K9C/+Wi/XfYf3aOKNiUpy1hUUAJJz0AiDhpBcACSe9AEg46QVAwkkvABJOegGQcNILgISTXgAknPQCIOGkFwAJJ70ASDjpBUDCSS8AEk56AZBw0guAhJNeACSc9AIg4aQXAAknvQBIOOkFQMI5sgBIlmFJ3UUhF621l5h3tBtawj6svzu/qrNhSUuXis9y0XF3mbR0qXdEidXlXHTkoq80/bneosNnuejIRc+v6uyhHd3szOWiY48Oq8tHPN3cy0XHP6T2Q9nFQfhnJ4eSp/0w5H3hjTj9YVhSvLougdJQZVl9bVgS3g9Ye2Gu6urcNCwJ14rDK+sId/PWwvrWScOUgwOLp2yrW0c9q1OkuIPi/KI4fZPmAen3xOmrMC7odnJOTo6ZgvwGAxegPr5PH1wAAAAASUVORK5CYII=" />
            
                            </svg>
                            <h2 class="text-l font-semibold ">Data Handphone</h2>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-md">
                            <p><span class="text-gray-400">Handphone</span> <span class="ml-1">: {{ $booking->hpModel->hpMerk->merk }}
                                {{ $booking->hpModel->model }}</span></p>
                            <p><span class="text-gray-400">Kode Imei</span> <span class="ml-4">   : {{ $booking->imei }}</span></p>
                            <p><span class="text-gray-400">Kendala</span> <span class="ml-7">: {{ $booking->kendala }}</span></p>
                        </div>
                    </div>
                </div>

                <!-- Service and Sparepart Table -->
                <div>
                    <h3 class="text-sm font-semibold mb-2">Detail Service dan Sparepart</h3>
                    <table class="w-full border-collapse border border-gray-300 text-sm min-w-full rounded-lg overflow-hidden">
                        <thead>
                            <tr class="bg-blue-100">
                                <th class="border border-gray-300 px-4 py-2 text-left">Deskripsi</th>
                                {{-- <th class="border border-gray-300 px-4 py-2 text-right">Harga</th> --}}
                                <th class="border border-gray-300 px-4 py-2 text-center">Tipe Servis</th>
                                <th class="border border-gray-300 px-4 py-2 text-right">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($booking->detailBooking as $item)
                <tr class="">
                    {{-- <th class="px-4 py-2 text-gray-500">{{ $item->dataService->code }} </th> --}}
                    <td class="px-4 py-2 text-gray-500">{{ $item->dataService->nama_servis }} </td>
                    <td class="px-4 py-2 text-gray-500 text-center">{{ $item->dataService->jenis_servis }} </td>
                    <td class="px-4 py-2 text-gray-500 text-right">Rp{{ number_format($item->harga, 0, ',', '.') }},- </td>
                </tr>
                @endforeach
                @foreach ($booking->sparepart_booking as $item)
                    <tr class="">
                        {{-- <th class="px-4 py-2 text-gray-500">{{ $item->sparepart->code }} </th> --}}
                        <td class="px-4 py-2 text-gray-500">{{ $item->sparepart->nama_sparepart }} </td>
                        <td class="px-4 py-2 text-gray-500 text-center">Sparepart </td>
                        <td class="px-4 py-2 text-gray-500 text-right">Rp{{ number_format($item->harga, 0, ',', '.') }},- </td>
                    </tr>
                @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="bg-gray-200 font-bold">
                                <td class="border border-gray-300 px-4 py-2" colspan="2">Total</td>
                                <td class="border border-gray-300 px-4 py-2 text-right">Rp{{number_format($total, 0, ',', '.')}},-</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Payment Section -->
                <div>
                    <h3 class="text-sm font-semibold mb-2">Pembayaran</h3>
                    <div class="space-y-4">
                        <div>
                            <label for="amount-paid" class="block text-sm font-medium text-gray-400">Catatan</label>
                            <input type="text" id="amount-paid" wire:model="catatan" class="w-full border-gray-300 rounded-lg shadow-sm"
                                placeholder="Masukkan catatan">
                            @error('catatan') 
                                <span class="text-red-600 text-sm">{{ $message }}</span> 
                            @enderror
                        </div>
                        <!-- Dropdown Metode Pembayaran -->
                        <div>
                            <label for="payment-method" class="block text-sm font-medium text-gray-400">Metode Pembayaran</label>
                            <select id="payment-method" wire:model="metodeSelected" class="w-full border-gray-300 rounded-lg shadow-sm">
                                <option value="">Pilih Metode</option>
                                @foreach ($metode as $item)
                                    <option value="{{ $item->id }}">{{ $item->metode }}</option>
                                @endforeach
                            </select>
                            @error('metodeSelected') 
                                <span class="text-red-600 text-sm">{{ $message }}</span> 
                            @enderror
                        </div>
                
                        <!-- Input Jumlah Bayar -->
                        
                        <div>
                            <label for="amount-paid" class="block text-sm font-medium text-gray-400">Jumlah Bayar</label>
                            <input type="number" id="amount-paid" wire:model="bayar" class="w-full border-gray-300 rounded-lg shadow-sm"
                                placeholder="Masukkan jumlah bayar">
                            @error('bayar') 
                                <span class="text-red-600 text-sm">{{ $message }}</span> 
                            @enderror
                        </div>
                    </div>
                </div>

            <!-- Modal Footer -->
            <div class="flex justify-end items-center border-t px-6 py-4">
                <button class="bg-red-400 text-white px-4 py-2 rounded-lg mr-2"
                    wire:click="$set('isModalDone', false)">Kembali</button>
                <button wire:click="selesaikan" onclick="printDiv('struk-pembayaran')" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Simpan</button>
            </div>
        </div>
    </div>
@endif
</div>


<script>
    function printDiv(divId) {
        let printContent = document.getElementById(divId).innerHTML;
        let originalContent = document.body.innerHTML;

        document.body.innerHTML = printContent;  // Hanya menampilkan elemen yang dipilih
        window.print();  // Perintah print
        document.body.innerHTML = originalContent;  // Mengembalikan halaman ke tampilan awal
    }
</script>