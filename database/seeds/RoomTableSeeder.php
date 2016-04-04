<?php

use Illuminate\Database\Seeder;
use App\Room;

class RoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $codes = ["1-305", "1-315", "2-260", "2-269", "2-286",
                        "2-102", "2-103", "Forum", "Chapel"];
      foreach($codes as $code){
          try{
              Room::create(['code' => $code]);
              }
              catch(Exception $e){
                print($e->getMessage());
              }
      }
    }
}
