<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\User;
use App\Models\Profile;
use App\Models\tag;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//Sweet alert
use RealRashid\SweetAlert\Facades\Alert;

class PertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = Profile::orderBy('created_at', 'desc')->paginate(5);
        $pertanyaan = Pertanyaan::orderBy('created_at', 'desc')->paginate(5);
        $user = User::all();
        $kat = Kategori::all();

        return view('admin.pertanyaan.index', compact('pertanyaan','profile','user','kat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // tambah
    public function store(Request $request)
    {
        $request->validate([
            'profile' => 'required',
            'judul' => 'required',
            'isi' => 'required',
            'kategori_id' => 'required'
        ]);
       
        $pertanyaan = new Pertanyaan;
        $pertanyaan->judul = $request->judul;
        $pertanyaan->isi = $request->isi;
        $pertanyaan->user_id = $request->profile;
        $pertanyaan->kategori_id = $request->kategori_id;

        $pertanyaan->save();

       
        
        $user = User::find($request->profile);

        $user->pertanyaan()->save($pertanyaan);

        Alert::success('Berhasil', 'Pertanyaan Berhasil di tambahkan');
        // Pertanyaan::create(['judul' => $request->judul, 'isi' => $request->isi, 'user_id' => $request->profile]);
        return redirect('pertanyaan')->with('sukses','data anda berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pertanyaan  $pertanyaan
     * @return \Illuminate\Http\Response
     */
    // detail
    public function show($id)
    {
        $tanya = Pertanyaan::find($id);
    
        // $tanya = DB::table('pertanyaan')
        // ->join('kategori','pertanyaan.kategori_id','=','kategori.id')
        // ->join('profile','pertanyaan.user_id','=','profile.user_id')

        // ->select('pertanyaan.*','kategori.nama','profile.foto','profile.nama_lengkap')
        // ->where('pertanyaan.id' == $id)
        // ->get();
        return view('admin.pertanyaan.show', compact('tanya'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pertanyaan  $pertanyaan
     * @return \Illuminate\Http\Response
     */
    // edit
    public function edit($id)
    {
        $tanya = Pertanyaan::find($id);
        $kat = Kategori::all();
        return view('admin.pertanyaan.edit', compact('tanya','kat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pertanyaan  $pertanyaan
     * @return \Illuminate\Http\Response
     */
    // uodate
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|min:',
            'isi' => 'required',
            'kategori_id' => 'required',
        ]);
    
        Pertanyaan::where('id', $id)
        ->update(['judul' => $request->judul, 'isi' => $request->isi, 'kategori_id' => $request->kategori_id]);
       
        Alert::success('Berhasil', 'Pertanyaan Berhasil di Update');
        return redirect('pertanyaan')->with('sukses', 'data anda berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pertanyaan  $pertanyaan
     * @return \Illuminate\Http\Response
     */
    // hapus
    public function destroy($id)
    {
        Pertanyaan::where('id', $id)->delete();
        Alert::success('Berhasil', 'Pertanyaan Berhasil di hapus');
        return redirect('pertanyaan')->with('eror', 'data anda berhasil di hapus');
    }
}
