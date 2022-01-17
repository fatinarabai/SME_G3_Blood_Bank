<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Zone;

class AlterZonesTableAddRow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('zones', function (Blueprint $table) {

            Zone::find(3)->update([
                'zone' => 'orange'
            ]);
            
            $zone = new Zone;
            $zone->id = 4;
            $zone->zone = 'Red';
            $zone->save();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('zones', function (Blueprint $table) {

            Zone::find(3)->update([
                'zone' => 'Red'
            ]);
            
            Zone::find(4)->delete();
        });
    }
}
