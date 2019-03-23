<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApacheLog extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'apache_log';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date_time' => 'datetime',
    ];

    /**
     * Group by IP for period
     *
     * @param string $startDate
     * @param string $endDate
     * @return array
     */
    public static function groupByIp($startDate, $endDate)
    {
        $result = [];

        foreach (self::period($startDate, $endDate)->get() as $line) {
            $result[$line->ip][] = $line;
        }

        return $result;
    }

    /**
     * Group dates for period
     *
     * @param string $startDate
     * @param string $endDate
     * @return array
     */
    public static function groupByDate($startDate, $endDate)
    {
        $result = [];
        foreach (self::period($startDate, $endDate)->get() as $line) {
            $result[$line->date_time->format('Y.m.d')][] = $line;
        }

        return $result;
    }

    /**
     * Period scope
     *
     * @param $query
     * @param string $startDate
     * @param string $endDate
     * @return mixed
     */
    public function scopePeriod($query, $startDate, $endDate)
    {
        $startDate = \DateTime::createFromFormat('Y-m-d', $startDate);
        $startDate->setTime(0,0,0);

        $endDate = \DateTime::createFromFormat('Y-m-d', $endDate);
        $endDate->setTime(23, 59, 59);

        return $query->where('date_time', '>=', $startDate)
            ->where('date_time', '<=', $endDate)
            ->orderBy('date_time', 'desc');
    }
}
