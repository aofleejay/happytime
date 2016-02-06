<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Stat;
use Carbon\Carbon;

class HappytimeController extends Controller
{
    public function index()
    {
        $ch = curl_init("https://hooks.slack.com/services/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");
        $fp = fopen("log.txt", "w");

        $postfields = 'payload={"channel":"#general","username":"happytime bot","text": "อย่าลืมใส่ happytime กันนะครับ"}';

        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);

        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
    }

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
