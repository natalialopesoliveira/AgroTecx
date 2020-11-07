<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;

class AdvertiseController extends Controller
{
    private $advertise;

    /**
    * Create a new advertise instance.
    *
    * @return void
    */
    public function __construct(Products $advertise)
    {
        $this->advertise = $advertise;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'advertise.title' => 'required',
            'advertise.id_user' => 'required',
            'advertise.status' => 'required',
            'advertise.description' => 'required',
            'advertise.price' => 'required'
        ]);

        $data = $request->all();

        try {

            $advertise = $this->advertise->create($data['advertise']);

            return response()->json(
                Msg::getSucess("Anúncio cadastrado com sucesso!"),
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                Msg::getError("Ocorreu um erro no cadastro, contate o administrador"),
                500
            );
        }

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'advertise.title' => 'required',
            'advertise.id_user' => 'required',
            'advertise.status' => 'required',
            'advertise.description' => 'required',
            'advertise.price' => 'required'
        ]);

        $data = $request->all();

        try {

            $advertise = $this->advertise->findOrFail($id);
            $advertise->update($data['advertise']);

            return response()->json(
                Msg::getSucess("Anúncio atualizado com sucesso!"),
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                Msg::getError("Ocorreu um erro na atualização, contate o administrador"),
                500
            );
        }

    }

    public function destroy($id)
    {
        $advertise = $this->advertise->find($id);

        $advertise->delete();

        return response()->json(
            Msg::getSucess("Anúncio foi removido com sucesso!"),
            200
        );

    }

    public function show(Request $request)
    {
        //Caso os filtros estejam vazios
        if(is_null($request->estado) && is_null($request->nome)){
            $advertise = Products::all();

        //Caso apenas o filtro nome esteja preenchido
        }else if(is_null($request->estado)){
            $advertise = Products::where('title', 'LIKE', '%'.$request->nome.'%')->orWhere('description', 'LIKE', '%'.$request->nome.'%')->get();

        //Caso apenas o filtro de estado esteja preenchido
        }else if(is_null($request->nome)){
            $advertise = Products::join('users', 'state', $request->estado)->get();

        //Caso o filtro de estado e nome estejam preenchidos
        }else{
            $advertise = Products::join('users', 'state', $request->estado)->where(function($query) {
                $query->where('title', 'LIKE', '%'.$request->nome.'%')->orWhere('description', 'LIKE', '%'.$request->nome.'%');
            })->get();
        }

        return response(new AdvertiseResource($advertise));

    }
}
