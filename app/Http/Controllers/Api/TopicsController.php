<?php

namespace App\Http\Controllers\Api;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateTopicsRequest;
use App\Http\Resources\TopicResource;
use App\Http\Resources\TopicWithChaptersResource;

class TopicsController extends APIBaseController
{
    public function __construct()
    {
        $this->middleware('permission:create-topics')->only(['store']);
        $this->middleware('permission:update-topics')->only(['update']);
        $this->middleware('permission:delete-topics')->only(['destroy']);
        $this->middleware('permission:show-topics')->only(['show', 'index']);
    }

    /**
     * Display a listing of Topic.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $year_id = request()->year_id;
        $topics = Topic::when($year_id, function($q)use($year_id){return $q->where('year_id', $year_id);})->get();
        return $this->sendResponse(TopicResource::collection($topics));
    }

    /**
     * Show the form for creating new Topic.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('topics.create');
    }

    /**
     * Store a newly created Topic in storage.
     *
     * @param  \App\Http\Requests\UpdateTopicsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdateTopicsRequest $request)
    {
        $topic = Topic::create($request->validated());

        return $this->sendResponse(new TopicResource($topic));
    }


    /**
     * Show the form for editing Topic.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $topic = Topic::findOrFail($id);

        return view('topics.edit', compact('topic'));
    }

    /**
     * Update Topic in storage.
     *
     * @param  \App\Http\Requests\UpdateTopicsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTopicsRequest $request, $id)
    {
        $topic = Topic::findOrFail($id);
        $topic->update($request->validated());
        $topic = Topic::find($topic->id);
        return $this->sendResponse(new TopicResource($topic));
    }


    /**
     * Display Topic.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topic = Topic::findOrFail($id);
        return $this->sendResponse(new TopicWithChaptersResource($topic));
    }


    /**
     * Remove Topic from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topic = Topic::findOrFail($id);
        $topic->delete();
        return $this->sendSuccess('success');
    }

    /**
     * Delete all selected Topic at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = Topic::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }

            return $this->sendSuccess('success');

        }
    }

}
