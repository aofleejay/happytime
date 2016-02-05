<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Stat;
use Carbon\Carbon;

class HappytimeController extends Controller
{
    public function store(Request $request)
    {
        $text = $request->input('text');

        if ($text == 'list') {
            $message = Stat::whereDate('created_at', '=', Carbon::today()->toDateString())
                            ->lists('user_name');
        } else {
            if (empty($text)) {
                $message = 'ใส่ 1 = sad, 2 = normal, 3 = happy ด้วยนะ';
            } else if (!preg_match("/^[1-3]$/", $text)) {
                $message = 'อย่าใส่มั่วซิจ๊ะ เดี๋ยวตบคว่ำเลย';
            } else {
                $found = Stat::where('user_id', $request->input('user_id'))
                            ->whereDate('created_at', '=', Carbon::today()->toDateString())
                            ->first();

                if (isset($found)) {
                    $message = 'วันนี้ส่งไปแล้วนะ';
                } else {
                    Stat::create($request->all());
                    $message = 'เรียบร้อยแจร้';
                }
            }
        }
        return $message;
    }
}
