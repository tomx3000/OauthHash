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

class ClientRedirectPaymentCotroller extends Controller
{
    //
    public function __construct(){
        $this->middleware('cors');
        // $this->middleware('auth_client');
    }

    public function redirectLoading(){

    	    return view('loading');

    }

    public function redirectCheckoutform(Request $request){
    	// $this->log('begin redirect_checkout_form');
    	
    	$path=$this->getOnetimeURL();
        
        $encryptedclientid=Crypt::encryptString($request->client_id);


    	$data = ['windowUrl' => "http://hash.zatana.net/api/oneurl/".$path.'/'.$encryptedclientid,
              'title' => 'checkout'
              ];

    	// $this->log('end redirect_checkout_form');

     return Response::json($data);

    // return redirect('www.google.com');

    }
    
 	public function URLisValid($id){
    	// $this->log('begin url_is_valid');
    	// $this->log('id=>'.$id);
    	$user=User::find($id);
    	if($user->transactionshowspan==0) return true;
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
            ->update(['transactionshowspan' => 1]);
    	// $this->log('end remove_onetime_url');

    }

    public function tempUserCreate($namesize=8,$mailserver='gmail'){
    	// $this->log('begin temp_user_create');
    	//create a tempory user to make payments from a particular client  
    	$email= $this->getRandomEmail($mailserver);
    	$password=$this->getRandomString();
    	$name=$this->getRandomName($namesize);
    	
    $id = DB::table('users')->insertGetId(
    ['email' =>$email , 'name' => $name,'password'=>bcrypt($password),'transactionshowspan' => 0]
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
