<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->first_name,
            'email'=>$this->email,
            'surname'=>$this->surname,
            'company_name'=>$this->company_name,
            'db_name'=>$this->database_name,
            'db_user'=>$this->database_user_name,
            'db_password'=>$this->database_password,
            'action'=>[
                'edit'=>route('customer.edit-page',encrypt($this->id)),
                'del'=>route('customer.delete',encrypt($this->id))
            ]
        ];
    }
}
