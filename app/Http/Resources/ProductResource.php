<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
    * Transform the resource into an array.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return array
    */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            "titulo" => $this->titulo,
            "id_empresa" => $this->id_empresa,
            "descricao_longa" => $this->descricao_longa,
            "preco" => $this->preco
        ];
    }
}
