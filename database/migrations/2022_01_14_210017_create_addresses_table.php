<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Address;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->String('street');
            $table->unsignedInteger('state_id');
            $table->unsignedInteger('district_id');
            $table->foreign('state_id')->references('id')->on('addresses_states')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('addresses_districts')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table('addresses', function (Blueprint $table) {
            $data = [
                ["street" => "No.9, Jalan Balam 5/37", "state_id"=>15, "district_id"=> 144],
            ];

            Address::insert($data);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
