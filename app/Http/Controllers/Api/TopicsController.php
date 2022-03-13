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
        // $this->middleware('permission:create-topics')->only(['store']);
        // $this->middleware('permission:update-topics')->only(['update']);
        // $this->middleware('permission:delete-topics')->only(['destroy']);
        // $this->middleware('permission:show-topics')->only(['show', 'index']);
        
        // commented because generic users can handle their own topics,chapters,definitions
    }

    /**
     * Display a listing of Topic.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // when year_id has a value => visibility is 1
        $topics =  Topic::when(request()->year_id && request()->visibility == 1, fn($q) => $q->where('year_id', request()->year_id))
                        ->when(request()->visibility == 0 && !request()->year_id , fn($q) => $q->where('user_id', auth()->id())->where('visibility', 0))
                        ->when(request()->visibility == 1, fn($q) => $q->where('visibility', 1))
                        ->get();

        // for practice page request
        $privateTopics = collect([]);
        if(request()->year_id && request()->visibility == 0)
        $privateTopics = Topic::where('user_id', auth()->id())->where('visibility', 0)->get();
        $all = $privateTopics->merge($topics);
        return $this->sendResponse(TopicResource::collection($all));
    }

    public function store(UpdateTopicsRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $topic = Topic::create($data);

        return $this->sendResponse(new TopicResource($topic));
    }

    public function update(UpdateTopicsRequest $request, $id)
    {
        $topic = Topic::findOrFail($id);
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $topic->update($data);
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
