<?php
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("transactions")->delete();
        $facker=Faker::create();
        for($i=0;$i<30;$i++){
        	DB::table("transactions")->insert([
        		"payerphonenumber"=>$facker->randomElement(["0754619822","078956548795","0789654251","5874562135","0157962154","0789587469","09875632541","03265795875"]),
        		"payeeaccountid"=>rand(1,4),
        		"amount"=>rand(2000,900000),
        		"payeeaccounttype"=>$facker->randomElement(["Bank","Mobile"]),
        		"userid"=>1,

        		]);
  
        }
    }
}
