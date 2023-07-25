@extends('kepsek.layouts.master')

@section('title', 'Data Kas Masuk')
@section('judul', 'Data Kas Masuk')
@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Kas Masuk') }}</div>
            <div class="card-body">
                <table id="table-data" class="table table-striped table-white">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>Kode Kas Masuk</th>
                            <th>Tanggal</th>
                            <th>Penanggung Jawab</th>
                            <th>Keterangan</th>
                            <th>Jumlah</th>
                            <th>Bukti</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1; @endphp
                        @foreach ($masuk as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->kode_kas_masuk }}</td>
                                <td>{{ $row->tanggal}}</td>
                                <td>{{ $row->penanggung_jawab }}</td>
                                <td>{{ $row->keterangan }}</td>
                                <td>{{ $row->jumlah }}</td>
                                <td>{{ $row->bukti }}</td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @stop
