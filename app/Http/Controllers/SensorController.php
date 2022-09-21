<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Sensor;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSensorRequest;
use App\Http\Requests\UpdateSensorRequest;

class SensorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Sensor::orderBy('waktu', 'desc')->get();
        $waktu = [];
        $suhu = [];
        $kelembaban = [];
        $latest = Sensor::orderBy('id', 'desc')->first();

        foreach($data as $row){
            $waktu[] = $row->waktu;
        }

        foreach($data as $row){
            $suhu[] = $row->temp_avg;
        }

        foreach($data as $row){
            $kelembaban[] = $row->humid_avg;
        }

        return view('index', [
            'data' => $data,
            'latest' => $latest,
            'waktu' => $waktu,
            'suhu' => $suhu,
            'kelembaban' => $kelembaban,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSensorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            // $temp_1 =
            // $humid_1 =
            // $temp_2 =
            // $humid_2 =
            // $temp_3 =
            // $humid_3 =
            // $temp_avg =
            // $humid_avg =
            // $keterangan =
            // $pwm_kipas =
            // $pwm_pompa =
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sensor  $sensor
     * @return \Illuminate\Http\Response
     */
    public function show(Sensor $sensor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sensor  $sensor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('edit', [
            'data' => Sensor::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSensorRequest  $request
     * @param  \App\Models\Sensor  $sensor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except(['_method','_token']);
        Sensor::find($id)->update($data);
        return redirect('/')->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sensor  $sensor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sensor::destroy($id);
        return redirect('/')->with('success', 'Data berhasil dihapus!');
    }
}
