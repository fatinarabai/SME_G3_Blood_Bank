<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\AddressesDistrict;

class CreateAddressesDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses_districts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('state_id');
            $table->string('name');
            $table->foreign('state_id')->references('id')->on('addresses_states')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table('addresses_districts', function (Blueprint $table) {
            $data = [
            ['state_id' => '1', 'name' => 'BATU PAHAT'],
            ['state_id' => '1', 'name' => 'JOHOR BAHRU'],
            ['state_id' => '1', 'name' => 'KLUANG'],
            ['state_id' => '1', 'name' => 'KOTA TINGGI'],
            ['state_id' => '1', 'name' => 'KULAI'],
            ['state_id' => '1', 'name' => 'MERSING'],
            ['state_id' => '1', 'name' => 'MUAR'],
            ['state_id' => '1', 'name' => 'PONTIAN'],
            ['state_id' => '1', 'name' => 'SEGAMAT'],
            ['state_id' => '1', 'name' => 'TANGKAK'],
        
            /*
             * kedah
             */
            ['state_id' => '2', 'name' => 'BALING'],
            ['state_id' => '2', 'name' => 'BANDAR BAHARU'],
            ['state_id' => '2', 'name' => 'KOTA SETAR'],
            ['state_id' => '2', 'name' => 'KUALA MUDA'],
            ['state_id' => '2', 'name' => 'KUBANG PASU'],
            ['state_id' => '2', 'name' => 'KULIM'],
            ['state_id' => '2', 'name' => 'LANGKAWI'],
            ['state_id' => '2', 'name' => 'PADANG TERAP'],
            ['state_id' => '2', 'name' => 'PENDANG'],
            ['state_id' => '2', 'name' => 'POKOK SENA'],
            ['state_id' => '2', 'name' => 'SIK'],
            ['state_id' => '2', 'name' => 'YAN'],

            /*
             * kelantan
             */
            ['state_id' => '3', 'name' => 'BACHOK'],
            ['state_id' => '3', 'name' => 'GUA MUSANG',],
            ['state_id' => '3', 'name' => 'JELI'],
            ['state_id' => '3', 'name' => 'KOTA BHARU'],
            ['state_id' => '3', 'name' => 'KUALA KRAI'],
            ['state_id' => '3', 'name' => 'MACHANG'],
            ['state_id' => '3', 'name' => 'PASIR MAS'],
            ['state_id' => '3', 'name' => 'PASIR PUTEH'],
            ['state_id' => '3', 'name' => 'TANAH MERAH'],
            ['state_id' => '3', 'name' => 'TUMPAT'],

            // ['id' => '0309', 'state_id' => '3', 'name' => '??'],
            
            // ['id' => '0312', 'state_id' => '3', 'name' => 'KECIL LOJING', 'code_3' => 'KLO'],
            /*
             * kuala lumpur - tiada daerah.
             */
            ['state_id' => '4', 'name' => 'TITIWANGSA'],
            ['state_id' => '4', 'name' => 'LEMBAH PANTAI'],
            ['state_id' => '4', 'name' => 'KEPONG'],
            ['state_id' => '4', 'name' => 'CHERAS'],

             /*
             * labuan - tiada daerah
             */
            ['state_id' => '5', 'name' => 'W. P. LABUAN'],
        
            /*
             * melaka
             */
            ['state_id' => '6', 'name' => 'MELAKA TENGAH'],
            ['state_id' => '6', 'name' => 'JASIN'],
            ['state_id' => '6', 'name' => 'ALOR GAJAH'],
        
            /*
             * negeri sembilan
             */
            ['state_id' => '7', 'name' => 'JELEBU'],
            ['state_id' => '7', 'name' => 'JEMPOL'],
            ['state_id' => '7', 'name' => 'KUALA PILAH'],
            ['state_id' => '7', 'name' => 'PORT DICKSON'],
            ['state_id' => '7', 'name' => 'REMBAU'],
            ['state_id' => '7', 'name' => 'SEREMBAN'],
            ['state_id' => '7', 'name' => 'TAMPIN'],

            /*
             * pahang
             */
            ['state_id' => '8', 'name' => 'BENTONG'],
            ['state_id' => '8', 'name' => 'CAMERON HIGHLANDS'],
            ['state_id' => '8', 'name' => 'JERANTUT'],
            ['state_id' => '8', 'name' => 'KUANTAN'],
            ['state_id' => '8', 'name' => 'LIPIS'],
            ['state_id' => '8', 'name' => 'PEKAN'],
            ['state_id' => '8', 'name' => 'RAUB'],
            ['state_id' => '8', 'name' => 'TEMERLOH'],
            ['state_id' => '8', 'name' => 'ROMPIN'],
            ['state_id' => '8', 'name' => 'MARAN'],
            ['state_id' => '8', 'name' => 'BERA'],

               /*
             * perak
             */
            ['state_id' => '9', 'name' => 'BATANG PADANG'],
            ['state_id' => '9', 'name' => 'MANJUNG'],
            ['state_id' => '9', 'name' => 'KINTA'],
            ['state_id' => '9', 'name' => 'KERIAN'],
            ['state_id' => '9', 'name' => 'KUALA KANGSAR'],
            ['state_id' => '9', 'name' => 'LARUT MATANG'],
            ['state_id' => '9', 'name' => 'HILIR PERAK'],
            ['state_id' => '9', 'name' => 'HULU PERAK'],
            ['state_id' => '9', 'name' => 'SELAMA'],
            ['state_id' => '9', 'name' => 'PERAK TENGAH'],
            ['state_id' => '9', 'name' => 'KAMPAR'],
            ['state_id' => '9', 'name' => 'MUALLIM'],
        
             /*
             * perlis
             */
            ['state_id' => '10', 'name' => 'KANGAR'],
            ['state_id' => '10', 'name' => 'ARAU'],
            /*
             * pulau pinang
             */
            ['state_id' => '11', 'name' => 'SEBERANG PERAI TENGAH'],
            ['state_id' => '11', 'name' => 'SEBERANG PERAI UTARA'],
            ['state_id' => '11', 'name' => 'SEBERANG PERAI SELATAN'],
            ['state_id' => '11', 'name' => 'TIMUR LAUT'],
            ['state_id' => '11', 'name' => 'BARAT DAYA'],
        
             /*
             * putrajaya
             */
            ['state_id' => '12', 'name' => 'PUTRAJAYA'],
                
            
            /*
             * sabah
             */
            ['state_id' => '13', 'name' => 'KOTA KINABALU'],
            ['state_id' => '13', 'name' => 'PAPAR'],
            ['state_id' => '13', 'name' => 'KOTA BELUD'],
            ['state_id' => '13', 'name' => 'TUARAN'],
            ['state_id' => '13', 'name' => 'KUDAT'],
            ['state_id' => '13', 'name' => 'RANAU'],
            ['state_id' => '13', 'name' => 'SANDAKAN'],
            ['state_id' => '13', 'name' => 'TELUPID'],
            ['state_id' => '13', 'name' => 'KINABATANGAN'],
            ['state_id' => '13', 'name' => 'TAWAU'],
            ['state_id' => '13', 'name' => 'LAHAD DATU'],
            ['state_id' => '13', 'name' => 'SEMPORNA'],
            ['state_id' => '13', 'name' => 'KENINGAU'],
            ['state_id' => '13', 'name' => 'TAMBUNAN'],
            ['state_id' => '13', 'name' => 'NABAWAN'],
            ['state_id' => '13', 'name' => 'TENOM'],
            ['state_id' => '13', 'name' => 'BEAUFORT'],
            ['state_id' => '13', 'name' => 'KUALA PENYU'],
            ['state_id' => '13', 'name' => 'SIPITANG'],
            ['state_id' => '13', 'name' => 'BELURAN'],
            ['state_id' => '13', 'name' => 'PENAMPANG'],
            ['state_id' => '13', 'name' => 'KOTA MARUDU'],
            ['state_id' => '13', 'name' => 'PITAS'],
            ['state_id' => '13', 'name' => 'KUNAK'],
            ['state_id' => '13', 'name' => 'TONGOD'],
            ['state_id' => '13', 'name' => 'PUTATAN'],
            ['state_id' => '13', 'name' => 'KALABAKAN'],

             /*
             * sarawak
             */
            ['state_id' => '14', 'name' => 'KUCHING'],
            ['state_id' => '14', 'name' => 'ASAJAYA'],
            ['state_id' => '14', 'name' => 'BAU'],
            ['state_id' => '14', 'name' => 'BELAGA'],
            ['state_id' => '14', 'name' => 'DARO'],
            ['state_id' => '14', 'name' => 'DALAT'],
            ['state_id' => '14', 'name' => 'JULAU'],
            ['state_id' => '14', 'name' => 'KABONG'],
            ['state_id' => '14', 'name' => 'KANOWIT'],
            ['state_id' => '14', 'name' => 'LAWAS'],
            ['state_id' => '14', 'name' => 'LUNDU'],
            ['state_id' => '14', 'name' => 'LUBOK ANTU'],
            ['state_id' => '14', 'name' => 'MERODONG'],
            ['state_id' => '14', 'name' => 'MARUDI'],
            ['state_id' => '14', 'name' => 'MATU'],
            ['state_id' => '14', 'name' => 'PAKAN'],
            ['state_id' => '14', 'name' => 'PUSA'],
            ['state_id' => '14', 'name' => 'SARATOK'],
            ['state_id' => '14', 'name' => 'SEBAUH'],
            ['state_id' => '14', 'name' => 'SELANGAU'],
            ['state_id' => '14', 'name' => 'SERIAN'],
            ['state_id' => '14', 'name' => 'SIMUNJAN'],
            ['state_id' => '14', 'name' => 'SONG'],
            ['state_id' => '14', 'name' => 'SRI AMAN'],
            ['state_id' => '14', 'name' => 'SIBU'],
            ['state_id' => '14', 'name' => 'MIRI'],
            ['state_id' => '14', 'name' => 'LIMBANG'],
            ['state_id' => '14', 'name' => 'SARIKEI'],
            ['state_id' => '14', 'name' => 'KAPIT'],
            ['state_id' => '14', 'name' => 'SAMARAHAN'],
            ['state_id' => '14', 'name' => 'BINTULU'],
            ['state_id' => '14', 'name' => 'MUKAH'],
            ['state_id' => '14', 'name' => 'BETONG'],
            ['state_id' => '14', 'name' => 'TATAU'],
            ['state_id' => '14', 'name' => 'BELURU'],
            ['state_id' => '14', 'name' => 'SUBIS'],
            ['state_id' => '14', 'name' => 'BUKIT MABUNG'],

            /*
             * selangor
             */
            ['state_id' => '15', 'name' => 'KLANG'],
            ['state_id' => '15', 'name' => 'KUALA LANGAT'],
            ['state_id' => '15', 'name' => 'KUALA SELANGOR'],
            ['state_id' => '15', 'name' => 'SABAK BERNAM'],
            ['state_id' => '15', 'name' => 'HULU LANGAT'],
            ['state_id' => '15', 'name' => 'HULU SELANGOR'],
            ['state_id' => '15', 'name' => 'PETALING'],
            ['state_id' => '15', 'name' => 'GOMBAK'],
            ['state_id' => '15', 'name' => 'SEPANG'],
        
            /*
             * terengganu
             */
            ['state_id' => '16', 'name' => 'BESUT'],
            ['state_id' => '16', 'name' => 'DUNGUN'],
            ['state_id' => '16', 'name' => 'KEMAMAN'],
            ['state_id' => '16', 'name' => 'KUALA TERENGGANU'],
            ['state_id' => '16', 'name' => 'HULU TERENGGANU'],
            ['state_id' => '16', 'name' => 'MARANG'],
            ['state_id' => '16', 'name' => 'SETIU'],
            ['state_id' => '16', 'name' => 'KUALA NERUS'],
            ];

            AddressesDistrict::insert($data);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses_districts');
    }
}
