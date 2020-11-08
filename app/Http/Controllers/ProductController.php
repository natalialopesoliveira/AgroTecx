<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Products;
use App\Http\Resources\ProductResource;

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

        try {
            if ($request->file) {
                $path = storage_path('app\public\\products\\' . $user_id . '\\');

                if (!file_exists($path)) {
                    mkdir($path, 666, true);
                }
                $filename = $path . 'product' . '.jpg';
                Image::make($request->file)->save($filename);

                $data['file'] = $filename;
            }

            $data = $request->except('file');
            $data['user_id'] = $user_id;

            $this->product->create($data);

            return response()->json("Produto cadastrado com sucesso!", 200);
        } catch (\Exception $e) {
            return $e->getMessage();
            return response()->json("Ocorreu um erro no cadastro, contate o administrador", 500);
        }
    }

    public function update($user_id, $product_id, Request $request)
    {

        try {
            if ($request->file) {

                $path = storage_path('app\public\\products\\' . $user_id . '\\');

                if (!file_exists($path)) {
                    mkdir($path, 666, true);
                }
                $filename = $path . 'product' . '.jpg';
                Image::make($request->file)->save($filename);

                $data = $request->except('file');
                $data['file'] = $filename;
            }

            $product = $this->product->findOrFail($product_id);
            $product->update($data);

            return response()->json("Produto atualizado com sucesso!", 200);
        } catch (\Exception $e) {
            return response()->json("Ocorreu um erro na atualização, contate o administrador", 500);
        }
    }

    public function destroy($user_id, $product_id)
    {
        $product = $this->product->findOrFail($product_id);

        $product->delete();

        return response()->json("Produto foi removido com sucesso!", 200);
    }

    public function show($user_id, $product_id)
    {
        try {

            $product = $this->product->find($product_id);

            if ($product) {
                return response()->json($product, 200);
            }

            return response()->json("Produto nao encontrado", 404);
        } catch (\Exception $e) {
            return response()->json(
                "Ocorreu um erro na busca, contate o administrador",
                500
            );
        }
    }

    public function teste($user_id, $product_id, Request $request)
    {
        $data = $request->all();
        //Caso os filtros estejam vazios
        if (is_null($data['estado']) && is_null($data['nome'])) {
            $product = Products::all();

            //Caso apenas o filtro nome esteja preenchido
        } else if (is_null($data['estado'])) {
            $product = Products::where('title', 'LIKE', '%' . $data['nome'] . '%')->orWhere('description', 'LIKE', '%' . $data['nome'] . '%')->get();

            //Caso apenas o filtro de estado esteja preenchido
        } else if (is_null($data['nome'])) {
            $product = Products::join('users', 'state', $request->estado)->get();

            //Caso o filtro de estado e nome estejam preenchidos
        } else {
            $product = Products::join('users', 'state', $request->estado)->where(function ($query) {
                $query->where('title', 'LIKE', '%' . $data['nome'] . '%')->orWhere('description', 'LIKE', '%' . $data['nome'] . '%');
            })->get();
        }
        return response(new ProductResource($product));
    }

    public function pay($user_id, $product_id)
    {
    }
}
