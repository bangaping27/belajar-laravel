<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\SubMateri;
use App\Models\IsiSubMateri;
use Illuminate\Support\Facades\DB;

class MateriController extends Controller
{
    public function index()
    {
        return view('materi.index');
    }

    public function create()
{
    return view('materi.create');
}

public function store(Request $request)
{
    $validatedData = $request->validate([
        'nama_materi' => 'required|string|max:255',
        'progres' => 'required|integer',
    ]);

    $materi = Materi::create($validatedData); 

    return redirect('materi/' . $materi->id . '/sub-materi/create')->with('success', 'Sub Materi berhasil ditambahkan.');
}

public function createsubmateri(Materi $materi)
{
    return view('sub_materi.create', compact('materi'));
}

public function storesubmateri(Request $request, Materi $materi)
{
    $validatedData = $request->validate([
        'judul_sub' => 'required|string|max:255',
    ]);

    $subMateri = $materi->subMateri()->create($validatedData);

    return redirect('sub-materi/' . $subMateri->id . '/isi/create')->with('success', 'Sub Materi berhasil ditambahkan.');
}


public function createisi(SubMateri $subMateri)
{
    return view('isi_sub_materi.create', compact('subMateri'));
}

public function storeisi(Request $request, SubMateri $subMateri)
{
    $validatedData = $request->validate([
        'judul_sub' => 'required|string|max:255',
        'text' => 'required|string',
    ]);

    $isiSubMateri = $subMateri->isiSubMateri()->create($validatedData);
    return redirect('sub-materi/' . $subMateri->id.'/isi/create')->with('success', 'Isi Sub Materi berhasil ditambahkan.');
}

public function show(Materi $materi)
{
    $materi = Materi::find($materi->id);
    $subMateri = $materi->subMateri;
    //dd($materi, $subMateris); // Tambahkan ini untuk debugging

    return view('materi.show', compact('materi', 'subMateri'));
}

public function showSubMateri(SubMateri $subMateri, IsiSubMateri $isiSubMateri)
{
    $subMateriId = $isiSubMateri->sub_materi_id;

    // Ambil data sub-materi terkait
    $data = DB::table('isi_sub_materi')
    ->join('sub_materi', 'isi_sub_materi.sub_materi_id', '=', 'sub_materi.id')
    ->select('isi_sub_materi.text', 'sub_materi.judul_sub')
    ->where('isi_sub_materi.id', '=', $isiSubMateri->id)
    ->get();

    return view('sub_materi.show', compact('data'));
}



}
