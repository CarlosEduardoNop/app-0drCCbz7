<?php

namespace App\Listeners;

use App\Events\ProductUpdated;
use App\Models\logProduto;
use App\Services\updateProduct;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class CreateLogProductUpdated
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\ProductUpdated  $event
     * @return void
     */
    public function handle(ProductUpdated $event)
    {
        try{
            logProduto::create([
                'produto_id' => $event->produto->id,
                'sku' => $event->produto->sku,
                'quantidade' => $event->request->quantidade
            ]);
        }catch(\Exception $exception){
            Log::error("CreateLogProductUpdated.handle", [
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'message' => $exception->getMessage()
            ]);
        }
    }
}
