<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Auth,Response;
use App\User;
use App\Mobileaccount;
use App\Transaction;
use App\Bankaccount;
class CustomerApiController extends Controller
{
    //
    public function __construct(){
        $this->middleware('cors');

    }

	public function sample(){

		  // request
		 $sampletigoresponse= "<?xml version='1.0'?>
		  <COMMAND>	
		 <TYPE>RESMFICI</TYPE>	 	
		  <REFERENCEID>REFERENCEID</REFERENCEID>	  	
		  <TXNID>42326232</TXNID>	
		  <TXNSTATUS>200</TXNSTATUS>	 	
		  <MESSAGE>Success</MESSAGE>	
		  </COMMAND>";

		$xml=$this->tigoXmlParse($sampletigoresponse);
		$type=$this->tigoXmlGen("referenceid","senderno","receiverno","pin","amount","language","REQMFICI");
		$type=$this->postXml($type,'/sample/testxml');
		return view("sample",compact("type"));

	}
	public function tigoXmlGen($referenceid,$senderno,$receiverno,$pin,$amount,$language,$type="REQMFICI"){
		$newsXML = new \SimpleXMLElement("<COMMAND></COMMAND>");
		$newsIntro = $newsXML->addChild('TYPE',$type);
		$newsIntro = $newsXML->addChild('REFERENCEID',$referenceid);
		$newsIntro = $newsXML->addChild('MSISDN',$senderno);
		$newsIntro = $newsXML->addChild('PIN',$pin);
		$newsIntro = $newsXML->addChild('MSISDN1',$receiverno);
		$newsIntro = $newsXML->addChild('AMOUNT',$amount);
		$newsIntro = $newsXML->addChild('LANGUAGE1',$language);
		Header('Content-type: text/xml');
		return $newsXML->asXML();
	}

	public function tigoXmlParse($samplerequest){
	  if(is_string($samplerequest)){
	  	$xml=simplexml_load_string($samplerequest) or die("Error: Cannot create object");
	  }else{
		$xml=simplexml_load_file($samplerequest) or die("Error: Cannot create object");
	  }
	return $xml;

	}

    public function customerPay(Request $request){
    	$respotext="error";
    	if($this->phoneParse($request->get("phonenumber"))!="invalid"){
    	$transaction= new Transaction;
        $transaction->amount=$request->get("amount");
        $transaction->payerphonenumber=$request->get("phonenumber");
        // need to solve how to get userid from client access token authentification
        $transaction->userid=1;
        $transaction->payeeaccounttype="Mobile";
        $mobile=Mobileaccount::orderBy("id","desc")->first();
        $transaction->payeeaccountid=$mobile->id;
        $transaction->save();
        $respotext="saved";
    	}
    	
        return Response::json($respotext);

    }

    public function phoneParse($phone){
    	if(strpos($phone, "+255")){
    		$phone=str_replace("+255", "0",$phone);
    	}
    	
    	if(strlen($phone)==10 ){
    		return $phone;
    	}else{
    		return "invalid";
    	}
    }
    public function postXml($xmldata,$uri){
    	// $xml2=simplexml_load_string($xml) or die("Error: Cannot create object");
		
		$client = new Client(['base_uri'=>'http://192.168.43.80:1334']);
		//
		$response=$client->post($uri,['form_params'=>['xml'=>$xmldata]]);
		// $response = $client->send($request);
		//$code = $response->getStatusCode(); // 200
		//$reason = $response->getReasonPhrase(); // OK
		 return $response->getBody();
    }
    public function xmlTestReceive(Request $request){
    	$xmlreceived=$this->tigoXmlParse($request->get("xml"));
    	if($xmlreceived){
    		// $type=$xmlreceived->MESSAGE;
    		Response::json($respotext);

    		return response('Hello World', 200)
                  ->header('Content-Type', 'text/plain');
    	}else {
    		return response('Error', 200)
                  ->header('Content-Type', 'text/plain');
    	}
    }
}
     