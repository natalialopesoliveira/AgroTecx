<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bookmark;
use App\Products;

class BookmarkController extends Controller
{
    // private $bookmark;
    //
    // /**
    // * Create a new bookmark instance.
    // *
    // * @return void
    // */
    // public function __construct(Bookmark $bookmark)
    // {
    //     $this->bookmark = $bookmark;
    // }

    public function store($user_id, Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'product_id' => 'required'
        ]);

        $user = User::find($request->user_id);

        try {

            $bookmark = $user->bookmark()->attach($request->product_id);

            return response()->json(
                "Produto favoritado com sucesso!",
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                "Ocorreu um erro ao favoritar produto, contate o administrador",
                500
            );
        }

    }

    public function show($user_id)
    {
        try {

            $user = User::find($user_id);

            $product = $user->bookmark;

            if ($product) {
                return response(new ProductResource($product));
            }

            return response()->json(
                "Não há produtos favoritados",
                404
            );
        } catch (\Exception $e) {
            return response()->json(
                "Ocorreu um erro na busca, contate o administrador",
                500
            );
        }

    }

    public function destroy($user_id, $product_id)
    {
        $user = User::find($user_id);

        $user->bookmark()->detach($product_id);

        return response()->json(
            "Produto foi desfavoritado com sucesso!",
            200
        );

    }

    public function destroyAll($user_id)
    {
        $user = User::find($user_id);

        $user->bookmark()->detach();

        return response()->json(
            "Os favoritos foram eliminados com sucesso!",
            200
        );

    }

}
