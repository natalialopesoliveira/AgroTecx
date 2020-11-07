<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;

class CartController extends Controller
{

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|unique:posts|max:255',
            'product_id' => 'required',
        ]);

        $user = User::find($request->user_id);

        try {

            $cart = $user->cart()->attach($request->product_id);

            return response()->json(
                Msg::getSucess("Produto inserido no carrinho com sucesso!"),
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                Msg::getError("Ocorreu um erro ao inserir produto no carrinho, contate o administrador"),
                500
            );
        }

    }

    public function show($id_user)
    {
        try {

            $user = User::find($id_user);

            $product = $user->cart;

            if ($product) {
                return response(new ProductResource($product));
            }

            return response()->json(
                Msg::getError("Não há produtos no carrinho"),
                404
            );
        } catch (\Exception $e) {
            return response()->json(
                Msg::getError("Ocorreu um erro na busca, contate o administrador"),
                500
            );
        }

    }

    public function destroy($id_user, $id_product)
    {
        $user = User::find($id_user);

        $user->cart()->detach($id_product);

        return response()->json(
            Msg::getSucess("Produto foi removido do carrinho com sucesso!"),
            200
        );

    }

    public function destroyAll($id_user)
    {
        $user = User::find($id_user);

        $user->cart()->detach();

        return response()->json(
            Msg::getSucess("O carrinho foi esvaziado com sucesso!"),
            200
        );

    }

}
