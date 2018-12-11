<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ThirdParty as ThirdPartyResource;
use DB;
use Validator;
use App\ThirdParty;

class ThirdPartyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return ThirdPartyResource::collection(ThirdParty::all());
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'=>'nullable',
            'code'=> 'required',
            'phone'=> 'required',
            'sub_type'=> 'required',

        ]);

         if($validator->fails()){
            $response = array('response' => $validator->messages(), 'success'=>false);
            return $response;
        }else{
            $thirdparty = ThirdParty::create($request->all());
            return response()->json($thirdparty);
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
        $thirdparty = ThirdParty::find($id);
        return response()->json($thirdparty);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $validator = Validator::make($request->all(), [
            'name'=>'nullable',
            'code'=> 'required',
            'phone'=> 'required',
            'sub_type'=> 'required',
        ]);

         if($validator->fails()){

            $response = array('response' => $validator->messages(), 'success'=>false);
            return $response;

        }else{

            $thirdparty = ThirdParty::find($id)->update($request->all());
            return response()->json($thirdparty);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ThirdParty::find($id)->delete();
        $response = array('response' => 'ThirdParty Successfully Deleted', 'success'=>true);
        return $response;
    }
}
