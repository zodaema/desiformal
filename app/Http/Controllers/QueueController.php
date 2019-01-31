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

            $today = array(
              'day' => date('d'),
              'month' => date('m'),
              'year' => date('Y')
            );

            $fastest_day = array(
              'day' => date('d',strtotime("$i month")),
              'month' => date('m',strtotime("$i month")),
              'year' => date('Y',strtotime("$i month")),
              'porsor' => (date('Y',strtotime("$i month")) + 543)
            );

            $row = QueueController::searchQueue($fastest_day['month'],$fastest_day['year']);
            if($row['queue']==1){
              // ถ้าติด 1 คิวเดือนนี้
                if($today['month'] == $row['month'] && $today['year'] == $fastest_day['year']){
                  // ให้เช็คคิวว่าวันนี้เลยกำหนดส่งงานแล้วยัง
                    if($today['day'] > 15){
                        return $today['day'].' '.$month_name[$fastest_day['month']].' '.$fastest_day['porsor'];
                    }
                }
                // ถ้าวันนี้ยังไม่เลยกำหนดส่งงานคิวแรก
                else {
                    return '15 '.$month_name[$fastest_day['month']].' '.$fastest_day['year'];
                }
            }
            if($row['queue']==0){
                if($today['month'] == $fastest_day['month'] && $today['year'] == $fastest_day['year']){
                    if($today['day'] > 1){
                        return $today['day'].' '.$month_name[$fastest_day['month']].' '.$fastest_day['porsor'];
                    }
                }
                else {
                    return '1 '.$month_name[$fastest_day['month']].' '.$fastest_day['porsor'];
                }
            }
        }
    }
}
