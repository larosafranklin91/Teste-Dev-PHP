<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cliente\StoreRequest;
use App\Http\Requests\Cliente\UpdateRequest;
use App\Models\cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

use function Termwind\render;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes=cliente::where('user_id', Auth::user()->id)->get();
        return Inertia::render('Cliente/Index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Cliente/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data=$request->except('cv');
        $file=$request->file('cv');
        $routeName=$file->store('cv',['disk'=>'public']);
        $data['cv']=$routeName;
        $data['user_id']=Auth::user()->id;
        cliente::create($data);
        return to_route('cliente.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(cliente $cliente)
    {
        return Inertia::render('Cliente/Edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, cliente $cliente)
    {
        $data=$request->except('cv');
        if($request->hasFile('cv')){
            $file=$request->file('cv');
            $routeName=$file->store('cv',['disk'=>'public']);
            $data['cv']=$routeName;
            if($cliente->cv){
                Storage::disk('public')->delete($cliente->cv);
            }
        }
        $cliente->update($data);
        return to_route('cliente.edit', $cliente);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(cliente $cliente)
    {
        if($cliente->cv){
            Storage::disk('public')->delete($cliente->cv);
        }
        $cliente->delete();
        return to_route('cliente.index');
    }
}
