<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AfricasTalking\SDK\AfricasTalking;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class SmsController extends Controller
{
    private $username   = "IdentifyNg.";
    private $apiKey     = "6de0d40e21ad45814e423d42e3b4caa494d43793fe37744828f467021da9c41d";

    public function generateOtp($len){
        $result = '';
        for($i = 0; $i < $len; $i++) {
            $result .= mt_rand(0, 9);
        }
        return $result;
    }

    // public function resolvephone($phone_number)
    // {
    //     $NGdialcode = '+234';
    //     $contains = strpos($phone_number, $NGdialcode);
    //     if($contains===true){
    //         return $phone_number;
    //     }else{
    //         $phone_number = substr($phone_number, 1);
    //          $phone_number = $NGdialcode.$phone_number;
    //          return $phone_number; 
    //     }
    // }

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

        $otp = $this->generateOtp(4);
        // $phone =$this->resolvephone($phone);
        $sent = $this->sendSms($phone, $otp);
        if($sent == 1){
            $id=true;
            // $id = DB::table('account_otp')->insertGetId(
            //     ['otp' => $otp, 'bvn' => $bvn, 'phone' => $phone]
            // );
            if($id)
            {
                return response()->json([
                    'message' => 'success',
                    // 'name' => $bvn,
                    // 'phone' => $phone,
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

    public function initiateForgetPassword(Request $request){
        
        $email = $request->get("email");
        $account = DB::table('users')
                     ->where('email', $email)
                     ->get();

        if($accounts->first()){
            $phone = $accounts->phone;
            $otp = $this->generateOtp(4);
            // $phone =$this->resolvephone($phone);
            $sent = $this->sendSms($phone, $otp);

            if($sent == 1){

                $id = DB::table('forget_password_otp')->insertGetId(
                    ['otp' => $otp, 'phone' => $phone]
                );
                if($id)
                {
                    return response()->json([
                        'message' => 'success',
                        'otp' => $otp
                    ], 200);
                }
                else{
                    return response()->json([
                        'message' => 'could not insert the record',
                    ],406);
                }  
            }else{
                return response()->json([
                    'message' => 'could not send the sms'
                ], 406);
            }
        }else{
            return response()->json([
                'message' => 'There is no user with that email'
            ], 406);
        } 
    }

    public function passwordReset(Request $request){
        
        $password = $request->password;
        $email = $request->email;
        $hashedPassword = Hash::make($password);

        $account = DB::table('users')
                     ->where('email', $email)
                     ->get();

        if($account->first()){
            $user = User::findOrFail($account->id);
            $user->password = $hashedPassword;

            $user->save();

            return response()->json([
                'message' => 'Password changed successfully'
            ], 200);
        }else{
            return response()->json([
                'message' => 'User not found'
            ], 406);
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