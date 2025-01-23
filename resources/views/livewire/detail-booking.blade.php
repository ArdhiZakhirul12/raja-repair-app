<div>
    <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between my-2 sm:my-2">
            <h1 class="text-2xl md:text-2xl text-gray-800 dark:text-gray-100 font-bold">
                Detail Transaksi Servis
            </h1>            
            <button 
                class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700"
                onclick="document.getElementById('add-customer-modal').classList.remove('hidden')"
            >
                Selesaikan
            </button> 


            {{-- <button   class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700"
        onclick="document.getElementById('add-sparepart-modal').classList.remove('hidden')">
        Tambah Sparepart
    </button> --}}
        </div>
        <h1 class="mt-3 text-2md md:text-2md text-blue-700 dark:text-gray-100">
            #{{ $booking->kode_pesanan }}
            <span
                class=" 
                @if ($booking->status == 'diproses') bg-blue-100 text-blue-700
                    text-md px-1.5 py-1.5 rounded">
                Diproses
                @elseif($booking->status == 'selesai') 
                    bg-green-100 text-green-700 
                    text-md px-1.5 py-1.5 rounded">
                Selesai @endif 
                
            </span>
        </h1>      
        <h2 class="mt-1
                text-xs md:text-sm text-gray-500 dark:text-gray-100 ">
            Pesanan : {{ $booking->created_at }}
        </h2>

        <div class="flex">
            <div class="w-4/6 ">
                <div class="bg-white rounded shadow-md p-5 my-3">
                    <div class="flex items-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30"
                            height="30" viewBox="0 0 30 30" fill="none" class="mr-2">

                            <image id="image0_76_221" width="30" height="30"
                                xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAFIUlEQVR4nO2dW2gcZRSAT70j3sUK3luf1Af1QXySKlqsSlGKS/acTVooGsEblpo9ZxrLKCqIPkhVhKCQdvc/G9k3KxXqrUXESlFUKlYRbQXFS9EH6yWmauTfbJqYmsskM/PP/jMfnJc87M7/8e+Z/3oCUFBQUFBQUFBQUFBQUBCNB4e6LuZ6Za0YekEUd4ji16L0Mxs6JIq/suJ++3dWfJgb5Ssjfny+CQd6T2RD97DiB6I0GiVY8Y1qo3yZ6zZkm1FYxIp3iKEDUQVPkf2HKFZcNyeTyJaeM1lx+0IET5H9Nxu61XW7MkW1XjmPFb+IS/LhsL8MQ/ez4sr1te7FkGdE6XRR/Cx2yUdKH2bFzX2N8jmQy5xsaFvikv8r/FupV66CPMGKq1OVPCH7p35DF0IeuO/VFcez4jdORNuXpaGdkAcCQ3e6kjwe1UZ5OfiOKO5yLVqUXgefWV/rXpwByTZ9HFrXLJ0BvhIo3uZa8kR4PINkxafcC273asWnwVdY8a0Mid4OvsKKe1wLnhRfgq+InZ25FzwWhg6Ar3BrGTMzoofBV9jQQeeCDwf+Ar7Chj53L3gs7LOAr3CMC/wxpI43wVdEcWOGRD8CviKN8tXOBbcjUFwGPsOG9rqWzIpfhWF4FPgMG3rWtWhRfA58JjB0nd2ldi26tVNer1wLviKGtrqWPEn2y+ArnKG1Djb0MfgKG3rPteCJwF3gK6I04F5wOww9D74iijc7FzwejfIK8BlWfMe1ZDb0rj3EAz7TX+teIoofOZOs+CEPdV0EeYEVNzmQvAnyBiuuTF10o3wL5I2wWTpOFH9ITbSh73oHeo+FPCJKnF6Pxnshz3dWxNC+FHLznnDHsmMgz1Qb5eVJLjR5v4AUBTb0UIK5OXDdvqzdynopAclD3k9MolJqlo6OeWw9kNtRxlyIS/ScvizPSCG6EO0V0oE9uu/FtSeLodDem2RDf7KhH+3LfYOhKyCrSIeJtiuB0x+hwBEx1ANZRDpItJU8+8wWR7jWfTlkiaBeuT4u0UG9ck0as1p7/He2Z7FpBDJVq0Oj1+mYoXG7w8E1JyT93FVDN80mmw19D1kgrFdOsYVN4pI8qYHbuFk61bVsewAfnDIKi4J65fYkryzbc3aBoVVJT8VnlG3oE3B3sRPvTvPAoz14zop9QaN89nxffLNdbZ5eNm6ENIugiC1WYminGPorLcH/0+gRm1Kqindt2Lz63EijC0PDVmYk2YY+DZulkyBJgnrlUrtMyYq7xdA/7uROE61nmvkG7RFDuCiyDe1LbMe9OtR1iSg9kaX7KjJ9OnlsXuPkuci2GxqxS7YvNUOrsnA4RpKWHEF2rFQVb7QnM12LkzQlpyk7HFxzmigOupYmMUu2pYAibRgnKbt/qOv8LNxFEdeSJ8uOu6qNKC1t1wl1Lk6yIHlMdLyji3bhqdjWIyStMPTkTO3iLT0X2GoH8/v8VqdbCnEihp5xLk097smtB6p1LxkrKexenvjaky32KoJzceq55PYZud+dy1NP08U4onSDa3nic0+eEI2Pdojkx2fryXZ9el6/EsX9iV/JEEOvdYDkrTMt7mdecku0w8s9MjfJw0GzdFZHS7a4rI4rc5PxSkfm5KlkfcTBhtZ1dE/udFixVkhOAVF6P/PpwpP/I3CwkJww7Zdg0ZPT2GIr0kUKSL3yQJGTM1OEpXjxLRhWfHua8fFvY7tEqHaNfeHflHPY0N627AE7obEVZ1oTEEf3Dv8FYD/aWmoSqxwAAAAASUVORK5CYII=" />

                        </svg>
                        <h2 class="text-l font-semibold">Data Pelanggan</h2>
                    </div>
                    <hr>
                    <div class="p-4 mt-4">

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

                <div class="bg-white rounded shadow-md px-5 py-3    ">
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
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            width="30" height="30" viewBox="0 0 30 30" fill="none">

                            <image id="image0_76_220" width="30" height="30"
                                xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAADZUlEQVR4nO2dsWpUQRiFB8So+AQm+AKCjU9ha/EfUwhapZCIViZWW7gzmyApLFNIwNJOUPEF1CgBIWwQbJx/USNYSURItTLXILjJ7t69O5s7x50D0ywL+32HyT83xXCNycnJyUkr1xufTovV23D+rVj/E067Ka3AJNZvwvpblx9+PGUYc/X+5/OwfrvuMlF+vZdmZ86w7WSykrt/y260ZwxL4PROAqV1qyxxftGwRKx/R1u09ZuGJXB+r+7CUHn5PcOS+svSsZZhSd1FIRettZc4FTvaJBYWTnoBkHDSC4CEk14AJJz0AiDhpBcACSe9AEg46QVAwkkvABJOegGQcNILgISTXgAknPQCIOGkFwAJJ70ASDjpBUDCSS8AEk56AZBw0guAhJNeACSc9AIg4aQXAAknvQBIOOkFQMKZnMC1B7tnxemqOP0m1n+B1RV50j2RGme01CEg1l+A053Dv+tbKXFGzXELSFNv9L26YXU3Fc7oGVVAGu2Z8GceSoHTr2EXlrlTEkYFnN/o93u56J4UJfcUJFafDyq7/6jIo6Pbr7SDndwtW/bAUfHvbn6UD8MSRRdlO/8yXD4K35O1zhlYXR9esP8lLV0wQzJ1MxrOtwYVJ05foOkvlRsVuhPGyiQ4/4/D0OmzEiUOm8cb4YCcFGdyqSIgxZOHf1qp4JKjIgZnUqkqINXK/iArnYvHyZlMxhGQUcq2+niUURGTM4mMKyDDyq44KmJz1p4YAtK/7MqjYhKctSaWgDTaM2K9C/+Wi/XfYf3aOKNiUpy1hUUAJJz0AiDhpBcACSe9AEg46QVAwkkvABJOegGQcNILgISTXgAknPQCIOGkFwAJJ70ASDjpBUDCSS8AEk56AZBw0guAhJNeACSc9AIg4aQXAAknvQBIOOkFQMI5sgBIlmFJ3UUhF621l5h3tBtawj6svzu/qrNhSUuXis9y0XF3mbR0qXdEidXlXHTkoq80/bneosNnuejIRc+v6uyhHd3szOWiY48Oq8tHPN3cy0XHP6T2Q9nFQfhnJ4eSp/0w5H3hjTj9YVhSvLougdJQZVl9bVgS3g9Ye2Gu6urcNCwJ14rDK+sId/PWwvrWScOUgwOLp2yrW0c9q1OkuIPi/KI4fZPmAen3xOmrMC7odnJOTo6ZgvwGAxegPr5PH1wAAAAASUVORK5CYII=" />

                        </svg> --}}
                        <h2 class="text-l font-semibold">Rincian Servis</h2>
                    </div>

                          
                          <table class="min-w-full table-auto">
                            <thead class="bg-blue-50 ">
                              <tr>
                                <th class="px-4 py-2 text-left">code</th>
                                <th class="px-4 py-2 text-left">Servis/Sparepart</th>
                                <th class="px-4 py-2 text-left">Tipe Servis</th>
                                <th class="px-4 py-2 text-left">Harga</th>
                              </tr>
                            </thead>
                            <tbody class="border-bottom">
                                @foreach ($booking->detailBooking as $item)
                                <tr class="">
                                    <th class="px-4 py-2">{{$item->dataService->code}} </th>
                                    <td class="px-4 py-2">{{$item->dataService->nama_servis}} </td>
                                    <td class="px-4 py-2">{{$item->dataService->jenis_servis}} </td>
                                    <td class="px-4 py-2">Rp{{number_format($item->harga, 0, ',', '.')}},- </td>
                                  </tr>
                                @endforeach                                                          
                                @foreach ($booking->sparepart_booking as $item)
                                <tr class="">
                                    <th class="px-4 py-2">{{$item->sparepart->code}} </th>
                                    <td class="px-4 py-2">{{$item->sparepart->nama_sparepart}} </td>
                                    <td class="px-4 py-2">sparepart </td>
                                    <td class="px-4 py-2">Rp{{number_format($item->harga, 0, ',', '.')}},- </td>
                                  </tr>
                                @endforeach      
                                <tr class="border-top">
                                    <td></td>    
                                    <td></td>    
                                    <td class="px-4 text-right"><h2 class="text-l font-semibold">Total :</h2></td>    
                                    <td class="px-4 py-2"><h2 class="text-l font-semibold">Rp{{number_format($total, 0, ',', '.')}},-</h2></td>    
                                </tr>                                                    
                            </tbody>
                          </table>
                        
                          
                        
                      
                      
                   
                </div>
    



