<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Pertanyaan;
use App\Models\Jawaban;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
class tampilController extends Controller
{
    public function index(){
        $pertanyaan = Pertanyaan::orderBy('created_at', 'desc')->get();
        $user = User::where('id','!=', Auth::user()->id)->get();
        $pertanyaan = DB::table('pertanyaan')
        ->join('kategori','pertanyaan.kategori_id','=','kategori.id')
        ->join('profile','pertanyaan.user_id','=','profile.user_id')
        ->select('pertanyaan.*','kategori.nama','profile.foto')
        ->get();
    
        return view('user.index', compact('pertanyaan','user'));
    }
}
