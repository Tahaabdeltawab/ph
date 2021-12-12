<?php

namespace App\Http\Controllers\Api;

use App\Models\Term;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateTermsRequest;
use App\Http\Resources\TermResource;

class TermsController extends APIBaseController
{
    public function __construct()
    {
        //$this->middleware('admin');
    }

    /**
     * Display a listing of Term.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $terms = Term::all();
        return $this->sendResponse(TermResource::collection($terms));
    }

    /**
     * Show the form for creating new Term.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('terms.create');
    }

    /**
     * Store a newly created Term in storage.
     *
     * @param  \App\Http\Requests\UpdateTermsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdateTermsRequest $request)
    {
        $term = Term::create($request->validated());

        return $this->sendResponse(new TermResource($term));
    }


    /**
     * Show the form for editing Term.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $term = Term::findOrFail($id);

        return view('terms.edit', compact('term'));
    }

    /**
     * Update Term in storage.
     *
     * @param  \App\Http\Requests\UpdateTermsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTermsRequest $request, $id)
    {
        $term = Term::findOrFail($id);
        $term->update($request->validated());
        $term = Term::find($term->id);
        return $this->sendResponse(new TermResource($term));
    }


    /**
     * Display Term.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $term = Term::findOrFail($id);
        return $this->sendResponse(new TermResource($term));
    }


    /**
     * Remove Term from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $term = Term::findOrFail($id);
        $term->delete();
        return $this->sendSuccess('success');
    }

    /**
     * Delete all selected Term at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = Term::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }

            return $this->sendSuccess('success');

        }
    }

}
