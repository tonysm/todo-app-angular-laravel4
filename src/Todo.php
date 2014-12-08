<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    public static $rules = [
        'name' => 'required|min:3'
    ];

    protected $fillable = ["name"];
}