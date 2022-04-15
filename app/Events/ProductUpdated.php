<?php

namespace App\Events;

use App\Models\Produtos;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $produto;
    public $request;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Produtos $produto, $request)
    {
        $this->produto = $produto;
        $this->request = $request;
    }

}
