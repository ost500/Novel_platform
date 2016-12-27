<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ViewCount extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'novel_id', 'date', 'count', 'separation',
    ];


    /*  public function novel()
      {
          return $this->belongsTo(Novel::class, 'id');
      }*/
    public function viewCountToday($novel_id)
    {
        $today = Carbon::now()->toDateString();
        return $this->where(['separation' => '1', 'date' => $today, 'novel_id' => $novel_id])->first();
    }

    public function viewCountWeek($novel_id)
    {
       $start_of_week = Carbon::now()->startOfWeek()->toDateString();
        return $this->where(['separation' => '2', 'date' => $start_of_week, 'novel_id' => $novel_id])->first();
    }

    public function viewCountMonth($novel_id)
    {
        $start_of_month = Carbon::now()->startOfMonth()->toDateString();
        return $this->where(['separation' => '3', 'date' => $start_of_month, 'novel_id' => $novel_id])->first();
    }

}
