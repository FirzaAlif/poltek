<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\Departement;
use App\Http\Requests\StoreMajorRequest;
use App\Http\Requests\UpdateMajorRequest;


class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $majors = Major::all();
        $departements = Departement::all();
        return view('majors.index', compact('majors','departements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMajorRequest $request)
    {
        Major::create([
            'name' => $request->name,
            'departement_id' => $request->departement_id,
        ]);
       

        return redirect()->route('majors.index')->with('success','Major created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
{
   
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Major $major)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMajorRequest $request, Major $major)
    {
        $major->update([
            'name' => $request->name,
            'departement_id' => $request->departement_id,
        ]);

        return redirect()->route('majors.index')->with('success','Major created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Major $major)
    {
        try {
            $major->delete();

        return redirect()->route('majors.index')->with('success','Major created successfully.');
        } catch (\Exception $e){
            return redirect()->route('majors.index')->with('error', 'Failed to delete major:' . $e->getMessage());
        }
    }
}
