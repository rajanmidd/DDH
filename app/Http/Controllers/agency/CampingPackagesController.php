<?php

namespace App\Http\Controllers\agency;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\CampingPackages;

class CampingPackagesController extends Controller
{
    public function index(Request $request)
    {
        $camping_packages = CampingPackages::where("is_deleted",'1');
    
        // if ($request->search_text <> '')
        // {
        //   $activity_list->WhereRaw('(name LIKE "%' . $request->search_text. '%")');
        // }
        $camping_packages = $camping_packages->orderBy('id', 'desc')->paginate(10);
        return view('agency.campingPackages.index', ['camping_packages' => $camping_packages]);
    }

    public function addCampingPackages()
    {
        return view('agency.campingPackages.addCampingPackages');
    }
}
