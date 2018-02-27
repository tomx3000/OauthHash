<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('secondname');
            $table->string('lastname');
            // accno should be unique 
            // do above after db modification
            $table->string('accountnumber');//either phone number , wallet unique id , account number, card number etc.
            //just any unique idetifier to the customer payment account
            $table->string('companyname');//something like voda, crdb
            $table->string('accounttype');//either phone or bank
            $table->integer('userid');
            $table->integer('clientid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('customers');

    }
}
