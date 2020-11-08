<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class BookmarkController extends Controller
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

    public function store($user_id, Request $request)
    {
        $user = $this->user->find($request->user_id);

        try {

            $user->bookmark()->attach($request->product_id);

            return response()->json(
                "Produto favoritado com sucesso!",
                200
            );
        } catch (\Exception $e) {
            return response()->json("Ocorreu um erro ao favoritar produto, contate o administrador", 500);
        }
    }

    public function show($user_id)
    {
        try {

            $user = $this->user->find($user_id);

            $product = $user->bookmark;

            if ($product) {
                return response($product);
            }

            return response()->json("Não há produtos favoritados", 404);
        } catch (\Exception $e) {
            return response()->json("Ocorreu um erro na busca, contate o administrador", 500);
        }
    }

    public function destroy($user_id, $product_id)
    {
        $user = $this->user->find($user_id);

        $user->bookmark()->detach($product_id);

        return response()->json("Produto foi desfavoritado com sucesso!", 200);
    }

    public function destroyAll($user_id)
    {
        $user = $this->user->find($user_id);

        $user->bookmark()->detach();

        return response()->json("Os favoritos foram eliminados com sucesso!", 200);
    }
}
