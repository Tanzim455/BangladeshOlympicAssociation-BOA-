<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class AboutBoaMission extends Model
{
    //
     use AsSource;
     protected $fillable = [
        'title',
        'description',
       
    ];
}
