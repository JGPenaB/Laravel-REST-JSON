<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DBInit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("users", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("email")->unique();
            $table->string("password");
            $table->timestamps();
        });
		
		Schema::create("profiles", function(Blueprint $table){
			$table->bigIncrements("id");
            $table->string("first_name");
			$table->string("last_name");
            $table->string("address");
			$table->string("country");
			$table->string("phone_number");
			$table->string("zip_code");
			$table->integer("users_id");
			$table->timestamps();
			
			$table->foreign('users_id')->references("id")->on("users");
		});
		
		Schema::create("accounts", function(Blueprint $table){
			$table->bigIncrements("id");
			$table->string("account_type");
			$table->integer("balance");
			$table->boolean("is_active");
			$table->integer("users_id");
			$table->timestamps();
			
			$table->foreign('users_id')->references("id")->on("users");
		});
		
		Schema::create("transactions", function(Blueprint $table){
			$table->bigIncrements("id");
			$table->integer("amount");
			$table->string("description");
			$table->integer("accounts_id");
			$table->timestamps();
			
			$table->foreign('accounts_id')->references("id")->on("accounts");
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::dropIfExists('transactions');
        Schema::dropIfExists('accounts');
		Schema::dropIfExists('profiles');
		Schema::dropIfExists('users');
    }
}
