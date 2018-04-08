<?php

namespace App\models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Agency extends Authenticatable {

  use Notifiable;

  protected $table = 'agency';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'owner_name', 'email', 'password', 'mobile','address','agency_image','company', 'terms_condition','geom','temp_access_token', 'team_size', 'is_document_verified', 'is_email_verified', 'status','is_block','is_deleted','created_at','updated_at', 'rejection_message'];

  public function confirmEmail() {
    $this->is_email_verified = '1';
    $this->temp_access_token = 0;
    $this->save();
  }
  
  public function agencyDocuments()
  {
     return $this->hasOne('App\models\AgencyDocuments', 'agency_id', 'id');
  }

}
