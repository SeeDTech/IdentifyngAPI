<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ThirdParty extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
     public function toArray($request)
        {
            //return parent::toArray($request);
            return [
                
                'id' => $this->id,
                'name' => $this->name,
                'phone' =>$this->phone,
                'code' =>$this->code,
                'sub_type' =>$this->sub_type,
             ];
            
    
        }
    
}
