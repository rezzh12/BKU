<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>

<body>
    <h3 class="text-center">Buku Kas Umum</h3>
    <h1 class="text-center">SMK 2 PASUNDAN</h1>
    <p class="text-center">Jl. Arief Rahman Hakim, Kab. Cianjur 43281</p>
    <br />

    <div class="container-fluid">
    <div>

                    <div>
                    <table id="table-data" class="table table-striped table-white">
                    <thead style = "background-color:Aquamarine">
                        <tr class="text-center">
                            <th>NO</th>
                            <th>Tanggal</th>
                            <th>Kode Kas</th>
                            <th>Keterangan</th>
                            <th>Bukti</th>
                            <th>Debt(masuk)</th>
                            <th>Kerdit(Keluar)</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1; @endphp
                        @foreach ($masuk as $mas)
                        
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $mas->tanggal}}</td>
                                <td>{{ $mas->kode_kas_masuk }}</td>
                                <td>{{ $mas->keterangan }}</td>
                                <td>{{ $mas->bukti }}</td>
                                <td>{{ $mas->jumlah }}</td>
                                <td></td>
                                </tr>
                                @foreach ($keluar as $row)
                                @if($row->penanggung_jawab == $mas->penanggung_jawab && $row->bukti_masuk == $mas->bukti)
                                
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->tanggal}}</td>
                                <td>{{ $row->kode_kas_keluar }}</td>
                                <td>{{ $row->keterangan }}</td>
                                <td>{{ $row->bukti }}</td>
                                <td></td>
                                <td>{{ $row->jumlah }}</td>
                            </tr>
                       
                        @endif
                        @endforeach
                        @endforeach
                    </tbody>
                    <tfoot>
    <tr>
     <th colspan="3">Total Saldo</th>
     <th colspan="2">Total Kas Masuk</th>
     <th colspan="2" style="padding-left:20%">Total Kas Keluar</t>
    </tr>
    <tr>
    @foreach($total as $tot)
    <td colspan="3">RP. {{$tot->total}}</td>
    @endforeach
    <td colspan="2">RP. {{$total_masuk}}</td>
    <td colspan="2"style="padding-left:20%">RP. {{$total_keluar}}</td>
    </tr>
  </tfoot>
                </table>
</div>

</body>

</html>