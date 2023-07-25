<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kas_Masuk;
use App\Models\Kas_Keluar;
use App\Models\User;
use App\Models\Roles;
use App\Models\Laporan;
use App\Models\Total;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use PDF;
use Session;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $dataMasuk = Kas_Masuk::select(DB::raw("COUNT(*) as count"))->whereYear("tanggal",date('Y'))->groupBy(DB::raw("Month(tanggal)"))->pluck('count');
        $dataKeluar = Kas_keluar::select(DB::raw("COUNT(*) as count"))->whereYear("tanggal",date('Y'))->groupBy(DB::raw("Month(tanggal)"))->pluck('count');
        $user = Auth::user();
        $masuk = Kas_Masuk::Count();
        $keluar = Kas_Keluar::Count();
        $laporan = Laporan::Count();
        $pengguna = User::Count();
        return view('admin.home', compact( 'user','dataMasuk','dataKeluar','masuk','keluar','laporan','pengguna'));
    }
    public function kas_masuk()
    {
        $user = Auth::user();
        $masuk = Kas_Masuk::all();
        $total = Total::all();
        return view('admin.kas_masuk', compact( 'user','masuk','total'));
    }
    public function submit_masuk(Request $req){
        $id = IdGenerator::generate(['table' => 'kas__masuks','field'=>'kode_kas_masuk', 'length' => 7, 'prefix' =>'MA']);
            { $validate = $req->validate([
                'tanggal'=> 'required',
                
                'keterangan'=> 'required|max:50',
                'jumlah'=> 'required|max:11',
                'bukti'=> 'required|max:15',
            ]);
            $masuk = new Kas_Masuk;
            $masuk->kode_kas_masuk = $id;
            $masuk->tanggal = $req->get('tanggal');
            $masuk->penanggung_jawab = "Bendahara Sekolah";
            $masuk->keterangan = $req->get('keterangan');
            $masuk->jumlah =  str_replace('.','',$req->get('jumlah'));
            $masuk->bukti = $req->get('bukti');
            if($req->hasFile('foto'))
            {
                $extension = $req->file('foto')->extension();
                $filename = 'foto'.time().'.'.$extension;
                $req->file('foto')->storeAS('public/bukti', $filename);
                $masuk->foto_bukti = $filename;
            }
            $masuk->save();
            Session::flash('status', 'Tambah data Kas Masuk berhasil!!!');
            return redirect()->route('admin.masuk');
        }}
        public function getDataMasuk($id)
        {
            $masuk = Kas_Masuk::find($id);
            return response()->json($masuk);
        }
    public function update_masuk(Request $req){
        $masuk= Kas_Masuk::find($req->get('id'));
            { $validate = $req->validate([
                'kode'=> 'required',
                'tanggal'=> 'required',
                
                'keterangan'=> 'required|max:50',
                'jumlah'=> 'required|max:11',
                'bukti'=> 'required|max:15',
            ]);
            $masuk->kode_kas_masuk = $req->get('kode');
            $masuk->tanggal = $req->get('tanggal');
            $masuk->penanggung_jawab = "Bendahara Sekolah";
            $masuk->keterangan = $req->get('keterangan');
            $masuk->jumlah =  str_replace('.','',$req->get('jumlah'));
            $masuk->bukti = $req->get('bukti');
            if($req->hasFile('foto'))
            {
                $extension = $req->file('foto')->extension();
                $filename = 'foto'.time().'.'.$extension;
                $req->file('foto')->storeAS('public/bukti', $filename);
                Storage::delete('public/bukti/'.$req->get('old_bukti'));
                $masuk->foto_bukti = $filename;
            }
            $masuk->save();
            Session::flash('status', 'Ubah data Kas Masuk berhasil!!!');
            return redirect()->route('admin.masuk');
        }}

        public function delete_masuk($id)
        {
            $masuk = Kas_Masuk::find($id);
            $masuk->delete();
    
            $success = true;
            $message = "Data Kas Masuk Berhasil Dihapus";
            return response()->json([
                'success' => $success,
                'message' => $message,
            ]);
        }

    public function kas_keluar()
    {
        $user = Auth::user();
        $keluar = Kas_Keluar::all();
        $total = Total::all();
        return view('admin.kas_keluar', compact( 'user','keluar','total'));
    }
    public function submit_keluar(Request $req){
        $id = IdGenerator::generate(['table' => 'kas__keluars','field'=>'kode_kas_keluar', 'length' => 7, 'prefix' =>'KE']);
        $masuk = Kas_Masuk::latest()->value('bukti');
            { $validate = $req->validate([
                'tanggal'=> 'required',
                
                'keterangan'=> 'required|max:50',
                'jumlah'=> 'required|max:11',
                'bukti'=> 'required|max:15',
            ]);
            $keluar = new Kas_Keluar;
            $keluar->kode_kas_masuk = $id;
            $keluar->tanggal = $req->get('tanggal');
            $keluar->penanggung_jawab = "Bendahara Sekolah";
            $keluar->keterangan = $req->get('keterangan');
            $keluar->jumlah =  str_replace('.','',$req->get('jumlah'));
            $keluar->bukti = $req->get('bukti');
            if($req->hasFile('foto'))
            {
                $extension = $req->file('foto')->extension();
                $filename = 'foto'.time().'.'.$extension;
                $req->file('foto')->storeAS('public/bukti', $filename);
                $keluar->foto_bukti = $filename;
            }
            $keluar->save();
            Session::flash('status', 'Tambah data Kas Keluar berhasil!!!');
            return redirect()->route('admin.keluar');
        }}
        public function getDataKeluar($id)
        {
            $keluar = Kas_Keluar::find($id);
            return response()->json($keluar);
        }
    public function update_keluar(Request $req){
        $keluar= Kas_Keluar::find($req->get('id'));
            { $validate = $req->validate([
                'kode'=> 'required',
                'tanggal'=> 'required',
                
                'keterangan'=> 'required|max:50',
                'jumlah'=> 'required|max:11',
                'bukti'=> 'required|max:15',
            ]);
            $keluar->kode_kas_keluar = $req->get('kode');
            $keluar->tanggal = $req->get('tanggal');
            $keluar->penanggung_jawab = "Bendahara Sekolah";
            $keluar->keterangan = $req->get('keterangan');
            $keluar->jumlah =  str_replace('.','',$req->get('jumlah'));
            $keluar->bukti = $req->get('bukti');
            if($req->hasFile('foto'))
            {
                $extension = $req->file('foto')->extension();
                $filename = 'foto'.time().'.'.$extension;
                $req->file('foto')->storeAS('public/bukti', $filename);
                Storage::delete('public/bukti/'.$req->get('old_bukti'));
                $keluar->foto_bukti = $filename;
            }
            $keluar->save();
            Session::flash('status', 'Ubah data Kas Keluar berhasil!!!');
            return redirect()->route('admin.keluar');
        }}
        public function delete_keluar($id)
        {
            $keluar = Kas_keluar::find($id);
            $keluar->delete();
    
            $success = true;
            $message = "Data Kas Keluar Berhasil Dihapus";
            return response()->json([
                'success' => $success,
                'message' => $message,
            ]);
        }

        public function rekapitulasi()
        {
            $user = Auth::user();
            $masuk = Kas_Masuk::all();
            $keluar = Kas_Keluar::all();
            $total = Total::all();
            return view('admin.rekapitulasi', compact( 'user','masuk','keluar','total'));
        }

        public function data_user(){
            $user = Auth::user();
            $pengguna = User::with('roles')->get();
            $roles = Roles::all();
            return view('admin.pengguna', compact('user','pengguna','roles'));
        }
    
        public function submit_user(Request $req){
            { $validate = $req->validate([
                'username'=> 'required',
                'email'=> 'required',
                'password'=> 'required',
                'roles_id'=> 'required',
            ]);
            
            $user = new User;
            $user->username = $req->get('username');
            $user->email = $req->get('email');
            $user->password = Hash::make($req->get('password'));
            $user->roles_id = $req->get('roles_id');
            $user->email_verified_at = null;
            $user->remember_token = null;
            $user->save();
            Session::flash('status', 'Tambah data User berhasil!!!');
            return redirect()->route('admin.pengguna');
        }}
        public function getDataUser($id)
        {
            $user = User::find($id);
            return response()->json($user);
        }
        public function update_user(Request $req)
        { 
            $user= User::find($req->get('id'));
            { $validate = $req->validate([
                'username'=> 'required',
                'email'=> 'required',
                'password'=> 'required',
                'roles_id'=> 'required',
            ]);
            $user->username = $req->get('username');
            $user->email = $req->get('email');
            $user->password = Hash::make($req->get('password'));
            $user->roles_id = $req->get('roles_id');
            $user->email_verified_at = null;
            $user->remember_token = null;
            $user->save();
            Session::flash('status', 'Ubah data User berhasil!!!');
            return redirect()->route('admin.pengguna');
        }
        }
        public function delete_user($id)
        {
            $user = User::find($id);
            $user->delete();
    
            $success = true;
            $message = "Data Pengguna Berhasil Dihapus";
            return response()->json([
                'success' => $success,
                'message' => $message,
            ]);
        }

        public function laporan()
    {
        $user = Auth::user();
        $laporan = Laporan::all();
        return view('admin.laporan', compact( 'user','laporan'));
    }
    public function submit_laporan(Request $req){
        $id = IdGenerator::generate(['table' => 'laporans','field'=>'kode_laporan', 'length' => 7, 'prefix' =>'LP']);
            { $validate = $req->validate([
                'dari_tanggal'=> 'required',
                'sampai_tanggal'=> 'required',
            ]);
            $laporan = new Laporan;
            $laporan->kode_laporan = $id;
            $laporan->dari_tanggal = $req->get('dari_tanggal');
            $laporan->sampai_tanggal = $req->get('sampai_tanggal');
            $laporan->save();
            Session::flash('status', 'Tambah data Laporan berhasil!!!');
            return redirect()->route('admin.laporan');
        }}
        public function getDataLaporan($id)
        {
            $laporan = Laporan::find($id);
            return response()->json($laporan);
        }
    public function update_laporan(Request $req){
        $laporan= Laporan::find($req->get('id'));
            { $validate = $req->validate([
                'kode'=> 'required',
                'dari_tanggal'=> 'required',
                'sampai_tanggal'=> 'required',
            ]);
            $laporan->kode_laporan = $req->get('kode');
            $laporan->dari_tanggal = $req->get('dari_tanggal');
            $laporan->sampai_tanggal = $req->get('sampai_tanggal');
            $laporan->save();
            Session::flash('status', 'Ubah data Laporan berhasil!!!');
            return redirect()->route('admin.laporan');
        }}
        public function delete_laporan($id)
        {
            $laporan = Laporan::find($id);
            $laporan->delete();
    
            $success = true;
            $message = "Data Laporan Berhasil Dihapus";
            return response()->json([
                'success' => $success,
                'message' => $message,
            ]);
        }
        public function profile()
        {
            $user = Auth::user();
            $profile = Profile::with('user')->get();
            $user = User::with('roles')->get();
            return view('admin.profile', compact( 'user','profile','user'));
        }
        public function submit_profile(Request $req){
                { $validate = $req->validate([
                    'nama'=> 'required',
                    'tempat'=> 'required',
                    'tanggal'=> 'required',
                    'alamat'=> 'required',
                    'no_telepon'=> 'required',
                    'jenis_kelamin'=> 'required',
                    'foto'=> 'required',
                    'jabatan'=> 'required',
                ]);
                $profile = new Profile;
                $profile->nama = $req->get('nama');
                $profile->tempat_lahir = $req->get('tempat');
                $profile->tanggal_lahir = $req->get('tanggal');
                $profile->no_telepon = $req->get('no_telepon');
                $profile->alamat = $req->get('alamat');
                $profile->jenis_kelamin = $req->get('jenis_kelamin');
                $profile->users_id = $req->get('jabatan');
                if($req->hasFile('foto'))
                {
                    $extension = $req->file('foto')->extension();
                    $filename = 'foto'.time().'.'.$extension;
                    $req->file('foto')->storeAS('public/foto', $filename);
                    $profile->foto = $filename;
                }
                if($req->hasFile('tandatangan'))
                {
                    $extension = $req->file('tandatangan')->extension();
                    $filename = 'tandatangan.'.$extension;
                    $req->file('tandatangan')->storeAS('public/tandatangan', $filename);
                    $profile->tandatangan = $filename;
                }
                $profile->save();
                Session::flash('status', 'Tambah data Profile berhasil!!!');
                return redirect()->route('admin.profile');
            }}
            public function getDataProfile($id)
            {
                $profile = Profile::find($id);
                return response()->json($profile);
            }
        public function update_profile(Request $req){
                { $validate = $req->validate([
                    'nama'=> 'required',
                    'tempat'=> 'required',
                    'tanggal'=> 'required',
                    'alamat'=> 'required',
                    'no_telepon'=> 'required',
                    'jenis_kelamin'=> 'required',
                    'foto'=> 'required',
                    'jabatan'=> 'required',
                ]);
                $profile = Profile::where('id',$req->get('id'))->first();
                $profile->nama = $req->get('nama');
                $profile->tempat_lahir = $req->get('tempat');
                $profile->tanggal_lahir = $req->get('tanggal');
                $profile->no_telepon = $req->get('no_telepon');
                $profile->alamat = $req->get('alamat');
                $profile->jenis_kelamin = $req->get('jenis_kelamin');
                $profile->users_id = $req->get('jabatan');
                if($req->hasFile('foto'))
                {
                    $extension = $req->file('foto')->extension();
                    $filename = 'foto'.time().'.'.$extension;
                    $req->file('foto')->storeAS('public/foto', $filename);
                    Storage::delete('public/foto/'.$req->get('old_foto'));
                    $profile->foto = $filename;
                }
                if($req->hasFile('tandatangan'))
                {
                    $extension = $req->file('tandatangan')->extension();
                    $filename = 'tandatangan.'.$extension;
                    $req->file('tandatangan')->storeAS('public/tandatangan', $filename);
                    Storage::delete('public/tandatangan/'.$req->get('old_tandatangan'));
                    $profile->tandatangan = $filename;
                }
                $profile->save();
                Session::flash('status', 'Ubah data Profile berhasil!!!');
                return redirect()->route('admin.profile');
            }}

            public function delete_profile($id)
            {
                $profile = Profile::find($id);
                Storage::delete('public/foto/'.$profile->foto);
                Storage::delete('public/tandatangan/'.$profile->tandatangan);
                $profile->delete();
        
                $success = true;
                $message = "Data Profile Berhasil Dihapus";
                return response()->json([
                    'success' => $success,
                    'message' => $message,
                ]);
            }

            public function print($dari,$sampai)
            {
                $user = Auth::user();
                $masuk = Kas_Masuk::whereBetween('tanggal', [$dari, $sampai])->get();
                $total_masuk = Kas_Masuk::whereBetween('tanggal', [$dari, $sampai])->SUM('jumlah')->get();
                $keluar = Kas_Keluar::whereBetween('tanggal', [$dari, $sampai])->get();
                $total_masuk = DB::table('kas__masuks')
                    ->whereBetween('tanggal',[$dari, $sampai])
                    ->sum(DB::raw('(kas__masuks.jumlah)'));
                $total_keluar = DB::table('kas__keluars')
                    ->whereBetween('tanggal',[$dari, $sampai])
                    ->sum(DB::raw('(kas__keluars.jumlah)'));
                $total = Total::all();
                $tanggal = Carbon::parse($sampai)->format('d M Y ');
                $pdf = PDF::loadview('admin.print',['masuk'=>$masuk,'keluar'=>$keluar,'total_masuk'=>$total_masuk,
                'total_keluar'=>$total_keluar, 'total'=>$total, 'tanggal'=>$tanggal]);
                return $pdf->stream('laporan.pdf');
            }
            public function terima_print($dari,$sampai)
            {
                $user = Auth::user();
                $masuk = Kas_Masuk::whereBetween('tanggal', [$dari, $sampai])->get();
                $total_masuk = Kas_Masuk::whereBetween('tanggal', [$dari, $sampai])->SUM('jumlah')->get();
                $keluar = Kas_Keluar::whereBetween('tanggal', [$dari, $sampai])->get();
                $total_masuk = DB::table('kas__masuks')
                    ->whereBetween('tanggal',[$dari, $sampai])
                    ->sum(DB::raw('(kas__masuks.jumlah)'));
                $total_keluar = DB::table('kas__keluars')
                    ->whereBetween('tanggal',[$dari, $sampai])
                    ->sum(DB::raw('(kas__keluars.jumlah)'));
                $total = Total::all();
                $profile = Profile::where('users_id','=',1)->get();
                $tanggal = Carbon::parse($sampai)->format('d M Y ');
                $pdf = PDF::loadview('kepsek.terimaprint',['masuk'=>$masuk,'keluar'=>$keluar,'total_masuk'=>$total_masuk,
                'total_keluar'=>$total_keluar, 'total'=>$total, 'tanggal'=>$tanggal, 'profile'=>$profile,]);
                set_time_limit(300);
                return $pdf->stream('laporan.pdf');
            }
            public function info()
        {
            $user = Auth::user();
            $profile = Profile::where('users_id','=',auth()->user()->id)->get();
            $user = User::with('roles')->get();
            $roles = Roles::all();
            return view('admin.info', compact( 'user','profile','user','roles'));
        }

        public function update_info_profile(Request $req){
            { $validate = $req->validate([
                'nama'=> 'required',
                'tempat'=> 'required',
                'tanggal'=> 'required',
                'alamat'=> 'required',
                'no_telepon'=> 'required',
                'jenis_kelamin'=> 'required',
            ]);
            $profile = Profile::where('users_id','=',auth()->user()->id)->first();
            $profile->nama = $req->get('nama');
            $profile->tempat_lahir = $req->get('tempat');
            $profile->tanggal_lahir = $req->get('tanggal');
            $profile->no_telepon = $req->get('no_telepon');
            $profile->alamat = $req->get('alamat');
            $profile->jenis_kelamin = $req->get('jenis_kelamin');
            $profile->users_id = auth()->user()->id;
            if($req->hasFile('foto'))
            {
                $extension = $req->file('foto')->extension();
                $filename = 'foto'.time().'.'.$extension;
                $req->file('foto')->storeAS('public/foto', $filename);
                Storage::delete('public/foto/'.$req->get('old_foto'));
                $profile->foto = $filename;
            }
            if($req->hasFile('tandatangan'))
            {
                $extension = $req->file('tandatangan')->extension();
                $filename = 'tandatangan.'.$extension;
                $req->file('tandatangan')->storeAS('public/tandatangan', $filename);
                Storage::delete('public/tandatangan/'.$req->get('old_tandatangan'));
                $profile->tandatangan = $filename;
            }
            $profile->save();
            Session::flash('status', 'Ubah data Profile berhasil!!!');
            return redirect()->back();
        }}
        public function update_info_user(Request $req)
        { 
            $user = User::where('id','=',auth()->user()->id)->first();
            { $validate = $req->validate([
                'username'=> 'required',
                'email'=> 'required',
                'password'=> 'required',
                'roles_id'=> 'required',
            ]);
            $user->username = $req->get('username');
            $user->email = $req->get('email');
            $user->password = Hash::make($req->get('password'));
            $user->roles_id = $req->get('roles_id');
            $user->email_verified_at = null;
            $user->remember_token = null;
            $user->save();
            Session::flash('status', 'Ubah data User berhasil!!!');
            return redirect()->back();
        }
        }
        public function download($nama){
            try {
             return Storage::disk('local')->download('public/bukti/'.$nama);
            } catch (\Exception $e) {
             return $e->getMessage();
            }
         }
}
