<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Commander\Events\EventGenerator;

class Todo extends Model
{
    use EventGenerator;

    public static $rules = [
        'name' => 'required|min:3'
    ];

    protected $fillable = ["name"];
}