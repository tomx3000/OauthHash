<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Auth,Response,DB,Redirect,Exception;
use App\User;
use App\Mobileaccount;
use App\Transaction;
use App\Bankaccount;
use App\Customer;
use App\Hash;
use App\HashBankAccount;
use App\HashMobileAccount;
use App\Item;
use App\Subscription;
use App\UserBankAccount;
use App\UserCreditTransaction;
use App\UserDebitTransaction;
use App\UserMobileAccount;
use Nexmo\Laravel\Facade\Nexmo;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\HashCreditTransaction;
use App\Http\Controllers\CustomerApiController;


use League\OAuth2\Server\ResourceServer;
use Illuminate\Auth\AuthenticationException;
use League\OAuth2\Server\Exception\OAuthServerException;
use Symfony\Bridge\PsrHttpMessage\Factory\DiactorosFactory;

class ClientRedirectPaymentCotroller extends Controller
{
    //
    private $server;

    protected $customC;
    public function __construct(ResourceServer $server)
    {
        $this->server = $server;
        $this->middleware('cors');
       
        // $this->middleware('auth_client');
    }
 

    public function redirectLoading(){

    	    return view('loading');

    }

    public function redirectCheckoutform(Request $request){
    	// $this->log('begin redirect_checkout_form');
    	// access the barrier token to get the client id instead of it being passed twice from the customer
    	$path=$this->getOnetimeURL();
        $cipher=Crypt::decryptString($path);
        $credentials=$this->getRouteCredential($cipher);

        // $bearertoken=$this->getBearerToken();
        // $bearertoken=$request->bearerToken();

        //getting client from request
        $psr = (new DiactorosFactory)->createRequest($request);
        try{
            $psr=$this->server->validateAuthenticatedRequest($psr);
           
            $clientId = $psr->getAttribute('oauth_client_id');

            $encryptedclientid=Crypt::encryptString($clientId);

            $data = ['windowUrl' => "http://hash.zatana.net/api/oneurl/".$path.'/'.$encryptedclientid,
              'title' => 'checkout'
              ];


              $object= new CustomerApiController;
            $newcustomer = $object->customerPay($request,$credentials['id'],$clientId);

        return Response::json($data);
        } catch (OAuthServerException $e) {
            throw new AuthenticationException;
        }

        //do this if an exception is thrown
        //find a better route to redirect a customer incase of any thrown eception 
        // the redirect should be able to explain to the customer on what is currently going on
        return Response::json( ['windowUrl' => 'http://hash.zatana.net/',
              'title' => "not working"
              ]);

                 
    }
    
 	public function URLisValid($id){
    	// $this->log('begin url_is_valid');
    	// $this->log('id=>'.$id);
    	$user=User::find($id);
    	if($user->privillage==0) return true;
    	else return false;
    	// $this->log('end url_is_valid');
    }

    public function logOutOneTimeUser(){
    	$id=Auth::user()->id;
    	Auth::logout();
    	$this->removeTempUser($id);
    	return redirect("http://hash.zatana.net");
    }
    public function getOnetimeURL(){
    	// $this->log('begin get_onetime_url');
    	//remember to encrpty the path before sending it using AES 256 bit key 

    	//take that !!!! Hacker!!!
    	$path='';
    	//recusively create a user till success
    	//note failure here is due to repeated email addresses.
    	// thus recursion is applied to mitigate the above situation
    	$user=$this->tempUserCreate();
    	// while($user['id']==null){
    	// $user=$this->tempUserCreate(8,'yahoo');	
    	// }
    	$path=$user['name'].''.$user['pass'].''.$user['id'];
    //username is alyways 8 chars
    	//password = 10 chars
    	//id = the rest

    	$encryptedpath=Crypt::encryptString($path);

    	// $this->log('end get_onetime_url');

    	return $encryptedpath;

    }

    public function removeOnetimeURL($id){
    	// $this->log('begin remove_onetime_url');
    	DB::table('users')
            ->where('id', $id)
            ->update(['privillage' => 1]);
    	// $this->log('end remove_onetime_url');

    }

    public function tempUserCreate($namesize=8,$mailserver='gmail'){
    	// $this->log('begin temp_user_create');
    	//create a tempory user to make payments from a particular client  
    	$email= $this->getRandomEmail($mailserver);
    	$password=$this->getRandomString();
    	$name=$this->getRandomName($namesize);
    	
    $id = DB::table('users')->insertGetId(
    ['email' =>$email , 'name' => $name,'password'=>bcrypt($password),'privillage' => 0]
);	    
// note here 'transactionshowspan' is hacked to be ussed as a flag for onetime urls
    	// $this->log('end temp_user_create');
    	
    return array('id'=>$id,'name'=>$name,'pass'=>$password);
 

    }

    public function removeTempUser($id){
    	// one transaction complete remove the user
    	DB::table('users')->where('id', $id)->delete();
    }

    public function getRouteCredential($path){
    	// $this->log('begin get_route_credential');
    	// from the onetime path (url) get the necessary credetial for login in the user

    	//decrypt first
    	//then strip it
    	$name=substr($path,0,8);
    	$password=substr($path,8,10);
    	$id=substr($path,18);
    	// $this->log('end get_route_credential');
    	return array('name'=>$name,'pass'=>$password,'id'=>$id);
    		
    }

    public function getRandomString($length = 10){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;

    }


    public function getRandomEmail($mail='gmail'){

    	return $this->getRandomString(10).'@'.$mail.'.com';
    }

    public function getRandomName($len=8){
    	return $this->getRandomString($len);
    }
    public function testPath(){
    	$this->log('begin testpath');
    	$path=$this->getOnetimeURL();
    	$this->log('end testpath');
    	return redirect('/api/oneurl/'.$path);
    }
    
    public function oneTimeUrlAuth($param,$cryptid, Request $request)
    {	
    	// $this->log('begin onetimeauth');
        $clientid=Crypt::decryptString($cryptid);
    	$parama1=Crypt::decryptString($param);
    	$credentials=$this->getRouteCredential($parama1);

    	if($this->URLisValid($credentials['id'])){
    		// $this->removeOnetimeURL($credentials['id']);
    		// $this->log('path =>'.$parama1);
    		// $this->log('name =>'.$credentials['name']);
    		// $this->log('password =>'.$credentials['pass']);
    		// $this->log('id =>'.$credentials['id']);
    		
    		
    		if (Auth::attempt(['name' => $credentials['name'], 'password' => $credentials['pass']],true)) {
            // link client and user via modified verify table
              $id = DB::table('request_verify')->insertGetId(
                ['clientid' =>$clientid , 'customerid' => Auth::user()->id]
            );  
            return redirect('/checkout');
        }else return Response::json("Authentification internal fail");

    	}else {
    		return Response::json("got you hacker!!!");
    	}

    	// $this->log('end onetimeauth');
		    
    }

    public function log($msg){
    	echo '<br>';
    	echo '...'.$msg.'...';
    }


   public function getAuthorizationHeader(){
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        }
        else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }
/**
 * get access token from header
 * */
    public function getBearerToken() {
    $headers = $this->getAuthorizationHeader();
    // HEADER: Get the access token from the header
    if (!empty($headers)) {
        if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
            return $matches[1];
        }
    }
    return null;
}


	public function testCipher(){
		$word="thomas";
		$this->log($word);
		echo '<br><br>';
		$ciphertexxt=Crypt::encryptString($word);
		$this->log($ciphertexxt);
		echo '<br><br>';
		$decipher=Crypt::decryptString($ciphertexxt);
		$this->log($decipher);
	}   


}
