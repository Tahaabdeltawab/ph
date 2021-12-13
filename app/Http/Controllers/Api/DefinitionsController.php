<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreMcqResultsRequest;
use App\Http\Requests\ToggleFavDefinitionRequest;
use App\Http\Requests\UpdateDefinitionLevelRequest;
use App\Models\Definition;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateDefinitionsRequest;
use App\Http\Resources\DefinitionResource;
use App\Http\Resources\McqResultResource;
use App\Models\DefinitionLevel;
use App\Models\McqResult;
use Illuminate\Support\Facades\DB;

class DefinitionsController extends APIBaseController
{
    public function __construct()
    {
        //$this->middleware('admin');
    }

    /**
     * Display a listing of Definition.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topic_id = request()->topic_id;
        $chapter_id = request()->chapter_id;
        $definitions = Definition::when($chapter_id, function($q)use($chapter_id){return $q->where('chapter_id', $chapter_id);})
                                 ->when($topic_id, function($q)use($topic_id){return $q->where('topic_id', $topic_id);})
                                 ->get();
        return $this->sendResponse(DefinitionResource::collection($definitions));
    }

    public function change_definition_level(UpdateDefinitionLevelRequest $request)
    {
        $definition = DefinitionLevel::updateOrCreate(
            ['definition_id' => $request->definition_id, 'user_id' => auth()->id()],
            ['level' => $request->level]
        );

        return $this->sendResponse(new DefinitionResource(Definition::find($request->definition_id)), 'Updated successfully');
    }

    public function toggle_fav(ToggleFavDefinitionRequest $request)
    {
        $definition = Definition::find($request->definition_id);
        auth()->user()->toggleFavorite($definition);
        return $this->sendResponse(new DefinitionResource($definition), 'Updated successfully');
    }

    
    public function save_mcq_results(StoreMcqResultsRequest $request)
    {
        $mcqResult = McqResult::create([
            'user_id' => auth()->id(),
            'topic_id' => $request->topic_id,
            'chapter_id' => $request->chapter_id,
            'score' => $request->score,
            'data' => json_encode($request->data),
        ]);

        return $this->sendSuccess('Result saved successfully');
         
    }

    public function mcq_results()
    {
        if(auth()->user()->checkRole('admin') && request()->all)
        return $this->sendResponse(McqResultResource::collection(McqResult::all()));
        return $this->sendResponse(McqResultResource::collection(auth()->user()->mcq_results));
    }

    public function destroy_mcq_results($id)
    {
        $mcqResult = McqResult::findOrFail($id);
        $mcqResult->delete();
        return $this->sendSuccess('Deleted successfully');
    }


    /**
     * Show the form for creating new Definition.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('definitions.create');
    }

    /**
     * Store a newly created Definition in storage.
     *
     * @param  \App\Http\Requests\UpdateDefinitionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdateDefinitionsRequest $request)
    {
        try {
            DB::beginTransaction();
            $definition = Definition::create([
                'title' => $request->title,
                'chapter_id' => $request->chapter_id,
                'topic_id' => $request->topic_id,
            ]);
                    
            $definition->term()->create([
                'title' => $request->term,
                'chapter_id' => $request->chapter_id,
                'topic_id' => $request->topic_id,
            ]);
            DB::commit();
            return $this->sendResponse(new DefinitionResource($definition));
        } catch (\Throwable $th) {
            DB::rollBack();
        }



    }


    /**
     * Show the form for editing Definition.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $definition = Definition::findOrFail($id);

        return view('definitions.edit', compact('definition'));
    }

    /**
     * Update Definition in storage.
     *
     * @param  \App\Http\Requests\UpdateDefinitionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDefinitionsRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $definition = Definition::findOrFail($id);
            $definition->update([
                'title' => $request->title,
                'chapter_id' => $request->chapter_id,
                'topic_id' => $request->topic_id,
            ]);
                        
            $definition->term()->update([
                'title' => $request->term,
                'chapter_id' => $request->chapter_id,
                'topic_id' => $request->topic_id,
            ]);
            $definition = Definition::find($definition->id);
            DB::commit();
            return $this->sendResponse(new DefinitionResource($definition));
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }


    /**
     * Display Definition.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $definition = Definition::findOrFail($id);
        return $this->sendResponse(new DefinitionResource($definition));
    }


    /**
     * Remove Definition from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $definition = Definition::findOrFail($id);
        $definition->term()->delete();
        $definition->delete();
        return $this->sendSuccess('success');
    }

    /**
     * Delete all selected Definition at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = Definition::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }

            return $this->sendSuccess('success');

        }
    }

}
