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

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'advertise.titulo' => 'required',
            'advertise.id_empresa' => 'required',
            'advertise.descricao_longa' => 'required'
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

    $advertise = Advertise::join('contas', 'estado', $estado)->where(function($q) {
        $q->where('titulo', 'LIKE', '%'.$snome.'%')->orWhere('descricao_longa', 'LIKE', '%'.$snome.'%');
    })->get();


    // return redirect('/...');
}

}
