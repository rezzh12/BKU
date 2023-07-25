@extends('kepsek.layouts.master')

@section('title', 'Info Profile')
@section('judul', 'Info Profile')
@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Info Profile') }}</div>
            <div class="card-body">
           <div class="row">
           @foreach($profile as $row)
           <div class="col-md-7">
           @if ($row->foto !== null)
           
                                        <img src="{{ asset('storage/foto/' . $row->foto) }}" width="300px" />
                                    @else
                                        [Gambar tidak tersedia]
                                    @endif</td>
            <table>
                <tr><h2>Data Diri</h2></tr>
                <tr>
                    <td>Nama</td>
                    <td> :</td>
                    <td> {{$row->nama}}</td>
                </tr>
                <tr>
                <td>TTL</td>
                    <td> :</td>
                    <td> {{ $row->tempat_lahir}}, {{ $row->tanggal_lahir }}</td>
                </tr>
                <tr><td> Gender</td>
            <td>:</td>
        <td> {{ $row->jenis_kelamin }}</td></tr>
                        <tr><td>Alamat</td>
                    <td> :</td>
                <td> {{ $row->alamat }}</td></tr>  
                <tr><td>No Telepon</td>
            <td> :</td>
        <td> {{ $row->no_telepon }}</td></tr>   
        <tr><td>Jabatan</td>
    <td> :</td>
<td> {{ $row->user->username }}</td></tr> 
 
                                            </div>  
@endforeach                                                   
</div>                      
            </table>
            @foreach($profile as $row)
           </div>
                
            </div>
            <div class="btn-group float-md-right" role="group" aria-label="Basic example" >
    <button type="button" id="btn-edit-jadwal" class="btn btn-success"
                                            data-toggle="modal" data-target="#editProfileModal"
                                            data-id="{{ $row->id }}"><i class="fa fa-edit"> Ubah Profile</i></button>
                                            <button class="btn "></button>
                                             <button type="button" id="btn-edit-user" class="btn btn-warning"
                                            data-toggle="modal" data-target="#ubahUserModal"
                                            data-id="{{ Auth::user()->id }}"><i class="fa fa-edit"> Ubah Akun</i></button>
                                            <button class="btn btn-xs"></button>
            </div>
            @endforeach  
        </div>
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
                    <form method="post" action="{{ route('kepsek.info.profile.update') }}" enctype="multipart/form-data">
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
                       
                        </div>

                </div>
                </div>
                <div class="modal-footer">
                <input type="hidden" name="id" id="edit-id" />
                <input type="hidden" name="old_foto" id="edit-old_foto" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

     <!-- Ubah Tingkatan -->
     <div class="modal fade" id="ubahUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('kepsek.info.pengguna.update') }}" enctype="multipart/form-data">
                    @csrf
                        @method('PATCH')
                        <div class="row">
                        
                        <div class="form-group">
                            <label for="edit-username">Username</label>
                            <input type="text" class="form-control" name="username" id="edit-username" required />
                        </div>

                        
                        <div class="form-group">
                            <label for="edit-email">Email</label>
                            <input type="text" class="form-control" name="email" id="edit-email" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-password">Password</label>
                            <input type="password" class="form-control" name="password" id="edit-password" required />
                        </div>
                        <div class="form-group">
                        <label for="edit-roles_id">Roles</label>
                            <select name="roles_id" id="edit-roles_id" class="form-control">
                            <option value="">Pilih Hak Akses</option>
                            @foreach($roles as $rl)
                            <option value="{{$rl->id}}">{{$rl->name}}</option>
                            @endforeach
                            </select>
                        </div>
                        </div>
                        
                        

                <div class="modal-footer">
              
                <input type="hidden" name="id" id="edit-id" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    @stop
    @section('js')
    <script>
        //EDIT
        $(function() {
            $(document).on('click', '#btn-edit-user', function() {
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "{{ url('/admin/ajaxadmin/dataUser') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-name').val(res.name);
                        $('#edit-username').val(res.username);
                        $('#edit-email').val(res.email);
                        $('#edit-password').val(res.password);
                        $('#edit-roles_id').val(res.roles_id);
                        $('#edit-id').val(res.id);
                    },
                });
            });
        });
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
                        $('#edit-id').val(res.id);
                    },
                });
            });
        });
        </script>
         @stop