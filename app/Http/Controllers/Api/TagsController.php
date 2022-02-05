<?php

namespace App\Http\Controllers\Api;

use \Spatie\Tags\Tag;
use App\Http\Requests\UpdateTagsRequest;
use App\Http\Resources\TagResource;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagsController extends APIBaseController
{
    public function __construct()
    {
        //$this->middleware('admin');
    }

    /**
     * Display a listing of Tag.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        return $this->sendResponse(TagResource::collection($tags));
    }


    public function store(UpdateTagsRequest $request)
    {
        try {
            DB::beginTransaction();
            $tag = Tag::create(['name' => $request->title]);
            if($request->chapter_id){
               $chapter = Chapter::find($request->chapter_id);
               $chapter->attachTag($tag);
            }
            DB::commit();
            return $this->sendResponse(new TagResource($tag));
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError($th->getMessage());
        }
    }


    public function update(UpdateTagsRequest $request, $id)
    {
        $tag = Tag::findOrFail($id);
        $tag->update(['name' => $request->title]);
        $tag = Tag::find($tag->id);
        return $this->sendResponse(new TagResource($tag));
    }


    /**
     * Display Tag.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::findOrFail($id);
        return $this->sendResponse(new TagResource($tag));
    }


    /**
     * Remove Tag from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
        return $this->sendSuccess('success');
    }

    /**
     * Delete all selected Tag at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = Tag::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }

            return $this->sendSuccess('success');

        }
    }

}
