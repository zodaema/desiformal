<?php

namespace App\Http\Controllers\Admincp;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Model\Admincp\Queue;

class QueueController extends Controller
{
    //
    public function index()
    {
        $month_name = array('01'=>'มกราคม','02'=>'กุมภาพันธ์','03'=>'มีนาคม','04'=>'เมษายน','05'=>'พฤษภาคม','06'=>'มิถุนายน','07'=>'กรกฎาคม','08'=>'สิงหาคม','09'=>'กันยายน','10'=>'ตุลาคม','11'=>'พฤศจิกายน','12'=>'ธันวาคม');
        return view('admincp.queue')->with('month_name', $month_name);
    }

    public static function sessionFetch($number){
        session(['fetch' => $number]);
        return response()->json([
            "message" => "Success"
        ]);
    }

    public static function requestQueue($month,$year)
    {
        $queue = Queue::where('month', $month)->where('year', $year)->first();
        return $queue;
    }

    public function plus($month,$year){
        $queue = Queue::where('month', $month)->where('year', $year)->first();
        if(empty($queue)){
            $queue = new Queue();
            $queue->month = $month;
            $queue->year = $year;
            $queue->queue = 1;
            $queue->save();
        }
        else {
            if ($queue->queue == 1) {
                $queue->queue = 2;
                $queue->save();
            }
        }
        return response()->json([
            "message" => "Success"
        ]);
    }

    public function minus($month,$year){
        $queue = Queue::where('month', $month)->where('year', $year)->first();
        if(isset($queue)){
            if ($queue->queue == 2) {
                $queue->queue = 1;
                $queue->save();
            }
            elseif($queue->queue == 1){
                $queue->delete();
            }
        }
        return response()->json([
            "message" => "Success"
        ]);
    }
}
