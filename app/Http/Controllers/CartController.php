<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class CartController extends Controller
{
    private $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function store(Request $request)
    {

        try {

            $user = $this->user->find($request->user_id);

            $user->cart()->attach($request->product_id);

            return response()->json("Produto inserido no carrinho com sucesso!", 200);
        } catch (\Exception $e) {
            return response()->json("Ocorreu um erro ao inserir produto no carrinho, contate o administrador", 500);
        }
    }

    public function show($user_id)
    {
        try {

            $user = $this->user->find($user_id);

            $product = $user->cart;

            if ($product) {
                return response($product);
            }

            return response()->json("Não há produtos no carrinho", 404);
        } catch (\Exception $e) {
            return response()->json("Ocorreu um erro na busca, contate o administrador", 500);
        }
    }

    public function destroy($user_id, $id_product)
    {
        $user = $this->user->find($user_id);

        $user->cart()->detach($id_product);

        return response()->json("Produto foi removido do carrinho com sucesso!", 200);
    }

    public function destroyAll($user_id)
    {
        $user = $this->user->find($user_id);

        $user->cart()->detach();

        return response()->json("O carrinho foi esvaziado com sucesso!", 200);
    }
}
