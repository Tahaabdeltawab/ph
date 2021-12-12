<?php

namespace App\Http\Controllers\Api;

use App\Models\Faculty;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateFacultiesRequest;
use App\Http\Resources\FacultyResource;

class FacultiesController extends APIBaseController
{
    public function __construct()
    {
        //$this->middleware('admin');
    }

    /**
     * Display a listing of Faculty.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $university_id = request()->university_id;
        $faculties = Faculty::when($university_id, function($q)use($university_id){return $q->where('university_id', $university_id);})->get();
        return $this->sendResponse(FacultyResource::collection($faculties));
    }

    /**
     * Show the form for creating new Faculty.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('faculties.create');
    }

    /**
     * Store a newly created Faculty in storage.
     *
     * @param  \App\Http\Requests\UpdateFacultiesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdateFacultiesRequest $request)
    {
        $faculty = Faculty::create($request->validated());

        return $this->sendResponse(new FacultyResource($faculty));
    }


    /**
     * Show the form for editing Faculty.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faculty = Faculty::findOrFail($id);

        return view('faculties.edit', compact('faculty'));
    }

    /**
     * Update Faculty in storage.
     *
     * @param  \App\Http\Requests\UpdateFacultiesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFacultiesRequest $request, $id)
    {
        $faculty = Faculty::findOrFail($id);
        $faculty->update($request->validated());
        $faculty = Faculty::find($faculty->id);
        return $this->sendResponse(new FacultyResource($faculty));
    }


    /**
     * Display Faculty.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faculty = Faculty::findOrFail($id);
        return $this->sendResponse(new FacultyResource($faculty));
    }


    /**
     * Remove Faculty from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faculty = Faculty::findOrFail($id);
        $faculty->delete();
        return $this->sendSuccess('success');
    }

    /**
     * Delete all selected Faculty at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = Faculty::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }

            return $this->sendSuccess('success');

        }
    }

}
