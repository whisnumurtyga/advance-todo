<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;


class Todo extends Model
{

    protected $collection = 'todo';
    protected $primaryKey ='id';
    protected $connection = 'mongodb';

    protected $fillable = [
        'id',
        'title',
        'date',
        'note'
    ];
}
