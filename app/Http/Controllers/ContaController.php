<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conta;

class ContaController extends Controller
{
    public function create(Request $request)
    {

        $conta= new Conta;
        $conta->nome= $request->nome;
        $conta->email= $request->email;
        $conta->empresa= $request->empresa;
        $conta->segmento= $request->segmento;
        $conta->estado= $request->estado;
        $conta->senha= $request->senha;

        $conta->save();

        // return redirect('/...');
    }

    public function list()
    {

        $contas = Contas::all();

        // return view('....', compact('contas'));
    }

    public function edit(Request $request, $idConta)
    {
       $conta = Conta::find($idConta);
       $conta->nome= $request->nome;
       $conta->email= $request->email;
       $conta->empresa= $request->empresa;
       $conta->segmento= $request->segmento;
       $conta->estado= $request->estado;
       $conta->senha= $request->senha;

       $conta->save();

        // return view('....', compact('contas'));
    }
}
