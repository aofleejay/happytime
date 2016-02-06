<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $table    = 'stat';
    protected $fillable = ['user_id', 'user_name', 'text'];

    public function scopeListSenderToday($query)
    {
        return $query->whereDate('updated_at', '=', Carbon::today()->toDateString());
    }

    public static function isTodaySend($user_id)
    {
        $found = Stat::where('user_id', $user_id)
                     ->whereDate('updated_at', '=', Carbon::today()->toDateString())
                     ->first();

        return isset($found);
    }

    public static function dateFormat($date)
    {
        if (empty($date)) {
            $date = Carbon::now()->toDateString();
        } else {
            $date = Carbon::createFromFormat('Y-m-d', $date)->toDateString();
        }

        return $date;
    }
}
