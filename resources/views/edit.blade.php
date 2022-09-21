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
        <div class="alert alert-success shadow-lg rounded-none">
            <div>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="stroke-current flex-shrink-0 h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                </svg>
                <span>Data berhasil dihapus!</span>
            </div>
        </div>
        @endif
        <div
            class="justify-center text-center text-xl lg:text-2xl font-bold pt-5"
        >
            FORM EDIT DATA
        </div>
        <form action="/{{ $data->id }}" method="post">
            @csrf
            <div class="card justify-center items-center w-full">
                <div class="form-control w-5/6 lg:w-1/2">
                    <label class="label">
                        <span class="label-text">Waktu</span>
                    </label>
                    <input
                        name="waktu"
                        type="datetime-local"
                        class="input input-bordered w-full"
                        value="{{ $data->waktu }}"
                    />
                </div>
                <div class="grid grid-cols-3 w-5/6 lg:w-1/2 gap-2">
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Suhu Sensor 1</span>
                        </label>
                        <input
                            name="temp_1"
                            type="number"
                            class="input input-bordered w-full"
                            value="{{ $data->temp_1 }}"
                        />
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Suhu Sensor 2</span>
                        </label>
                        <input
                            name="temp_2"
                            type="number"
                            class="input input-bordered w-full"
                            value="{{ $data->temp_2 }}"
                        />
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Suhu Sensor 3</span>
                        </label>
                        <input
                            name="temp_3"
                            type="number"
                            class="input input-bordered w-full"
                            value="{{ $data->temp_3 }}"
                        />
                    </div>
                </div>
                <div class="grid grid-cols-3 w-5/6 lg:w-1/2 gap-2">
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Kelembaban Sensor 1</span>
                        </label>
                        <input
                            name="humid_1"
                            type="number"
                            class="input input-bordered w-full"
                            value="{{ $data->humid_1 }}"
                        />
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Kelembaban Sensor 2</span>
                        </label>
                        <input
                            name="humid_2"
                            type="number"
                            class="input input-bordered w-full"
                            value="{{ $data->humid_2 }}"
                        />
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Kelembaban Sensor 3</span>
                        </label>
                        <input
                            name="humid_3"
                            type="number"
                            class="input input-bordered w-full"
                            value="{{ $data->humid_3 }}"
                        />
                    </div>
                </div>
                <div class="grid grid-cols-2 w-5/6 lg:w-1/2 gap-2">
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">PWM Kipas</span>
                        </label>
                        <input
                            name="pwm_kipas"
                            type="number"
                            class="input input-bordered w-full"
                            value="{{ $data->pwm_kipas }}"
                        />
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">PWM Pompa</span>
                        </label>
                        <input
                            name="pwm_pompa"
                            type="number"
                            class="input input-bordered w-full"
                            value="{{ $data->pwm_pompa }}"
                        />
                    </div>
                </div>
                <div class="grid grid-cols-2 w-5/6 lg:w-1/2 gap-5 py-5">
                    <a href="/" class="btn">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </div>
        </form>
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
</html>
