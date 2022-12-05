<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menampilkan ke halaman dashboard
        return view('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $get = new hitung($request->pesanan,$request->status);
        
        $data = [
            'pesanan' => $get->pesanan(),
            'diskon' => $get->diskon(),
            'total_pembayaran'=>$get->total_pembayaran(),
            'nama'=>$request->nama,
            'status'=>$request->status,
            'jml'=>$get->total_pesanan(),
            
        ];
        return view('dashboard', compact('data'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}



// Mendefinisikan Interface 
interface order {
    
    public function pesanan();
    public function total_pesanan();
    public function diskon();
    
    
  }
  
  // Mendefinisikan Class sale
  class sale implements order {
    public function __construct($pesanan,$status)
    {
         //deklarasi variabel
         $this->pesanan=$pesanan;
         $this->status=$status;
      
    }

    public function total_pesanan()
    {
        $aa = explode(",", $this->pesanan);
        $jumData = count($aa);
        return $jumData;
    }

    public function pesanan() {
        
        return $this->total_pesanan() * 50000;
    }

    
    public function diskon() {
        if ($this->status=='Member' && $this->pesanan() >= 100000) {
            return '20%';
        }elseif ($this->status=='Member' && $this->pesanan() < 100000) {
            return '10%';
        }else{
            return 'Tidak Ada Diskon';
        } 
    }
    
   
  }
// class turunan dari class sale
  class hitung extends sale{
    public function total_pembayaran()
    {
        if ($this->status=='Member' && $this->pesanan() >= 100000) {
            return $this->pesanan() - ($this->pesanan() * 20/100);
        }elseif ($this->status=='Member' && $this->pesanan() < 100000) {
            return $this->pesanan() - ($this->pesanan() * 10/100);
        }else{
            return $this->pesanan();
        }
    }
  }