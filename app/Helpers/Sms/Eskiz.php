<?php 
namespace App\Helpers\Sms;

use Illuminate\Support\Facades\Http;
use App\Models\SmsConfig;
class Eskiz
{
    public static function loginAndRefreshToken($data)
    {
        $response = Http::post('notify.eskiz.uz/api/auth/login',[
            'email' => $data['login'],
            'password' => $data['password']
        ]);
        
        $response = json_decode($response->body(),true);
    
        if($response['message'] != 'token_generated'){
            return false;
        }

        SmsConfig::where('id',$data['smsconfig_id'])->first()->update([
            'token' => $response['data']['token']
        ]);
        return self::send($response['data']['token'],$data);
    }

    public static function send($token,$data)
    {
        $response = Http::withToken($token)->post('notify.eskiz.uz/api/message/sms/send',[
            'mobile_phone' => $data['phone']['receiver'],
            'message' => $data['message'],
            'from' => $data['title'],
        ]);
        $response = json_decode($response->body(),true);

        if(isset($response['status_code']) && $response['status_code'] == 500){
            return self::loginAndRefreshToken($data);
        }
        return $response;
    }
}