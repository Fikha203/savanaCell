<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $items = Item::all();
        return view('katalog',['items' => $items]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'provider' => 'required|min:5',
            'option' => 'required|min:4',
            'price' => 'required | numeric',
        ]);
        
        Item::create($validatedData);
        
        // Simpan perubahan
        // $item->save();
    
    // Berikan respons berhasil ke klien
        return response()->json(
            ['message'=>'Item Created']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        // Validasi input

        $validatedData = $request->validate([
            'provider' => 'required|min:5',
            'option' => 'required|min:4',
            'price' => 'required | numeric',
        ]);
        
        $item->update($validatedData);
        
        // Simpan perubahan
        // $item->save();

    // Berikan respons berhasil ke klien
        return response()->json(
            ['message'=>'Item Updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {

        $item->delete();

        return back()->with('success','Item deleted');
    }
}
