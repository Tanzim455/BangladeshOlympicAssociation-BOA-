<?php

namespace App\Models;
use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;

class Statute extends Model
{
    //
    use AsSource,Attachable;
        protected $fillable = [
        'title',
        'is_active'
        
       
    ];
}
