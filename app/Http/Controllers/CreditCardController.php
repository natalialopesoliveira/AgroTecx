<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CreditCard;

class CreditCardController extends Controller
{

    private $creditcard;

    /**
    * Create a new credit card instance.
    *
    * @return void
    */
    public function __construct(CreditCard $creditcard)
    {
        $this->creditcard = $creditcard;
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'card_number' => 'required',
            'card_name' => 'required',
            'id_user' => 'required'
        ]);

        $data = $request->all();

        try {

            $creditcard = $this->creditcard->create($data['creditcard']);

            return response()->json(
                Msg::getSucess("Cartão de crédito cadastrado com sucesso!"),
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                Msg::getError("Ocorreu um erro no cadastro, contate o administrador"),
                500
            );
        }

    }

    public function show($id)
    {
        try {

            $creditcard = $this->creditcard->find($id);

            if ($creditcard) {
                return response(new CreditCardResource($creditcard));
            }

            return response()->json(
                Msg::getError("Cartão de crédito não encontrado"),
                404
            );
        } catch (\Exception $e) {
            return response()->json(
                Msg::getError("Ocorreu um erro na busca, contate o administrador"),
                500
            );
        }

    }

    public function update($id, Request $request)
    {

        $validatedData = $request->validate([
            'card_number' => 'required',
            'card_name' => 'required',
            'id_user' => 'required'
        ]);

        $data = $request->all();

        try {

            $creditcard = $this->creditcard->findOrFail($creditcard);
            $creditcard->update($data['creditcard']);


            return response()->json(
                Msg::getSucess("Cartão de crédito atualizado com sucesso!"),
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                Msg::getError("Ocorreu um erro na atualização, contate o administrador"),
                500
            );
        }

    }

    public function destroy($id)
    {
        $creditcard = $this->creditcard->find($creditcard);

        $creditcard->delete();

        return response()->json(
            Msg::getSucess("Cartão de crédito foi removido com sucesso!"),
            200
        );

    }

}
