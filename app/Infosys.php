<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Infosys extends Model
{
    protected $table = 'infosys';
    protected $connection = 'mysql';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'abrv', 'description', 'local_url', 
        'public_url', 'icon', 'type',
    ];
}
