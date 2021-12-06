<?php

namespace App\Http\Controllers\API;

use App\Models\Year;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateYearsRequest;
use App\Http\Resources\YearResource;

class YearsController extends APIBaseController
{
    public function __construct()
    {
        //$this->middleware('admin');
    }

    /**
     * Display a listing of Year.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculty_id = request()->faculty_id;
        $years = Year::when($faculty_id, function($q)use($faculty_id){return $q->where('faculty_id', $faculty_id);})->get();
        return $this->sendResponse(YearResource::collection($years));
    }

    /**
     * Show the form for creating new Year.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('years.create');
    }

    /**
     * Store a newly created Year in storage.
     *
     * @param  \App\Http\Requests\UpdateYearsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdateYearsRequest $request)
    {
        $year = Year::create($request->validated());

        return $this->sendResponse(new YearResource($year));
    }


    /**
     * Show the form for editing Year.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $year = Year::findOrFail($id);

        return view('years.edit', compact('year'));
    }

    /**
     * Update Year in storage.
     *
     * @param  \App\Http\Requests\UpdateYearsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateYearsRequest $request, $id)
    {
        $year = Year::findOrFail($id);
        $year->update($request->validated());
        $year = Year::find($year->id);
        return $this->sendResponse(new YearResource($year));
    }


    /**
     * Display Year.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $year = Year::findOrFail($id);
        return $this->sendResponse(new YearResource($year));
    }


    /**
     * Remove Year from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $year = Year::findOrFail($id);
        $year->delete();
        return $this->sendSuccess('success');
    }

    /**
     * Delete all selected Year at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = Year::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }

            return $this->sendSuccess('success');

        }
    }

}
