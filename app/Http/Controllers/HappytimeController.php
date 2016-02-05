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
        $found = Stat::where('user_id', $request->input('user_id'))
                    ->whereDate('created_at', '=', Carbon::today()->toDateString())
                    ->get();

        if ($found) {
            $message = 'วันนี้ส่งไปแล้วนะ';
        } else {
            Stat::create($request->all());
            $message = 'เรียบร้อยแจร้';
        }

        return view('store')
                ->with('text', $request->input('text'))
                ->with('user_name', $request->input('user_name'))
                ->with('message', $message);
    }
}