</div>
<div class="w-2/6 p-4 m-3 bg-white rounded shadow-md h-100">
    <div class="flex items-center mb-2">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30"
            fill="none">

            <image id="image0_26_74" width="30" height="30"
                xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAFZUlEQVR4nO2dXWgkRRDHS7mIioqniF+gvijooyFbtblAFB9ERBCN+AXiJ6I+6IN4hy9RQbwTFdQz3rpVGz/eTnxRFBSVexHF84TDU0RBFLnTeDHZ7k3UqJeR2j1FcjuzO5udne7Z/kHBPsxHzT893V091RWAQCAQCAQCgUAgEAikJ9p50TGGcZsROmCFonZmBPcboa16bA+3CCgqYJzARwpOW5snBdKT1JKPEJrppx5uEVC6Fflfa54USE8Quo9EldGRrIVOusdQ0ODyZUZoX9ZCW6ZvDJeuhGFjcRbPs4xvdRSoX0L/dwy+ucDlc2EYaHDpUsM4l06gfglNkWWar9fKl0NRiSI4yjJuNox/rxVomcfPWnv88st0dlqhu72OYVptBjnTcDQUTWTDNBMrEuPmtedYwS1phU57HcO4XX2DomAZn+kQbKyoSNoi1Votn1bSCt3TdZiegiJgmB5L3TIHbEbwEfAZI3iF9ofWATE7vAmrpkpXgY80qni6Efo5bxFt12LjL+0GUx8Gvw/yFs+m70LeB5+wVbwmb9Fsr8blq8EHounJDUboq9wFk14Nv9ZnANexVbo7f7FofVajO8F1/G7N1LSkhS4nMIKYt0i2T1av4ii4SmKYLb4ZPgfOTumEDuYvEPVtXu3kOoit4oV5i2P7LfZLYxeAaxjB2wontNAt4BpGcEcBhX4BXMMw7iqg0B+CaxjBLwoo9F5wDc2BK6DQP4JrGMbfCyc042/gGukfgvQT00PerQHnTT8+pAYyEHqpMnpmEHYAQi+HLqM3Qtfh8mDIrRyMQfnoFfsro8draGqF6nlPv+ygjXGxmd20k47LXOgirmnYtG+j4I5MRdakQJ3E5/2gNn9bzjRBMghNgxFaCV0HadfxImSNDgRW8HkdGBx4haPBGi7ot8SBDIZx9OQ4k2nU8Pq8fDaCj3fyEVwjjcBGtxUzbtNsfAdyBF8vhNDNlFjGXYbxUSulKVPD88EhrEycZgV/9V5oy3gvOI5m/Xsv9PxrpZPAcZIyrMA1vHG0DfUqneKN/9446rv/3jjqu/9G6FA7R31I6o6mJze0n4bSIXCNuGXTpdmxM8BxmnsSYyJBcA3LuKedsw3GG8Bx6lW6Kabr+Ay82R2rJRxeGTsVHEV9s4Lfxgj9NHiW7f+drmm4JLj6oj6pb3F+16tUAjcT0fHzBLEjHVy0jIQTpSxiBu//RbR7nExEV2yVNnXakmyYKnn7qT508HHV8HgZXEY3sCe2FEGbZ1iu91YfklszTYMP6Dpv0qtpGO/Pzzd6IKlrU9/BJ6zghBV6L0bouYM8fmIerVk3AcUI/a76DD5Sn5nYGPfV3ORQ4tIKPhnTVSwtzk6eDD5jmZ6NnYFU8ZKB+SE40a6eU2Gq0GjWqInNBcHvtdUPZhkUf4jpMpa1tggUAcs0nTDKf5xlf92cZTB9kjDDeBiKVQeavkwIDj6a2z55QiZ5ggm7xXRzfeHqTptaedwI/Zkg9qcLlU3n9Ot+WrHRCu1OCEpWdNkAiogVvKdDoDBvGG9dT+jbSiEo3570ZfvwH/YuKDKmQ/h72HZbxmvTfDRoLd6XpuKWawee0pU3UWV0xAi90YXYzRZuBcUK3bFYo4t1BhPNTh6rpr+1poZWi7FMtdaxna+pCTNDU+Y4qoyOWKFXuxK7n8ZU8+HTWv+LwgpuMYJ/ZS2wDsKGSw/CMFOvUinLOkw6hXO6bM+gu5KGlO7T/zzRR4EP6Cxn6LqKbtDgoc50s5Zv6KVL0XO0gmRdyjcWLhDJivrMxMYGl68zTE9Ypnc0stRWagT/aJn+pn2W6e3mMVKa8n4FLhAIBAKBQADWyz+oAe9kkGkpgAAAAABJRU5ErkJggg==" />

        </svg>
        <h2 class="text-l font-semibold ">Teknisi</h2>
    </div>
    <label for="dataDropdown" class="block text-sm font-medium text-gray-400">List Data Teknisi</label>

    <select id="dataDropdown" name="dataDropdown"
        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
        onchange="showSuccessDialog()">
        <option>Data 1</option>
        <option>Data 2</option>
        <option>Data 3</option>
    </select>

    <!-- Success Dialog -->
    <div id="successDialog"
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
    </script>
</div>
</div>
</div>
</div>
