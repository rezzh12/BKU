<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kas_Masuk;
use App\Models\Kas_Keluar;
use App\Models\Laporan;
use App\Models\Total;
use App\Models\Profile;
use App\Models\User;
use App\Models\Roles;
use PDF;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class KepsekController extends Controller
{
    public function index()
    {
        $dataMasuk = Kas_Masuk::select(DB::raw("COUNT(*) as count"))->whereYear("tanggal",date('Y'))->groupBy(DB::raw("Month(tanggal)"))->pluck('count');
        $dataKeluar = Kas_keluar::select(DB::raw("COUNT(*) as count"))->whereYear("tanggal",date('Y'))->groupBy(DB::raw("Month(tanggal)"))->pluck('count');
        $user = Auth::user();
        $masuk = Kas_Masuk::Count();
        $keluar = Kas_Keluar::Count();
        $laporan = Laporan::Count();
        return view('kepsek.home', compact( 'user','dataMasuk','dataKeluar','masuk','keluar','laporan'));
    }
    public function kas_masuk()
    {
        $user = Auth::user();
        $masuk = Kas_Masuk::all();
        $total = Total::all();
        return view('kepsek.kas_masuk', compact( 'user','masuk','total'));
    }
    public function kas_keluar()
    {
        $user = Auth::user();
        $keluar = Kas_Keluar::all();
        $total = Total::all();
        return view('kepsek.kas_keluar', compact( 'user','keluar','total'));
    }
    public function laporan()
    {
        $user = Auth::user();
        $laporan = Laporan::all();
        return view('kepsek.laporan', compact( 'user','laporan'));
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
                $pdf = PDF::loadview('kepsek.print',['masuk'=>$masuk,'keluar'=>$keluar,'total_masuk'=>$total_masuk,
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
            public function terima_laporan($id){
                $terima = DB::table('laporans')->where('id', $id)->update(['status' => 1, ]);
                Session::flash('status', 'Laporan Berhasil di Terima!!!');
                return redirect()->back();
            }
            public function tolak_laporan($id){
                $terima = DB::table('laporans')->where('id', $id)->update([ 'status' => 2,]);
                Session::flash('status', 'Laporan Berhasil di Tolak!!!');
                return redirect()->back();
            }
            public function info()
            {
                $user = Auth::user();
                $profile = Profile::where('users_id','=',auth()->user()->id)->get();
                $user = User::with('roles')->get();
                $roles = Roles::all();
                return view('kepsek.info', compact( 'user','profile','user','roles'));
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
            
}
