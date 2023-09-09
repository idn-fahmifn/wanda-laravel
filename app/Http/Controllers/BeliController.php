<?php

namespace App\Http\Controllers;

use App\Beli;
use App\Barang;
use Illuminate\Http\Request;

class BeliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beli = Beli::paginate(5);
        $barang = Barang::all();
        $values = $barang->pluck('nama_barang');
        $stok = $barang->pluck('stok');
        return view('beli.index',compact('beli','values','stok','barang'));
        // dd($sisa_barang);
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
        $input = $request->all();
        $barang = Barang::find($request->id_barang);
        $sisa = $barang->stok - $input['jumlah_barang'];
        Beli::create($input);
        $barang->stok = $sisa;
        $barang->save();
        // dd($sisa);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Beli  $beli
     * @return \Illuminate\Http\Response
     */
    public function show(Beli $beli)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Beli  $beli
     * @return \Illuminate\Http\Response
     */
    public function edit(Beli $beli)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Beli  $beli
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Beli $beli)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Beli  $beli
     * @return \Illuminate\Http\Response
     */
    public function destroy(Beli $beli)
    {
        //
    }
}
