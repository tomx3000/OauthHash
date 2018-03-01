<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 use GuzzleHttp\Client;
 use GuzzleHttp\Exception\ServerException;
 use GuzzleHttp\Exception\ConnectException;
 use Response,Redirect;

class DemoShopController extends Controller
{
    public function product()
    {
        return view('product');
    }
    public function pricing()
    {
        return view('pricing');
    }
    public function getdemo()
    {
        return view('demo');
    }
    public function postdemo(Request $request){
     $http = new Client(['base_uri' => 'http://hash.zatana.net']);
	 $responsez = $http->post('/oauth/token', [
	     'form_params' => [
	         'grant_type' => 'client_credentials',
	         'client_id' => '3',
	         'client_secret' => 'OyZDmuvUosmUSrO9IxD0qCm0e5fYKR49IWOxdamQ'
	     ],
	 ]);
	 $resposArr=json_decode((string)$responsez->getBody(), true);

	 $response = $http->request('POST', '/api/checkoutform',
	   ['headers' => [
	        'Authorization' => 'Bearer '.$resposArr['access_token'],
	   ],
	   'form_params'=>[ 
				    "firstname"=>"Thomas",
				    "secondname"=>"Lucas",
				    "lastname"=>"Thomas",
				    "accountnumber"=>"0684905873",
				    "accounttype"=>"mobile",
				    "price_id"=>"434",
				    "price"=>$request->get("amount"),
				    "currency"=>"USD",
				    "client_id" => "3",
				    "description" => "affordable",
				    "company_name" => "stripe",
                    "clientid"=>"3",
                    "amount"=>"800000"

				    ]

                    // ["firstname"=>"arnold","accountnumber"=>"0684905473","secondname"=>"godwin","lastname"=>"lymo","company_name"=>"VODA","clientid"=>"3","accounttype"=>"mobile","amount"=>"800000","description"=>"mining","client_id"=>"3","price_id"=>"12","price"=>"40000","currency"=>"TSH"]

	 ]);

	$urlarr= json_decode((string)$response->getBody(), true);
	$url=$urlarr['windowUrl'];
	 return redirect($url);
        
    }
}
