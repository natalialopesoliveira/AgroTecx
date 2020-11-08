<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;

class CartController extends Controller
{

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'product_id' => 'required'
        ]);

        $user = User::find($request->user_id);

        try {

            $cart = $user->cart()->attach($request->product_id);

            return response()->json(
                "Produto inserido no carrinho com sucesso!",
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                "Ocorreu um erro ao inserir produto no carrinho, contate o administrador",
                500
            );
        }

    }

    public function show($user_id)
    {
        try {

            $user = User::find($user_id);

            $product = $user->cart;

            if ($product) {
                return response(new ProductResource($product));
            }

            return response()->json(
                "Não há produtos no carrinho",
                404
            );
        } catch (\Exception $e) {
            return response()->json(
                "Ocorreu um erro na busca, contate o administrador",
                500
            );
        }

    }

    public function destroy($user_id, $id_product)
    {
        $user = User::find($user_id);

        $user->cart()->detach($id_product);

        return response()->json(
            "Produto foi removido do carrinho com sucesso!",
            200
        );

    }

    public function destroyAll($user_id)
    {
        $user = User::find($user_id);

        $user->cart()->detach();

        return response()->json(
            "O carrinho foi esvaziado com sucesso!",
            200
        );

    }

}
