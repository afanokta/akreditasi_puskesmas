<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PUSKESMAS DAN HASIL</title>
</head>
<body>
    <p>Detail Puskesmas</p>
    <table>
        <tr>
            <th>Nama Puskesmas</th>
            <td>{{ $data->nama_puskesmas }}</td>
        </tr>
        <tr>
            <th>Kota</th>
            <td>{{ $data->kota }}</td>
        </tr>
        <tr>
            <th>Provinsi</th>
            <td>{{ $data->provinsi }}</td>
        </tr>
        <tr>
            <th>Tanggal SA</th>
            <td>{{ $data->tanggal_sa }}</td>
        </tr>
    </table>

    <p>Hasil Penilaian</p>
    <table>
        <tr>
            <th>BAB 1</th>
            <td>{{ $data->bab_1 }}</td>
        </tr>
        <tr>
            <th>BAB 2</th>
            <td>{{ $data->bab_2 }}</td>
        </tr>
        <tr>
            <th>BAB 3</th>
            <td>{{ $data->bab_3 }}</td>
        </tr>
        <tr>
            <th>BAB 4</th>
            <td>{{ $data->bab_4 }}</td>
        </tr>
        <tr>
            <th>BAB 5</th>
            <td>{{ $data->bab_5 }}</td>
        </tr>
        <tr>
            <th>Nilai Akhir</th>
            <td>{{ $data->nilai_akhir }}</td>
        </tr>
    </table>
</body>
</html>
