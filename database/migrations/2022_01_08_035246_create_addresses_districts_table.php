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
            ['state_id' => '1', 'name' => 'Batu Pahat'],
            ['state_id' => '1', 'name' => 'Johor Bahru'],
            ['state_id' => '1', 'name' => 'Kluang'],
            ['state_id' => '1', 'name' => 'Kota Tinggi'],
            ['state_id' => '1', 'name' => 'Kulai'],
            ['state_id' => '1', 'name' => 'Mersing'],
            ['state_id' => '1', 'name' => 'Muar'],
            ['state_id' => '1', 'name' => 'Pontian'],
            ['state_id' => '1', 'name' => 'Segamat'],
            ['state_id' => '1', 'name' => 'Tangkak'],
        
            /*
             * kedah
             */
            ['state_id' => '2', 'name' => 'Baling'],
            ['state_id' => '2', 'name' => 'Bandar Baharu'],
            ['state_id' => '2', 'name' => 'Kota Setar'],
            ['state_id' => '2', 'name' => 'Kuala Muda'],
            ['state_id' => '2', 'name' => 'Kubang Pasu'],
            ['state_id' => '2', 'name' => 'Kulim'],
            ['state_id' => '2', 'name' => 'Langkawi'],
            ['state_id' => '2', 'name' => 'Padang Terap'],
            ['state_id' => '2', 'name' => 'Pendang'],
            ['state_id' => '2', 'name' => 'Pokok Sena'],
            ['state_id' => '2', 'name' => 'Sik'],
            ['state_id' => '2', 'name' => 'Yan'],

            /*
             * kelantan
             */
            ['state_id' => '3', 'name' => 'Bachok'],
            ['state_id' => '3', 'name' => 'Gua Musang',],
            ['state_id' => '3', 'name' => 'Jeli'],
            ['state_id' => '3', 'name' => 'Kota Bharu'],
            ['state_id' => '3', 'name' => 'Kuala Krai'],
            ['state_id' => '3', 'name' => 'Machang'],
            ['state_id' => '3', 'name' => 'Pasir Mas'],
            ['state_id' => '3', 'name' => 'Pasir Puteh'],
            ['state_id' => '3', 'name' => 'Tanah Merah'],
            ['state_id' => '3', 'name' => 'Tumpat'],

            // ['id' => '0309', 'state_id' => '3', 'name' => '??'],
            
            // ['id' => '0312', 'state_id' => '3', 'name' => 'KECIL LOJING', 'code_3' => 'KLO'],
            /*
             * kuala lumpur - tiada daerah.
             */
            ['state_id' => '4', 'name' => 'Titiwangsa'],
            ['state_id' => '4', 'name' => 'Lembah Pantai'],
            ['state_id' => '4', 'name' => 'Kepong'],
            ['state_id' => '4', 'name' => 'Cheras'],

             /*
             * labuan - tiada daerah
             */
            ['state_id' => '5', 'name' => 'Labuan'],
        
            /*
             * melaka
             */
            ['state_id' => '6', 'name' => 'Melaka Tengah'],
            ['state_id' => '6', 'name' => 'Jasin'],
            ['state_id' => '6', 'name' => 'Alor Gajah'],
        
            /*
             * negeri sembilan
             */
            ['state_id' => '7', 'name' => 'Jelebu'],
            ['state_id' => '7', 'name' => 'Jempol'],
            ['state_id' => '7', 'name' => 'Kuala Pilah'],
            ['state_id' => '7', 'name' => 'Port Dickson'],
            ['state_id' => '7', 'name' => 'Rembau'],
            ['state_id' => '7', 'name' => 'Seremban'],
            ['state_id' => '7', 'name' => 'Tampin'],

            /*
             * pahang
             */
            ['state_id' => '8', 'name' => 'Bentong'],
            ['state_id' => '8', 'name' => 'Cameron Highlands'],
            ['state_id' => '8', 'name' => 'Jerantut'],
            ['state_id' => '8', 'name' => 'Kuantan'],
            ['state_id' => '8', 'name' => 'Lipis'],
            ['state_id' => '8', 'name' => 'Pekan'],
            ['state_id' => '8', 'name' => 'Raub'],
            ['state_id' => '8', 'name' => 'Temerloh'],
            ['state_id' => '8', 'name' => 'Rompin'],
            ['state_id' => '8', 'name' => 'Maran'],
            ['state_id' => '8', 'name' => 'Bera'],

               /*
             * perak
             */
            ['state_id' => '9', 'name' => 'Batang Padang'],
            ['state_id' => '9', 'name' => 'Manjung'],
            ['state_id' => '9', 'name' => 'Kinta'],
            ['state_id' => '9', 'name' => 'Kerian'],
            ['state_id' => '9', 'name' => 'Kuala Kangsar'],
            ['state_id' => '9', 'name' => 'Larut Matang'],
            ['state_id' => '9', 'name' => 'Hilir Perak'],
            ['state_id' => '9', 'name' => 'Hulu Perak'],
            ['state_id' => '9', 'name' => 'Selama'],
            ['state_id' => '9', 'name' => 'Perak Tengah'],
            ['state_id' => '9', 'name' => 'Kampar'],
            ['state_id' => '9', 'name' => 'Muallim'],
        
             /*
             * perlis
             */
            ['state_id' => '10', 'name' => 'Kangar'],
            ['state_id' => '10', 'name' => 'Arau'],
            /*
             * pulau pinang
             */
            ['state_id' => '11', 'name' => 'Seberang Perai Tengah'],
            ['state_id' => '11', 'name' => 'Seberang Perai Utara'],
            ['state_id' => '11', 'name' => 'Seberang Perai Selatan'],
            ['state_id' => '11', 'name' => 'Timur Laut'],
            ['state_id' => '11', 'name' => 'Barat Daya'],
        
             /*
             * putrajaya
             */
            ['state_id' => '12', 'name' => 'Putrajaya'],
                
            
            /*
             * sabah
             */
            ['state_id' => '13', 'name' => 'Kota Kinabalu'],
            ['state_id' => '13', 'name' => 'Papar'],
            ['state_id' => '13', 'name' => 'Kota Belud'],
            ['state_id' => '13', 'name' => 'Tuaran'],
            ['state_id' => '13', 'name' => 'Kudat'],
            ['state_id' => '13', 'name' => 'Ranau'],
            ['state_id' => '13', 'name' => 'Sandakan'],
            ['state_id' => '13', 'name' => 'Telupid'],
            ['state_id' => '13', 'name' => 'Kinabatangan'],
            ['state_id' => '13', 'name' => 'Tawau'],
            ['state_id' => '13', 'name' => 'Lahad Datu'],
            ['state_id' => '13', 'name' => 'Semporna'],
            ['state_id' => '13', 'name' => 'Keningau'],
            ['state_id' => '13', 'name' => 'Tambunan'],
            ['state_id' => '13', 'name' => 'Nabawan'],
            ['state_id' => '13', 'name' => 'Tenom'],
            ['state_id' => '13', 'name' => 'Beaufort'],
            ['state_id' => '13', 'name' => 'Kuala Penyu'],
            ['state_id' => '13', 'name' => 'Sipitang'],
            ['state_id' => '13', 'name' => 'Beluran'],
            ['state_id' => '13', 'name' => 'Penampang'],
            ['state_id' => '13', 'name' => 'Kota Marudu'],
            ['state_id' => '13', 'name' => 'Pitas'],
            ['state_id' => '13', 'name' => 'Kunak'],
            ['state_id' => '13', 'name' => 'Tongod'],
            ['state_id' => '13', 'name' => 'Putatan'],
            ['state_id' => '13', 'name' => 'Kalabakan'],

             /*
             * sarawak
             */
            ['state_id' => '14', 'name' => 'Kuching'],
            ['state_id' => '14', 'name' => 'Asajaya'],
            ['state_id' => '14', 'name' => 'Bau'],
            ['state_id' => '14', 'name' => 'Belaga'],
            ['state_id' => '14', 'name' => 'Daro'],
            ['state_id' => '14', 'name' => 'Dalat'],
            ['state_id' => '14', 'name' => 'Julau'],
            ['state_id' => '14', 'name' => 'Kabong'],
            ['state_id' => '14', 'name' => 'Kanowit'],
            ['state_id' => '14', 'name' => 'Lawas'],
            ['state_id' => '14', 'name' => 'Lundu'],
            ['state_id' => '14', 'name' => 'Lubok Antu'],
            ['state_id' => '14', 'name' => 'Merodong'],
            ['state_id' => '14', 'name' => 'Marudi'],
            ['state_id' => '14', 'name' => 'Matu'],
            ['state_id' => '14', 'name' => 'Pakan'],
            ['state_id' => '14', 'name' => 'Pusa'],
            ['state_id' => '14', 'name' => 'Saratok'],
            ['state_id' => '14', 'name' => 'Sebauh'],
            ['state_id' => '14', 'name' => 'Selangau'],
            ['state_id' => '14', 'name' => 'Serian'],
            ['state_id' => '14', 'name' => 'Simunjan'],
            ['state_id' => '14', 'name' => 'Song'],
            ['state_id' => '14', 'name' => 'Sri Amain'],
            ['state_id' => '14', 'name' => 'Sibu'],
            ['state_id' => '14', 'name' => 'Miri'],
            ['state_id' => '14', 'name' => 'Limbang'],
            ['state_id' => '14', 'name' => 'Sarikei'],
            ['state_id' => '14', 'name' => 'Kapit'],
            ['state_id' => '14', 'name' => 'Samarahan'],
            ['state_id' => '14', 'name' => 'Bintulu'],
            ['state_id' => '14', 'name' => 'Mukah'],
            ['state_id' => '14', 'name' => 'Betong'],
            ['state_id' => '14', 'name' => 'Tatau'],
            ['state_id' => '14', 'name' => 'Beluru'],
            ['state_id' => '14', 'name' => 'Subis'],
            ['state_id' => '14', 'name' => 'Bukit Mabung'],

            /*
             * selangor
             */
            ['state_id' => '15', 'name' => 'Klang'],
            ['state_id' => '15', 'name' => 'Kuala Langat'],
            ['state_id' => '15', 'name' => 'Kuala Selangor'],
            ['state_id' => '15', 'name' => 'Sabak Bernam'],
            ['state_id' => '15', 'name' => 'Hulu Langat'],
            ['state_id' => '15', 'name' => 'Hulu Selangor'],
            ['state_id' => '15', 'name' => 'Petaling'],
            ['state_id' => '15', 'name' => 'Gombak'],
            ['state_id' => '15', 'name' => 'Sepang'],
        
            /*
             * terengganu
             */
            ['state_id' => '16', 'name' => 'Besut'],
            ['state_id' => '16', 'name' => 'Dungun'],
            ['state_id' => '16', 'name' => 'Kemaman'],
            ['state_id' => '16', 'name' => 'Kuala Terengganu'],
            ['state_id' => '16', 'name' => 'Hulu Terengganu'],
            ['state_id' => '16', 'name' => 'Marang'],
            ['state_id' => '16', 'name' => 'Setiu'],
            ['state_id' => '16', 'name' => 'Kuala Nerus'],
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
