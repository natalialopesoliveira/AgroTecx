<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anuncio;

class AnuncioController extends Controller
{
    public function create(Request $request, $idConta)
    {

        $anuncio= new Anuncio;
        $anuncio->titulo= $request->nome;
        $anuncio->id_empresa= $idConta;
        $anuncio->descricao_longa= $request->empresa;

        $anuncio->save();

        // return redirect('/...');
    }

    public function delete($idAnuncio)
    {

        $anuncio = Anuncio::find($idAnuncio);
        $anuncio->delete();

        // return redirect('/...');
    }

    public function list($estado, $nome)
    {

        $anuncios = Anuncio::join('contas', 'estado', $estado)->where(function($q) {
            $q->where('titulo', 'LIKE', '%'.$snome.'%')->orWhere('descricao_longa', 'LIKE', '%'.$snome.'%');
        })->get();
        

        // return redirect('/...');
    }

}
