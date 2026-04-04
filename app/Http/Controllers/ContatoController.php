<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MotivoContato;
use App\Models\SiteContato;


class ContatoController extends Controller
{
    public function contato(Request $request) {

        $motivo_contatos = MotivoContato::all();

        return view('site.contato', ['titulo' => 'Contato (teste)', 'motivo_contatos' => $motivo_contatos, 'request' => $request]);
    }

    public function salvar(Request $request) {


        $request->validate([

            'nome'=> 'required|min:3|max:40|unique:site_contatos',
            'telefone'=> 'required',
            'email'=> 'email',
            'motivo_contatos_id'=> 'required',
            'mensagem'=> 'required|max:2000',

        ],[
            'nome.min' => 'O campo nome precisa de ter no mínimo 3 caracteres',
            'nome.max' => 'O campo nome precisa de ter no máximo 40 caracteres',
            'nome.unique' => 'O nome informado ja esta em uso no sistema',
            'email.email' => 'O e-mail informado não é valido',
            'mensagem.max' => 'O campo mensagem precisa de ter no máximo 2000 caracteres',
            'required' => 'O campo :attribute precisa ser preenchido',
        ]);


        SiteContato::create($request->all());
        return redirect()->route('site.index');
    }
}
