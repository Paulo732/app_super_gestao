<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fornecedor;
use Illuminate\Support\Facades\DB;


class fornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //1º forma / Instanciando um objeto
        $fornecedor = new Fornecedor();
        $fornecedor->nome = 'fornecedor 100';
        $fornecedor->site = 'fornecedor100.com.br';
        $fornecedor->uf = 'CE';
        $fornecedor->email ='contato@fornecedor100.com.br';
        $fornecedor->save();

        //2º forma / o medoto create (atencao para o atributo fillable da classe)
        Fornecedor::create([
            'nome' => 'fornecedor 200',
            'site' => 'fornecedor200.com.br',
            'uf' => 'RS',
            'email' => 'contato@fornecedor200.com.br',
        ]);

        //3º forma / insert, mas nao ira criar as datas de criacao e atualizacao que é o created_at e o updated_at.
        DB::table('fornecedores')->insert([
            'nome' => 'fornecedor 300',
            'site' => 'fornecedor300.com.br',
            'uf' => 'SP',
            'email' => 'contato@fornecedor300.com.br',
        ]);
    }
}
