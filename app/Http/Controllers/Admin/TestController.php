<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Http;
use Spatie\ArrayToXml\ArrayToXml;

class TestController extends Controller
{

    public function index()
    {        
        $data = [
            'username' => 'demo',
            'password' => '12345678',
            'header' => '12345678',
            'validity' => '12345678',
            'sendDateTime' => '12345678',
            'messages' => [
                'mb' => [
                    'no' => '905550156185',
                    'msg' => 'Test messsage'
                ]
            ]
        ];
      
        $response = Http::withOptions(['decode_content' => false])->get('http://panel.1sms.com.tr:8080/api/smspost/v1',ArrayToXml::convert($data,'sms'));
        dd($response->body());

    }
    
}
