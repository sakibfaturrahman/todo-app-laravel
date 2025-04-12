<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{

    public function index(){
        $kategori = Kategori::all();
        return view('component.sidebar', compact('kategori'));
    }
    
   public function store(Request $request){
    $request->validate([
        'nama_kategori' => 'required',

    ],[
        'nama_kategori.required' => 'Nama Kategori tidak boleh dikosongkan!'
    ]);

    $kategori = Kategori::create($request->all());
    Alert::toast('Data Berhasil Disimpan', 'success');
    return redirect()->back();
    }

    public function update(Request $request, $id){
        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all());
        Alert::toast('Data Berhasil Disimpan', 'success');
        return redirect()->back();
    }
    public function destroy($id){
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        Alert::toast('Data Berhasil Dihapus', 'success');
        return redirect()->back();
    }

    public function detail($id)
{
    $kategori = Kategori::with('task')->find($id);
    $allKategori = Kategori::all();

    if (!$kategori) {
        return redirect()->route('task')->with('error', 'Kategori tidak ditemukan!');
    }

    $task = $kategori->task ?? []; // Jika tidak ada task, set ke array kosong

    return view('kategori.detail', compact('kategori', 'task','allKategori'));
}

    
    

}
