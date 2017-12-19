<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class AgencyActivities extends Model
{
    protected $table = 'agency_activities';
    
    protected $fillable = ['agency_id','activity_id','title','location','unit_type','capacity','difficult_level',
    'minimum_amount_percent','price_per_person','season','days','open_time','close_time','description','status',
    'is_deleted','is_block','latitude','longitude','created_at','update_at'];


    public function activityName()
    {
        return $this->hasOne('App\models\Activity', 'id', 'activity_id');
    }

    public function difficultyLevel()
    {
        return $this->hasOne('App\models\ActivityDifficultyLevel', 'id', 'difficult_level');
    }

    public function activityImages()
    {
        return $this->hasMany('App\models\ActivityUploads', 'agency_activity_id', 'id')->where('type','1');
    }

    public function activityVideos()
    {
        return $this->hasMany('App\models\ActivityUploads', 'agency_activity_id', 'id')->where('type','2');
    }

    public function activityTerms()
    {
        return $this->hasMany('App\models\ActivityUploads', 'agency_activity_id', 'id')->where('type','3');
    }

    public function activityNotes()
    {
        return $this->hasMany('App\models\ActivityUploads', 'agency_activity_id', 'id')->where('type','4');
    }
}
