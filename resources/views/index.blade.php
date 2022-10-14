<!DOCTYPE html>
<html
    class="bg-base-200"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    data-theme="winter"
>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />

        <title>SISTEM KONTROL | Suhu & Kelembaban Kumbung Jamur</title>
    </head>
    <body class="bg-base-200">
        @if (session()->has('success'))
        <div class="toast toast-end z-50">
            <div class="alert alert-success">
                <div>
                    <span>{{ session("success") }}</span>
                </div>
            </div>
        </div>
        @elseif (session()->has('info'))
        <div class="toast toast-end z-50">
            <div class="alert alert-info">
                <div>
                    <span>{{ session("info") }}</span>
                </div>
            </div>
        </div>
        @elseif (session()->has('error'))
        <div class="toast toast-end z-50">
            <div class="alert alert-error">
                <div>
                    <span>{{ session("error") }}</span>
                </div>
            </div>
        </div>
        @endif @if ($errors->any())
        <div class="toast toast-end z-50">
            <div class="alert alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
        <div
            class="justify-center text-center text-xl lg:text-2xl font-bold pt-5"
        >
            SISTEM KONTROL<br />Suhu & Kelembaban Kumbung Jamur
        </div>
        <div class="grid lg:grid-cols-2 gap-5">
            <div class="card p-10">
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body items-center text-center">
                        <h2 class="card-title pb-5">Nilai Sensor Rata-rata</h2>
                        <div class="grid lg:grid-cols-2 gap-4 lg:gap-24">
                            <div>
                                <div
                                    id="temp-avg"
                                    class="radial-progress text-primary"
                                    style="
                                        --value: {{ ($latest->temp_avg / 33) * 100 }};
                                        --size: 10rem;
                                        --thickness: 1.5rem;
                                    "
                                >
                                    {{ $latest->temp_avg }}° C
                                </div>
                                <div class="text-center pt-2">Suhu</div>
                            </div>

                            <div>
                                <div
                                    id="humid-avg"
                                    class="radial-progress text-secondary"
                                    style="
                                        --value: {{ ($latest->humid_avg * 90) / 100 }};
                                        --size: 10rem;
                                        --thickness: 1.5rem;
                                    "
                                >
                                    {{ $latest->humid_avg }}%
                                </div>
                                <div class="text-center pt-2">Kelembaban</div>
                            </div>

                            <div>
                                <div class="card bg-base-200 p-4">
                                    <i
                                        id="kipas"
                                        class="fa-solid fa-fan text-primary text-7xl"
                                    ></i>
                                </div>
                                <div class="text-center py-2">Kipas</div>
                            </div>
                            <div>
                                <div class="card bg-base-200 p-5">
                                    <i
                                        id="pompa"
                                        class="fa-solid fa-droplet text-primary text-6xl"
                                    ></i>
                                </div>
                                <div class="text-center py-2">Pompa</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card p-10">
                <div class="grid lg:grid-cols-2 gap-3">
                    <div class="card bg-base-100 shadow-xl p-5">
                        <div class="form-control pb-4">
                            <div class="text-xl text-center font-bold py-2">
                                Kipas
                            </div>
                            <label class="label cursor-pointer">
                                <span class="label-text text-lg">OFF</span>
                                <input
                                    id="checkKipas"
                                    type="checkbox"
                                    class="toggle toggle-lg toggle-primary"
                                />
                                <span class="label-text text-lg">ON</span>
                            </label>
                        </div>
                        <div class="form-control">
                            <div class="text-xl text-center font-bold py-2">
                                Pompa
                            </div>
                            <label class="label cursor-pointer">
                                <span class="label-text text-lg">OFF</span>
                                <input
                                    id="checkPompa"
                                    type="checkbox"
                                    class="toggle toggle-lg toggle-primary"
                                />
                                <span class="label-text text-lg">ON</span>
                            </label>
                        </div>
                    </div>
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body items-center text-center">
                            <h2 class="card-title pb-5">Sensor 1</h2>
                            <div class="grid grid-cols-2 gap-5">
                                <div
                                    id="temp-1"
                                    class="radial-progress text-primary"
                                    style="
                                        --value: {{ ($latest->temp_1 / 33) * 100 }};
                                        --size: 6rem;
                                        --thickness: 1rem;
                                    "
                                >
                                    {{ $latest->temp_1 }}° C
                                </div>
                                <div
                                    id="humid-1"
                                    class="radial-progress text-secondary"
                                    style="
                                        --value: {{ ($latest->humid_1 * 90) / 100 }};
                                        --size: 6rem;
                                        --thickness: 1rem;
                                    "
                                >
                                    {{ $latest->humid_1 }}%
                                </div>
                            </div>
                            <div class="grid pt-5 grid-cols-2 w-full gap-5">
                                <div class="text-center">Suhu</div>
                                <div class="text-center">Kelembaban</div>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body items-center text-center">
                            <h2 class="card-title pb-5">Sensor 2</h2>
                            <div class="grid grid-cols-2 gap-5">
                                <div
                                    id="temp-2"
                                    class="radial-progress text-primary"
                                    style="
                                        --value: {{ ($latest->temp_2 / 33) * 100 }};
                                        --size: 6rem;
                                        --thickness: 1rem;
                                    "
                                >
                                    {{ $latest->temp_2 }}° C
                                </div>
                                <div
                                    id="humid-2"
                                    class="radial-progress text-secondary"
                                    style="
                                        --value: {{ ($latest->humid_2 * 90) / 100 }};
                                        --size: 6rem;
                                        --thickness: 1rem;
                                    "
                                >
                                    {{ $latest->humid_2 }}%
                                </div>
                            </div>
                            <div class="grid pt-5 grid-cols-2 w-full gap-5">
                                <div class="text-center">Suhu</div>
                                <div class="text-center">Kelembaban</div>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body items-center text-center">
                            <h2 class="card-title pb-5">Sensor 3</h2>
                            <div class="grid grid-cols-2 gap-5">
                                <div
                                    id="temp-3"
                                    class="radial-progress text-primary"
                                    style="
                                        --value: {{ ($latest->temp_3 / 33) * 100 }};
                                        --size: 6rem;
                                        --thickness: 1rem;
                                    "
                                >
                                    {{ $latest->temp_3 }}° C
                                </div>
                                <div
                                    id="humid-3"
                                    class="radial-progress text-secondary"
                                    style="
                                        --value: {{ ($latest->humid_3 * 90) / 100 }};
                                        --size: 6rem;
                                        --thickness: 1rem;
                                    "
                                >
                                    {{ $latest->humid_3 }}%
                                </div>
                            </div>
                            <div class="grid pt-5 grid-cols-2 w-full gap-5">
                                <div class="text-center">Suhu</div>
                                <div class="text-center">Kelembaban</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card p-10">
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body item-center text-center">
                    <h2 class="card-title text-center justify-center">
                        Riwayat Pendeteksian
                    </h2>
                    <div class="overflow-x-auto">
                        <table class="table table-compact w-full">
                            <thead class="text-center">
                                <tr>
                                    <th>Waktu</th>
                                    <th>Rata-rata Suhu</th>
                                    <th>Rata-rata Kelembaban</th>
                                    <th>PWM Kipas</th>
                                    <th>PWM Pompa</th>
                                    <th>Keterangan</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach($data as $row)
                                <tr class="hover">
                                    <th>{{ $row->created_at }}</th>
                                    <td>{{ $row->temp_avg }}° C</td>
                                    <td>{{ $row->humid_avg }}%</td>
                                    <td>{{ $row->pwm_kipas }}</td>
                                    <td>{{ $row->pwm_pompa }}</td>
                                    <td>{{ $row->keterangan }}</td>
                                    <td>
                                        <div class="dropdown dropdown-left">
                                            <label
                                                tabindex="0"
                                                class="btn btn-ghost btn-xs"
                                                ><i
                                                    class="fa-solid fa-ellipsis"
                                                ></i
                                            ></label>
                                            <ul
                                                tabindex="0"
                                                class="dropdown-content menu p-2 shadow bg-base-100 rounded-box"
                                            >
                                                <li>
                                                    <a
                                                        href="/{{ $row->id }}/edit"
                                                        ><i
                                                            class="fa-solid fa-pen"
                                                        ></i>
                                                        Edit</a
                                                    >
                                                </li>
                                                <li>
                                                    <form
                                                        action="/{{ $row->id }}/delete"
                                                        method="post"
                                                    >
                                                        @method('delete') @csrf
                                                        <button>
                                                            <i
                                                                class="fa-solid fa-trash pr-2"
                                                            ></i>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="card p-10">
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body item-center text-center">
                    <h2 class="card-title text-center justify-center">
                        Statistik Pendeteksian
                    </h2>
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>
    </body>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"
        integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    ></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    ></script>
    <script>
        // function getRandInt(min, max) {
        //     return Math.floor(Math.random() * (max - min)) + min;
        // }
        // var temp_1 = getRandInt(26, 28);
        // var temp_2 = getRandInt(26, 28);
        // var temp_3 = getRandInt(26, 28);

        // var humid_1 = getRandInt(80, 90);
        // var humid_2 = getRandInt(80, 90);
        // var humid_3 = getRandInt(80, 90);

        // var temp_avg = (temp_1 + temp_2 + temp_3) / 3;
        // var humid_avg = (humid_1 + humid_2 + humid_3) / 3;

        // $("#temp-1").html(temp_1 + "°C");
        // $("#temp-2").html(temp_2 + "°C");
        // $("#temp-3").html(temp_3 + "°C");

        // $("#temp-1").css("--value", (temp_1 / 33) * 100);
        // $("#temp-2").css("--value", (temp_2 / 33) * 100);
        // $("#temp-3").css("--value", (temp_3 / 33) * 100);

        // $("#humid-1").html(humid_1);
        // $("#humid-2").html(humid_2);
        // $("#humid-3").html(humid_3);

        // $("#humid-1").css("--value", (humid_1 * 90) / 100);
        // $("#humid-2").css("--value", (humid_2 * 90) / 100);
        // $("#humid-3").css("--value", (humid_3 * 90) / 100);

        // $("#temp-avg").html(Math.round(temp_avg) + "°C");

        // $("#temp-avg").css("--value", (temp_avg / 33) * 100);

        // $("#humid-avg").html(Math.round(humid_avg));

        // $("#humid-avg").css("--value", (humid_avg * 90) / 100);
    </script>
    <script>
        $("#checkKipas").change(function () {
            if ($("#checkKipas").is(":checked")) {
                $("#kipas").addClass("animate-spin");
            } else {
                $("#kipas").removeClass("animate-spin");
            }
        });

        $("#checkPompa").change(function () {
            if ($("#checkPompa").is(":checked")) {
                $("#pompa").addClass("animate-bounce");
            } else {
                $("#pompa").removeClass("animate-bounce");
            }
        });
    </script>
    <script>
        const ctx = document.getElementById("lineChart").getContext("2d");
        const myChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: @JSON($waktu),
                datasets: [
                    {
                        label: "Suhu",
                        data: @JSON($suhu),
                        backgroundColor: ["rgba(0, 125, 255, 0.2)"],
                        borderColor: ["rgba(0, 125, 255, 1)"],
                        borderWidth: 3,
                        fill: true,
                        tension: 0.3,
                        pointRadius: 0,
                    },
                    {
                        label: "Kelembaban",
                        data: @JSON($kelembaban),
                        backgroundColor: ["rgba(125, 125, 200, 0.2)"],
                        borderColor: ["rgba(125, 125, 200, 1)"],
                        borderWidth: 3,
                        fill: true,
                        tension: 0.3,
                        pointRadius: 0,
                    },
                ],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
                interaction: {
                    mode: "nearest",
                    axis: "x",
                    intersect: false,
                },
            },
        });
    </script>
    <script>
        $(".toast")
            .fadeTo(2000, 500)
            .slideUp(500, function () {
                $(".toast").slideUp(500);
            });
    </script>
</html>
