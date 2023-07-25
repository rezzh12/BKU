@extends('bensek.layouts.master')

@section('title', 'Data Kas Masuk')
@section('judul', 'Data Kas Masuk')
@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Kas Masuk') }}</div>
            <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahMasukModal"><i class="fa fa-plus"></i>
                    Tambah Data</button>

                    
                    <hr />
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
                            <th>AKSI</th>
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
                                
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-jadwal" class="btn btn-success"
                                            data-toggle="modal" data-target="#editMasukModal"
                                            data-id="{{ $row->id }}"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-xs"></button>
                                            <button type="button" class="btn btn-danger"
                                            onclick="deleteConfirmation('{{ $row->id }}', '{{ $row->kode_kas_masuk }}' )"><i class="fa fa-times"></i></button>
                                            <button class="btn btn-xs"></button>
                                            <a href="masuk/download/{{$row->foto_bukti}}" class="btn btn-warning"> <i class="fa fa-download"></i></a>
                                    </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <tfoot>
    <tr>
     <th colspan="5">Total Kas Masuk</th>
     <th colspan="3"> @foreach($total as $tot) RP. {{$tot->total_kas_masuk}}
    @endforeach</th>
    </tr>
  </tfoot>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tambah Jadwal -->
    <div class="modal fade" id="tambahMasukModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kas Masuk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('bensek.masuk.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal" required />
                        </div>
                       
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" id="keterangan" required />
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="text" class="form-control" name="jumlah" id="jumlah" required />
                        </div>
                        <div class="form-group">
                            <label for="no_kwitansi">No Kwitansi</label>
                            <input type="text" class="form-control" name="bukti" id="no_kwitansi" required />
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto Bukti</label>
                            <input type="file" class="form-control" name="foto" id="foto" required />
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Ubah Data-->
     <!-- UBAH DATA -->
     <div class="modal fade" id="editMasukModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Kas Masuk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('bensek.masuk.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="edit-tanggal">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" id="edit-tanggal" required />
                        </div>
                       
                        <div class="form-group">
                            <label for="edit-keterangan">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" id="edit-keterangan" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-jumlah">Jumlah</label>
                            <input type="text" class="form-control" name="jumlah" id="edit-jumlah" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-no_kwitansi">No Kwitansi</label>
                            <input type="text" class="form-control" name="bukti" id="edit-no_kwitansi" required />
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto Bukti</label>
                            <input type="file" class="form-control" name="foto" id="foto" required />
                        </div>
                </div>
                <div class="modal-footer">
                <input type="hidden" name="old_bukti" id="edit-old_bukti" />
                <input type="hidden" name="kode" id="edit-kode" />
                <input type="hidden" name="id" id="edit-id" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @stop

    @section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
$(function() {var harga = document.getElementById('edit-jumlah');
harga.addEventListener('keyup', function(e)
{
    harga.value = formatRupiah(this.value);
});

function formatRupiah(angka, prefix)
{
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split    = number_string.split(','),
        sisa     = split[0].length % 3,
        rupiah     = split[0].substr(0, sisa),
        ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
        
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}
            $(document).on('click', '#btn-edit-jadwal', function() {
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "{{ url('admin/kas_masuk/ajaxadmin/dataMasuk') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-tanggal').val(res.tanggal);
                        $('#edit-pj').val(res.penanggung_jawab);
                        $('#edit-keterangan').val(res.keterangan);
                        $('#edit-jumlah').val(res.jumlah);
                        $('#edit-no_kwitansi').val(res.bukti);
                        $('#edit-old_bukti').val(res.foto_bukti);
                        $('#edit-kode').val(res.kode_kas_masuk);
                        $('#edit-id').val(res.id);
                    },
                });
            });
        });

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
        
        function deleteConfirmation(npm, judul) {
            swal.fire({
                title: "Hapus?",
                type: 'warning',
                text: "Apakah anda yakin akan menghapus data dengan kode " + judul + "?!",

                showCancelButton: !0,
                confirmButtonText: "Ya, lakukan!",
                cancelButtonText: "Tidak, batalkan!",
                reverseButtons: !0
            }).then(function(e) {

                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "kas_masuk/delete/" + npm,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            if (results.success === true) {
                                swal.fire("Selamat", results.message, "success");
                                // refresh page after 2 seconds
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            } else {
                                swal.fire("Error!", results.message, "error");
                            }
                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            })
        }
        $(function() {
var harga = document.getElementById('jumlah');
harga.addEventListener('keyup', function(e)
{
    harga.value = formatRupiah(this.value);
});

function formatRupiah(angka, prefix)
{
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split    = number_string.split(','),
        sisa     = split[0].length % 3,
        rupiah     = split[0].substr(0, sisa),
        ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
        
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}
});
    </script>
    @stop