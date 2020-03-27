<?php

namespace App\Http\Controllers;

use App\Http\Requests\mirequest;
use App\profesor;
use Illuminate\Http\Request;

class micontrolador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = profesor::all();

        if ($request->ajax()){
            return response()->json($data,200);


        }

        return  view('layouts.inicio', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('layouts.create');


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(mirequest $request)
    {
        $prof = new profesor();
        $prof->nombre = $request->nombre;
        $prof->salario = $request->salario;
        $prof->save();

        return $prof;

    }

    /**
     * Display the specified resource.
     *
     * @param profesor $pro
     * @return void
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $profesor = profesor::find($id);
        return  view('layouts.edit', compact('profesor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param profesor $pro
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Request $request, $id)
    {
        /*$prof = profesor::find($id);
        $prof->fill($request->all());
        $prof->save();

        return redirect('inicio');*/
        $prof = profesor::find($id);
        $prof->nombre = $request->nombre;
        $prof->salario = $request->salario;
        $prof->save();
        return $prof;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prof = profesor::find($id);
        $prof->delete();
    }
}
