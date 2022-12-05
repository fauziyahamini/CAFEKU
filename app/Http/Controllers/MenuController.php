<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mengambil data pada tabel menu
        $data= Menu::all();
        //menampilkan ke halaman menu
        return view('menu',compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //mengambil data dari tabel kategori
        $kategori=Kategori::all();
        //menampilkan halaman menuAdd
        return view('menuAdd',[  'kategori' => $kategori ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //menambahkan data pada tabel menu   
       $data = $request->all();

       $data['foto'] = Storage::put('img', $request->file('foto'));
   
                
        Menu::create($data);
                
        return redirect('menu')->with('success', 'Data Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //mengambil data pada tabel menu berdasarkan id
       $data = Menu::find($id);
       $kategori = Kategori::all();

       return view('menuEdit', compact('data','kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
       //update data pada tabel menu
       $data = $request->all();

       try {
           $data['foto'] = Storage::put('img', $request->foto);

           $menu->update($data);
       } catch (\Throwable $th) {
           $data['foto'] = $menu->foto;

           $menu->update($data);
       }

       return redirect('menu');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //menghapus data pada tabel menu
       Menu::where('id', $id)->delete();
       return back();
    }
}
