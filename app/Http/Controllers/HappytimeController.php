<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\HappytimeRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Stat;
use App\Sprint;
use Carbon\Carbon;

class HappytimeController extends Controller
{
    public function index(Request $request)
    {
        $startdate = Stat::dateFormat($request->input('startdate'));
        $enddate = Stat::dateFormat($request->input('enddate'));

        // if (!empty($request->input('sprint'))) {
        //     $sprint = Sprint::where('sprint', $request->input('sprint'))->first();
        //     if (count($sprint)) {
        //         $startdate = $sprint->start;
        //         $enddate = $sprint->end;
        //     }
        // }

        $stat = Stat::orderBy('updated_at')
                    ->whereDate('updated_at', '>=', $startdate)
                    ->whereDate('updated_at', '<=', $enddate)
                    ->get();

        return view('report')->with('stat', $stat)
                             ->with('startdate', $startdate)
                             ->with('enddate', $enddate)
                             ->with('sprint', $request->input('sprint'));
    }

    public function store(Request $request)
    {
        $text = $request->input('text');

        $messages = [
            'in'       => "ค่า Happy มีค่าระหว่าง 1 - 3 นะครับ",
            'required' => "อย่าลืมส่งค่า Happy มาด้วยนะครับ เช่น /Happytime 3",
        ];

        $validator = \Validator::make(
            ['text' => $text],
            ['text' => 'required|in:1,2,3,list'],
            $messages
        );

        if (!$validator->fails()) {
            if ($text == 'list') {
                $response = Stat::ListSenderToday()->lists('user_name');
            } else {
                if (Stat::isTodaySend($request->input('user_id'))) {
                    $response = "วันนี้คุณส่ง happytime ไปแล้วนะครับ";
                } else {
                    Stat::create($request->all());
                    $response = 'บันทึกเรียบร้อยครับ';
                }
            }
        } else {
            $response = $validator->errors()->all();
        }

        return $response;
    }
}
