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

    public function store($user_id, Request $request)
    {
        
        try {
            $data = $request->all();
            $data['user_id'] = $user_id;

            $this->creditcard->create($data);

            return response()->json("Cartão de crédito cadastrado com sucesso!", 200);
        } catch (\Exception $e) {
            return response()->json("Ocorreu um erro no cadastro, contate o administrador", 500);
        }
    }

    public function show($user_id)
    {
        try {
            $creditcard = $this->creditcard->where('user_id', '=', $user_id)->get();

            if ($creditcard) {
                return response($creditcard);
            }

            return response()->json("Cartão de crédito não encontrado", 404);
        } catch (\Exception $e) {
            return $e->getMessage();
            return response()->json("Ocorreu um erro na busca, contate o administrador", 500);
        }
    }

    public function update($card_id, Request $request)
    {
        try {
            $data = $request->all();

            $creditcard = $this->creditcard->findOrFail($card_id);
            $creditcard->update($data);

            return response()->json("Cartão de crédito atualizado com sucesso!", 200);
        } catch (\Exception $e) {
            return response()->json("Ocorreu um erro na atualização, contate o administrador", 500);
        }
    }

    public function destroy($card_id)
    {
        $creditcard = $this->creditcard->find($card_id);

        $creditcard->delete();

        return response()->json("Cartão de crédito foi removido com sucesso!", 200);
    }
}
