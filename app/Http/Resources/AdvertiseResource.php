<?php

namespace App\Http\Resources;

use App\Advertise;
use Illuminate\Http\Resources\Json\JsonResource;

class AdvertiseResource extends JsonResource
{
    /**
    * Transform the resource into an array.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return array
    */
    public function toArray($request)
    {
        return [
            "titulo" => $this->titulo,
            "id_empresa" => $this->id_empresa,
            "descricao_longa" => $this->descricao_longa
        ];
    }
}
