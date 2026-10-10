<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Timbangan Digital</title>


    <style>

        * {
            box-sizing: border-box;
        }


        body {
            margin: 0;
            padding: 20px;

            font-family: Arial, sans-serif;

            background: #f2f2f2;
        }


        .container {
            max-width: 600px;

            margin: 30px auto;

            background: white;

            padding: 30px;

            border-radius: 20px;

            box-shadow:
                0 5px 20px rgba(0, 0, 0, 0.1);
        }


        h1 {
            text-align: center;

            margin-bottom: 30px;
        }


        .label {
            text-align: center;

            color: #666;

            font-size: 18px;
        }


        .weight {
            text-align: center;

            font-size: 60px;

            font-weight: bold;

            margin: 20px 0;
        }


        .unit {
            font-size: 25px;

            color: #555;
        }


        /* BAR BERAT */

        .bar-container {
            width: 100%;

            height: 25px;

            background: #ddd;

            border-radius: 15px;

            overflow: hidden;

            margin: 25px 0;
        }


        .bar {
            height: 100%;

            width: 0%;

            background: #2196F3;

            transition: width 0.2s;
        }


        /* BUTTON */

        button {
            width: 100%;

            padding: 15px;

            border: none;

            border-radius: 12px;

            background: #2196F3;

            color: white;

            font-size: 18px;

            font-weight: bold;

            cursor: pointer;
        }


        button:hover {
            background: #1976D2;
        }


        button:active {
            transform: scale(0.98);
        }


        /* PESAN */

        #pesan {
            text-align: center;

            margin-top: 15px;

            font-weight: bold;
        }


        /* STATUS */

        .status {
            text-align: center;

            margin-top: 20px;

            color: green;
        }


        /* ========================= */
        /* FILTER */
        /* ========================= */

        .filter {
            margin-top: 30px;

            padding: 20px;

            background: #f7f7f7;

            border-radius: 15px;
        }


        .filter h2 {
            margin-top: 0;

            font-size: 20px;
        }


        .filter-row {
            display: grid;

            grid-template-columns:
                1fr 1fr 1fr;

            gap: 10px;

            margin-bottom: 15px;
        }


        .filter-group {
            display: flex;

            flex-direction: column;

            gap: 5px;
        }


        .filter-group label {
            font-size: 13px;

            color: #666;
        }


        .filter-group select {
            width: 100%;

            padding: 10px;

            border: 1px solid #ccc;

            border-radius: 8px;

            background: white;

            font-size: 14px;
        }


        .filter-buttons {
            display: flex;

            gap: 10px;
        }


        .filter-buttons button {
            flex: 1;

            padding: 10px;

            font-size: 15px;
        }


        .btn-reset {
            background: #777;
        }


        .btn-reset:hover {
            background: #555;
        }


        /* ========================= */
        /* RIWAYAT */
        /* ========================= */

        .history {
            margin-top: 30px;
        }


        .history h2 {
            font-size: 20px;

            margin-bottom: 15px;
        }


        /*
         * INI YANG MEMBUAT RIWAYAT
         * MEMILIKI SCROLLBAR
         */

        .history-list {
            max-height: 300px;

            overflow-y: auto;

            padding-right: 5px;

            border: 1px solid #eee;

            border-radius: 10px;

            padding-left: 15px;

            padding-right: 15px;
        }


        .data {
            display: flex;

            justify-content: space-between;

            align-items: center;

            padding: 15px 0;

            border-bottom: 1px solid #ddd;

            gap: 10px;
        }


        .data:last-child {
            border-bottom: none;
        }


        .data strong {
            font-size: 16px;
        }


        .data span {
            color: #666;

            font-size: 14px;

            text-align: right;
        }


        .empty {
            text-align: center;

            color: #777;

            padding: 30px 10px;
        }


        /* ========================= */
        /* RESPONSIVE HP */
        /* ========================= */

        @media (max-width: 500px) {

            .container {
                margin: 10px auto;

                padding: 20px;
            }


            .weight {
                font-size: 50px;
            }


            .filter-row {
                grid-template-columns: 1fr;
            }


            .data {
                flex-direction: column;

                align-items: flex-start;
            }


            .data span {
                text-align: left;
            }

        }

    </style>

</head>


<body>


