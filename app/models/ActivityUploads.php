<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ActivityUploads extends Model
{
    protected $table = 'activity_uploads';
    
    protected $fillable = ['agency_activity_id', 'file_url','type','created_at','updated_at'];
}
