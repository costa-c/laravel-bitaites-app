<?php

namespace App\Http\Controllers;

use App\Models\Bitaite;
use App\Http\Requests\StoreBitaiteRequest;
use App\Http\Requests\UpdateBitaiteRequest;

class BitaiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('bitaites.index');
        return view('bitaites.index', [
            'bitaites' => Bitaite::with('user')->latest()->get(),
        ]);
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
     * @param  \App\Http\Requests\StoreBitaiteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBitaiteRequest $request)
    {
        $validate = $request->validate([
            'message' => 'required|string|max:255',
        ]);
        $request->user()->bitaites()->create($validate);
        return redirect(route('bitaites.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bitaite  $bitaite
     * @return \Illuminate\Http\Response
     */
    public function show(Bitaite $bitaite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bitaite  $bitaite
     * @return \Illuminate\Http\Response
     */
    public function edit(Bitaite $bitaite)
    {
        $this->authorize('update', $bitaite);
        return view('bitaites.edit', [
            'bitaite' => $bitaite,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBitaiteRequest  $request
     * @param  \App\Models\Bitaite  $bitaite
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBitaiteRequest $request, Bitaite $bitaite)
    {
        $this->authorize('update', $bitaite);
        $validate = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $bitaite->update($validate);

        return redirect(route('bitaites.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bitaite  $bitaite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bitaite $bitaite)
    {
        $this->authorize('delete', $bitaite);
        $bitaite->delete();
        return redirect(route('bitaites.index'));
    }
}
