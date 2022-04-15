<?php

namespace App\Services;

use App\Events\ProductUpdated;
use App\Models\logProduto;
use App\Models\Produtos;
use Illuminate\Support\Facades\Log;

class updateProduct
{
    public function update(Produtos $produto, $request)
    {
        try{
            $produto->update([
                'quantidade' => $produto->quantidade + $request->quantidade
            ]);
            event(new ProductUpdated($produto, $request));
            return response()->json([
                'success' => "Produto atualizado com sucesso"
            ]);
        }catch(\Exception $exception){
            Log::error("updateProduct.update", [
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'message' => $exception->getMessage()
            ]);
        }
    }
}
