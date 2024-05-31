<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kategori;
use App\Models\tag;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//Sweet alert
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $kategori = Kategori::orderBy('created_at', 'desc')->paginate(5);
        $user = User::all();
        return view('admin.kategori.index', compact('kategori','user'));
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
            'nama' => 'required',
        ]);
       
        $kategori = new Kategori();
        $kategori->nama = $request->nama;
        $kategori->save();



        Alert::success('Berhasil', 'Kategori Berhasil di tambahkan');
        // Kategori::create(['judul' => $request->judul, 'isi' => $request->isi, 'user_id' => $request->profile]);
        return redirect('kategori')->with('sukses','data anda berhasil di tambahkan');
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
        $kat = Kategori::find($id);
        return view('admin.kategori.show', compact('kat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $pertanyaan
     * @return \Illuminate\Http\Response
     */
    // edit
    public function edit($id)
    {
        $kat = Kategori::find($id);
        return view('admin.kategori.edit', compact('kat'));
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
            'nama' => 'required',
        
        ]);
        Kategori::where('id', $id)
        ->update(['nama' => $request->nama]);
        Alert::success('Berhasil', 'Kategori Berhasil di Update');
        return redirect('kategori')->with('sukses', 'data anda berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $pertanyaan
     * @return \Illuminate\Http\Response
     */
    // hapus
    public function destroy($id)
    {
        Kategori::where('id', $id)->delete();
        Alert::success('Berhasil', 'Kategori Berhasil di hapus');
        return redirect('kategori')->with('erorr', 'data anda berhasil di hapus');
    }
}
