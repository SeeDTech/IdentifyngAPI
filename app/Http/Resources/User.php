<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class User extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
        'user_id' =>$this->user_id,
        'lname' =>$this->lname,
        'sname' =>$this->sname,
        'mname' =>$this->mname,
        'email' =>$this->email,
        'gender' =>$this->gender,
        'dob' =>$this->dob,
        'state'=>$this->state,
        'lga'=>$this->lga,
        'bvn'=>$this->bvn,
        'phone'=>$this->phone,
        'qrcode'=>$this->qrcode, 
        'password' =>$this->password,
        'user_token'=>$this->user_token,
        'role'=>$this->role,
        'image' =>$this->image,
        'address'=>$this->address,
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at,
        ];
    }
}
