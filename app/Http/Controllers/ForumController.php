<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\Kategori;
use App\Models\Jawaban;
use App\Models\komentar_jawaban;
use App\Models\komentar_pertanyaan;
use App\Models\tag;
use App\Models\Pertanyaan;
use App\Models\Follower;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//Sweet alert
use RealRashid\SweetAlert\Facades\Alert;

class ForumController extends Controller
{
    public function create(){
        $pertanyaan = Pertanyaan::orderBy('created_at','asc')->get();
        $user = User::where('id', '!=', Auth::user()->id)->get();
        $kat = Kategori::all();
        return view('user.create', compact('pertanyaan','user','kat'));
    }
    public function store(Request $request){
        $pertanyaan = new Pertanyaan;
        $pertanyaan->judul = $request->Judul;
        $pertanyaan->isi = $request->isi;
        $pertanyaan->kategori_id = $request->kategori_id;
        $pertanyaan->user_id = auth()->user()->id;
        $pertanyaan->save();
      
        // menambahkan ke pertayaan_id  baru di pertanyaan_tags
        $user = Auth::user();
    
        Alert::success('Berhasil', 'Pertanyaan Berhasil di tambahkan');
        // Pertanyaan::create(['judul' => $request->judul, 'isi' => $request->isi, 'user_id' => $request->profile]);
        return redirect('/')->with('sukses','data anda berhasil di tambahkan');
    }
    public function show($id){
        $pertanyaan = Pertanyaan::find($id);
        $user = User::where('id', '!=', Auth::user()->id)->get(); // unutk menampilkan yanng tiak di follow
        return view('user.show', compact('pertanyaan','user'));
    }
    public function jawab(Request $request, $id){
        $jawaban = new Jawaban;
        $jawaban->isi = $request->jawaban;
        $jawaban->pertanyaan_id = $id;
        $jawaban->user_id = auth()->user()->id;
        $jawaban->save();
        return redirect('/forum/show/'.$id)->with('sukses', 'data anda berhasil di tambahkan');
    }

    public function komentar_pertanyaan(Request $request, $id){
            $komentar = new komentar_pertanyaan;
            $komentar->isi = $request->komentar;
            $komentar->user_id = auth()->user()->id;
            $komentar->pertanyaan_id = $id;
            $komentar->save();
        Alert::success('Berhasil', 'Komentar Berhasil di tambahkan');
        return redirect('/forum/show/' . $id)->with('sukses', 'data anda berhasil di tambahkan');
    }
    public function komentar_jawaban(Request $request, $id)
    {

        $komentar = new komentar_jawaban;
        $komentar->isi = $request->komentar;
        $komentar->user_id = auth()->user()->id;
        $komentar->jawaban_id = $id;
        $komentar->save();
        Alert::success('Berhasil', 'Komentar Berhasil di tambahkan');
        return back();
    }
    // untuk follow
    public function follower($id){
        $follower = new Follower;
        $follower->user_id = auth()->user()->id;
        $follower->follow_id = $id;
        $follower->save();


        return back();
    }
    public function unfollow($id){
        $unfollow = Follower::where('user_id',Auth::user()->id)
                    ->where('follow_id', $id)
                    ->delete();
        return back();
    }
    public function edit($id){
        $user = User::where('id', '!=', Auth::user()->id)->get();
        $pertanyaan = Pertanyaan::find($id);
        $kat = Kategori::all();
        return view('user.edit', compact('pertanyaan','user','kat'));
    }
    public function edit2($id)
    {
        $user = User::where('id', '!=', Auth::user()->id)->get();
        $jawaban = Jawaban::find($id);
        return view('user.edit2', compact('jawaban', 'user'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'kategori_id' => 'required'
        ]);
        Pertanyaan::where('id', $id)
            ->update(['judul' => $request->judul, 'isi' => $request->isi, 'kategori_id' => $request->kategori_id]);
        Alert::success('Berhasil', 'Pertanyaan Berhasil di Update');
        return redirect('/forum/show/'. $id);
    }
    public function update2(Request $request, $id)
    {
        $request->validate([
            'isi' => 'required'
        ]);
        Jawaban::where('id', $id)
            ->update(['isi' => $request->isi]);
        Alert::success('Berhasil', 'Jawaban Berhasil di Update');
        return redirect('/forum/show/' . $request->pertanyaan);
    }
    public function destroy($id){
        Pertanyaan::where('id', $id)->delete();
        Alert::success('Berhasil', 'Pertanyaan Berhasil di hapus');
        return redirect('/')->with('eror', 'data anda berhasil di hapus');
    }
    public function destroy2($id)
    {
        Jawaban::where('id', $id)->delete();

        Alert::success('Berhasil', 'Jawaban Berhasil di hapus');
        return back()->with('eror', 'data anda berhasil di hapus');
    }

    public function upload()
    {
        
    }
}
