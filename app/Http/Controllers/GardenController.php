<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\garden;
use App\Models\Division;
class GardenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index(Request $request)
    {

echo 'dd';
        //return redirect()->route('garden_view');
    }
    function garden_view(){

        $gardens = garden::all();
        $divisions = Division::all();
        return view("garden_master",compact('gardens','divisions'));
    }
}
