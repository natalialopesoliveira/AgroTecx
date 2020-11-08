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

    public function index($user_id)
    {
        return $this->product->where('user_id', '=', $user_id)->get();
    }

    public function all()
    {
        return $this->product->all();
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

    public function pay($user_id, $product_id)
    {
    }
}
