<div class="min-w-fit">
    <!-- Sidebar backdrop (mobile only) -->
    <div class="fixed inset-0 bg-gray-900 bg-opacity-30 z-40 lg:hidden lg:z-auto transition-opacity duration-200"
        :class="sidebarOpen ? 'opacity-100' : 'opacity-0 pointer-events-none'" aria-hidden="true" x-cloak></div>

    <!-- Sidebar -->
    <div id="sidebar"
        class="flex lg:!flex flex-col absolute z-40 left-0 top-0 lg:static lg:left-auto lg:top-auto lg:translate-x-0 h-[100dvh] overflow-y-scroll lg:overflow-y-auto no-scrollbar w-64 lg:w-20 lg:sidebar-expanded:!w-64 2xl:!w-64 shrink-0 bg-white dark:bg-gray-800 p-4 transition-all duration-200 ease-in-out {{ $variant === 'v2' ? 'border-r border-gray-200 dark:border-gray-700/60' : 'rounded-r-2xl shadow-sm' }}"
        :class="sidebarOpen ? 'max-lg:translate-x-0' : 'max-lg:-translate-x-64'" @click.outside="sidebarOpen = false"
        @keydown.escape.window="sidebarOpen = false">

        <!-- Sidebar header -->
        <div class="flex justify-between mb-10 pr-3 sm:px-2">
            <!-- Close button -->
            <button class="lg:hidden text-gray-500 hover:text-gray-400" @click.stop="sidebarOpen = !sidebarOpen"
                aria-controls="sidebar" :aria-expanded="sidebarOpen">
                <span class="sr-only">Close sidebar</span>
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.7 18.7l1.4-1.4L7.8 13H20v-2H7.8l4.3-4.3-1.4-1.4L4 12z" />
                </svg>

            </button>
            <!-- Logo -->
            <a class="block" href="{{ route('dashboard') }}">
                <img class="w-10 h-10" src="{{ asset('images/logo_raja.png') }}" alt="Logo">
                {{-- <svg class="fill-violet-500" xmlns="http://www.w3.org/2000/svg" width="32" height="32">
                    <path d="M31.956 14.8C31.372 6.92 25.08.628 17.2.044V5.76a9.04 9.04 0 0 0 9.04 9.04h5.716ZM14.8 26.24v5.716C6.92 31.372.63 25.08.044 17.2H5.76a9.04 9.04 0 0 1 9.04 9.04Zm11.44-9.04h5.716c-.584 7.88-6.876 14.172-14.756 14.756V26.24a9.04 9.04 0 0 1 9.04-9.04ZM.044 14.8C.63 6.92 6.92.628 14.8.044V5.76a9.04 9.04 0 0 1-9.04 9.04H.044Z" />
                </svg>                 --}}
            </a>
        </div>

        <!-- Links -->
        <div class="space-y-5">
            <!-- Pages group -->
            <div>
                <h3 class="text-xs uppercase text-gray-400 dark:text-gray-500 font-semibold pl-3">
                    <span class="hidden lg:block lg:sidebar-expanded:hidden 2xl:hidden text-center w-6"
                        aria-hidden="true">•••</span>
                    <span class="lg:hidden lg:sidebar-expanded:block 2xl:block">Pages</span>
                </h3>

                <a href="{{ route('dashboard') }}" :active="request() - > routeIs('dashboard')">
                    <div class="flex items-center justify-between p-3">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            width="18" height="18" fill="none">

                            <image id="image0_26_80" width="20" height="20"
                                xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAENklEQVR4nO2cPWwURxTHJyixCEoENCiBjoY0KdKAkICGBrpQpaM0hMaKnJu3oVk6DA1CorHke3MG0VwTKUUkI9FhRQ5U4CaRHMf2e+evBBQlRIivQ2OMObw+dnZvv273/aSVLMvevfnf+Df/tW5HKUEQBEEQBKGD2tjqp4B0BQytauS/7Nf2e50/I/SIV184BIZ/B8PtzkMjzdaQj/Z6/srj++0PPWQAw083h7xxID3Xhkb85vRA5QOLg1df2q+R7nQNOHDQ3doYHYh1saoCjYXTgPSfe8hvZjf/D8hDqt3+IO8xFJrh64t7tOGfIgccdPdEbWxub97jKSQ1w19rQyuhIRpacf05e868x1UY/FHeAUhXo8zUSDMf6Xrla6DXpba5ute6XBv61+ENmoVG65iqGr5LbXurgF/f1yac20nVaqBXX9oPhieTDCbKG1eJGgiOtS3uHV+vKup7hjNcvOIsrqoM6EbrJCAtZl3HPNM6oZFbDipZhQafUv1KEWbWcNlrYNFcCWWrgUVe/b2y1MA0alveE+EHw1+oKtW2squt1IuNH2GxBkO3zjfm91WqtqUxjkLWQDsrNdJonrUtz79Mbbg5ZGZ3qTTpO7eluNakUgPtag2GL9jGULTallcN1IZeWMcn1p5sxbHhFbm25VsD+T7g/Jc9XVDjwhlt6LGLu7xxOqxKhjdOh928TY9tVvEuYuisW/V5faiSAhEyiBU2IP0hQatoQRuaiRE0P5KgVcQZzQ8jB60N3djKRaIO7pqFzSxy0N7Nud321rOjqN+2tU2C5rU8bBY2k45uPWEzU3E5f+PPzzvv7iRofmfxt9nYjFTSSNCcTctKKmi/OT0ASJfc/qHT88Fxb6Zym1hJXVgbGskg4M2L1Uhe480vaMxkJr97IC3mNV6V14Uh65ATfp0qbSRolqBBZnQQUUcIog4WdYCoI4ioIwRRB4s6QNQRRNQRgqiDRR0g6ggi6ghB1MGiDhB1BBF1hCDqYFEHiDqCiDpCEHWwqANEHUFEHSGIOljUAaKOIKKOEEQdLOqAMqnDZd8LlxcEBftIWJRzaKR/Ugt44wUh/1L1oMHwpEqbGtK5qgftGTqr0mbtA+QuT9KWNWjkqcHRex+pLPjeLH9md1isXNDIU3bsKkvsuwp1+tb66n0LZL8HrV+PbdI+FZvZTE4SiBGSNvTMbk/hNVqDjg/EOwddWiB6SH/XDB3f+P06HwGkZQk6waA18m9b7QGytreGoQcyo5MIGulnGJ3Z2e08/rXlTwDpR1FHL0EjXfX99rawvw67pdD6DjkvxdGbCAnkid3fSEXEQ/ombCMXVTXAMHcJg3Vj/mDs847TV4A018X1pKqG3urJWeSpJLZvs+fY8oYK6aKqGn5zemA9bLY1TSNf9s3s9qTO/11z/mN7zvUKGPtZcEEQBEEQBNVXvAIcNnYcwHfDSQAAAABJRU5ErkJggg==" />

                        </svg>
                            <span
                                class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Dashboard</span>
                        </div>
                    </div>
                </a>


                <ul class="mt-3">
                    <!-- Dashboard -->
                    {{-- <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(1), ['dashboard'])) {{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }} @endif"
                        x-data="{ open: {{ in_array(Request::segment(1), ['dashboard']) ? 1 : 0 }} }">
                        <a class="block text-gray-800 dark:text-gray-100 truncate transition @if (!in_array(Request::segment(1), ['dashboard'])) {{ 'hover:text-gray-900 dark:hover:text-white' }} @endif"
                            href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="icon-holder">
                                        <i class="c-blue-500 ti-home"></i>
                                    </span>
                                    {{-- <svg class="shrink-0 fill-current @if (in_array(Request::segment(1), ['dashboard'])){{ 'text-violet-500' }}@else{{ 'text-gray-400 dark:text-gray-500' }}@endif" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                        <path d="M5.936.278A7.983 7.983 0 0 1 8 0a8 8 0 1 1-8 8c0-.722.104-1.413.278-2.064a1 1 0 1 1 1.932.516A5.99 5.99 0 0 0 2 8a6 6 0 1 0 6-6c-.53 0-1.045.076-1.548.21A1 1 0 1 1 5.936.278Z" />
                                        <path d="M6.068 7.482A2.003 2.003 0 0 0 8 10a2 2 0 1 0-.518-3.932L3.707 2.293a1 1 0 0 0-1.414 1.414l3.775 3.775Z" />
                                    </svg> --}}

                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="18" height="18" fill="none">

                                        <image id="image0_26_80" width="20" height="20"
                                            xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAENklEQVR4nO2cPWwURxTHJyixCEoENCiBjoY0KdKAkICGBrpQpaM0hMaKnJu3oVk6DA1CorHke3MG0VwTKUUkI9FhRQ5U4CaRHMf2e+evBBQlRIivQ2OMObw+dnZvv273/aSVLMvevfnf+Df/tW5HKUEQBEEQBKGD2tjqp4B0BQytauS/7Nf2e50/I/SIV184BIZ/B8PtzkMjzdaQj/Z6/srj++0PPWQAw083h7xxID3Xhkb85vRA5QOLg1df2q+R7nQNOHDQ3doYHYh1saoCjYXTgPSfe8hvZjf/D8hDqt3+IO8xFJrh64t7tOGfIgccdPdEbWxub97jKSQ1w19rQyuhIRpacf05e868x1UY/FHeAUhXo8zUSDMf6Xrla6DXpba5ute6XBv61+ENmoVG65iqGr5LbXurgF/f1yac20nVaqBXX9oPhieTDCbKG1eJGgiOtS3uHV+vKup7hjNcvOIsrqoM6EbrJCAtZl3HPNM6oZFbDipZhQafUv1KEWbWcNlrYNFcCWWrgUVe/b2y1MA0alveE+EHw1+oKtW2squt1IuNH2GxBkO3zjfm91WqtqUxjkLWQDsrNdJonrUtz79Mbbg5ZGZ3qTTpO7eluNakUgPtag2GL9jGULTallcN1IZeWMcn1p5sxbHhFbm25VsD+T7g/Jc9XVDjwhlt6LGLu7xxOqxKhjdOh928TY9tVvEuYuisW/V5faiSAhEyiBU2IP0hQatoQRuaiRE0P5KgVcQZzQ8jB60N3djKRaIO7pqFzSxy0N7Nud321rOjqN+2tU2C5rU8bBY2k45uPWEzU3E5f+PPzzvv7iRofmfxt9nYjFTSSNCcTctKKmi/OT0ASJfc/qHT88Fxb6Zym1hJXVgbGskg4M2L1Uhe480vaMxkJr97IC3mNV6V14Uh65ATfp0qbSRolqBBZnQQUUcIog4WdYCoI4ioIwRRB4s6QNQRRNQRgqiDRR0g6ggi6ghB1MGiDhB1BBF1hCDqYFEHiDqCiDpCEHWwqANEHUFEHSGIOljUAaKOIKKOEEQdLOqAMqnDZd8LlxcEBftIWJRzaKR/Ugt44wUh/1L1oMHwpEqbGtK5qgftGTqr0mbtA+QuT9KWNWjkqcHRex+pLPjeLH9md1isXNDIU3bsKkvsuwp1+tb66n0LZL8HrV+PbdI+FZvZTE4SiBGSNvTMbk/hNVqDjg/EOwddWiB6SH/XDB3f+P06HwGkZQk6waA18m9b7QGytreGoQcyo5MIGulnGJ3Z2e08/rXlTwDpR1FHL0EjXfX99rawvw67pdD6DjkvxdGbCAnkid3fSEXEQ/ombCMXVTXAMHcJg3Vj/mDs847TV4A018X1pKqG3urJWeSpJLZvs+fY8oYK6aKqGn5zemA9bLY1TSNf9s3s9qTO/11z/mN7zvUKGPtZcEEQBEEQBNVXvAIcNnYcwHfDSQAAAABJRU5ErkJggg==" />

                                    </svg>

                                    <span
                                        class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Dashboard</span>
                                </div>
                                <!-- Icon -->
                                <div
                                    class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500 @if (in_array(Request::segment(1), ['dashboard'])) {{ 'rotate-180' }} @endif"
                                        :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a> --}}
                        {{-- <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-8 mt-1 @if (!in_array(Request::segment(1), ['dashboard'])) {{ 'hidden' }} @endif"
                                :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate   --}}
                                    {{-- @if (Route::is('dashboard')){{ '!text-violet-500' }}@endif" href="{{ route('dashboard') }} --}}
                                    {{-- "
                                        href="{{ route('dashboard') }}" :active="request() - > routeIs('dashboard')">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Main</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a
                                        class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate  --}}
                                    {{-- @if (Route::is('analytics')){{ '!text-violet-500' }}@endif" href="{{ route('analytics') }} --}}
                                    {{-- ">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Analytics</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a
                                        class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate  --}}
                                    {{-- @if (Route::is('fintech')){{ '!text-violet-500' }}@endif" href="{{ route('fintech') }} --}}
                                    {{-- ">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Fintech</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li> --}}

                    <li class="pl-4 pr-3 pb-2 rounded-lg mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(2), ['antrian-ditangani'])) {{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }} @endif"
                        x-data="{ open: {{ in_array(Request::segment(1), ['dashboard']) ? 1 : 0 }} }">
                        <a class="block text-gray-800 dark:text-gray-100 truncate transition @if (!in_array(Request::segment(2), ['antrian-ditangani'])) {{ 'hover:text-gray-900 dark:hover:text-white' }} @endif"
                            href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    {{-- <i class="fa fa-user-group"></i> --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="20" height="20" viewBox="0 0 20 20" fill="none">

                                        <image id="image0_27_82" width="20" height="20"
                                            xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAFM0lEQVR4nO2czYscRRTAS1GTXITFg18BCRI9aWKCEUWNgmA8eFGWnfd6NXhwD8pGApmpmtnDGK8GY1DR9ZK4XTULC34hJsaLJ9EgxE38+BeUfCkY0HV1V97MBGe0e6a7p7r6Y94PCgZ2pvvNr99U1auuXiEYhmEYhmEYhmEYhmHGlObRvRulgZeUxlPKwGVlcH28GlyWGr9WGvfNHt+zIRXJNd/bLDWeyf7LYk4aLJMT+5nMkteDZFvN7HZ3kXkGYS6bbFVmrYnu9MnZfymVywZfWRMtNf6W/RfCXDZyY0102EnEmKHS9sCiO7BoR7BoR7BoR7BoR7BoR7BoR7BoR7BoR7BoR7BoR7BoR7BoR7BoR7BoR7BoR7BoR7BoR7BoR7BoR7BoR7BoR7BoR7BoRyiNP/K+DkfMLUxvkRpfVBq/5A00jlAGd0oDx2wekLeEuYBFO4JFO6KMomeP79lQ1/io1PiK1Phhd0ZxSRn4U2pcodfSwA/dvx2UvvdIas+tlFG06gxg7yqNv8beC23gF2VwvuF7O9IKrvCiG763Qxo4aXED+omGxu1Wgyyy6P1Lk5ukgSNK418p7PZflQYO08NUYy266nt3KgNnbQv+f4PlqoGtYyla+d69UuO59CV3m8aLtcWpB0YL2lWwJlZ7LDTeVuW+LB5wonPWDOwqjWhp4ONB3YU0cCGz+DSeT9yNZC1W9WfNilqcumPAs+rfZh0jjQs0CBdd9FthcbZnF+lm6x/KoDywNHkTNXrdLW6CZL9WaNH1VuXusHlyGlO4Xsk1jU8EXFwVkhCrcmF6WzFFazwVFqPNYiRA2oo08GTQeeutyo0DPvdpUR9RnglJhJ2uM/kKDd+7ecBn12Srck+hHrqXBv5W7z1zQ2Ai0NpFBpK7bupDjvFOHNH7shatNH4TFButqCVZIIrS6hqfGuSFLkJ3gBx0nEvNpcnrIolufxkDyxln9JGg2GipM6UL+5kFyZ0LZmB3JNHtA/ve5mxlw3NBcdF6ckrnOxTmQhmciPMrkgZeFnGgzKb/uEL/DMT1ACkNPBj8peGjlM530lZGKwMfiDyjeoKd03hbnL0WfdI6RUVfoRFFkqU+mrqh70WeUT3BNn3v+qD3RFzXkIkkRZh1hBUs/znOeVEY0V/sviboPeEl8L+NsjjoszUDj0sDvyctVoYVLL0XTOQZ1RPszPzMtbZF25BdbVVuKZVoZXAiaddBP+9B5xmlGxlasBSt65hbmN6SdDCM0tfSwBflOHTRqOymRq+j/KKcD4b7lyY3KY2vS40/RxjA+hoVJiNN76KV05/HjSuX0ztl4M2kwdY1Ph8i52Dk43SKjIkB8R1KRbTGpnBFs9m8ursBJWnA80HHpR1Eec9oqfFh4Yx1cdVoiz9wNrRaHXYBo82Hn04pmy9GXlSyhdT4xggBrzWOPXtr0HEp2+MWLMnL6ZjZbOBt4Zrm0b0b6V6a0vhTwqx+IfQ2VtJ5dIqS28lhe9tY1kiNJ+KKjlKsjJjNn4iy0dC4nW6IRi1YUs3kKzdnNd4lyog0cHhACd1XaKQpuXtxXxVlpUljgMbTaQqMmM1nEm2gKRJVA1tpbSFDyecOLE7dLsaBmoFdWW1ypF2sYpxQGWzbVQbuF+NIlboRFzeUNZ4em+5iWJEUNvUbsatYpYUoa49WlAG5ML2N9sJRtWYhg9eoGCntPNkGtBeOtml1nimM3w/T2kXpymqRIrSiRsuXtLmFFubpLgjdFmsXN50C54I08J008D69p+57D42yCvcPvJfHpgRcNFMAAAAASUVORK5CYII=" />

                                    </svg>
                                    <span
                                        class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Antrian</span>
                                </div>
                                <!-- Icon -->
                                <div
                                    class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500 @if (in_array(Request::segment(2), ['antrian-ditangani'])) {{ 'rotate-180' }} @endif"
                                        :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        {{-- {{ route('cs.pcAntrian') }}" :active="request()->routeIs('cs.pcAntrian') --}}
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-8 mt-1 @if (!in_array(Request::segment(2), ['antrian-ditangani'])) {{ 'hidden' }} @endif"
                                :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate "
                                        href="{{ route('cs.antrian-ditangani') }}"
                                        :active="request() - > routeIs('cs.antrian-ditangani')">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Panel</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate "
                                        href="{{ route('cs.pcAntrian') }}"
                                        :active="request() - > routeIs('cs.pcAntrian')">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Layar</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>




                    <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(2), ['antrian-ditangani'])) {{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }} @endif"
                        x-data="{ open: {{ in_array(Request::segment(1), ['dashboard']) ? 1 : 0 }} }">
                        <a class="block text-gray-800 dark:text-gray-100 truncate transition @if (!in_array(Request::segment(2), ['antrian-ditangani'])) {{ 'hover:text-gray-900 dark:hover:text-white' }} @endif"
                            href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    {{-- <i class="fa fa-user-group"></i> --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="20" height="20" viewBox="0 0 20 20" fill="none">

                                        <image id="image0_50_219" width="20" height="20"
                                            xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAEzElEQVR4nO2cTYgcVRCAX9QY//Dn4B/+oSIGRDwI/osSEBdjMlWjc1AEFWEPogYRieAhKh686sHfiwiKBBU9GNCos121u0lkSaIExQVRosluV81sEjf+/7S82YksuDvdO9szr2emPqhb7/brj5rXr97UG+cMwzAMwzAMwzAMwzAMwzCMkHxXvfc4YdggjDuU8bAyJj0eh4VxuxA+MrllaFUhsqtWxXOV4YsCyOlMEOz2zxg8k7WfJc+THTSzhWFDcAldipjw4YCicUcRJHQjhGBbMNHKMBtaQPcCZnOVl+ypHBtT+XolfFAIXlaCD5XxS2X4VgjqwjgjBH/7m+d640Fg73jleOXy3U2pmZdnzsjGvonbT1CGJ3ymtvNxckY6Mlq6URj3LmfeckZrNILHhfHP5b4gnLEwSfWmY4TwpbzexM74PweqpVOF4dMsAoXxgDC+LwRPCsFdfpqJR+Hig7z2NP/i/O+TEXzJ1d1IzatpLl8kjF+lC4atMlq+zS/xsiSrFuDhCyO6PgrXKoO0/CeE017wUmcCLcDDF0J0THinEvzSWjLsnuHK+UuV7An94IUQ3dgfblZwi4UQvjv10S0nujbRQRbt51chfD39D+H5JNl0VLuSPQMr2q8KhOCzVhcLwe9xVLrP5YAOoujGyoLg6xTJdeXSzXlI9gyc6MbKgiBufSFM6uj6S12O6KCJVsbfWl0gBB/7giVPyZ5BFN3qgleTieGVrgNoAR4+uGhh+EsZN3ZC8BF00EUL4U/tVHpLRXMYvE8IvxytRXCV3x/36/oarb/aLz/TpsSgooXg++mR0uWdluxZtmSCD3SsvNotQsx4hTD8UDjRQjg+vW3dma5LaLuDJtylEa7Jcg8vuyiZfeSB3/INLa6L6JIzGPfFhPcvtSJVhhcKIVoINiWJW9E5pYsJyJzBPyvj0+3uq9QYrymE6FBoegb/o4ybZ8bKFyznPnG1clJoyYUVLQTbfMWax318sRVacgFFw6RSCfK8z9yXFyY6aWZw3e+Bd6IKFcYXB160EPyhjK/sp8rprgMow5V+a3egRQvBezJSvqRT/99LVob9oQUHF91JlOCeoh3TcP3E5JahVc19jqRIIYSHXL8wFa27UBknQkstXCN6nkiEa33vdWihi0WN4SHXyySbK0cr47PNKjIpZBDuytq9VUimxvAMYfwkuMgUybXxyjmuV4mj0nVC8GNwkQsGzPotZz9d9HQmK8NwWhHS7N/eGGJXsueJ/S4cwdtpGeUz3R9YCj3enkTHyquFYE+6ZKzG1cpZocfbk6g/8ZVS5flVhzA851chocfbt1WeMBysMWLo8fYk9ah0nq+mMrzhd/q+wdDj7Uk0wjXpvYCNTH5j/pkYIyNJ4lb4JVlaA7wy/CpcesDEtsH0XNtwy97sZnzTrQafviKZGF6pXH6s2VKQJvmd2vahk0OPuaeY2Vo5pfk7SqnHnK3Ky4DvKvJtZnW+47I4Kt+qBM8oIWX9Hq/RncRwg+sHwm/C4GIxIhGe7fqFAghNFpgqnuq7Ki+0WJ0fhOQ7QF0/ElwuN3bcPtcISn29rRlOMIgyvJZXj13h6Xy24iFlmJr7GUl4Uwgf9ccflnvy1jAMwzAMwzAMwzAMwzAMw3C9xL8zapdMmRr3rgAAAABJRU5ErkJggg==" />

                                    </svg>
                                    <span
                                        class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Transaksi
                                        Servis</span>
                                </div>
                                <!-- Icon -->
                                <div
                                    class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500 @if (in_array(Request::segment(2), ['antrian-ditangani'])) {{ 'rotate-180' }} @endif"
                                        :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        {{-- {{ route('cs.pcAntrian') }}" :active="request()->routeIs('cs.pcAntrian') --}}
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-8 mt-1 @if (!in_array(Request::segment(2), ['antrian-ditangani'])) {{ 'hidden' }} @endif"
                                :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate "
                                        href="{{ route('cs.booking.index') }}">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">List
                                            Pemesanan</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate "
                                        href="{{ route('cs.booking.create') }}"
                                        :active="request() - > routeIs('cs.booking.create')">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Buat
                                            Pesanan</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>




                    {{-- <a href="{{ route('cs.booking.create') }}" :active="request()->routeIs('cs.booking.create')">
                        <div class="flex items-center justify-between p-3">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 20 20" fill="none">
                      
                                    <image id="image0_50_219" width="20" height="20" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAEzElEQVR4nO2cTYgcVRCAX9QY//Dn4B/+oSIGRDwI/osSEBdjMlWjc1AEFWEPogYRieAhKh686sHfiwiKBBU9GNCos121u0lkSaIExQVRosluV81sEjf+/7S82YksuDvdO9szr2emPqhb7/brj5rXr97UG+cMwzAMwzAMwzAMwzAMwzCMkHxXvfc4YdggjDuU8bAyJj0eh4VxuxA+MrllaFUhsqtWxXOV4YsCyOlMEOz2zxg8k7WfJc+THTSzhWFDcAldipjw4YCicUcRJHQjhGBbMNHKMBtaQPcCZnOVl+ypHBtT+XolfFAIXlaCD5XxS2X4VgjqwjgjBH/7m+d640Fg73jleOXy3U2pmZdnzsjGvonbT1CGJ3ymtvNxckY6Mlq6URj3LmfeckZrNILHhfHP5b4gnLEwSfWmY4TwpbzexM74PweqpVOF4dMsAoXxgDC+LwRPCsFdfpqJR+Hig7z2NP/i/O+TEXzJ1d1IzatpLl8kjF+lC4atMlq+zS/xsiSrFuDhCyO6PgrXKoO0/CeE017wUmcCLcDDF0J0THinEvzSWjLsnuHK+UuV7An94IUQ3dgfblZwi4UQvjv10S0nujbRQRbt51chfD39D+H5JNl0VLuSPQMr2q8KhOCzVhcLwe9xVLrP5YAOoujGyoLg6xTJdeXSzXlI9gyc6MbKgiBufSFM6uj6S12O6KCJVsbfWl0gBB/7giVPyZ5BFN3qgleTieGVrgNoAR4+uGhh+EsZN3ZC8BF00EUL4U/tVHpLRXMYvE8IvxytRXCV3x/36/oarb/aLz/TpsSgooXg++mR0uWdluxZtmSCD3SsvNotQsx4hTD8UDjRQjg+vW3dma5LaLuDJtylEa7Jcg8vuyiZfeSB3/INLa6L6JIzGPfFhPcvtSJVhhcKIVoINiWJW9E5pYsJyJzBPyvj0+3uq9QYrymE6FBoegb/o4ybZ8bKFyznPnG1clJoyYUVLQTbfMWax318sRVacgFFw6RSCfK8z9yXFyY6aWZw3e+Bd6IKFcYXB160EPyhjK/sp8rprgMow5V+a3egRQvBezJSvqRT/99LVob9oQUHF91JlOCeoh3TcP3E5JahVc19jqRIIYSHXL8wFa27UBknQkstXCN6nkiEa33vdWihi0WN4SHXyySbK0cr47PNKjIpZBDuytq9VUimxvAMYfwkuMgUybXxyjmuV4mj0nVC8GNwkQsGzPotZz9d9HQmK8NwWhHS7N/eGGJXsueJ/S4cwdtpGeUz3R9YCj3enkTHyquFYE+6ZKzG1cpZocfbk6g/8ZVS5flVhzA851chocfbt1WeMBysMWLo8fYk9ah0nq+mMrzhd/q+wdDj7Uk0wjXpvYCNTH5j/pkYIyNJ4lb4JVlaA7wy/CpcesDEtsH0XNtwy97sZnzTrQafviKZGF6pXH6s2VKQJvmd2vahk0OPuaeY2Vo5pfk7SqnHnK3Ky4DvKvJtZnW+47I4Kt+qBM8oIWX9Hq/RncRwg+sHwm/C4GIxIhGe7fqFAghNFpgqnuq7Ki+0WJ0fhOQ7QF0/ElwuN3bcPtcISn29rRlOMIgyvJZXj13h6Xy24iFlmJr7GUl4Uwgf9ccflnvy1jAMwzAMwzAMwzAMwzAMw3C9xL8zapdMmRr3rgAAAABJRU5ErkJggg=="/>
                                
                                    </svg>
                                <span class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Transaksi Servis</span>
                            </div>
                        </div>
                       </a> --}}

                    <a href="{{ route('cs.hp.index') }}" :active="request() - > routeIs('cs.hp.index')">
                        <div class="flex items-center justify-between p-3">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="20" height="20" viewBox="0 0 20 20" fill="none">

                                    <image id="image0_50_215" width="20" height="20"
                                        xlink:href="data:image/png;base64,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" />

                                </svg>
                                <span
                                    class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">HP</span>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('cs.pembayaran.index') }}" :active="request() - > routeIs('cs.pembayaran.index')">
                        <div class="flex items-center justify-between p-3">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="20" height="20" viewBox="0 0 20 20" fill="none">

                                    <image id="image0_50_217" width="20" height="20"
                                        xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAEeklEQVR4nO2cS4hcRRRAKypRET+4Mir4IZCk730zqCBxoaMw0/dOBvwgLW50IxL8jJnue3ta8NOIOxF0IfhBAro2bk0UjOhCBRcKKmZhFDGKmk2c4F9baibR+dSbdA/1+lPvHribppq6dbr6vqp6j+ecYRiGYRiGYRiGYRhGSZloX3YWNWAPC37ICsdZsVOugOOk+AEJPsSzW88sRDLPZ5eSwCeDHywOS3zsncSfySa5E5Qdc2YvlovBz6DOkMZsNNFLNXngA+oMY5DC+/FEKy4MekA8vLEQU3T41xT8nRTmJ5vbLvbBkrX8Z7Ha84hE4aK9qDVtJWtFa6+jEYWLprntW1a33aWVi2K15xGJwkX7v//qtjP18UtitecRicJFB0uB4sPR2utoROGiFy9kkrV6uRhyD+1HJQoXbYEmmm1GY3L/BCsdaqI7g56FNqN18OKGrnS4ksEmuj+Y6D5RCtFchhxKMcguMNF9ImnR1TqMs+Dj6yyvnqRmdnU/cklSNCuOseLBrtezAu9yY8dVBeeUlmgSuIsV/uh58yDwJwvcU1ReSYmmBhAJ/t2z5P/jn6rC7UXklozoWruymRW/yenvOxJ8ZvG5N4H7WeFpVjgcntl4dLJ1zfmx80tGNAneEerHCw49ejXRnjiDBB4N5wdzsfNLSfRLayQrHGq33Wnrfk/x5UB++2Pnl4xoFnwjUAZe624JCG+tCIW90fNLRTQJHgjM6C997XZDQDKiWWFvTl/7Qs+E9JtkRE8r3J3XFyn8QgKvk+JulkrlVHW7CJIRXavvPNsv4/L6Wykej7Hg26TwBAncWKvVTncFk4xoD2k2uZFdISl8S4qPTcnYOa4gkhJ9UjYJft+r7BMz/euizjySE+3h2a3nscIjLPBVz8IFj87MZVe6yCQpejk0vwNIKw+w4qss8IU/z+hC+D4XmeRFr6Zar1zIzaxGgq/kPSRJCn/dsmf8AheR0oleDrXGL2fBT0P5VZtwk4tIqUV7qvOVa4OiIx+XJiGamtn1rPDRysCDzrlNp/ruzc1t5wbLRwMoZo5JiJ6SMdzorGTF20Lfjb3ySEK0c25T6NB/aQcId+ZtuX0dZoUfAhfDQ5HzS0a0Y6nUc5drfj0t+BwJNKuCD7LiU/5NA3ntp7Vyb/T8UhFda1c2k+J7ubK7DniziEOnZESfXCOTwDsblezPtP3F0RVAUqL/uxe4+EaFtbU3v7TgEVa4r8jj0+RELy8l0w281dfmdSQ/S4Iz/sdxBZOs6NLlUIpBdoGJ7hOlED0MmOg+YaJTEU2CP4c68C81cSVh0r+NIbRBUjwWrZMTt49CnTRcSWAFzdmJfh6tE1J4MWc39quXHXqFTyrQ3PYtVUEhxd/CpQOej9bZ0lHkxs4eUo9dkt3gYuJPxAY9KB6+2F/ITVAS+HEIBtcZiijo2ZEl2YrXkeJPAx+kDjYWJ1w92+mKZErGrihzGSHBA/7f7foFN3GCBV7wy5vE3126QIqf+dVF9AufYRiGYRiGYRiGYRiGG03+Bbc104DvEL5dAAAAAElFTkSuQmCC" />

                                </svg>
                                <span
                                    class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Metode
                                    Pembayaran</span>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('cs.customer.index') }}" :active="request() - > routeIs('cs.customer.index')">
                        <div class="flex items-center justify-between p-3">
                            <div class="flex items-center">
                                <i class="fa fa-user text-blue-500"></i>
                                <span
                                    class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Customer</span>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('cs.service.index') }}" :active="request() - > routeIs('cs.service.index')">
                        <div class="flex items-center justify-between p-3">
                            <div class="flex items-center">
                                {{-- <i class="fa fa-screwdriver-wrench"></i> --}}
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="20    " height="20    " viewBox="0 0 20    20    " fill="none">


                                    <image id="image0_26_78" width="20  " height="20  "
                                        xlink:href="data:image/png;base64,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" />

                                </svg>
                                <span
                                    class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Service</span>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('cs.antrian-ditangani') }}"
                        :active="request() - > routeIs('cs.antrian-ditangani')">

                        <a href="{{ route('cs.teknisi.index') }}" :active="request() - > routeIs('cs.sparepart.index')">
                            <div class="flex items-center justify-between p-3">
                                <div class="flex items-center">



                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="20" height="20" fill="none">

                                        <image id="image0_26_74" width="20" height="20"
                                            xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAFZUlEQVR4nO2dXWgkRRDHS7mIioqniF+gvijooyFbtblAFB9ERBCN+AXiJ6I+6IN4hy9RQbwTFdQz3rpVGz/eTnxRFBSVexHF84TDU0RBFLnTeDHZ7k3UqJeR2j1FcjuzO5udne7Z/kHBPsxHzT893V091RWAQCAQCAQCgUAgEAikJ9p50TGGcZsROmCFonZmBPcboa16bA+3CCgqYJzARwpOW5snBdKT1JKPEJrppx5uEVC6Fflfa54USE8Quo9EldGRrIVOusdQ0ODyZUZoX9ZCW6ZvDJeuhGFjcRbPs4xvdRSoX0L/dwy+ucDlc2EYaHDpUsM4l06gfglNkWWar9fKl0NRiSI4yjJuNox/rxVomcfPWnv88st0dlqhu72OYVptBjnTcDQUTWTDNBMrEuPmtedYwS1phU57HcO4XX2DomAZn+kQbKyoSNoi1Votn1bSCt3TdZiegiJgmB5L3TIHbEbwEfAZI3iF9ofWATE7vAmrpkpXgY80qni6Efo5bxFt12LjL+0GUx8Gvw/yFs+m70LeB5+wVbwmb9Fsr8blq8EHounJDUboq9wFk14Nv9ZnANexVbo7f7FofVajO8F1/G7N1LSkhS4nMIKYt0i2T1av4ii4SmKYLb4ZPgfOTumEDuYvEPVtXu3kOoit4oV5i2P7LfZLYxeAaxjB2wontNAt4BpGcEcBhX4BXMMw7iqg0B+CaxjBLwoo9F5wDc2BK6DQP4JrGMbfCyc042/gGukfgvQT00PerQHnTT8+pAYyEHqpMnpmEHYAQi+HLqM3Qtfh8mDIrRyMQfnoFfsro8draGqF6nlPv+ygjXGxmd20k47LXOgirmnYtG+j4I5MRdakQJ3E5/2gNn9bzjRBMghNgxFaCV0HadfxImSNDgRW8HkdGBx4haPBGi7ot8SBDIZx9OQ4k2nU8Pq8fDaCj3fyEVwjjcBGtxUzbtNsfAdyBF8vhNDNlFjGXYbxUSulKVPD88EhrEycZgV/9V5oy3gvOI5m/Xsv9PxrpZPAcZIyrMA1vHG0DfUqneKN/9446rv/3jjqu/9G6FA7R31I6o6mJze0n4bSIXCNuGXTpdmxM8BxmnsSYyJBcA3LuKedsw3GG8Bx6lW6Kabr+Ay82R2rJRxeGTsVHEV9s4Lfxgj9NHiW7f+drmm4JLj6oj6pb3F+16tUAjcT0fHzBLEjHVy0jIQTpSxiBu//RbR7nExEV2yVNnXakmyYKnn7qT508HHV8HgZXEY3sCe2FEGbZ1iu91YfklszTYMP6Dpv0qtpGO/Pzzd6IKlrU9/BJ6zghBV6L0bouYM8fmIerVk3AcUI/a76DD5Sn5nYGPfV3ORQ4tIKPhnTVSwtzk6eDD5jmZ6NnYFU8ZKB+SE40a6eU2Gq0GjWqInNBcHvtdUPZhkUf4jpMpa1tggUAcs0nTDKf5xlf92cZTB9kjDDeBiKVQeavkwIDj6a2z55QiZ5ggm7xXRzfeHqTptaedwI/Zkg9qcLlU3n9Ot+WrHRCu1OCEpWdNkAiogVvKdDoDBvGG9dT+jbSiEo3570ZfvwH/YuKDKmQ/h72HZbxmvTfDRoLd6XpuKWawee0pU3UWV0xAi90YXYzRZuBcUK3bFYo4t1BhPNTh6rpr+1poZWi7FMtdaxna+pCTNDU+Y4qoyOWKFXuxK7n8ZU8+HTWv+LwgpuMYJ/ZS2wDsKGSw/CMFOvUinLOkw6hXO6bM+gu5KGlO7T/zzRR4EP6Cxn6LqKbtDgoc50s5Zv6KVL0XO0gmRdyjcWLhDJivrMxMYGl68zTE9Ypnc0stRWagT/aJn+pn2W6e3mMVKa8n4FLhAIBAKBQADWyz+oAe9kkGkpgAAAAABJRU5ErkJggg==" />

                                    </svg>


                                    <span
                                        class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Teknisi</span>
                                </div>
                            </div>
                        </a>
                        {{-- 
                    <a href="{{ route('cs.sparepart.index') }}" :active="request()->routeIs('cs.sparepart.index')">
                    <div class="flex items-center justify-between p-4">
                        <div class="flex items-center">
                            <i class="fa fa-square-check"></i>
                            <span class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">CS</span>
                        </div>
                    </div></a> --}}

                        <a href="{{ route('cs.sparepart.index') }}"
                            :active="request() - > routeIs('cs.sparepart.index')">
                            <div class="flex items-center justify-between p-3">
                                <div class="flex items-center">
                                    {{-- <i class="fa fa-toolbox"></i> --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="20" height="20" viewBox="0 0 20 20" fill="none">

                                        <image id="image0_26_76" width="20" height="20"
                                            xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAADeklEQVR4nO2cy2sUQRCHWw8+LhIEUTzoJV7iY6sSFG+5xe3aaPSQP0HwIl4U9ZSjj0gQokchiHjISRSC6HZvEBL/A08SERPxQUDM46DESG8STUJ2M7uZ7Z7Z+X3QLMxOT1d/U1PzYBilAAAAAAAAACDLjPee3m003TSa3llNc+7XCN1wy0PH1jSUOjt3WSFjhRfXNyNUdP83cvxiof1CpDh17rxKM0Zy1zaSvEr21UaMu6jUNqtpwI0RZf2lWPie66eSxnBv2w4jdMcIfa4m00ZtmhdcSYkjNqP54cp2o6z/Pw4aVEnDaLodi2BZL5wej+Rbd9YbV1HzpdXbi9JnzVGmcxdVkrCaphoiWsrZPVY8e2x/rTEZ4cNGeGZrounn6+6OQyopNEyy/JM9aQvtHbXEZDQPrd9OfXOhRyozoqV8gpqxQj1R4nl1jg8aod9xiDZCv0py8oDKimi7lNkLtsDXN41H05WN+tc7FyN8WWVKtKzUTh5yVzqV46HnsYrW/ExlUbQtZzcNVIxH08eYM/qDyqxo4elK8RhN8/FmNM2rpr+8k0oZzZO1ijZCL9yJcqM+b/K0z2oerjDerGrqGxapKvpW5Xh4olI/I/zNFKh3zfoF6nXLK49H71VibsGdbB+ZrWnKjVX1ZKj5aYQdNWzO5I5WyeLVO+eJSgtRJKqYKOn27jh3bkk4r9KCT9F9fWq7EXobU4kac9tTacGnaMdogY4YTd+3ItnV7VIXt6o04Vu0o5jnE+4auC7JmidGdcdxlTZCiHaUenIt5Qf/muYiSp61mvtH8qf2qDQSSvQKL7va9hrhP5ue+HpyLSrNhBbtiCJapR2I9gREewKiPQHRnoBoT0C0JyDaExDtCYj2BERvkajPapNw+2tiiMH7s+nyS+VCD6zQj+U22MwvlI+Hmq8Rvl/LuxZpx4Sar9X8ZYND76tqUmyo+TbtY8akzReiGaIzkdFZawqiGaJtAjIRGS3h5aF0SHixqNEC0cGzziKjObgolA4JLxE1WpLTcMMiEL0YOgubIqNVk2Ih2g8Q7QmI9gREewKisyo6a01BNEO0TUAmIqMlvDyUDgkvFjVaIDp41llkNAcXhdIh4SUmo0aH+DKYJKsZ4U8eRHN/6Ina0E3z3YaLdl/pWv7S+HTwCYv3Nu3mXu1LZQAAAAAAAAAAAAAqA/wFIYhuUZ6HB7IAAAAASUVORK5CYII=" />

                                    </svg>
                                    <span
                                        class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Sparepart</span>
                                </div>
                            </div>
                        </a>
                    
{{-- 
                        <a href="{{ route('cs.sparepart.index') }}"
                        :active="request() - > routeIs('cs.sparepart.index')">
                        <div class="flex items-center justify-between p-3">
                            <div class="flex items-center">
                                {{-- <i class="fa fa-toolbox"></i> --}}
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="20" height="20" viewBox="0 0 20 20" fill="none">

                                    <image id="image0_26_76" width="20" height="20"
                                        xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAADeklEQVR4nO2cy2sUQRCHWw8+LhIEUTzoJV7iY6sSFG+5xe3aaPSQP0HwIl4U9ZSjj0gQokchiHjISRSC6HZvEBL/A08SERPxQUDM46DESG8STUJ2M7uZ7Z7Z+X3QLMxOT1d/U1PzYBilAAAAAAAAACDLjPee3m003TSa3llNc+7XCN1wy0PH1jSUOjt3WSFjhRfXNyNUdP83cvxiof1CpDh17rxKM0Zy1zaSvEr21UaMu6jUNqtpwI0RZf2lWPie66eSxnBv2w4jdMcIfa4m00ZtmhdcSYkjNqP54cp2o6z/Pw4aVEnDaLodi2BZL5wej+Rbd9YbV1HzpdXbi9JnzVGmcxdVkrCaphoiWsrZPVY8e2x/rTEZ4cNGeGZrounn6+6OQyopNEyy/JM9aQvtHbXEZDQPrd9OfXOhRyozoqV8gpqxQj1R4nl1jg8aod9xiDZCv0py8oDKimi7lNkLtsDXN41H05WN+tc7FyN8WWVKtKzUTh5yVzqV46HnsYrW/ExlUbQtZzcNVIxH08eYM/qDyqxo4elK8RhN8/FmNM2rpr+8k0oZzZO1ijZCL9yJcqM+b/K0z2oerjDerGrqGxapKvpW5Xh4olI/I/zNFKh3zfoF6nXLK49H71VibsGdbB+ZrWnKjVX1ZKj5aYQdNWzO5I5WyeLVO+eJSgtRJKqYKOn27jh3bkk4r9KCT9F9fWq7EXobU4kac9tTacGnaMdogY4YTd+3ItnV7VIXt6o04Vu0o5jnE+4auC7JmidGdcdxlTZCiHaUenIt5Qf/muYiSp61mvtH8qf2qDQSSvQKL7va9hrhP5ue+HpyLSrNhBbtiCJapR2I9gREewKiPQHRnoBoT0C0JyDaExDtCYj2BERvkajPapNw+2tiiMH7s+nyS+VCD6zQj+U22MwvlI+Hmq8Rvl/LuxZpx4Sar9X8ZYND76tqUmyo+TbtY8akzReiGaIzkdFZawqiGaJtAjIRGS3h5aF0SHixqNEC0cGzziKjObgolA4JLxE1WpLTcMMiEL0YOgubIqNVk2Ih2g8Q7QmI9gREewKisyo6a01BNEO0TUAmIqMlvDyUDgkvFjVaIDp41llkNAcXhdIh4SUmo0aH+DKYJKsZ4U8eRHN/6Ina0E3z3YaLdl/pWv7S+HTwCYv3Nu3mXu1LZQAAAAAAAAAAAAAqA/wFIYhuUZ6HB7IAAAAASUVORK5CYII=" />

                                </svg>
                                <span
                                    class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Sparepart</span>
                            </div>
                        </div>
                    </a> --}}










                        <!-- E-Commerce -->
                        {{-- <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(1), ['ecommerce'])){{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }}@endif" x-data="{ open: {{ in_array(Request::segment(1), ['ecommerce']) ? 1 : 0 }} }">
                        <a class="block text-gray-800 dark:text-gray-100 truncate transition @if (!in_array(Request::segment(1), ['ecommerce'])){{ 'hover:text-gray-900 dark:hover:text-white' }}@endif" href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="shrink-0 fill-current @if (in_array(Request::segment(1), ['ecommerce'])){{ 'text-violet-500' }}@else{{ 'text-gray-400 dark:text-gray-500' }}@endif" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                        <path d="M9 6.855A3.502 3.502 0 0 0 8 0a3.5 3.5 0 0 0-1 6.855v1.656L5.534 9.65a3.5 3.5 0 1 0 1.229 1.578L8 10.267l1.238.962a3.5 3.5 0 1 0 1.229-1.578L9 8.511V6.855ZM6.5 3.5a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Zm4.803 8.095c.005-.005.01-.01.013-.016l.012-.016a1.5 1.5 0 1 1-.025.032ZM3.5 11c.474 0 .897.22 1.171.563l.013.016.013.017A1.5 1.5 0 1 1 3.5 11Z" />
                                    </svg>
                                    <span class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">E-Commerce</span>
                                </div>
                                <!-- Icon -->
                                <div class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500 @if (in_array(Request::segment(1), ['ecommerce'])){{ 'rotate-180' }}@endif" :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-8 mt-1 @if (!in_array(Request::segment(1), ['ecommerce'])){{ 'hidden' }}@endif" :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('customers')){{ '!text-violet-500' }}@endif" href="{{ route('customers') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Customers</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('orders')){{ '!text-violet-500' }}@endif" href="{{ route('orders') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Orders</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('invoices')){{ '!text-violet-500' }}@endif" href="{{ route('invoices') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Invoices</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('shop')){{ '!text-violet-500' }}@endif" href="{{ route('shop') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Shop</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('shop-2')){{ '!text-violet-500' }}@endif" href="{{ route('shop-2') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Shop 2</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('product')){{ '!text-violet-500' }}@endif" href="{{ route('product') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Single Product</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('cart')){{ '!text-violet-500' }}@endif" href="{{ route('cart') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Cart</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('cart-2')){{ '!text-violet-500' }}@endif" href="{{ route('cart-2') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Cart 2</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('cart-3')){{ '!text-violet-500' }}@endif" href="{{ route('cart-3') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Cart 3</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('pay')){{ '!text-violet-500' }}@endif" href="{{ route('pay') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Pay</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- Community -->
                    <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(1), ['community'])){{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }}@endif" x-data="{ open: {{ in_array(Request::segment(1), ['community']) ? 1 : 0 }} }">
                        <a class="block text-gray-800 dark:text-gray-100 truncate transition @if (!in_array(Request::segment(1), ['community'])){{ 'hover:text-gray-900 dark:hover:text-white' }}@endif" href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="shrink-0 fill-current @if (in_array(Request::segment(1), ['community'])){{ 'text-violet-500' }}@else{{ 'text-gray-400 dark:text-gray-500' }}@endif" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                        <path d="M12 1a1 1 0 1 0-2 0v2a3 3 0 0 0 3 3h2a1 1 0 1 0 0-2h-2a1 1 0 0 1-1-1V1ZM1 10a1 1 0 1 0 0 2h2a1 1 0 0 1 1 1v2a1 1 0 1 0 2 0v-2a3 3 0 0 0-3-3H1ZM5 0a1 1 0 0 1 1 1v2a3 3 0 0 1-3 3H1a1 1 0 0 1 0-2h2a1 1 0 0 0 1-1V1a1 1 0 0 1 1-1ZM12 13a1 1 0 0 1 1-1h2a1 1 0 1 0 0-2h-2a3 3 0 0 0-3 3v2a1 1 0 1 0 2 0v-2Z" />
                                    </svg>
                                    <span class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Community</span>
                                </div>
                                <!-- Icon -->
                                <div class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500 @if (in_array(Request::segment(1), ['community'])){{ 'rotate-180' }}@endif" :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-8 mt-1 @if (!in_array(Request::segment(1), ['community'])){{ 'hidden' }}@endif" :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('users-tabs')){{ '!text-violet-500' }}@endif" href="{{ route('users-tabs') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Users - Tabs</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('users-tiles')){{ '!text-violet-500' }}@endif" href="{{ route('users-tiles') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Users - Tiles</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('profile')){{ '!text-violet-500' }}@endif" href="{{ route('profile') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Profile</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('feed')){{ '!text-violet-500' }}@endif" href="{{ route('feed') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Feed</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('forum')){{ '!text-violet-500' }}@endif" href="{{ route('forum') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Forum</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('forum-post')){{ '!text-violet-500' }}@endif" href="{{ route('forum-post') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Forum - Post</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('meetups')){{ '!text-violet-500' }}@endif" href="{{ route('meetups') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Meetups</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('meetups-post')){{ '!text-violet-500' }}@endif" href="{{ route('meetups-post') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Meetups - Post</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- Finance -->
                    <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(1), ['finance'])){{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }}@endif" x-data="{ open: {{ in_array(Request::segment(1), ['finance']) ? 1 : 0 }} }">
                        <a class="block text-gray-800 dark:text-gray-100 truncate transition @if (!in_array(Request::segment(1), ['finance'])){{ 'hover:text-gray-900 dark:hover:text-white' }}@endif" href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="shrink-0 fill-current @if (in_array(Request::segment(1), ['finance'])){{ 'text-violet-500' }}@else{{ 'text-gray-400 dark:text-gray-500' }}@endif" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                        <path d="M6 0a6 6 0 0 0-6 6c0 1.077.304 2.062.78 2.912a1 1 0 1 0 1.745-.976A3.945 3.945 0 0 1 2 6a4 4 0 0 1 4-4c.693 0 1.344.194 1.936.525A1 1 0 1 0 8.912.779 5.944 5.944 0 0 0 6 0Z" />
                                        <path d="M10 4a6 6 0 1 0 0 12 6 6 0 0 0 0-12Zm-4 6a4 4 0 1 1 8 0 4 4 0 0 1-8 0Z" />
                                    </svg>
                                    <span class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Finance</span>
                                </div>
                                <!-- Icon -->
                                <div class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500 @if (in_array(Request::segment(1), ['finance'])){{ 'rotate-180' }}@endif" :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-8 mt-1 @if (!in_array(Request::segment(1), ['finance'])){{ 'hidden' }}@endif" :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('credit-cards')){{ '!text-violet-500' }}@endif" href="{{ route('credit-cards') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Cards</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('transactions')){{ '!text-violet-500' }}@endif" href="{{ route('transactions') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Transactions</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('transaction-details')){{ '!text-violet-500' }}@endif" href="{{ route('transaction-details') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Transaction Details</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- Job Board -->
                    <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(1), ['job'])){{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }}@endif" x-data="{ open: {{ in_array(Request::segment(1), ['job']) ? 1 : 0 }} }">
                        <a class="block text-gray-800 dark:text-gray-100 truncate transition @if (!in_array(Request::segment(1), ['job'])){{ 'hover:text-gray-900 dark:hover:text-white' }}@endif" href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="shrink-0 fill-current @if (in_array(Request::segment(1), ['job'])){{ 'text-violet-500' }}@else{{ 'text-gray-400 dark:text-gray-500' }}@endif" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                        <path d="M6.753 2.659a1 1 0 0 0-1.506-1.317L2.451 4.537l-.744-.744A1 1 0 1 0 .293 5.207l1.5 1.5a1 1 0 0 0 1.46-.048l3.5-4ZM6.753 10.659a1 1 0 1 0-1.506-1.317l-2.796 3.195-.744-.744a1 1 0 0 0-1.414 1.414l1.5 1.5a1 1 0 0 0 1.46-.049l3.5-4ZM8 4.5a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H9a1 1 0 0 1-1-1ZM9 11.5a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z" />
                                    </svg>
                                    <span class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Job Board</span>
                                </div>
                                <!-- Icon -->
                                <div class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500 @if (in_array(Request::segment(1), ['job'])){{ 'rotate-180' }}@endif" :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-8 mt-1 @if (!in_array(Request::segment(1), ['job'])){{ 'hidden' }}@endif" :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('job-listing')){{ '!text-violet-500' }}@endif" href="{{ route('job-listing') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Listing</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('job-post')){{ '!text-violet-500' }}@endif" href="{{ route('job-post') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Job Post</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('company-profile')){{ '!text-violet-500' }}@endif" href="{{ route('company-profile') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Company Profile</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- Tasks -->
                    <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(1), ['tasks'])){{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }}@endif" x-data="{ open: {{ in_array(Request::segment(1), ['tasks']) ? 1 : 0 }} }">
                        <a class="block text-gray-800 dark:text-gray-100 truncate transition @if (!in_array(Request::segment(1), ['tasks'])){{ 'hover:text-gray-900 dark:hover:text-white' }}@endif" href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="shrink-0 fill-current @if (in_array(Request::segment(1), ['tasks'])){{ 'text-violet-500' }}@else{{ 'text-gray-400 dark:text-gray-500' }}@endif" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                        <path d="M7.586 9H1a1 1 0 1 1 0-2h6.586L6.293 5.707a1 1 0 0 1 1.414-1.414l3 3a1 1 0 0 1 0 1.414l-3 3a1 1 0 1 1-1.414-1.414L7.586 9ZM3.075 4.572a1 1 0 1 1-1.64-1.144 8 8 0 1 1 0 9.144 1 1 0 0 1 1.64-1.144 6 6 0 1 0 0-6.856Z" />
                                    </svg>                                       
                                    <span class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Tasks</span>
                                </div>
                                <!-- Icon -->
                                <div class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500 @if (in_array(Request::segment(1), ['tasks'])){{ 'rotate-180' }}@endif" :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-8 mt-1 @if (!in_array(Request::segment(1), ['tasks'])){{ 'hidden' }}@endif" :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('tasks-kanban')){{ '!text-violet-500' }}@endif" href="{{ route('tasks-kanban') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Kanban</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('tasks-list')){{ '!text-violet-500' }}@endif" href="{{ route('tasks-list') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">List</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- Messages -->
                    <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(1), ['messages'])){{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }}@endif">
                        <a class="block text-gray-800 dark:text-gray-100 truncate transition @if (!in_array(Request::segment(1), ['messages'])){{ 'hover:text-gray-900 dark:hover:text-white' }}@endif" href="{{ route('messages') }}">
                            <div class="flex items-center justify-between">
                                <div class="grow flex items-center">
                                    <svg class="shrink-0 fill-current @if (in_array(Request::segment(1), ['messages'])){{ 'text-violet-500' }}@else{{ 'text-gray-400 dark:text-gray-500' }}@endif" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                        <path d="M13.95.879a3 3 0 0 0-4.243 0L1.293 9.293a1 1 0 0 0-.274.51l-1 5a1 1 0 0 0 1.177 1.177l5-1a1 1 0 0 0 .511-.273l8.414-8.414a3 3 0 0 0 0-4.242L13.95.879ZM11.12 2.293a1 1 0 0 1 1.414 0l1.172 1.172a1 1 0 0 1 0 1.414l-8.2 8.2-3.232.646.646-3.232 8.2-8.2Z" />
                                        <path d="M10 14a1 1 0 1 0 0 2h5a1 1 0 1 0 0-2h-5Z" />
                                    </svg>
                                    <span class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Messages</span>
                                </div>
                                <!-- Badge -->
                                <div class="flex flex-shrink-0 ml-2">
                                    <span class="inline-flex items-center justify-center h-5 text-xs font-medium text-white bg-violet-400 px-2 rounded">4</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!-- Inbox -->
                    <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(1), ['inbox'])){{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }}@endif">
                        <a class="block text-gray-800 dark:text-gray-100 truncate transition @if (!in_array(Request::segment(1), ['inbox'])){{ 'hover:text-gray-900 dark:hover:text-white' }}@endif" href="{{ route('inbox') }}">
                            <div class="flex items-center">
                                <svg class="shrink-0 fill-current @if (in_array(Request::segment(1), ['inbox'])){{ 'text-violet-500' }}@else{{ 'text-gray-400 dark:text-gray-500' }}@endif" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                    <path d="M11.92 6.851c.044-.027.09-.05.137-.07.481-.275.758-.68.908-1.256.126-.55.169-.81.357-2.058.075-.498.144-.91.217-1.264-4.122.75-7.087 2.984-9.12 6.284a18.087 18.087 0 0 0-1.985 4.585 17.07 17.07 0 0 0-.354 1.506c-.05.265-.076.448-.086.535a1 1 0 0 1-1.988-.226c.056-.49.209-1.312.502-2.357a20.063 20.063 0 0 1 2.208-5.09C5.31 3.226 9.306.494 14.913.004a1 1 0 0 1 .954 1.494c-.237.414-.375.993-.567 2.267-.197 1.306-.244 1.586-.392 2.235-.285 1.094-.789 1.853-1.552 2.363-.748 3.816-3.976 5.06-8.515 4.326a1 1 0 0 1 .318-1.974c2.954.477 4.918.025 5.808-1.556-.628.085-1.335.121-2.127.121a1 1 0 1 1 0-2c1.458 0 2.434-.116 3.08-.429Z" />
                                </svg>   
                                <span class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Inbox</span>
                            </div>
                        </a>
                    </li>
                    <!-- Calendar -->
                    <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(1), ['calendar'])){{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }}@endif">
                        <a class="block text-gray-800 dark:text-gray-100 truncate transition @if (!in_array(Request::segment(1), ['calendar'])){{ 'hover:text-gray-900 dark:hover:text-white' }}@endif" href="{{ route('calendar') }}">
                            <div class="flex items-center">
                                <svg class="shrink-0 fill-current @if (in_array(Request::segment(1), ['calendar'])){{ 'text-violet-500' }}@else{{ 'text-gray-400 dark:text-gray-500' }}@endif" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                    <path d="M5 4a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2H5Z" />
                                    <path d="M4 0a4 4 0 0 0-4 4v8a4 4 0 0 0 4 4h8a4 4 0 0 0 4-4V4a4 4 0 0 0-4-4H4ZM2 4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4Z" />
                                </svg>
                                <span class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Calendar</span>
                            </div>
                        </a>
                    </li>
                    <!-- Campaigns -->
                    <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(1), ['campaigns'])){{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }}@endif">
                        <a class="block text-gray-800 dark:text-gray-100 truncate transition @if (!in_array(Request::segment(1), ['campaigns'])){{ 'hover:text-gray-900 dark:hover:text-white' }}@endif" href="{{ route('campaigns') }}">
                            <div class="flex items-center">
                                <svg class="shrink-0 fill-current @if (in_array(Request::segment(1), ['campaigns'])){{ 'text-violet-500' }}@else{{ 'text-gray-400 dark:text-gray-500' }}@endif" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                    <path d="M6.649 1.018a1 1 0 0 1 .793 1.171L6.997 4.5h3.464l.517-2.689a1 1 0 1 1 1.964.378L12.498 4.5h2.422a1 1 0 0 1 0 2h-2.807l-.77 4h2.117a1 1 0 1 1 0 2h-2.501l-.517 2.689a1 1 0 1 1-1.964-.378l.444-2.311H5.46l-.517 2.689a1 1 0 1 1-1.964-.378l.444-2.311H1a1 1 0 1 1 0-2h2.807l.77-4H2.46a1 1 0 0 1 0-2h2.5l.518-2.689a1 1 0 0 1 1.17-.793ZM9.307 10.5l.77-4H6.612l-.77 4h3.464Z" />
                                </svg>
                                <span class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Campaigns</span>
                            </div>
                        </a>
                    </li>
                    <!-- Settings -->
                    <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(1), ['settings'])){{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }}@endif" x-data="{ open: {{ in_array(Request::segment(1), ['settings']) ? 1 : 0 }} }">
                        <a class="block text-gray-800 dark:text-gray-100 truncate transition @if (!in_array(Request::segment(1), ['settings'])){{ 'hover:text-gray-900 dark:hover:text-white' }}@endif" href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="shrink-0 fill-current @if (in_array(Request::segment(1), ['settings'])){{ 'text-violet-500' }}@else{{ 'text-gray-400 dark:text-gray-500' }}@endif" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                        <path d="M10.5 1a3.502 3.502 0 0 1 3.355 2.5H15a1 1 0 1 1 0 2h-1.145a3.502 3.502 0 0 1-6.71 0H1a1 1 0 0 1 0-2h6.145A3.502 3.502 0 0 1 10.5 1ZM9 4.5a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM5.5 9a3.502 3.502 0 0 1 3.355 2.5H15a1 1 0 1 1 0 2H8.855a3.502 3.502 0 0 1-6.71 0H1a1 1 0 1 1 0-2h1.145A3.502 3.502 0 0 1 5.5 9ZM4 12.5a1.5 1.5 0 1 0 3 0 1.5 1.5 0 0 0-3 0Z" fill-rule="evenodd" />
                                    </svg>
                                    <span class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Settings</span>
                                </div>
                                <!-- Icon -->
                                <div class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500 @if (in_array(Request::segment(1), ['settings'])){{ 'rotate-180' }}@endif" :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-8 mt-1 @if (!in_array(Request::segment(1), ['settings'])){{ 'hidden' }}@endif" :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('account')){{ '!text-violet-500' }}@endif" href="{{ route('account') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">My Account</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('notifications')){{ '!text-violet-500' }}@endif" href="{{ route('notifications') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">My Notifications</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('apps')){{ '!text-violet-500' }}@endif" href="{{ route('apps') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Connected Apps</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('plans')){{ '!text-violet-500' }}@endif" href="{{ route('plans') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Plans</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('billing')){{ '!text-violet-500' }}@endif" href="{{ route('billing') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Billing & Invoices</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('feedback')){{ '!text-violet-500' }}@endif" href="{{ route('feedback') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Give Feedback</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- Utility -->
                    <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(1), ['utility'])){{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }}@endif" x-data="{ open: {{ in_array(Request::segment(1), ['utility']) ? 1 : 0 }} }">
                        <a class="block text-gray-800 dark:text-gray-100 truncate transition @if (!in_array(Request::segment(1), ['utility'])){{ 'hover:text-gray-900 dark:hover:text-white' }}@endif" href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="shrink-0 fill-current @if (in_array(Request::segment(1), ['utility'])){{ 'text-violet-500' }}@else{{ 'text-gray-400 dark:text-gray-500' }}@endif" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                        <path d="M14.75 2.5a1.25 1.25 0 1 0 0-2.5 1.25 1.25 0 0 0 0 2.5ZM14.75 16a1.25 1.25 0 1 0 0-2.5 1.25 1.25 0 0 0 0 2.5ZM2.5 14.75a1.25 1.25 0 1 1-2.5 0 1.25 1.25 0 0 1 2.5 0ZM1.25 2.5a1.25 1.25 0 1 0 0-2.5 1.25 1.25 0 0 0 0 2.5Z" />
                                        <path d="M8 2a6 6 0 1 0 0 12A6 6 0 0 0 8 2ZM4 8a4 4 0 1 1 8 0 4 4 0 0 1-8 0Z" />
                                    </svg>
                                    <span class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Utility</span>
                                </div>
                                <!-- Icon -->
                                <div class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500 @if (in_array(Request::segment(1), ['utility'])){{ 'rotate-180' }}@endif" :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-8 mt-1 @if (!in_array(Request::segment(1), ['utility'])){{ 'hidden' }}@endif" :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('changelog')){{ '!text-violet-500' }}@endif" href="{{ route('changelog') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Changelog</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('roadmap')){{ '!text-violet-500' }}@endif" href="{{ route('roadmap') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Roadmap</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('faqs')){{ '!text-violet-500' }}@endif" href="{{ route('faqs') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">FAQs</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('empty-state')){{ '!text-violet-500' }}@endif" href="{{ route('empty-state') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Empty State</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('404')){{ '!text-violet-500' }}@endif" href="{{ route('404') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">404</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li> --}}
                </ul>
            </div>
            <!-- More group -->
            <div>
                <h3 class="text-xs uppercase text-gray-400 dark:text-gray-500 font-semibold pl-3">
                    <span class="hidden lg:block lg:sidebar-expanded:hidden 2xl:hidden text-center w-6"
                        aria-hidden="true">•••</span>
                    <span class="lg:hidden lg:sidebar-expanded:block 2xl:block">More</span>
                </h3>
                <ul class="mt-3">
                    <!-- Authentication -->
                    <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0" x-data="{ open: false }">
                        <a class="block text-gray-800 dark:text-gray-100 truncate transition"
                            :class="open ? '' : 'hover:text-gray-900 dark:hover:text-white'" href="#0"
                            @click.prevent="open = !open; sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="shrink-0 fill-current text-gray-400 dark:text-gray-500"
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M11.442 4.576a1 1 0 1 0-1.634-1.152L4.22 11.35 1.773 8.366A1 1 0 1 0 .227 9.634l3.281 4a1 1 0 0 0 1.59-.058l6.344-9ZM15.817 4.576a1 1 0 1 0-1.634-1.152l-5.609 7.957a1 1 0 0 0-1.347 1.453l.656.8a1 1 0 0 0 1.59-.058l6.344-9Z" />
                                    </svg>
                                    <span
                                        class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Authentication</span>
                                </div>
                                <!-- Icon -->
                                <div
                                    class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500"
                                        :class="{ 'rotate-180': open }" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-8 mt-1" :class="{ 'hidden': !open }" x-cloak>
                                <li class="mb-1 last:mb-0">
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf

                                        <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate"
                                            href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                            <span
                                                class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Sign
                                                In</span>
                                        </a>
                                    </form>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf

                                        <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate"
                                            href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                            <span
                                                class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Sign
                                                Up</span>
                                        </a>
                                    </form>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf

                                        <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate"
                                            href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                            <span
                                                class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Reset
                                                Password</span>
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {{-- <!-- Onboarding -->
                    <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0" x-data="{ open: false }">
                        <a class="block text-gray-800 dark:text-gray-100 truncate transition" :class="open ? '' : 'hover:text-gray-900 dark:hover:text-white'" href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="shrink-0 fill-current text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                        <path d="M6.668.714a1 1 0 0 1-.673 1.244 6.014 6.014 0 0 0-4.037 4.037 1 1 0 1 1-1.916-.571A8.014 8.014 0 0 1 5.425.041a1 1 0 0 1 1.243.673ZM7.71 4.709a3 3 0 1 0 0 6 3 3 0 0 0 0-6ZM9.995.04a1 1 0 1 0-.57 1.918 6.014 6.014 0 0 1 4.036 4.037 1 1 0 0 0 1.917-.571A8.014 8.014 0 0 0 9.995.041ZM14.705 8.75a1 1 0 0 1 .673 1.244 8.014 8.014 0 0 1-5.383 5.384 1 1 0 0 1-.57-1.917 6.014 6.014 0 0 0 4.036-4.037 1 1 0 0 1 1.244-.673ZM1.958 9.424a1 1 0 0 0-1.916.57 8.014 8.014 0 0 0 5.383 5.384 1 1 0 0 0 .57-1.917 6.014 6.014 0 0 1-4.037-4.037Z" />
                                    </svg>
                                    <span class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Onboarding</span>
                                </div>
                                <!-- Icon -->
                                <div class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500" :class="{ 'rotate-180': open }" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-8 mt-1 @if (!in_array(Request::segment(1), ['onboarding'])){{ 'hidden' }}@endif" :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate" href="{{ route('onboarding-01') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Step 1</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate" href="{{ route('onboarding-02') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Step 2</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate" href="{{ route('onboarding-03') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Step 3</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate" href="{{ route('onboarding-04') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Step 4</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- Components -->
                    <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(1), ['component'])){{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }}@endif" x-data="{ open: {{ in_array(Request::segment(1), ['component']) ? 1 : 0 }} }">
                        <a class="block text-gray-800 dark:text-gray-100 truncate transition" :class="open ? '' : 'hover:text-gray-900 dark:hover:text-white'" href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="shrink-0 fill-current @if (in_array(Request::segment(1), ['component'])){{ 'text-violet-500' }}@else{{ 'text-gray-400 dark:text-gray-500' }}@endif" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                        <path d="M.06 10.003a1 1 0 0 1 1.948.455c-.019.08.01.152.078.19l5.83 3.333c.053.03.116.03.168 0l5.83-3.333a.163.163 0 0 0 .078-.188 1 1 0 0 1 1.947-.459 2.161 2.161 0 0 1-1.032 2.384l-5.83 3.331a2.168 2.168 0 0 1-2.154 0l-5.83-3.331a2.162 2.162 0 0 1-1.032-2.382Zm7.856-7.981-5.83 3.332a.17.17 0 0 0 0 .295l5.828 3.33c.054.031.118.031.17.002l5.83-3.333a.17.17 0 0 0 0-.294L8.085 2.023a.172.172 0 0 0-.17-.001ZM9.076.285l5.83 3.332c1.458.833 1.458 2.935 0 3.768l-5.83 3.333c-.667.38-1.485.38-2.153-.001l-5.83-3.332c-1.457-.833-1.457-2.935 0-3.767L6.925.285a2.173 2.173 0 0 1 2.15 0Z" />
                                    </svg>  
                                    <span class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Components</span>
                                </div>
                                <!-- Icon -->
                                <div class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500" :class="{ 'rotate-180': open }" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-8 mt-1 @if (!in_array(Request::segment(1), ['component'])){{ 'hidden' }}@endif" :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('button-page')){{ '!text-violet-500' }}@endif" href="{{ route('button-page') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Button</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('form-page')){{ '!text-violet-500' }}@endif" href="{{ route('form-page') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Input Form</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('dropdown-page')){{ '!text-violet-500' }}@endif" href="{{ route('dropdown-page') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Dropdown</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('alert-page')){{ '!text-violet-500' }}@endif" href="{{ route('alert-page') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Alert & Banner</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('modal-page')){{ '!text-violet-500' }}@endif" href="{{ route('modal-page') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Modal</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('pagination-page')){{ '!text-violet-500' }}@endif" href="{{ route('pagination-page') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Pagination</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('tabs-page')){{ '!text-violet-500' }}@endif" href="{{ route('tabs-page') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Tabs</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('breadcrumb-page')){{ '!text-violet-500' }}@endif" href="{{ route('breadcrumb-page') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Breadcrumb</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('badge-page')){{ '!text-violet-500' }}@endif" href="{{ route('badge-page') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Badge</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('avatar-page')){{ '!text-violet-500' }}@endif" href="{{ route('avatar-page') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Avatar</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('tooltip-page')){{ '!text-violet-500' }}@endif" href="{{ route('tooltip-page') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Tooltip</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('accordion-page')){{ '!text-violet-500' }}@endif" href="{{ route('accordion-page') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Accordion</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('icons-page')){{ '!text-violet-500' }}@endif" href="{{ route('icons-page') }}">
                                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Icons</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li> --}}
                </ul>
            </div>
        </div>

        <!-- Expand / collapse button -->
        <div class="pt-3 hidden lg:inline-flex 2xl:hidden justify-end mt-auto">
            <div class="w-12 pl-4 pr-3 py-2">
                <button
                    class="text-gray-400 hover:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400 transition-colors"
                    @click="sidebarExpanded = !sidebarExpanded">
                    <span class="sr-only">Expand / collapse sidebar</span>
                    <svg class="shrink-0 fill-current text-gray-400 dark:text-gray-500 sidebar-expanded:rotate-180"
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                        <path
                            d="M15 16a1 1 0 0 1-1-1V1a1 1 0 1 1 2 0v14a1 1 0 0 1-1 1ZM8.586 7H1a1 1 0 1 0 0 2h7.586l-2.793 2.793a1 1 0 1 0 1.414 1.414l4.5-4.5A.997.997 0 0 0 12 8.01M11.924 7.617a.997.997 0 0 0-.217-.324l-4.5-4.5a1 1 0 0 0-1.414 1.414L8.586 7M12 7.99a.996.996 0 0 0-.076-.373Z" />
                    </svg>
                </button>
            </div>
        </div>

    </div>
</div>
