<?php

namespace App\Http\Controllers\Api;

use App\Models\Chapter;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateChaptersRequest;
use App\Http\Resources\ChapterResource;

class ChaptersController extends APIBaseController
{
    public function __construct()
    {
        //$this->middleware('admin');
    }

    /**
     * Display a listing of Chapter.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topic_id = request()->topic_id;
        $chapters = Chapter::when($topic_id, function($q)use($topic_id){return $q->where('topic_id', $topic_id);})->get();
        return $this->sendResponse(ChapterResource::collection($chapters));
    }

    /**
     * Show the form for creating new Chapter.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('chapters.create');
    }

    /**
     * Store a newly created Chapter in storage.
     *
     * @param  \App\Http\Requests\UpdateChaptersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdateChaptersRequest $request)
    {
        $chapter = Chapter::create($request->validated());

        return $this->sendResponse(new ChapterResource($chapter));
    }


    /**
     * Show the form for editing Chapter.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chapter = Chapter::findOrFail($id);

        return view('chapters.edit', compact('chapter'));
    }

    /**
     * Update Chapter in storage.
     *
     * @param  \App\Http\Requests\UpdateChaptersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChaptersRequest $request, $id)
    {
        $chapter = Chapter::findOrFail($id);
        $chapter->update($request->validated());
        $chapter = Chapter::find($chapter->id);
        return $this->sendResponse(new ChapterResource($chapter));
    }


    /**
     * Display Chapter.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $chapter = Chapter::findOrFail($id);
        return $this->sendResponse(new ChapterResource($chapter));
    }


    /**
     * Remove Chapter from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $chapter = Chapter::findOrFail($id);
        $chapter->delete();
        return $this->sendSuccess('success');
    }

    /**
     * Delete all selected Chapter at once.
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

            return $this->sendSuccess('success');

        }
    }

}
