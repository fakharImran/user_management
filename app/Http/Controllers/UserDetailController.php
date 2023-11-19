<?php

namespace App\Http\Controllers;

use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:file-list|file-create|file-edit|file-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:file-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:file-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:file-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        if(Auth::user()->hasRole('Admin')){
            $userDetails = UserDetail::latest()->paginate(5);
        }
        else{
            $user = Auth::user();
            $userDetails = $user->userDetails()->latest()->paginate(5);
        }
        
        return view('userDetails.index', compact('userDetails'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('userDetails.create');

        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());
        request()->validate([
            'name' => 'required',
            'dob' => 'required',
            'passport_photo' => 'required',
            'recommended_source' => 'required',
            'recommended_source_address' => 'required',
        ]);

        // Convert the "illness" array to a JSON string
        $illnessJson = json_encode($request->input('illness'));

        // Set the JSON string in the request data
        $request->merge(['illness' => $illnessJson]);
        $request->merge(['user_id' => Auth::user()->id]);

        if($request->hasFile('passport_photo'))
        {
            $url = $request->file('passport_photo')->store('passport_photo', 'public');
        }
        else
        {
            $url=null;
        }

        $request->passport_photo=$url;

        $userDetail = UserDetail::create($request->all());
        $userDetail->passport_photo=$url;
        $userDetail->save();
        return redirect()->route('userDetails.index')
            ->with('success', 'File created successfully.');
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $userDetail= UserDetail::select('*')->where('id', $id)->first();
        return view('userDetails.edit', compact('id','userDetail'));

        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        request()->validate([
             'name' => 'required',
            'dob' => 'required',
            'passport_photo' => 'required',
            'recommended_source' => 'required',
            'recommended_source_address' => 'required',
        ]);

        // Convert the "illness" array to a JSON string
        $illnessJson = json_encode($request->input('illness'));

        // Set the JSON string in the request data
        $request->merge(['illness' => $illnessJson]);
        $request->merge(['user_id' => Auth::user()->id]);

        if($request->hasFile('passport_photo'))
        {
            $url = $request->file('passport_photo')->store('passport_photo', 'public');
        }
        else
        {
            $url=null;
        }

        $request->passport_photo=$url;



        // Create the UserDetail model with the updated request data
        $userDetail = UserDetail::find($id);
        
        if (!$userDetail) {
            return response()->json(['message' => 'UserDetail not found'], 404);
        }
        
        $userDetail->update($request->all());
        $userDetail->passport_photo= $url;
        $userDetail->save();
        return redirect()->route('userDetails.index')
            ->with('success', 'File Updated successfully.');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            // Find the item with the given ID and delete it
            $item = UserDetail::find($id);
            if ($item) {
                $item->delete();
                return redirect()->route('userDetails.index');
            } else {
                return redirect()->back()->withErrors(['error' => 'Item not found']);
                // return response()->json(['error' => 'Item not found']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong while deleting the item']);
        }

    }
}
