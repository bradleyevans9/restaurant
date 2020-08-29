<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreUomRequest;
use App\Http\Requests\UpdateUomRequest;

class UomController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('show-uom');
        $uoms = \App\Uom::orderBy('unit_name')->get();

        return view('admin.uoms.index', compact('uoms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create-uom');
        $uom_types = config('polanco.uom_types');

        return view('admin.uoms.create', compact('uom_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUomRequest $request)
    {
        $this->authorize('create-uom');

        $uom = new \App\Uom;
        $uom->type = $request->input('type');
        $uom->unit_name = $request->input('unit_name');
        $uom->unit_symbol = $request->input('unit_symbol');
        $uom->description = $request->input('description');
        $uom->is_active = $request->input('is_active');

        $uom->save();

        return Redirect::action('UomController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('show-uom');

        $uom = \App\Uom::findOrFail($id);

        return view('admin.uoms.show', compact('uom'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update-uom');

        $uom = \App\Uom::findOrFail($id);
        $uom_types = config('polanco.uom_types');

        return view('admin.uoms.edit', compact('uom','uom_types')); //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUomRequest $request, $id)
    {
        $this->authorize('update-uom');

        $uom = \App\Uom::findOrFail($id);

        $uom->type = $request->input('type');
        $uom->unit_name = $request->input('unit_name');
        $uom->unit_symbol = $request->input('unit_symbol');
        $uom->description = $request->input('description');
        $uom->is_active = $request->input('is_active');

        $uom->save();

        return Redirect::action('UomController@show',$uom->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete-uom');

        \App\Uom::destroy($id);

        return Redirect::action('UomController@index');
    }

}