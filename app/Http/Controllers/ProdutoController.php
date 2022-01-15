<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produtos;
use App\Models\logProduto;
use Illuminate\Support\Facades\Hash;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Produtos::all();
    }

    public function getLog($id)
    {
        return logProduto::where('produto_id', $id)->orderBy('created_at')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newProduto = new Produtos();
        if ($request->nome == null or ''){
            return 'Nome inválido';
        };
        if ($request->quantidade <= 0 or null){
            return 'Quantidade inválida';
        };
        $sku = bin2hex(random_bytes(12));
        $newProduto->nome = $request->nome;
        $newProduto->sku = $sku;
        $newProduto->quantidade = $request->quantidade;
        $newProduto->save();
        return $newProduto;
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        if ($id){
            $existingItem = Produtos::find($id);
            if($existingItem){
                $newLog = new logProduto();
                $newLog->sku = $existingItem->sku;
                if($request->sku){
                    if(is_bool($request->sku)){
                        $newLog->novo_sku = $existingItem->sku;
                        $existingItem->sku = bin2hex(random_bytes(12));
                        $newLog->sku = $existingItem->sku;
                    };
                };
                if($request->quantidade and $request->quantidade >= 1){
                    if (is_numeric($request->quantidade)){
                        $newLog->quantidade = $request->quantidade;
                        $newLog->quantidade_anterior = $existingItem->quantidade;
                        if($request->operacao == '+'){$existingItem->quantidade = $existingItem->quantidade + $request->quantidade;
                            $newLog->operacao = '+';
                        }elseif($request->operacao == '-'){$existingItem->quantidade = $existingItem->quantidade - $request->quantidade;
                            $newLog->operacao = '-';
                        }else{$existingItem->quantidade = $request->quantidade;
                            $newLog->operacao = '+';
                        };
                        $newLog->quantidade_atual = $existingItem->quantidade;
                    };
                };
                if($request->sku == false and is_numeric($request->quantidade) == false){return 'Houve algum erro ao tentar alterar o produto';};
                $existingItem->save();
                $newLog->produto_id = $id;
                $newLog->save();
                return $existingItem;
            };
            return 'Item não encontrado';
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingItem = Produtos::find($id);

        if($existingItem){
            $existingItem->delete();
            return 'Item deletado com sucesso';
        };

        return 'Informe um ID correto';
    }

    public function destroyLog($id){
        $existingItem = logProduto::find($id);

        if($existingItem){
            $existingItem->delete();
            return 'Log deletada com sucesso';
        };

        return 'Informe um ID correto';
    }
}
