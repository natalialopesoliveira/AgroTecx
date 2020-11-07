<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Advertise;

class AdvertiseController extends Controller
{
    private $advertise;

    /**
    * Create a new advertise instance.
    *
    * @return void
    */
    public function __construct(Advertise $advertise)
    {
        $this->advertise = $advertise;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'advertise.titulo' => 'required',
            'advertise.id_empresa' => 'required',
            'advertise.descricao_longa' => 'required'
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

        return response(new StatusResource($statusObj));

    }

    public function update(Request $request, $advertise)
    {
        $this->validate($request, [
            'advertise.titulo' => 'required',
            'advertise.id_empresa' => 'required',
            'advertise.descricao_longa' => 'required'
        ]);

        $data = $request->all();

        try {

            $advertise = $this->advertise->findOrFail($advertise);
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

        return response(new StatusResource($statusObj));
    }

    public function destroy($advertise)
    {
        $advertise = $this->advertise->find($advertise);

        $advertise->delete();

        return response()->json(
            Msg::getSucess("Anúncio foi removido com sucesso!"),
            200
        );

    }

    public function show(Request $request)
    {
        // Ver como ele está passando o filtro

        $advertise = Advertise::join('contas', 'estado', $estado)->where(function($query) {
            $query->where('titulo', 'LIKE', '%'.$nome.'%')->orWhere('descricao_longa', 'LIKE', '%'.$nome.'%');
        })->get();

        return response(new AdvertiseResource($advertise));

    }
