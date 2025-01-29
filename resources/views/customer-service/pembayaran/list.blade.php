<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if (session('msg'))
            <div id="notification"
                class="fixed top-5 right-5 bg-blue-500 text-white px-6 py-3 rounded shadow-lg z-50 transition-opacity duration-10">
                <p>{{ session('msg') }}</p>
            </div>
        @endif
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                <div
                                    class="flex top-5 right-5 bg-red-200 bg-opacity-50  px-6 py-3 mb-2 rounded shadow-lg z-50 transition-opacity duration-10 border border-red-800">
                                    <img src="{{ asset('images/error_smg.png') }}" alt="error mssg" class="w-6 h-6 mr-4">
                                    <p>{{ $error }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div id="notification"
                    class="fixed top-5 right-5 bg-green-500 text-white px-6 py-3 rounded shadow-lg z-50 transition-opacity duration-10">
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
            <div class="flex justify-between mb-2 sm:mb-5">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">
                    Metode Pembayaran
                </h1>
                {{-- <button class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700"
                    onclick="document.getElementById('add-sparepart-modal').classList.remove('hidden')">
                    Tambah Metode Pembayaran
                </button> --}}
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="flex flex-col space-y-6 mt2">
                    <div class="bg-white rounded-lg p-3">
                        {{-- <h4 class="text-gray-900 mb-5 text-lg font-bold">Simple Table</h4> --}}
                        {{-- <p class="text-sm text-gray-700">Using the most basic table markup, here’s how <code class="bg-gray-100 px-1 py-0.5 rounded">.table</code>-based tables look in Tailwind CSS. <strong>All table styles are inherited</strong>, meaning any nested tables will be styled in the same manner as the parent.</p> --}}
                        <table
                            class="table-auto w-full border-collapse rounded-lg overflow-hidden text-gray-500 dark:text-gray-400">
                            <thead class="bg-blue-100">
                                <tr>
                                    <th class="px-4 py-2 text-left ">#</th>
                                    <th class="px-4 py-2 text-left">Metode Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pembayarans as $pembayaran)
                                    <tr>
                                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-2">{{ $pembayaran->metode }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Horizontal Form -->
                <div class="bg-white p-4 border rounded shadow">
                  <div class="flex">
                    <i class="fa-solid fa-money-check-dollar mr-2" style="color: #63E6BE;"></i>
                    <h6 class="text-gray-500 font-semibold">Tambah Metode Pembayaran</h6>
                  </div>
                   <hr class="my-3">
                    <div class="mt-3">
                        <form action="{{ route('cs.pembayaran.store') }}" method="POST">
                            @csrf
                            <div class="mb-2 flex items-center">
                                    <img src="{{ asset('images/atm_card.svg') }}" alt="logo" class="w-20 h-20 mx-auto">
                                <div class="w-2/3">
                                    <input type="text" name="metode" placeholder="Metode Pembayaran"
                                        class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Disabled Forms -->
                <div class="bg-white p-5 border rounded shadow" style="display: none;">
                    <h6 class="text-gray-900 font-semibold">Disabled Forms</h6>
                    <div class="mt-5">
                        <form>
                            <fieldset disabled>
                                <div class="mb-4 flex items-center">
                                    <label for="inputPassword3"
                                        class="block text-sm font-medium text-gray-700 w-1/4">Password</label>
                                    <div class="w-3/4">
                                        <input type="password" id="inputPassword3" placeholder="Password"
                                            class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                                <fieldset class="mb-4">
                                    <div class="flex items-start">
                                        <legend class="text-sm font-medium text-gray-700 w-1/4">Radios</legend>
                                        <div class="w-3/4 space-y-2">
                                            <div class="flex items-center">
                                                <input type="radio" name="gridRadios" id="gridRadios1" value="option1"
                                                    checked class="h-4 w-4 text-blue-600 border-gray-300">
                                                <label for="gridRadios1" class="ml-2 text-sm text-gray-700">Option one
                                                    is this and that&mdash;be sure to include why it's great</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input type="radio" name="gridRadios" id="gridRadios2" value="option2"
                                                    class="h-4 w-4 text-blue-600 border-gray-300">
                                                <label for="gridRadios2" class="ml-2 text-sm text-gray-700">Option two
                                                    can be something else and selecting it will deselect option
                                                    one</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input type="radio" name="gridRadios" id="gridRadios3" value="option3"
                                                    disabled class="h-4 w-4 text-gray-400 border-gray-300">
                                                <label for="gridRadios3" class="ml-2 text-sm text-gray-400">Option three
                                                    is disabled</label>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="mb-4 flex items-center">
                                    <div class="w-1/4 text-sm font-medium text-gray-700">Checkbox</div>
                                    <div class="w-3/4">
                                        <div class="flex items-center">
                                            <input type="checkbox" id="checkMeOut"
                                                class="h-4 w-4 text-blue-600 border-gray-300">
                                            <label for="checkMeOut" class="ml-2 text-sm text-gray-700">Check me
                                                out</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="disabledTextInput"
                                        class="block text-sm font-medium text-gray-700">Disabled input</label>
                                    <input type="text" id="disabledTextInput" placeholder="Disabled input"
                                        class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100 text-gray-500">
                                </div>
                                <div class="mb-4">
                                    <label for="disabledSelect" class="block text-sm font-medium text-gray-700">Disabled
                                        select menu</label>
                                    <select id="disabledSelect"
                                        class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100 text-gray-500">
                                        <option>Disabled select</option>
                                    </select>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" disabled class="h-4 w-4 text-gray-400 border-gray-300">
                                    <label class="ml-2 text-sm text-gray-400">Can't check this</label>
                                </div>
                                <button type="submit"
                                    class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 disabled:opacity-50"
                                    disabled>Submit</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>




</x-app-layout>
