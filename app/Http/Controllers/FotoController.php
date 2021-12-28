<?php

namespace App\Http\Controllers;

use App\Foto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    //
    public function __construct(Foto $foto)
    {
        $this->foto = $foto;
    }
    public function set_foto(Request $req)
    {
        $fotoAntiga = Foto::where('user_id', $req->user->id)->first();
        if ($fotoAntiga) {
            Storage::delete(str_replace('storage', 'public', $fotoAntiga->url));
            $fotoAntiga->delete();
        }

        $nome_foto = $req->file('foto')->store('/public/fotos');
        $this->foto->create([
            'url' => str_replace('public', 'storage', $nome_foto),
            'user_id' => $req->user->id
        ]);
        return [];
    }
}
