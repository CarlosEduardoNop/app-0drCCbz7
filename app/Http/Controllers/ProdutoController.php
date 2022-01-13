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
        return logProduto::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
                    $newLog->novo_sku = $existingItem->sku;
                    $existingItem->sku = $request->sku;
                    $newLog->sku = $request->sku;
                };
                if($request->quantidade and $request->quantidade >= 1){
                    if (is_numeric($request->quantidade)){
                        $newLog->quantidade = $request->quantidade;
                        $newLog->quantidade_anterior = $existingItem->quantidade;
                        if($request->operacao == '+'){
                            $existingItem->quantidade = $existingItem->quantidade + $request->quantidade;
                            $newLog->operacao = '+';
                        }elseif($request->operacao == '-'){
                            $existingItem->quantidade = $existingItem->quantidade - $request->quantidade;
                            $newLog->operacao = '-';
                        }else{
                            $existingItem->quantidade = $request->quantidade;
                            $newLog->operacao = '+';
                        };
                        $newLog->quantidade_atual = $existingItem->quantidade;
                    };
                };
                if($request->sku == false and $request->quantidade == false){return 'Informe os dados';};
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
        //
    }
}
