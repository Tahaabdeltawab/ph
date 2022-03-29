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
use App\Models\Chapter;
use App\Models\DefinitionLevel;
use App\Models\McqResult;
use App\Models\Term;
use Illuminate\Support\Facades\DB;

class DefinitionsController extends APIBaseController
{
    public function __construct()
    {
        // $this->middleware('permission:create-definitions')->only(['store']);
        // $this->middleware('permission:update-definitions')->only(['update']);
        // $this->middleware('permission:delete-definitions')->only(['destroy']);
        // $this->middleware('permission:show-definitions')->only(['show', 'index']);
        
        // commented because generic users can handle their own topics,chapters,definitions
        
        $this->middleware('permission:delete-adminmcqresults')->only(['destroy_mcq_results']);

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
        $practiceMode = request()->practiceMode;
        $definitions = Definition::when($chapter_id, function($q)use($chapter_id){return $q->where('chapter_id', $chapter_id);})
                                 ->when($topic_id, function($q)use($topic_id){return $q->where('topic_id', $topic_id);})
                                 ->when($practiceMode == 'MCQ', fn($q) => $q->mcquable())
                                 ->when($practiceMode == 'Flashcard', fn($q) => $q->flashable())
                                 ->when($practiceMode == 'Complete', fn($q) => $q->completable())
                                 ->get();
        return $this->sendResponse(DefinitionResource::collection($definitions));
    }

    public function change_definition_level(UpdateDefinitionLevelRequest $request)
    {
        $definition = DefinitionLevel::updateOrCreate(
            ['definition_id' => $request->id, 'user_id' => auth()->id()],
            ['level' => $request->level]
        );

        return $this->sendResponse(new DefinitionResource(Definition::find($request->id)), 'Updated successfully');
    }

    public function toggle_fav(ToggleFavDefinitionRequest $request)
    {
        $definition = Definition::find($request->id);
        auth()->user()->toggleFavorite($definition);
        return $this->sendResponse(new DefinitionResource($definition), 'Updated successfully');
    }

    
    public function save_mcq_results(StoreMcqResultsRequest $request)
    {
        $mcqResult = McqResult::create([
            'user_id' => auth()->id(),
            'topic_id' => $request->topic_id,
            'chapter_id' => $request->chapter_id,
            'mode' => $request->mode,
            'score' => $request->score,
            'data' => json_encode($request->data),
        ]);

        return $this->sendSuccess('Result saved successfully');
         
    }

    public function mcq_results()
    {
        if(auth()->user()->isAbleTo('show-adminmcqresults') && request()->all)
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
                'flashable' => $request->flashable,
                'reversible' => $request->reversible,
                'completable' => $request->completable,
                'mcquable' => $request->mcquable,
                'automcquable' => $request->automcquable,
                'custommcquable' => $request->custommcquable,
                'explanation' => $request->explanation,
            ]);

            $data = collect($request->terms)->mapWithKeys(function ($item, $key) use ($definition, $request) {
                // if the definition is custom mcq so the terms are considered mcq options with the first term ($key == 0) is the correct option
                return [$key =>['title' => $item, 'definition_id' => $definition->id, 'correct' => ($request->custommcquable ? ($key == 0 ? 1 : 0) : null)]];
            })->toArray();
           
            Term::upsert($data, [],['title', 'definition_id', 'correct']);

            // add request tags to the chapter tags to choose among them in future created definitions
            Chapter::find($definition->chapter_id)->attachTags($request->tags);
            // add the tags to the definition
            $definition->syncTags($request->tags);
            
            DB::commit();
            return $this->sendResponse(new DefinitionResource($definition));
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return $this->sendError($th->getMessage());
        }



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
                'flashable' => $request->flashable,
                'reversible' => $request->reversible,
                'completable' => $request->completable,
                'mcquable' => $request->mcquable,
                'automcquable' => $request->automcquable,
                'custommcquable' => $request->custommcquable,
                'explanation' => $request->explanation,
            ]);
         
            // be careful in case of the term is linked to another table other than the definitions table
            $definition->terms()->delete();
            $data = collect($request->terms)->mapWithKeys(function ($item, $key) use ($definition, $request) {
                // if the definition is custom mcq so the terms are considered mcq options with the first term ($key == 0) is the correct option
                return [$key =>['title' => $item, 'definition_id' => $definition->id, 'correct' => ($request->custommcquable ? ($key == 0 ? 1 : 0) : null)]];
            })->toArray();
            Term::upsert($data, [],['title', 'definition_id', 'correct']);
            
            Chapter::find($definition->chapter_id)->attachTags($request->tags);
            $definition->syncTags($request->tags);
            
            $definition = Definition::find($definition->id);
            DB::commit();
            return $this->sendResponse(new DefinitionResource($definition));
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError($th->getMessage());
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
        $definition->terms()->delete();
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
