<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AfricasTalking\SDK\AfricasTalking;
use Illuminate\Support\Facades\DB;

class SmsController extends Controller
{
    private $username   = "identifyng";
    private $apiKey     = "67202e15d0c39ddb376eb461ca51f5368e17119f0cbb148f326152480e266e00";

    public function generateOtp($len){
        $result = '';
        for($i = 0; $i < $len; $i++) {
            $result .= mt_rand(0, 9);
        }
        return $result;
    }

    public function index(Request $request){

        $bvn = $request->get("bvn");
        $phone = $request->get("phone");
        $accounts = DB::table('account_otp')
                     ->where('bvn', $bvn)
                     ->where('phone', $phone)
                     ->get();

        if($accounts->first()){
            return response()->json([
                'message' => 'account already in use',
                'name' => $bvn,
                'phone' => $phone
            ]);
        }

        $otp = $this->generateOtp(6);

        $sent = $this->sendSms($phone, $otp);
        if($sent == 1){
            $id = DB::table('account_otp')->insertGetId(
                ['otp' => $otp, 'bvn' => $bvn, 'phone' => $phone]
            );
            if($id)
            {
                return response()->json([
                    'message' => 'success',
                    'name' => $bvn,
                    'phone' => $phone,
                    'otp' => $otp
                ]);
            }
            else{
                return response()->json([
                    'message' => 'could not insert the record',
                    'name' => $bvn,
                    'phone' => $phone
                ]);
            }  
        }else{
            return response()->json([
                'message' => 'could not send the sms',
                'name' => $bvn,
                'phone' => $phone
            ]);
        } 
    }

    public function sendSms($recipients, $otp){

        $user = $this->username;
        $pass = $this->apiKey;
        // Initialize the SDK
        $AT = new AfricasTalking($this->username, $this->apiKey);

        // Get the SMS service
        $sms = $AT->sms();

        // Set the numbers you want to send to in international format
        // $recipients = "+2348034846400";

        // Set your message
        $message  = "Your otp is ".(string)$otp;

        // Set your shortCode or senderId
        $from  = "";

        try {
            // Thats it, hit send and we'll take care of the rest
            $result = $sms->send([
                'to'      => $recipients,
                'message' => $message,
                'from'    => $from
            ]);

            // print_r($result);
            return 1;
        } catch (Exception $e) {
            // echo "Error: ".$e->getMessage();
            return 0;
        }
    }
}