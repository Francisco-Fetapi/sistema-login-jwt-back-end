<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $fillable = [
        'url', 'user_id'
    ];
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function create($dados)
    {
        parent::create($dados);
    }
    public function url()
    {
        return 'Ola mundo';
    }
}
