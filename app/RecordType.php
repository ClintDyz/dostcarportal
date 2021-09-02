<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecordType extends Model
{
    protected $table = 'record_types';
    protected $connection = 'mysql';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type'
    ];

    public $timestamps = false;
}
