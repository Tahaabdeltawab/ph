<?php

namespace App\Http\Controllers\Api;

use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUniversitiesRequest;
use App\Http\Resources\UniversityResource;
use App\Http\Resources\UniversityWithFacultiesResource;

class UniversitiesController extends APIBaseController
{
    public function __construct()
    {
        $this->middleware('permission:create-universities')->only(['store']);
        $this->middleware('permission:update-universities')->only(['update']);
        $this->middleware('permission:delete-universities')->only(['destroy']);
        $this->middleware('permission:show-universities')->only(['show', 'index']);
    }

    /**
     * Display a listing of University.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $universities = University::all();
        return $this->sendResponse(UniversityResource::collection($universities));
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
     * @param  \App\Http\Requests\UpdateUniversitiesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdateUniversitiesRequest $request)
    {
        $university = University::create($request->validated());

        return $this->sendResponse(new UniversityResource($university));
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
    public function update(UpdateUniversitiesRequest $request, $id)
    {
        $university = University::findOrFail($id);
        $university->update($request->validated());
        $university = University::find($university->id);
        return $this->sendResponse(new UniversityResource($university));
    }


    /**
     * Display University.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $university = University::findOrFail($id);
        return $this->sendResponse(new UniversityWithFacultiesResource($university));
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
