<?php

namespace App\Http\Controllers\API;

use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUniversitiesRequest;

class UniversitiesController extends APIBaseController
{
    public function __construct()
    {
        //$this->middleware('admin');
    }

    /**
     * Display a listing of University.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $us = University::all();
        return $this->sendResponse($us);
    }

    /**
     * Show the form for creating new University.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('universities.create');
    }

    /**
     * Store a newly created University in storage.
     *
     * @param  \App\Http\Requests\StoreUniversitiesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUniversitiesRequest $request)
    {
        $u = University::create($request->all());

        return $this->sendResponse($u);
    }


    /**
     * Show the form for editing University.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $university = University::findOrFail($id);

        return view('universities.edit', compact('university'));
    }

    /**
     * Update University in storage.
     *
     * @param  \App\Http\Requests\UpdateUniversitiesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUniversitiesRequest $request, $id)
    {
        $university = University::findOrFail($id);
        $university->update($request->all());
        $u = University::find($university->id);
        return $this->sendResponse($u);
    }


    /**
     * Display University.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $u = University::findOrFail($id);
        return $this->sendResponse($u);
    }


    /**
     * Remove University from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $university = University::findOrFail($id);
        $university->delete();
        return $this->sendSuccess('success');
    }

    /**
     * Delete all selected University at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = University::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }

            return $this->sendSuccess('success');

        }
    }

}
