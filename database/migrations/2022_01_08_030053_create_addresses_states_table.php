<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\AddressesState;

class CreateAddressesStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses_states', function (Blueprint $table) {
            $table->increments('id');
            $table->String('state');
            $table->timestamps();
        });

        Schema::table('addresses_states', function (Blueprint $table) {
            $data = [
                ["state" => "Johor"],
                ["state" => "Kedah"],
                ["state" => "Kelantan"],
                ["state" => "Kuala Lumpur"],
                ["state" => "Labuan"],
                ["state" => "Melaka"],
                ["state" => "Negeri Sembilan"],
                ["state" => "Pahang"],
                ["state" => "Perak"],
                ["state" => "Perlis"],
                ["state" => "Pulau Pinang"],
                ["state" => "Putrajaya"],
                ["state" => "Sabah"],
                ["state" => "Sarawak"],
                ["state" => "Selangor"],
                ["state" => "Terengganu"],
            ];

            AddressesState::insert($data);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses_states');
    }
}
