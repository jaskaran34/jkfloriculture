<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Division;
class DivisionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    function  delete(Request $request)
    {

        $division_delete = Division::findOrFail($request['id']);
        $division_delete->delete();
        session()->flash('Message_deleted', 'Record Deleted');
        return redirect()->route('division_view');

    }
    function generateRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }

    public function view_records()
    {
        $divisions = Division::all();
        return view("division_master",compact('divisions'));

    }

    public function index(Request $request){


        $val=trim(strtoupper($request['name']));
        $check = Division::whereRaw('UPPER(name) = ?', [$val])->get();
        $count = $check->count();
        /*
        return $count;

        $check = Division::where('name', 'Kashmir')->get();
        $count = $check->count();
*/
        if($count<1) {


            $randomString = $this->generateRandomString(6);

            Division::create([
                'division_code' => $randomString,
                'name' => $val,
            ]);
            session()->flash('Message', 'Record Added');
        }
        else{
            session()->flash('Message', 'Record Already Exist');
        }
        return redirect()->route('division_view');
    }
}
