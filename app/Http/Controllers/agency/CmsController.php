<?php

namespace App\Http\Controllers\merchant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Cms;
use App\Helpers\CustomHelper;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class CmsController extends Controller
{
   public function index($slug)
   {
      error_reporting(E_ALL);
      ini_set('display_errors',1);
      $pageDetail=Cms::where('slug',$slug)->where('type','2')->first();
      return view('merchant.cms.index',['slug'=>$slug,'pageDetail'=>$pageDetail]);
   }
}
