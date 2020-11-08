<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
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

    public function store($user_id, Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'user_id' => 'required',
            'status' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);

        $data = $request->except('file');
        $caminho="public/products/".$request->id."/";
        Image::make($request->file)->save($caminho);

        try {

            $product = $this->product->create($data['product']);

            return response()->json(
                "Produto cadastrado com sucesso!",
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                "Ocorreu um erro no cadastro, contate o administrador",
                500
            );
        }

    }

    public function update($user_id, $product_id, Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'user_id' => 'required',
            'status' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        $data = $request->except('file');
        $caminho="public/products/".$request->id."/";
        Image::make($request->file)->save($caminho);

        try {

            $product = $this->product->findOrFail($product_id);
            $product->update($data['product']);

            return response()->json(
                "Produto atualizado com sucesso!",
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                "Ocorreu um erro na atualização, contate o administrador",
                500
            );
        }

    }

    public function destroy($user_id, $product_id)
    {
        $product = $this->$product->findOrFail($product_id);

        $product->delete();

        return response()->json(
            "Produto foi removido com sucesso!",
            200
        );

    }

    public function show($user_id, $product_id, Request $request)
    {
        //Caso os filtros estejam vazios
        if(is_null($request->estado) && is_null($request->nome)){
            $product = Products::all();

        //Caso apenas o filtro nome esteja preenchido
        }else if(is_null($request->estado)){
            $product = Products::where('title', 'LIKE', '%'.$request->nome.'%')->orWhere('description', 'LIKE', '%'.$request->nome.'%')->get();

        //Caso apenas o filtro de estado esteja preenchido
        }else if(is_null($request->nome)){
            $product = Products::join('users', 'state', $request->estado)->get();

        //Caso o filtro de estado e nome estejam preenchidos
        }else{
            $product = Products::join('users', 'state', $request->estado)->where(function($query) {
                $query->where('title', 'LIKE', '%'.$request->nome.'%')->orWhere('description', 'LIKE', '%'.$request->nome.'%');
            })->get();
        }
        return response(new ProductResource($product));
    }

    public function pay($user_id, $product_id)
    {

    }
}
