<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bookmark;
use App\Products;

class BookmarkController extends Controller
{
    private $bookmark;

    /**
    * Create a new cart instance.
    *
    * @return void
    */
    public function __construct(Bookmark $bookmark)
    {
        $this->bookmark = $bookmark;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'cart.id_user' => 'required',
            'cart.id_product' => 'required',
        ]);

        $data = $request->all();

        try {

            $bookmark = $this->bookmark->create($data['bookmark']);

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

            $product = Products::where('id_user',$id_user);

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

    public function destroy($id)
    {
        $bookmark = $this->bookmark->find($id);

        $bookmark->delete();

        return response()->json(
            Msg::getSucess("Produto foi desfavoritado com sucesso!"),
            200
        );

    }

    public function destroyAll($id_user)
    {
        $bookmark = $this->bookmark->where('id_user',$id_user);

        $bookmark->delete();

        return response()->json(
            Msg::getSucess("Os favoritos foram eliminados com sucesso!"),
            200
        );

    }

}
