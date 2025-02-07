<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MensagemResource extends JsonResource
{
    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->resource = is_array($resource) ? $resource : ['mensagem' => $resource];
    }

    public function toArray(Request $request): array
    {
        return $this->resource;
    }
}
