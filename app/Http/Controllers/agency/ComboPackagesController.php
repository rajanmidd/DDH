<?php

namespace App\Http\Controllers\agency;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\ComboPackages;

class ComboPackagesController extends Controller
{
    public function index(Request $request)
    {
        $combo_packages = ComboPackages::where("is_deleted",'1');
    
        // if ($request->search_text <> '')
        // {
        //   $activity_list->WhereRaw('(name LIKE "%' . $request->search_text. '%")');
        // }
        $combo_packages = $combo_packages->orderBy('id', 'desc')->paginate(10);
        return view('agency.comboPackages.index', ['combo_packages' => $combo_packages]);
    }

    public function addComboPackages()
    {
        return view('agency.comboPackages.addComboPackages');
    }
}
