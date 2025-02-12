<div class="justify-between my-2 sm:my-2 m-6">
    <div class="flex justify-between my-2 sm:my-2">
        <h1 class="text-2xl md:text-2xl text-gray-800 dark:text-gray-100 font-bold">
            Detail Claim Garansi
        </h1>
        @if (isset($feedbackMessage))
                    <div class="p-4 mb-4 text-blue-700 bg-blue-100 rounded">
                        {{ $feedbackMessage }}
                    </div>
                @endif

                @if (session()->has('doneMsg'))
                    <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">
                        {{ session('doneMsg') }}
                        {{-- {{ session('inputData')[''] }} --}}

                    </div>
                @endif
    </div>
    {{-- <p>{{ $garansi }}</p> --}}
    <div class="flex space-x-4">


        <div class="w-1/2 bg-white rounded p-6 shadow-md">
            <div class="flex items-center ">
                <img src="{{ asset('images/Reset.svg') }}" alt="garansi" class="w-5 h-5 object-cover rounded-l-lg">
                <h2 class="text-xl font-semibold ml-4">Detail Booking</h2>
            </div>
            <hr class="my-3">
            <div class="grid grid-cols-1 gap-4">
                <p><strong>Kode Pesanan: </strong> {{ $garansi->booking->kode_pesanan }}</p>
                <p><strong>Tanggal Pesanan: </strong> {{ $garansi->booking->created_at }}</p>
                <p><strong>Nama: </strong> {{ $garansi->booking->customer->nama }}</p>
                <p><strong>No HP: </strong> {{ $garansi->booking->customer->no_hp }}</p>
                <p><strong>IMEI: </strong> {{ $garansi->booking->imei }}</p>
                <p><strong>Kendala: </strong> {{ $garansi->booking->kendala }}</p>
                <p><strong>Status: </strong> {{ $garansi->booking->status }}</p>
                <p><strong>Total: </strong> Rp. {{ number_format($garansi->booking->total, 0, ',', '.') }}</p>
                <p><strong>Nomor Antrian: </strong> {{ $garansi->booking->nomor_antrian }}</p>
                <p><strong>Keterangan: </strong> {{ $garansi->booking->keterangan }}</p>
            </div>
            <div class="mt-4">
                <p class="font-semibold">Detail Service:</p>
                <ul class="text-gray-600 list-disc ml-5">
                    @foreach ($garansi->booking->detailBooking as $item)
                        <li>{{ $item->dataService->nama_servis}}</li>
                    @endforeach
                </ul>
            </div>

            {{-- Sparepart --}}
            <div class="mt-4">
                <p class="font-semibold">Sparepart Digunakan:</p>
                <ul class="text-gray-600 list-disc ml-5">
                    @foreach ($garansi->booking->sparepart_booking as $item)
                        <li>{{ $item->sparepart->nama_sparepart }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="w-1/2 bg-white rounded p-6 shadow-md">
            <div class="flex items-center ">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30"
                    height="30" viewBox="0 0 30 30" fill="none">

                    <image id="image0_50_219" width="30" height="30"
                        xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAEzElEQVR4nO2cTYgcVRCAX9QY//Dn4B/+oSIGRDwI/osSEBdjMlWjc1AEFWEPogYRieAhKh686sHfiwiKBBU9GNCos121u0lkSaIExQVRosluV81sEjf+/7S82YksuDvdO9szr2emPqhb7/brj5rXr97UG+cMwzAMwzAMwzAMwzAMwzCMkHxXvfc4YdggjDuU8bAyJj0eh4VxuxA+MrllaFUhsqtWxXOV4YsCyOlMEOz2zxg8k7WfJc+THTSzhWFDcAldipjw4YCicUcRJHQjhGBbMNHKMBtaQPcCZnOVl+ypHBtT+XolfFAIXlaCD5XxS2X4VgjqwjgjBH/7m+d640Fg73jleOXy3U2pmZdnzsjGvonbT1CGJ3ymtvNxckY6Mlq6URj3LmfeckZrNILHhfHP5b4gnLEwSfWmY4TwpbzexM74PweqpVOF4dMsAoXxgDC+LwRPCsFdfpqJR+Hig7z2NP/i/O+TEXzJ1d1IzatpLl8kjF+lC4atMlq+zS/xsiSrFuDhCyO6PgrXKoO0/CeE017wUmcCLcDDF0J0THinEvzSWjLsnuHK+UuV7An94IUQ3dgfblZwi4UQvjv10S0nujbRQRbt51chfD39D+H5JNl0VLuSPQMr2q8KhOCzVhcLwe9xVLrP5YAOoujGyoLg6xTJdeXSzXlI9gyc6MbKgiBufSFM6uj6S12O6KCJVsbfWl0gBB/7giVPyZ5BFN3qgleTieGVrgNoAR4+uGhh+EsZN3ZC8BF00EUL4U/tVHpLRXMYvE8IvxytRXCV3x/36/oarb/aLz/TpsSgooXg++mR0uWdluxZtmSCD3SsvNotQsx4hTD8UDjRQjg+vW3dma5LaLuDJtylEa7Jcg8vuyiZfeSB3/INLa6L6JIzGPfFhPcvtSJVhhcKIVoINiWJW9E5pYsJyJzBPyvj0+3uq9QYrymE6FBoegb/o4ybZ8bKFyznPnG1clJoyYUVLQTbfMWax318sRVacgFFw6RSCfK8z9yXFyY6aWZw3e+Bd6IKFcYXB160EPyhjK/sp8rprgMow5V+a3egRQvBezJSvqRT/99LVob9oQUHF91JlOCeoh3TcP3E5JahVc19jqRIIYSHXL8wFa27UBknQkstXCN6nkiEa33vdWihi0WN4SHXyySbK0cr47PNKjIpZBDuytq9VUimxvAMYfwkuMgUybXxyjmuV4mj0nVC8GNwkQsGzPotZz9d9HQmK8NwWhHS7N/eGGJXsueJ/S4cwdtpGeUz3R9YCj3enkTHyquFYE+6ZKzG1cpZocfbk6g/8ZVS5flVhzA851chocfbt1WeMBysMWLo8fYk9ah0nq+mMrzhd/q+wdDj7Uk0wjXpvYCNTH5j/pkYIyNJ4lb4JVlaA7wy/CpcesDEtsH0XNtwy97sZnzTrQafviKZGF6pXH6s2VKQJvmd2vahk0OPuaeY2Vo5pfk7SqnHnK3Ky4DvKvJtZnW+47I4Kt+qBM8oIWX9Hq/RncRwg+sHwm/C4GIxIhGe7fqFAghNFpgqnuq7Ki+0WJ0fhOQ7QF0/ElwuN3bcPtcISn29rRlOMIgyvJZXj13h6Xy24iFlmJr7GUl4Uwgf9ccflnvy1jAMwzAMwzAMwzAMwzAMw3C9xL8zapdMmRr3rgAAAABJRU5ErkJggg==" />

                </svg>
                <h2 class="text-xl font-semibold ml-4">Detail Garansi</h2>
            </div>
            <hr class="my-3">

            <div class="grid grid-cols-1 gap-4">
                <p><strong>Keterangan:</strong> {{ $garansi->keterangan }}</p>

                <p><strong>Kendala:</strong> {{ $garansi->kendala }}</p>
                <p><strong>Waktu dibuat:</strong> {{ $garansi->created_at }}</p>
                @if ($garansi->status == 'diproses')
                
                <button wire:click="$set('isModal', 1)" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 mr-2">
                    Selesaikan
                </button>
                @endif
            </div>
            <script>
                function editStatus() {
                    var selectedStatus = document.getElementById('statusDropdown').value;
                    // Add your logic to update the status here
                    alert('Status updated to: ' + selectedStatus);
                }
            </script>
        </div>
        @if($isModal == 1)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50 p-4">
            <div class="bg-white p-6 rounded-lg shadow-xl w-full sm:max-w-2xl relative max-h-[80vh] overflow-y-auto">
                <div class="flex justify-between items-center border-b pb-3">
                <h2 class="text-lg font-semibold text-gray-800">Detail Pemesanan & Garansi</h2>
                <button wire:click="$set('isModal', 0)" class="text-gray-500 hover:text-gray-800">
                    ✖
                </button>
                <div class="mt-6 border-t pt-4">
                    <form wire:submit.prevent="submit">
                        <label for="keterangan" class="block text-sm font-medium text-gray-700">Masukkan Keterangan:</label>
                        <input type="text" id="keterangan" wire:model="keterangan"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2">

                        {{-- Error message --}}
                        @if ($errors->has('keterangan'))
                            <div class="mt-1 p-2 bg-yellow-100 border border-yellow-400 text-yellow-900 text-xs rounded flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01M12 5a7 7 0 110 14 7 7 0 010-14z"></path>
                                </svg>
                                @error('keterangan')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                        <button type="submit"
                            class="mt-4 w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">
                            Buat Klaim Garansi
                        </button>
                    </form>
                </div>
            </div>
            </div>
            </div>
        @endif

    </div>
