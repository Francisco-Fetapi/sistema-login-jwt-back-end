<?php

namespace App\Http\Controllers;

use App\Foto;
use Illuminate\Http\Request;
use App\User;
use Exception;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'bail|email|required|unique:users',
            'nome'      => 'bail|required|min:5|max:50',
            'password'  => 'bail|required|min:6',
            'conf-senha' => 'same:password'
        ], [
            'same' => 'Senha e confirmar senha não são iguais.'
        ]);
        if ($validator->fails()) {
            return response([
                'status' => 'error',
                'erros' => $validator->errors(),
            ]);
        }

        $this->user->create([
            'nome' => $request->nome,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        return response([
            'status' => 'ok',
            'msg' => 'Usuario criado',
            'token' => $this->user->login($request->only('email', 'password'))
        ]);
    }
    public function login(Request $req)
    {
        $credenciais = $req->only(['email', 'password']);
        $token = $this->user->login($credenciais);
        if (!$token) {
            return response([
                'status' => 'error',
                'msg' => "Email ou senha incorretos."
            ]);
        }
        return response([
            'status' => 'ok',
            'token' => $token,
            'msg' => 'Login feito com sucesso',
            'user' => $this->user->findByEmail($req['email'])
        ]);
    }
    public function logout(Request $req)
    {
        $token = $req->input('token') ?? $req->header('token');
        if ($token) {
            $this->user->logout($token);
            return response([
                'status' => 'ok',
                'msg' => 'Deslogado com sucesso'
            ]);
        }
        return response([
            'status' => 'error',
            'msg' => 'Erro ao deslogar.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