<div class="container">


    <h1>
        Timbangan Digital
    </h1>


    <!-- ========================= -->
    <!-- BERAT REALTIME -->
    <!-- ========================= -->

    <div class="label">

        Berat Saat Ini

    </div>


    <div class="weight">

        <span id="berat">
            0.000
        </span>

        <span class="unit">
            kg
        </span>

    </div>


    <!-- BAR -->

    <div class="bar-container">

        <div
            class="bar"
            id="bar">
        </div>

    </div>


    <!-- SIMPAN -->

    <button onclick="simpanData()">

        SIMPAN DATA

    </button>


    <div id="pesan"></div>


    <!-- STATUS -->

    <div class="status">

        ● Sistem Online

    </div>


    <!-- ========================= -->
    <!-- FILTER RIWAYAT -->
    <!-- ========================= -->

    <div class="filter">

        <h2>
            Filter Riwayat
        </h2>


        <form
            method="GET"
            action="/"
        >

            <div class="filter-row">


                <!-- TANGGAL -->

                <div class="filter-group">

                    <label>
                        Tanggal
                    </label>

                    <select name="tanggal">

                        <option value="">
                            Semua
                        </option>


                        @for ($i = 1; $i <= 31; $i++)

                            <option
                                value="{{ $i }}"
                                {{ request('tanggal') == $i ? 'selected' : '' }}
                            >
                                {{ $i }}
                            </option>

                        @endfor

                    </select>

                </div>


                <!-- BULAN -->

                <div class="filter-group">

                    <label>
                        Bulan
                    </label>

                    <select name="bulan">

                        <option value="">
                            Semua
                        </option>


                        @php

                            $namaBulan = [
                                1 => 'Januari',
                                2 => 'Februari',
                                3 => 'Maret',
                                4 => 'April',
                                5 => 'Mei',
                                6 => 'Juni',
                                7 => 'Juli',
                                8 => 'Agustus',
                                9 => 'September',
                                10 => 'Oktober',
                                11 => 'November',
                                12 => 'Desember'
                            ];

                        @endphp


                        @foreach ($namaBulan as $nomor => $nama)

                            <option
                                value="{{ $nomor }}"
                                {{ request('bulan') == $nomor ? 'selected' : '' }}
                            >
                                {{ $nama }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <!-- TAHUN -->

                <div class="filter-group">

                    <label>
                        Tahun
                    </label>

                    <select name="tahun">

                        <option value="">
                            Semua
                        </option>


                        @foreach ($tahunTersedia as $tahun)

                            <option
                                value="{{ $tahun }}"
                                {{ request('tahun') == $tahun ? 'selected' : '' }}
                            >
                                {{ $tahun }}
                            </option>

                        @endforeach

                    </select>

                </div>

            </div>


            <div class="filter-buttons">

                <button type="submit">

                    CARI

                </button>


                <button
                    type="button"
                    class="btn-reset"
                    onclick="window.location='/'"
                >

                    RESET

                </button>

            </div>

        </form>

    </div>


    <!-- ========================= -->
    <!-- RIWAYAT -->
    <!-- ========================= -->

    <div class="history">


        <h2>

            Riwayat Timbangan

        </h2>


        <!-- SCROLL AREA -->

        <div class="history-list">


            @forelse ($dataTimbangan as $data)

                <div class="data">

                    <strong>

                        {{ number_format(
                            $data->berat,
                            3
                        ) }}

                        kg

                    </strong>


                    <span>

                        {{ $data->created_at
                            ->format('d-m-Y H:i')
                        }}

                    </span>


                    <form
                        action="{{ route('timbangan.destroy', $data->id) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus data {{ number_format($data->berat, 3) }} kg?')"
                    >
                        @csrf

                        <button type="submit" class="btn-hapus">
                            Hapus
                        </button>
                    </form>

                </div>

            @empty


                <div class="empty">

                    Tidak ada data pada
                    tanggal/bulan/tahun tersebut.

                </div>


            @endforelse


        </div>

    </div>


</div>


<script>


// =====================================================
// REALTIME BERAT DARI WEMOS
// =====================================================

function updateBerat() {


    fetch('/api/berat')


        .then(response => {


            if (!response.ok) {

                throw new Error(
                    'Gagal mengambil data'
                );

            }


            return response.json();

        })


        .then(data => {


            let berat =
                parseFloat(data.berat);


            if (isNaN(berat)) {

                throw new Error(
                    'Data berat tidak valid'
                );

            }


            // Tampilkan berat

            document.getElementById(
                "berat"
            ).innerText =
                berat.toFixed(3);


            // =========================
            // BAR
            // =========================

            let persen =
                (berat / 10) * 100;


            if (persen > 100) {

                persen = 100;

            }


            if (persen < 0) {

                persen = 0;

            }


            document.getElementById(
                "bar"
            ).style.width =
                persen + "%";

        })


        .catch(error => {

            console.log(error);

        });

}


// =====================================================
// SIMPAN DATA
// =====================================================

function simpanData() {


    let berat =
        parseFloat(
            document.getElementById(
                "berat"
            ).innerText
        );


    if (isNaN(berat)) {


        document.getElementById(
            "pesan"
        ).innerText =
            "Berat tidak valid";


        return;

    }


    fetch('/api/timbangan', {


        method: 'POST',


        headers: {

            'Content-Type':
                'application/json',

            'Accept':
                'application/json'

        },


        body: JSON.stringify({

            berat: berat

        })

    })


    .then(response => {


        if (!response.ok) {

            throw new Error(
                'Gagal menyimpan data'
            );

        }


        return response.json();

    })


    .then(data => {


        if (data.success) {


            document.getElementById(
                "pesan"
            ).innerText =
                "✓ Data berhasil disimpan";


            setTimeout(() => {

                location.reload();

            }, 500);


        } else {


            document.getElementById(
                "pesan"
            ).innerText =
                "Gagal menyimpan data";

        }

    })


    .catch(error => {


        console.error(error);


        document.getElementById(
            "pesan"
        ).innerText =
            "Gagal terhubung ke server";

    });

}


// =====================================================
// UPDATE REALTIME SETIAP 500ms
// =====================================================

setInterval(

    updateBerat,

    500

);


// Jalankan langsung

updateBerat();


</script>


</body>

</html>