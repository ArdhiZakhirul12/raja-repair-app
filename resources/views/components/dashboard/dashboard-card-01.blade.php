@props(['title', 'total'])

<div class="flex flex-col col-span-full sm:col-span-4 xl:col-span-3 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
    <div class="px-4 py-4">
        {{-- <i class="fa-solid fa-user"></i> --}}
        @if ($title == 'Servis')
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="35" height="35"
                viewBox="0 0 35 35" fill="none">

                <image id="image0_50_219" width="35" height="35"
                    xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAEzElEQVR4nO2cTYgcVRCAX9QY//Dn4B/+oSIGRDwI/osSEBdjMlWjc1AEFWEPogYRieAhKh686sHfiwiKBBU9GNCos121u0lkSaIExQVRosluV81sEjf+/7S82YksuDvdO9szr2emPqhb7/brj5rXr97UG+cMwzAMwzAMwzAMwzAMwzCMkHxXvfc4YdggjDuU8bAyJj0eh4VxuxA+MrllaFUhsqtWxXOV4YsCyOlMEOz2zxg8k7WfJc+THTSzhWFDcAldipjw4YCicUcRJHQjhGBbMNHKMBtaQPcCZnOVl+ypHBtT+XolfFAIXlaCD5XxS2X4VgjqwjgjBH/7m+d640Fg73jleOXy3U2pmZdnzsjGvonbT1CGJ3ymtvNxckY6Mlq6URj3LmfeckZrNILHhfHP5b4gnLEwSfWmY4TwpbzexM74PweqpVOF4dMsAoXxgDC+LwRPCsFdfpqJR+Hig7z2NP/i/O+TEXzJ1d1IzatpLl8kjF+lC4atMlq+zS/xsiSrFuDhCyO6PgrXKoO0/CeE017wUmcCLcDDF0J0THinEvzSWjLsnuHK+UuV7An94IUQ3dgfblZwi4UQvjv10S0nujbRQRbt51chfD39D+H5JNl0VLuSPQMr2q8KhOCzVhcLwe9xVLrP5YAOoujGyoLg6xTJdeXSzXlI9gyc6MbKgiBufSFM6uj6S12O6KCJVsbfWl0gBB/7giVPyZ5BFN3qgleTieGVrgNoAR4+uGhh+EsZN3ZC8BF00EUL4U/tVHpLRXMYvE8IvxytRXCV3x/36/oarb/aLz/TpsSgooXg++mR0uWdluxZtmSCD3SsvNotQsx4hTD8UDjRQjg+vW3dma5LaLuDJtylEa7Jcg8vuyiZfeSB3/INLa6L6JIzGPfFhPcvtSJVhhcKIVoINiWJW9E5pYsJyJzBPyvj0+3uq9QYrymE6FBoegb/o4ybZ8bKFyznPnG1clJoyYUVLQTbfMWax318sRVacgFFw6RSCfK8z9yXFyY6aWZw3e+Bd6IKFcYXB160EPyhjK/sp8rprgMow5V+a3egRQvBezJSvqRT/99LVob9oQUHF91JlOCeoh3TcP3E5JahVc19jqRIIYSHXL8wFa27UBknQkstXCN6nkiEa33vdWihi0WN4SHXyySbK0cr47PNKjIpZBDuytq9VUimxvAMYfwkuMgUybXxyjmuV4mj0nVC8GNwkQsGzPotZz9d9HQmK8NwWhHS7N/eGGJXsueJ/S4cwdtpGeUz3R9YCj3enkTHyquFYE+6ZKzG1cpZocfbk6g/8ZVS5flVhzA851chocfbt1WeMBysMWLo8fYk9ah0nq+mMrzhd/q+wdDj7Uk0wjXpvYCNTH5j/pkYIyNJ4lb4JVlaA7wy/CpcesDEtsH0XNtwy97sZnzTrQafviKZGF6pXH6s2VKQJvmd2vahk0OPuaeY2Vo5pfk7SqnHnK3Ky4DvKvJtZnW+47I4Kt+qBM8oIWX9Hq/RncRwg+sHwm/C4GIxIhGe7fqFAghNFpgqnuq7Ki+0WJ0fhOQ7QF0/ElwuN3bcPtcISn29rRlOMIgyvJZXj13h6Xy24iFlmJr7GUl4Uwgf9ccflnvy1jAMwzAMwzAMwzAMwzAMw3C9xL8zapdMmRr3rgAAAABJRU5ErkJggg==" />

            </svg>
        @elseif($title == 'Pendapatan')
            <img src="{{ asset('images/Profit.svg') }}" alt="">
        @elseif($title == 'Customer')
            <img src="{{ asset('images/batch-assign.svg') }}" alt="">
        @elseif($title == 'Teknisi')
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="35"
                height="35" fill="none">

                <image id="image0_26_74" width="35" height="35"
                    xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAFZUlEQVR4nO2dXWgkRRDHS7mIioqniF+gvijooyFbtblAFB9ERBCN+AXiJ6I+6IN4hy9RQbwTFdQz3rpVGz/eTnxRFBSVexHF84TDU0RBFLnTeDHZ7k3UqJeR2j1FcjuzO5udne7Z/kHBPsxHzT893V091RWAQCAQCAQCgUAgEAikJ9p50TGGcZsROmCFonZmBPcboa16bA+3CCgqYJzARwpOW5snBdKT1JKPEJrppx5uEVC6Fflfa54USE8Quo9EldGRrIVOusdQ0ODyZUZoX9ZCW6ZvDJeuhGFjcRbPs4xvdRSoX0L/dwy+ucDlc2EYaHDpUsM4l06gfglNkWWar9fKl0NRiSI4yjJuNox/rxVomcfPWnv88st0dlqhu72OYVptBjnTcDQUTWTDNBMrEuPmtedYwS1phU57HcO4XX2DomAZn+kQbKyoSNoi1Votn1bSCt3TdZiegiJgmB5L3TIHbEbwEfAZI3iF9ofWATE7vAmrpkpXgY80qni6Efo5bxFt12LjL+0GUx8Gvw/yFs+m70LeB5+wVbwmb9Fsr8blq8EHounJDUboq9wFk14Nv9ZnANexVbo7f7FofVajO8F1/G7N1LSkhS4nMIKYt0i2T1av4ii4SmKYLb4ZPgfOTumEDuYvEPVtXu3kOoit4oV5i2P7LfZLYxeAaxjB2wontNAt4BpGcEcBhX4BXMMw7iqg0B+CaxjBLwoo9F5wDc2BK6DQP4JrGMbfCyc042/gGukfgvQT00PerQHnTT8+pAYyEHqpMnpmEHYAQi+HLqM3Qtfh8mDIrRyMQfnoFfsro8draGqF6nlPv+ygjXGxmd20k47LXOgirmnYtG+j4I5MRdakQJ3E5/2gNn9bzjRBMghNgxFaCV0HadfxImSNDgRW8HkdGBx4haPBGi7ot8SBDIZx9OQ4k2nU8Pq8fDaCj3fyEVwjjcBGtxUzbtNsfAdyBF8vhNDNlFjGXYbxUSulKVPD88EhrEycZgV/9V5oy3gvOI5m/Xsv9PxrpZPAcZIyrMA1vHG0DfUqneKN/9446rv/3jjqu/9G6FA7R31I6o6mJze0n4bSIXCNuGXTpdmxM8BxmnsSYyJBcA3LuKedsw3GG8Bx6lW6Kabr+Ay82R2rJRxeGTsVHEV9s4Lfxgj9NHiW7f+drmm4JLj6oj6pb3F+16tUAjcT0fHzBLEjHVy0jIQTpSxiBu//RbR7nExEV2yVNnXakmyYKnn7qT508HHV8HgZXEY3sCe2FEGbZ1iu91YfklszTYMP6Dpv0qtpGO/Pzzd6IKlrU9/BJ6zghBV6L0bouYM8fmIerVk3AcUI/a76DD5Sn5nYGPfV3ORQ4tIKPhnTVSwtzk6eDD5jmZ6NnYFU8ZKB+SE40a6eU2Gq0GjWqInNBcHvtdUPZhkUf4jpMpa1tggUAcs0nTDKf5xlf92cZTB9kjDDeBiKVQeavkwIDj6a2z55QiZ5ggm7xXRzfeHqTptaedwI/Zkg9qcLlU3n9Ot+WrHRCu1OCEpWdNkAiogVvKdDoDBvGG9dT+jbSiEo3570ZfvwH/YuKDKmQ/h72HZbxmvTfDRoLd6XpuKWawee0pU3UWV0xAi90YXYzRZuBcUK3bFYo4t1BhPNTh6rpr+1poZWi7FMtdaxna+pCTNDU+Y4qoyOWKFXuxK7n8ZU8+HTWv+LwgpuMYJ/ZS2wDsKGSw/CMFOvUinLOkw6hXO6bM+gu5KGlO7T/zzRR4EP6Cxn6LqKbtDgoc50s5Zv6KVL0XO0gmRdyjcWLhDJivrMxMYGl68zTE9Ypnc0stRWagT/aJn+pn2W6e3mMVKa8n4FLhAIBAKBQADWyz+oAe9kkGkpgAAAAABJRU5ErkJggg==" />

            </svg>
        @endif

        <header class="flex justify-between items-start mb-2">

            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Total {{ $title }}</h2>
            <!-- Menu button -->
            {{-- <div class="relative inline-flex" x-data="{ open: false }">
                <button
                    class="rounded-full"
                    :class="open ? 'bg-gray-100 dark:bg-gray-700/60 text-gray-500 dark:text-gray-400': 'text-gray-400 hover:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400'"          
                    aria-haspopup="true"
                    @click.prevent="open = !open"
                    :aria-expanded="open"
                >
                    <span class="sr-only">Menu</span>
                    <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32">
                        <circle cx="16" cy="16" r="2" />
                        <circle cx="10" cy="16" r="2" />
                        <circle cx="22" cy="16" r="2" />
                    </svg>
                </button>
                <div
                    class="origin-top-right z-10 absolute top-full right-0 min-w-36 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700/60 py-1.5 rounded-lg shadow-lg overflow-hidden mt-1"                
                    @click.outside="open = false"
                    @keydown.escape.window="open = false"
                    x-show="open"
                    x-transition:enter="transition ease-out duration-200 transform"
                    x-transition:enter-start="opacity-0 -translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-out duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    x-cloak                
                >
                    <ul>
                        <li>
                            <a class="font-medium text-sm text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-200 flex py-1 px-3" href="#0" @click="open = false" @focus="open = true" @focusout="open = false">Option 1</a>
                        </li>
                        <li>
                            <a class="font-medium text-sm text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-200 flex py-1 px-3" href="#0" @click="open = false" @focus="open = true" @focusout="open = false">Option 2</a>
                        </li>
                        <li>
                            <a class="font-medium text-sm text-red-500 hover:text-red-600 flex py-1 px-3" href="#0" @click="open = false" @focus="open = true" @focusout="open = false">Remove</a>
                        </li>
                    </ul>
                </div>
            </div> --}}
        </header>

        <div class="flex items-center">
            <div class="text-3xl font-bold text-gray-800 dark:text-gray-100 mr-2">
                {{ $total }}
            </div>
            {{-- <div class="text-sm font-medium text-green-700 px-1.5 bg-green-500/20 rounded-full">+49%</div> --}}
            <div class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase mb-1">
                @if ($title == 'Servis')
           Servis
            @elseif($title == 'Pendapatan')
                
            @elseif($title == 'Customer')
                Pelanggan
            @elseif($title == 'Teknisi')
                Teknisi
            @endif
            </div>
        </div>

        <p class="text-sm text-gray-400">Total keseluruhan {{ $title }}</p>
    </div>
    <!-- Chart built with Chart.js 3 -->
    <!-- Check out src/js/components/dashboard-card-01.js for config -->
    {{-- <div class="grow max-sm:max-h-[128px] xl:max-h-[108px]">
        <!-- Change the height attribute to adjust the chart height -->
        <canvas id="dashboard-card-01" width="389" height="128"></canvas>
    </div> --}}
</div>
