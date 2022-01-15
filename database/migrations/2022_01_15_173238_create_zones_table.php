<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Zone;

class CreateZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zones', function (Blueprint $table) {
            $table->increments('id');
            $table->String('zone');
            $table->timestamps();
        });

        Schema::table('zones', function (Blueprint $table) {
            $data = [
                ["zone"=>"Green"],
                ["zone"=>"Yellow"],
                ["zone"=>"Red"],
            ];

            Zone::insert($data);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zones');
    }
}
