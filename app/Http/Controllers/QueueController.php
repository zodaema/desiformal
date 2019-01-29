<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Model\Admincp\Queue;
use function Symfony\Component\HttpKernel\Tests\controller_func;

class QueueController extends Controller
{
    public static function searchQueue($month,$year)
    {
        $queue = Queue::where('month', $month)->where('year', $year)->first();
        return $queue;
    }
    public static function blankMonth(){
        for ($i=0; $i<20; $i++) {
            $month_name = array('01'=>'มกราคม','02'=>'กุมภาพันธ์','03'=>'มีนาคม','04'=>'เมษายน','05'=>'พฤษภาคม','06'=>'มิถุนายน','07'=>'กรกฎาคม','08'=>'สิงหาคม','09'=>'กันยายน','10'=>'ตุลาคม','11'=>'พฤศจิกายน','12'=>'ธันวาคม');
            $day = date('d',strtotime("$i month"));
            $month = date('m',strtotime("$i month"));
            $year = date('Y',strtotime("$i month"));
            $thisday = date('d');
            $thismonth = date('m');
            $thisyear = date('Y');
            $porsor = $year+543;
            $row = QueueController::searchQueue($month,$year);
            if($row['queue']==1){
                if($thismonth == $month && $thisyear == $year){
                    if($thisday > 15){
                        return $thisday.' '.$month_name[$month].' '.$porsor;
                    }
                }
                else {
                    return '15 '.$month_name[$month].' '.$porsor;
                }
            }
            if($row['queue']==0){
                if($thismonth == $month && $thisyear == $year){
                    if($thisday > 1){
                        return $thisday.' '.$month_name[$month].' '.$porsor;
                    }
                }
                else {
                    return '1 '.$month_name[$month].' '.$porsor;
                }
            }
        }
    }
}
