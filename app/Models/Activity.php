<?php

namespace App\Models;
use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;



class Activity extends Model
{
    //
    use Attachable,AsSource;
    protected $fillable = [
        'title',
        'description',
        'slug',
         'photo',
         'status',
         'publishable'
    ];
}
