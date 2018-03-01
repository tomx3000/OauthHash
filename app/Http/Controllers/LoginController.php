<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Auth,Response,DB,Exception;
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


class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @return Response

     */
    public function __construct()
    {
        $this->middleware('timeout');
        $this->middleware('auth');
        
    }

   public function redirectCheckoutformUserDetails(Request $request){
         error_log('message here.'.$request->phonenumber);
         $phone=$this->parseTZPhone($request->phonenumber);

// begin neximo sms gen 
            $verification = Nexmo::verify()->start([
            'number' => $phone,
            'brand'  => 'HAsh inc',
            'pin_expiry'=>'120',
            'sender_id'=>'ZATANA'
        ]);
// end neximo sms gen

// database for holding temporary request id, plus sms otp identifier
        if($verification['status']==0){
            $row=DB::table('request_verify')->where('customerid',Auth::user()->id)->orderBy('id', 'desc')->first();
        DB::table('request_verify')
            ->where('id', $row->id)
            ->update(['otprequestid' => $verification->getRequestId(),'phonenumber'=>$phone]);


          $data = ['url' => "http://hash.zatana.net/checkout_verifyOTP/new",
                      ];
        }else{
            $data = ['url' => "http://hash.zatana.net/checkout/",
                      ];
        }
        
     return Response::json($data);
    }

    public function redirectCheckoutformVerifyOTP(Request $request){
         error_log('message OTP.'.$request->otp);

        $data = ['url' => "http://hash.zatana.net/checkout_password",
                  ];

//begin uncomment

        $results=DB::table('request_verify')->where('customerid',Auth::user()->id)->orderBy('id', 'desc')->first();
        
        if(!empty($results)){
         error_log('get session key =>'.$results->otprequestid);
        try {
            Nexmo::verify()->check(
                $results->otprequestid,
                $request->otp
            );
            $data = ['url' => "http://hash.zatana.net/checkout_password",
                  ];

         DB::table('request_verify')->where('id', $results->id)->delete();
         error_log('verified and deleted');

         return Response::json($data);
        } catch (Exception $e) {
          
         error_log('not verified not deleted GOBACK');
         $data = ['url' => "http://hash.zatana.net/checkout_verifyOTP/old",
                      ];
             return Response::json($data);
         // return redirect()->route('view.checkout_verifyOTP',['id' => $results->phonenumber]);
            // return redirect()->back()->withErrors([
            //     'code' => $e->getMessage()
            // ]);
     
        }

        }else{
            $data = ['url' => "http://hash.zatana.net/",
                  ];
         return Response::json($data);

           error_log('not verified and deleted');
           

        } 

      
//end uncomment

    }
    public function logTransaction(){
        error_log("transaction loged");

        $object= new CustomerApiController;
   
        $customer = Customer::where('userid',Auth::user()->id)->orderBy('id', 'desc')->first();
        error_log("customer created");
        $account=$object->getAcountToReceivePayment($customer->accounttype,$customer->clientid,$customer->companyname);
        error_log("account acquired");
        
        //items
        $itemid = DB::table('customer_items')->where('customerid', $customer->id)->value('itemid');
        $item = DB::table('items')->where('id', $itemid)->first();
        //end items

        // the log the transaction

        $client = DB::table('oauth_clients')->where('id',$customer->clientid)->first();

        $object->logUserCreditTransaction($account,(float)$item->price,$item->description,$customer,$customer->accounttype,$client->user_id);

        //get redirect url
         $url = DB::table('oauth_clients')->where('id',$customer->clientid)->value('redirect');


        //remove customer as a user
        //let now the userid point to the real user who has multiple clients within hash
        DB::table('customers')
            ->where('id', $customer->id)
            ->update(['userid' => $client->user_id]);

            return $url;
    }

    public function redirectCheckoutformPassword(Request $request){

        //upon received feed back from wallet of confirmation of payment
        //log transaction
        $redirecturl=$this->logTransaction();
        // return Response::json("success");
       
            $data = ['url' =>$redirecturl,
                  ];
    // logout
            Auth::logout();
            return Response::json($data);

    }

    public function viewCheckout(){
            error_log("checkout .......");
        $customer = Customer::where('userid',Auth::user()->id)->orderBy('id', 'desc')->first();
        $itemid = DB::table('customer_items')->where('customerid', $customer->id)->value('itemid');
        $item = DB::table('items')->where('id', $itemid)->first();
        $price=$item->price;
        $currency=$item->brand;

            return view('checkout',compact('price','currency'));

    }
    public function viewCheckoutVerifyOTP($param){
            $error=$param;
            return view('checkout_verifyOTP',compact('error'));


    }
    public function viewCheckoutPassword(){

            return view('checkout_password');

    }


    public function parseTZPhone($phonenumber){
        $phone="";
       if(substr($phonenumber, 0,1)=="0" && strlen($phonenumber)==10){           
        $phone="+255".substr($phonenumber, 1);

       }else if(substr($phonenumber, 0,4)=="+255" && strlen($phonenumber)==10){
        $phone=$phonenumber;

       } else{
        $phone="+255684905873";

       }
       return $phone;
    }

    public function testHome(){
        return Response::json("customlogin");
    }

    
}