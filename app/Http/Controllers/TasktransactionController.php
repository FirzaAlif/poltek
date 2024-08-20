<?php

namespace App\Http\Controllers;

use App\Models\Tasktransaction;
use App\Http\Requests\StoreTasktransactionRequest;
use App\Http\Requests\UpdateTasktransactionRequest;

class TasktransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasktransactions = Tasktransaction::all();
        return view('tasktransactions.index', compact('tasktransactions'));
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
    public function store(StoreTasktransactionRequest $request)
    {
        Tasktransaction::create($request->all());
        return redirect()->route('tasktransactions.index')->with('succes', 'Tasktransaction created succesfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tasktransaction $tasktransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tasktransaction $tasktransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTasktransactionRequest $request, Tasktransaction $tasktransaction)
    {
        Tasktransaction::create($request->all());
        return redirect()->route('tasktransactions.index')->with('success','Tasktransaction created succesfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tasktransaction $tasktransaction)
    {
        try {
            $tasktransaction->delete();
            return redirect()->route('tasktransactions.index')->with('success', 'Tasktransaction deleted succesfully.');
        } catch (\Exception $e) {
            return redirect()->route('tasktransaction.index')->with('error','Failed to deleted Tasktransaction. it may still have related employes.');
        }
    }
}
