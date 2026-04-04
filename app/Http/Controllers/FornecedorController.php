<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;

class FornecedorController extends Controller
{
   public function index() {
        return view('app.fornecedor.index');
    }

    public function listar(Request $request) {

        $fornecedores = Fornecedor::with(['produtos'])->where('nome', 'like', '%'.$request->input('nome').'%')
        ->where('site', 'like', '%'.$request->input('site').'%')
        ->where('uf', 'like', '%'.$request->input('uf').'%')
        ->where('email', 'like', '%'.$request->input('email').'%')
        ->paginate(5);

        return view('app.fornecedor.listar', ['fornecedores' => $fornecedores, 'request' => $request->all() ]);
    }

    public function adicionar(Request $request) {
        $msg = '';

        //inclusao
        if($request->input('_token') != '' && $request->input('id') == '') {
            // validacao
            $regras = [
                'nome' => 'required|min:3|max:40',
                'site' => 'required',
                'uf' => 'required|min:2|max:2',
                'email' => 'email',
            ];

            $fedback =[
                'required' => 'O campo :attribute precisa ser preenchido',
                'nomemin' => 'O campo nome precisa de ter no mínimo 3 caracteres',
                'nomemax' => 'O campo nome precisa de ter no máximo 40 caracteres',
                'ufmin' => 'O campo uf precisa de ter no mínimo 2 caracteres',
                'ufmax' => 'O campo uf precisa de ter no máximo 2 caracteres',
                'email.email' => 'O e-mail informado não é valido',
            ];

            $request->validate($regras, $fedback);

            $fornecedor = new Fornecedor();
            $fornecedor->create($request->all());

            $msg = 'Fornecedor cadastrado com sucesso!';
        }
            //Edicao
        if($request->input('_token') != '' && $request->input('id') != '') {
            $fornecedor = Fornecedor::find($request->input('id'));
            $update = $fornecedor->update($request->all());

            if($update) {
                $msg ='Fornecedor atualizado com sucesso!';
            } else {
                $msg ='Erro ao atualizar o fornecedor!';
            }

            return redirect()->route('app.fornecedor.editar', ['id' =>$request->input('id'), 'msg' => $msg]);
        }

        return view('app.fornecedor.adicionar', ['msg' => $msg]);
    }

    public function editar($id, $msg = '') {

        $fornecedor = Fornecedor::find($id);
        return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor, 'msg' => $msg]);
    }

    public function excluir ($id) {
        Fornecedor::find($id)->delete();
        return redirect()->route('app.fornecedor');
    }
}
