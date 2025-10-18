<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;

class AffiliatedOrganizationInfo extends Model
{
    //
    use Attachable;
    protected $fillable = [
    'logo',
    'president_name',
    'president_image',
    'gs_name',
    'gs_image',
    'description',
    'address',
    'phone',
    'email',
    'website',
    'facebook_link',
    'instagram_link',
    'youtube_link',
    
    'affiliated_organization_category_id', // Foreign key
];
}
