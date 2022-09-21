<?php

namespace Database\Seeders;

use DateTime;
use App\Models\Sensor;
use Illuminate\Database\Seeder;

class SensorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $waktu = [];
        $temp_1 = [];
        $temp_2 = [];
        $temp_3 = [];
        $humid_1 = [];
        $humid_2 = [];
        $humid_3 = [];
        $temp_avg = [];
        $humid_avg = [];
        $keterangan = [];
        $pwm_kipas = [];
        $pwm_kompas = [];

        $datetime = new DateTime();
        
        for($i=11;$i<60;$i+=5){
            $seconds = rand(10,60);
            $waktu[] = $datetime->createFromFormat('Y/m/d H:i:s', '2022/09/21 09:'.$i.':'.$seconds);
        }
        for($i=11;$i<60;$i+=5){
            $seconds = rand(10,60);
            $waktu[] = $datetime->createFromFormat('Y/m/d H:i:s', '2022/09/21 10:'.$i.':'.$seconds);
        }

        for($i=0;$i<20;$i++){
            $temp_1_new = rand(26,28);
            $temp_2_new = rand(26,28);
            $temp_3_new = rand(26,28);

            $temp_1[] = $temp_1_new;
            $temp_2[] = $temp_2_new;
            $temp_3[] = $temp_3_new;

            $temp_avg[] = ($temp_1_new + $temp_2_new + $temp_3_new) / 3;
            
            $humid_1_new = rand(80,90);
            $humid_2_new = rand(80,90);
            $humid_3_new = rand(80,90);
            
            $humid_1[] = $humid_1_new;
            $humid_2[] = $humid_2_new;
            $humid_3[] = $humid_3_new;
            
            $humid_avg[] = ($humid_1_new + $humid_2_new + $humid_3_new) / 3;
        }

        for($i=0;$i<20;$i++){
            Sensor::create(
                [
                    'waktu' => $waktu[$i],
                    'temp_1' => $temp_1[$i],
                    'temp_2' => $temp_2[$i],
                    'temp_3' => $temp_3[$i],
                    'humid_1' => $humid_1[$i],
                    'humid_2' => $humid_2[$i],
                    'humid_3' => $humid_3[$i],
                    'temp_avg' => $temp_avg[$i],
                    'humid_avg' => $humid_avg[$i],
                ]
            );
        }
    }
}
