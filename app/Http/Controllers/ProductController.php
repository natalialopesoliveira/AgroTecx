<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;

class ProductController extends Controller
{
    private $product;

    /**
    * Create a new product instance.
    *
    * @return void
    */
    public function __construct(Products $product)
    {
        $this->product = $product;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'product.titulo' => 'required',
            'product.id_empresa' => 'required',
            'product.descricao_longa' => 'required'
            'product.preco' => 'required'
        ]);

        $data = $request->all();

        try {

            $product = $this->product->create($data['product']);

            return response()->json(
                Msg::getSucess("Produto cadastrado com sucesso!"),
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                Msg::getError("Ocorreu um erro no cadastro, contate o administrador"),
                500
            );
        }

    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'product.titulo' => 'required',
            'product.id_empresa' => 'required',
            'product.descricao_longa' => 'required'
            'product.preco' => 'required'
        ]);

        $data = $request->all();

        try {

            $product = $this->product->findOrFail($id);
            $product->update($data['product']);

            return response()->json(
                Msg::getSucess("Produto atualizado com sucesso!"),
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
        $product = $this->$product->find($id);

        $product->delete();

        return response()->json(
            Msg::getSucess("Produto foi removido com sucesso!"),
            200
        );

    }

    public function show(Request $request)
    {
        //Caso os filtros estejam vazios
        if(is_null($request->estado) && is_null($request->nome)){
            $product = Products::all();

        //Caso apenas o filtro nome esteja preenchido
        }else if(is_null($request->estado)){
            $product = Products::where('titulo', 'LIKE', '%'.$request->nome.'%')->orWhere('descricao_longa', 'LIKE', '%'.$request->nome.'%')->get();

        //Caso apenas o filtro de estado esteja preenchido
        }else if(is_null($request->nome)){
            $product = Products::join('users', 'state', $request->estado)->get();

        //Caso o filtro de estado e nome estejam preenchidos
        }else{
            $product = Products::join('users', 'state', $request->estado)->where(function($query) {
                $query->where('titulo', 'LIKE', '%'.$request->nome.'%')->orWhere('descricao_longa', 'LIKE', '%'.$request->nome.'%');
            })->get();
        }

        return response(new ProductResource($product));

    }

    public function pay()
    {

    }
}
