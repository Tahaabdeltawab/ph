<?php

namespace App\Http\Controllers\API;

use App\Models\Chapter;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Requests\StoreChaptersRequest;
use App\Http\Requests\UpdateChaptersRequest;

class ChaptersController extends APIBaseController
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of Topic.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chapters = Chapter::all();

        return view('chapters.index', compact('chapters'));
    }

    /**
     * Show the form for creating new chapter.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $relations = [
            'topics' => Topic::get()->pluck('title', 'id')->prepend('Please select', ''),
        ];
        return view('chapters.create', $relations);
    }

    /**
     * Store a newly created chapter in storage.
     *
     * @param  \App\Http\Requests\StoreChaptersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChaptersRequest $request)
    {
        Chapter::create($request->all());

        return redirect()->route('chapters.index');
    }


    /**
     * Show the form for editing chapter.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chapter = Chapter::findOrFail($id);
        $relations = [
            'topics' => Topic::get()->pluck('title', 'id')->prepend('Please select', ''),
        ];
        return view('chapters.edit', compact('chapter') + $relations);
    }

    /**
     * Update chapter in storage.
     *
     * @param  \App\Http\Requests\UpdateChaptersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChaptersRequest $request, $id)
    {
        $chapter = Chapter::findOrFail($id);
        $chapter->update($request->all());

        return redirect()->route('chapters.index');
    }


    /**
     * Display chapter.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $chapter = Chapter::findOrFail($id);

        return view('chapters.show', compact('chapter'));
    }


    /**
     * Remove chapter from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $chapter = Chapter::findOrFail($id);
        $chapter->delete();

        return redirect()->route('chapters.index');
    }

    /**
     * Delete all selected chapter at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = Chapter::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
