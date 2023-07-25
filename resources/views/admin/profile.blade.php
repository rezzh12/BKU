@extends('admin.layouts.master')

@section('title', 'Data Profile')
@section('judul', 'Data Profile')
@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Data Profile') }}</div>
            <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahProfileModal"><i class="fa fa-plus"></i>
                    Tambah Data</button>
                    <hr />
                <table id="table-data" class="table table-striped table-white">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>Nama</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>No Telepon</th>
                            <th>Jenis Kelamin</th>
                            <th>Foto</th>
                            <th>Jabatan</th>
                            <th>Aksi</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1; @endphp
                        @foreach ($profile as $row)
                        
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->nama}}</td>
                                <td>{{ $row->tempat_lahir}}</td>
                                <td>{{ $row->tanggal_lahir }}</td>
                                <td>{{ $row->alamat }}</td>
                                <td>{{ $row->no_telepon }}</td>
                                <td>{{ $row->jenis_kelamin }}</td>
                                <td> @if ($row->foto !== null)
                                        <img src="{{ asset('storage/foto/' . $row->foto) }}" width="100px" />
                                    @else
                                        [Gambar tidak tersedia]
                                    @endif</td>
                                <td>{{ $row->user->username }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-jadwal" class="btn btn-success"
                                            data-toggle="modal" data-target="#editProfileModal"
                                            data-id="{{ $row->id }}"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-xs"></button>
                                            <button type="button" class="btn btn-danger"
                                            onclick="deleteConfirmation('{{ $row->id }}', '{{ $row->nama }}' )"><i class="fa fa-times"></i></button>
                                    </div>
                                </td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="tambahProfileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.profile.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" required />
                        </div>
                        <div class="form-group">
                            <label for="tempat">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat" id="tempat" required />
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal" required />
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="textArea" class="form-control" name="alamat" id="alamat"required />
                        </div>
    
                        
                        <div class="form-group">
                            <label for="no_telepon">No Telepon</label>
                            <input type="number" class="form-control" name="no_telepon" id="no_telepon" required />
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control"required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Pria">Pria</option>
                                <option value="Wanita">Wanita</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control" name="foto" id="foto" required />
                        </div>
                        <div class="form-group">
                            <label for="tandatangan">Tandatangan</label>
                            <input type="file" class="form-control" name="tandatangan" id="tandatangan"  />
                        </div>
                        <div class="form-group">
                            <label for="jabatan">User dan Jabatan</label>
                            <select name="jabatan" id="jabatan" class="form-control" required>
                                <option value="">Pilih User dan Jabatan</option>
                               @foreach($user as $us)
                               <option value="{{$us->id}}">{{$us->username}} {{$us->roles->name}}</option>
                               @endforeach
                            </select>
                        </div>
                        </div>

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
     <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form method="post" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6">
                        <div class="form-group">
                            <label for="edit-nama">Nama</label>
                            <input type="text" class="form-control" name="nama" id="edit-nama" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-tempat">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat" id="edit-tempat" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-tanggal">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal" id="edit-tanggal" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-alamat">Alamat</label>
                            <input type="textArea" class="form-control" name="alamat" id="edit-alamat"required />
                        </div>
    
                        
                        <div class="form-group">
                            <label for="edit-no_telepon">No Telepon</label>
                            <input type="number" class="form-control" name="no_telepon" id="edit-no_telepon" required />
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="edit-jenis_kelamin">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="edit-jenis_kelamin" class="form-control"required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Pria">Pria</option>
                                <option value="Wanita">Wanita</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-foto">Foto</label>
                            <input type="file" class="form-control" name="foto" id="edit-foto" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-tandatangan">Tandatangan</label>
                            <input type="file" class="form-control" name="tandatangan" id="edit-tandatangan" />
                        </div>
                        <div class="form-group">
                            <label for="edit-jabatan">User dan Jabatan</label>
                            <select name="jabatan" id="edit-jabatan" class="form-control" required>
                                <option value="">Pilih User dan Jabatan</option>
                               @foreach($user as $us)
                               <option value="{{$us->id}}">{{$us->username}} {{$us->roles->name}}</option>
                               @endforeach
                            </select>
                        </div>
                        </div>

                </div>
                </div>
                <div class="modal-footer">
                <input type="hidden" name="id" id="edit-id" />
                <input type="hidden" name="old_foto" id="edit-old_foto" />
                <input type="hidden" name="old_tandatangan" id="edit-old_tandatangan" />
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
$(function() {
            $(document).on('click', '#btn-edit-jadwal', function() {
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "{{ url('admin/ajaxadmin/dataProfile') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-nama').val(res.nama);
                        $('#edit-tempat').val(res.tempat_lahir);
                        $('#edit-tanggal').val(res.tanggal_lahir);
                        $('#edit-alamat').val(res.alamat);
                        $('#edit-no_telepon').val(res.no_telepon);
                        $('#edit-jenis_kelamin').val(res.jenis_kelamin);
                        $('#edit-old_foto').val(res.foto);
                        $('#edit-old_tandatangan').val(res.tandatangan);
                        $('#edit-jabatan').val(res.users_id);
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
                text: "Apakah anda yakin akan menghapus data dengan nama " + judul + "?!",

                showCancelButton: !0,
                confirmButtonText: "Ya, lakukan!",
                cancelButtonText: "Tidak, batalkan!",
                reverseButtons: !0
            }).then(function(e) {

                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "Profile/delete/" + npm,
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
    </script>
    @stop