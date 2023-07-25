@extends('kepsek.layouts.master')

@section('title', 'Data Laporan')
@section('judul', 'Data Laporan')
@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Laporan') }}</div>
            <div class="card-body">
                <table id="table-data" class="table table-striped table-white">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>Kode Laporan</th>
                            <th>Dari Tanggal</th>
                            <th>Sampai Tanggal</th>
                            <th>status</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1; @endphp
                        @foreach ($laporan as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->kode_laporan }}</td>
                                <td>{{ $row->dari_tanggal}}</td>
                                <td>{{ $row->sampai_tanggal }}</td>
                                <td>@if ($row->status == 1)
                                    <span>Diterima</span>
                                    @elseif ($row->status == 2)
                                    <span>Ditolak</span>
                                    @elseif ($row->status == Null)
                                    <span>Belum diverifikasi</span>
                                    
                                    
                                    @endif
                                </td>
                                
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                            <a class="btn  btn-success" href="laporan/terima/{{$row->id}}"><i class="fa fa-check"></i></a>
                                            <button class="btn btn-xs"></button>
                                            <a class="btn  btn-danger" href="laporan/tolak/{{$row->id}}"><i class="fa fa-times"></i></a>
                                            <button class="btn btn-xs"></button>
                                            @if ($row->status == 1)
                                            <a class="btn  btn-warning" href="laporan/print/terima/{{ $row->dari_tanggal}}/{{ $row->sampai_tanggal }}"><i class="fa fa-print"></i></a>
                                            @else
                                            <a class="btn  btn-warning" href="laporan/print/{{ $row->dari_tanggal}}/{{ $row->sampai_tanggal }}"><i class="fa fa-print"></i></a>

                                            @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @stop
@section('js')
<script>
     @if(session('status'))
            Swal.fire({
                title: 'Congratulations!',
                text: "{{ session('status') }}",
                icon: 'Success',
                timer: 3000
            })
        @endif
        @if($errors->any())
            @php
                $message = '';
                foreach($errors->all() as $error)
                {
                    $message .= $error."<br/>";
                }
            @endphp
            Swal.fire({
                title: 'Error',
                html: "{!! $message !!}",
                icon: 'error',
            })
        @endif
</script>
@stop