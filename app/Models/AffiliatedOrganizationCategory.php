<?php

namespace App\Models;
use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Model;

class AffiliatedOrganizationCategory extends Model
{
    //
    use AsSource;
    protected $table='affiliated_categories';
     protected $fillable = [
        'name',
        'description',
       
    ];
}
