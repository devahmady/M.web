<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        <style>.table-container {
            white-space: nowrap;
            /* Menghindari wrap konten */
            overflow-x: auto;
            /* Memunculkan scroll horizontal jika konten terlalu lebar */
        }

        .table-wrapper {
            display: inline-block;
            /* Menjadikan tabel berderet secara horizontal */
            /* margin-right: 2px; Margin antara tabel */
        }

        table {
            border: 1px solid black;
            margin: 2;
            padding: 0;
            width: 150px;
            /* Ukuran tabel */
            border-collapse: collapse;
            /* Menggabungkan batas sel */
        }

        td {
            width: 150px;
            border: 1px solid black;
            /* Menambahkan garis di dalam tabel */
            margin: 0;
            padding: 0;
            font-size: 14px;
            /* Ukuran font */
            text-align: center;
        }

        h4 {
            font-size: 12px;
            /* Ukuran font h4 */
            border-bottom: 1px solid black;
            margin: 0;
            padding: 0;
            caption-side: top;
        }

        h6 {
            font-size: 12px;
            /* Ukuran font h4 */
            margin: 0;
            padding: 0;
            caption-side: top;
        }
    </style>
    </style>
</head>

<body>

    @php
        $counter = 0; // Inisialisasi counter
    @endphp
    <div class="table-container">
        <!-- Tampilkan hanya jika ada data yang dipilih -->
        @foreach ($server as $profile)
            @foreach ($comment as $user)
                @if ($user['profile'] == $profile['name'])
                    @php
                        $counter++; // Increment counter untuk setiap user yang sesuai dengan profil
                    @endphp
                    <div class="table-wrapper">
                        <table>
                            <tr>
                                <td colspan="2">
                                    <h4>{{ $profile['name'] }}</h4>
                                    <h6>Code Voucher [ {{ $counter }} ]</h6>
                                </td>
                            </tr>
                            <tr>
                                @if ($user['name'] === $user['password'])
                                    <td colspan="2"> {{ $user['name'] }}</td>
                                @else
                                    <td>Username : {{ $user['name'] }}</td>
                                    <td>Password : {{ $user['password'] }}</td>
                                @endif
                            </tr>
                        </table>
                    </div>
                @endif
            @endforeach
        @endforeach
    </div>

</body>

</html>
