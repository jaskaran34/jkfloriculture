<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Http\Request;
use App\Models\garden;
use App\Models\Division;

class GardenController extends Controller
{
    function generateRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index(Request $request)
    {
        try {
            $division = Division::where('division_code', $request->input('division_code'))->firstOrFail();

        } catch (ModelNotFoundException $exception) {
            //print_r($exception);exit;
            return redirect()->back()->with('error', 'Division not found.');
        }



        $validatedata=$request->validate([
            'name' => 'required|string|max:255|unique:gardens',
            'price_adult' => 'required|numeric|min:0',
            'price_child' => 'required|numeric|min:0',
            'file' => 'required|file|max:500', // max:10240 means maximum file size is 10MB
        ]);

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $file->move(public_path('uploads'), $fileName);
        $randomString = $this->generateRandomString(6);
        garden::create([
            'division_code' => $request['division_code'],
            'garden_code' => $randomString,
            'name' => $validatedata['name'],
            'price_adult' => $validatedata['price_adult'],
            'price_child' => $validatedata['price_child'],
            'image_path' => $fileName,
        ]);
        session()->flash('Message', 'Record Added');





        return redirect()->route('garden_view');
        /*
        // snippet to display file
        $filePath = 'uploads/a.pdf'; // Adjust the path to your PDF file

        // Check if the file exists
        if (Storage::exists($filePath)) {
            // Get the file contents
            $fileContents = Storage::get($filePath);

            // Set the appropriate HTTP headers
            $headers = [
                'Content-Type' => 'application/pdf',
            ];

            // Return the file contents as a response with the appropriate headers
            return new Response($fileContents, 200, $headers);
        } else {
            // File not found
            abort(404);
        }
*/
        /*

       // snippet to upload file in storage directory
        $request->validate([
            'file' => 'required|file|max:10240', // max:10240 means maximum file size is 10MB
        ]);

        $file = $request->file('file');
        $path = $file->store('uploads');

        return "File uploaded successfully. Path: $path";
        //return redirect()->route('garden_view');

         $request->validate([
            'file' => 'required|file|max:10240', // max:10240 means maximum file size is 10MB
        ]);

        */
        /*
        // snippet to store file in public directory

        $request->validate([
            'file' => 'required|file|max:10240', // max:10240 means maximum file size is 10MB
        ]);

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $file->move(public_path('uploads'), $fileName);

        return "File uploaded successfully. Path: $fileName";
        */
    }
    function update_request(Request $request)
    {
        $garden = garden::findOrFail($request['id']);

        $divisions = Division::all();
        return view("garden_edit",compact('garden','divisions'));
    }
    function garden_update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:gardens,name,' . $id,
            // Define other validation rules as needed
        ]);

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $file->move(public_path('uploads'), $fileName);

        garden::where('id', $request['id'])
            ->update([
                'name' =>  $request->input('name'),
                'image_path' => $fileName,
                'division_code' => $request->input('division_code'),
                'price_adult' => $request->input('price_adult'),
                'price_child' => $request->input('price_child')
            ]);

        $garden = garden::findOrFail($request['id']);

        $divisions = Division::all();
        return view("garden_edit",compact('garden','divisions'));
/*
        $garden = garden::findOrFail($request['id']);

        return $garden;

        //$divisions = Division::all();
       // return view("garden_edit",compact('garden','divisions'));
*/
}
    function  delete(Request $request)
    {

        $garden_delete = garden::findOrFail($request['id']);
        $garden_delete->delete();
        session()->flash('Message_deleted', 'Record Deleted');
        return redirect()->route('garden_view');

    }
    function garden_view(){

        $gardens = garden::with('division')->get();
        $divisions = Division::all();
        return view("garden_master",compact('gardens','divisions'));


        /*
        $gardens = garden::select('gardens.*', 'division.name as division_name')
            ->join('division', 'gardens.division_code', '=', 'division.division_code')
            ->get();
        return $gardens;
        */
        /*

        $gardens = garden::all();
        $divisions = Division::all();
        return view("garden_master",compact('gardens','divisions'));
*/
    }
}
