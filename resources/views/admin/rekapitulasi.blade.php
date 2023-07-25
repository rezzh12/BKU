@extends('admin.layouts.master')

@section('title', 'Data Rekapitulasi')
@section('judul', 'Data Rekapitulasi')
@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Data Rekapitulasi') }}</div>
            <div class="card-body">
                    <hr />
                <table id="table-data" class="table table-striped table-white">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>Tanggal</th>
                            <th>Kode Kas</th>
                            <th>Penanggung Jawab</th>
                            <th>Keterangan</th>
                            <th>Bukti</th>
                            <th>Debt(Masuk)</th>
                            <th>Kredit(Keluar)</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1; @endphp
                        @foreach ($masuk as $mas)
                        
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $mas->tanggal}}</td>
                                <td>{{ $mas->kode_kas_masuk }}</td>
                                <td>{{ $mas->penanggung_jawab }}</td>
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
                                <td>{{ $row->penanggung_jawab }}</td>
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
     <th colspan="3">Total Kas Keluar</t>
    </tr>
    <tr>
    @foreach($total as $tot)
    <td colspan="3">RP. {{$tot->total}}</td>
    <td colspan="2">RP. {{$tot->total_kas_masuk}}</td>
    <td colspan="3">RP. {{$tot->total_kas_keluar}}</td>
    @endforeach
    </tr>
  </tfoot>
                </table>
            </div>
        </div>
    </div>

    @stop