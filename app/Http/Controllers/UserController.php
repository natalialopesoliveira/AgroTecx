<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
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

    public function index()
    {
        return $this->user->all();
    }

    public function show($user)
    {

        try {

            $user = $this->user->find($user);

            if ($user) {
                return response()->json(
                    ['Usuario' => $user],
                    200
                );
            }

            return response()->json("Usuário nao encontrado", 404);
        } catch (\Exception $e) {
            return response()->json(
                "Ocorreu um erro na busca, contate o administrador",
                500
            );
        }
    }

    public function login(Request $request)
    {

        try {

            $data = $request->all();

            $user = $this->user->where('email', '=', $data['email'])->first();

            if ($user->password === $data['password']) {
                return response()->json(true, 200);
            }

            return response()->json("Erro login", 404);
        } catch (\Exception $e) {
            return response()->json(
                "Ocorreu um erro no login, contate o administrador",
                500
            );
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();

        try {

            $this->user->create($data);

            return response()->json("Usuário cadastrado com sucesso!", 200);
        } catch (\Exception $e) {
            return response()->json("Ocorreu um erro no cadastro, contate o administrador", 500);
        }
    }

    public function update($user, Request $request)
    {
        $data = $request->all();

        try {

            $user = $this->user->findOrFail($user);
            $user->update($data['user']);


            return response()->json("Usuário atualizado com sucesso!", 200);
        } catch (\Exception $e) {
            return response()->json("Ocorreu um erro na atualização, contate o administrador", 500);
        }
    }

    public function destroy($user)
    {
        $user = $this->user->find($user);

        $user->delete();

        return response()->json("Usuario foi removido com sucesso!", 200);
    }
}
