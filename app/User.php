<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function create($dados)
    {
        parent::create([
            'nome' => $dados['nome'],
            'email' => $dados['email'],
            'password' => Hash::make($dados['password'])
        ]);
    }
    public function fotos()
    {
        return $this->hasMany('App\Foto', 'user_id', 'id');
    }
    public function foto()
    {
        return $this->hasOne('App\Foto', 'user_id', 'id');
    }
    public function login($credentials)
    {
        $token = JWTAuth::attempt($credentials);
        if (!$token) {
            return false;
        }
        return $token;
    }
    public function findByEmail($email)
    {
        return parent::where('email', $email)->get();
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function logout($token)
    {
        if (!JWTAuth::invalidate($token)) {
            throw new \Exception("Erro. Tente novamente.", -404);
        }
    }
}
