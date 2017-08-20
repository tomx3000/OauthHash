<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth,Response;
use App\User;
use App\Mobileaccount;
use App\Transaction;
use App\Bankaccount;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function getPhones(){
        $userid=Auth::user()->id;
        $mobile=Mobileaccount::where("userid",$userid)->get();
        
        return Response::json($mobile);

    }
    public function storePhone(Request $request){
        $mobile= new Mobileaccount;
        $mobile->companyname=$request->get("company");
        $mobile->phonenumber=$request->get("phonenumber");
        $mobile->userid=Auth::user()->id;
        $mobile->save();
        return Response::json("saved");
        
    }

    public function updatePhone(Request $request){
        $mobile=Mobileaccount::where("id",$request->get("id"))->first();
        $mobile->companyname=$request->get("company");
        $mobile->phonenumber=$request->get("phonenumber");
        $mobile->save();
        return Response::json("saved");

    }
    public function deletePhone(Request $request){
        $responsetext="not deleted";
        $mobile=Mobileaccount::where("id",$request->get("id"))->first();
        if($mobile){
            $mobile->delete();
            $responsetext="deleted";
        }
        
        return Response::json($responsetext);
    }
    public function getTransactions(){
        $userid=Auth::user()->id;
        $transactions=Transaction::where("userid",$userid)->get();
        
        return Response::json($transactions);


    }
}
