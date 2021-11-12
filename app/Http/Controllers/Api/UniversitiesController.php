<?php

namespace App\Http\Controllers\API;

use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUniversitysRequest;
use App\Http\Requests\UpdateUniversitysRequest;

class UniversitysController extends APIBaseController
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of University.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $universities = University::all();
        return $this->sendResponse($universities);
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
     * @param  \App\Http\Requests\StoreUniversitysRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUniversitysRequest $request)
    {
        University::create($request->all());

        return redirect()->route('universities.index');
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
     * @param  \App\Http\Requests\UpdateUniversitysRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUniversitysRequest $request, $id)
    {
        $university = University::findOrFail($id);
        $university->update($request->all());

        return redirect()->route('universities.index');
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

        return view('universities.show', compact('university'));
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

        return redirect()->route('universities.index');
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
        }
    }

}
