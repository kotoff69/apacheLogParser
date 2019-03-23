<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogFileQueue extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'apache_logs_queue';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'file',
    ];

    /**
     * Get file
     * @return string
     */
    public static function pop()
    {
        return self::orderBy('id')->firstOrFail();
    }

    /**
     * Mark as done
     *
     * @return void
     */
    public function setDone()
    {
        $this->done = true;
        $this->save();
    }
}
