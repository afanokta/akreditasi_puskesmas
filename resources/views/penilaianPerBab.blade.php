<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ "BAB ". $bab }}</title>
</head>
<body>
    <table>
        <tr>
            <th>BAB : </th>
            <td>{{ $bab }}</td>
        </tr>
    </table>
    <table>
        <tr>
            <th>#</th>
            <th>Standar</th>
            <th>kriteria</th>
            <th>No. Urut</th>
            <th>Elemen</th>
            <th>Regulasi</th>
            <th>Dokumen Bukti</th>
            <th>Observasi</th>
            <th>wawancara</th>
            <th>simulasi</th>
            <th>Fakta &amp; Analisa</th>
            <th>Nilai</th>
            <th>Foto</th>
        </tr>
        @foreach ($data as $d)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $d->standar }}</td>
            <td>{{ $d->kriteria }}</td>
            <td>{{ $d->no_urut }}</td>
            <td>{{ $d->elemen }}</td>
            <td>{{ $d->regulasi }}</td>
            <td>{{ $d->dokumen_bukti }}</td>
            <td>{{ $d->wawancara }}</td>
            <td>{{ $d->observasi }}</td>
            <td>{{ $d->simulasi }}</td>
            <td>{{ $d->fakta_analisa }}</td>
            <td>{{ $d->nilai }}</td>
            <td><a href={{ Storage::disk('public')->url($d->foto) }}>
                Menuju Link untuk Lihat Foto
            </a>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
