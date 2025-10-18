<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffiliatedOrganizationInfo extends Model
{
    //
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
    'instagram_link', // Fixed: only once!
    'affiliated_organization_category_id', // Foreign key
];
}
