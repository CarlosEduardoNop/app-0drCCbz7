<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductControllerRequest;
use App\Http\Requests\ProductControllerUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Produtos;
use App\Models\logProduto;
use App\Services\compareOperations;
use App\Services\updateProduct;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
        return logProduto::where('produto_id', $id)->orderByDesc('created_at')->get();
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
     * @return \Illuminate\Http\Response
     */
    public function store(ProductControllerRequest $request)
    {
        try{
            $sku = bin2hex(random_bytes(12));
            return Produtos::create([
                'nome' =>  $request->nome,
                'sku' => $sku,
                'quantidade' => $request->quantidade
            ]);
        }catch (ProductControllerRequest $e){
            return response()->json([
                'error' => $e
            ]);
        }
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProductControllerUpdateRequest $request)
    {
        try{
            app(updateProduct::class)->update(Produtos::findOrFail($request->id), $request);
            return response()->json([
                'error' => "Produto alterado com sucesso"
            ]);
        }catch(\Exception $exception){
            Log::error("ProdutoController.update", [
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'message' => $exception->getMessage()
            ]);
            return response()->json([
                'error' => "Ocorreu algum erro"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try{
            Produtos::findOrFail($id)->delete();
            return response()->json([
                'message' => "Sucesso ao destruir o produto"
            ]);
        }catch(\Exception $exception){
            Log::error("ProdutoController.update", [
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'message' => $exception->getMessage()
            ]);
            return response()->json([
                'error' => "Ocorreu algum erro"
            ]);
        }
    }
}
