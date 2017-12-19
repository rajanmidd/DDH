<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class AgencyDocuments extends Model {

  protected $table = 'agency_documents';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [ 'agency_id', 'certificate_image', 'id_proof', 'is_certificate_image_verified', 'is_id_proof_verified', 'certificate_image_verified_on', 'id_proof_verified_on'];

}
