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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
        ]);

        $user = User::find($request->user_id);

        try {

            $bookmark = $user->bookmark()->attach($request->product_id);

            return response()->json(
                Msg::getSucess("Produto favoritado com sucesso!"),
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                Msg::getError("Ocorreu um erro ao favoritar produto, contate o administrador"),
                500
            );
        }

    }

    public function show($id_user)
    {
        try {

            $user = User::find($id_user);

            $product = $user->bookmark;

            if ($product) {
                return response(new ProductResource($product));
            }

            return response()->json(
                Msg::getError("Não há produtos favoritados"),
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

        $user->bookmark()->detach($id_product);

        return response()->json(
            Msg::getSucess("Produto foi desfavoritado com sucesso!"),
            200
        );

    }

    public function destroyAll($id_user)
    {
        $user = User::find($id_user);

        $user->bookmark()->detach();

        return response()->json(
            Msg::getSucess("Os favoritos foram eliminados com sucesso!"),
            200
        );

    }

}