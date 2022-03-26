<?php

namespace App\Http\Controllers\Api;

use App\Models\Chapter;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateChaptersRequest;
use App\Http\Requests\ShareChaptersRequest;
use App\Http\Resources\ChapterResource;
use App\Http\Resources\ChapterWithDefinitionsResource;
use App\Http\Resources\TopicWithChaptersResource;
use App\Models\ChapterUser;
use App\Models\Topic;
use App\Models\User;
use App\Notifications\ShareChapterNotification;
use Illuminate\Support\Facades\DB;

class ChaptersController extends APIBaseController
{
    public function __construct()
    {
        // $this->middleware('permission:create-chapters')->only(['store']);
        // $this->middleware('permission:update-chapters')->only(['update']);
        // $this->middleware('permission:delete-chapters')->only(['destroy']);
        // $this->middleware('permission:show-chapters')->only(['show', 'index']);

        // commented because generic users can handle their own topics,chapters,definitions
    }

    /**
     * Display a listing of Chapter.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topic_id = request()->topic_id;
        $chapters = Chapter::when($topic_id, function($q)use($topic_id){return $q->where('topic_id', $topic_id);}) // for admin and others
        ->when(!$topic_id, fn($q) => $q->public()) // for admin
        ->get();
        return $this->sendResponse(ChapterResource::collection($chapters));
    }

    public function store(UpdateChaptersRequest $request)
    {
        $chapter = Chapter::create($request->validated());
        $chapter->users()->attach(auth()->id(), ['permission' => 'admin-show-update-create-delete']);
        
        return $this->sendResponse(new ChapterResource($chapter));
    }
    
    public function share(ShareChaptersRequest $request){
        try{
            DB::beginTransaction();
            $data = collect($request->usersPermissions)->mapWithKeys(function ($item, $key) {
                return [$key =>['chapter_id' => request()->chapter_id, 'user_id' => $item['user_id'], 'permission' => $item['permission']]];
            })->toArray();
            
            ChapterUser::where('chapter_id', $request->chapter_id)->notAdmin()->delete();
            ChapterUser::upsert($data, [], []);
            
            // notify
            if($data){
                $usersIds = collect($request->usersPermissions)->map(fn ($item) => $item['user_id'])->toArray();
                $users = User::whereIn('id', $usersIds)->get();
                $chapter = Chapter::find($request->chapter_id);
                foreach($users as $user){
                    $user->notify(new ShareChapterNotification($chapter));
                }
            }

            DB::commit();
            return $this->sendSuccess('Chapter shared successfully');
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
            return $this->sendError($th->getMessage());
        }
    }
    public function get_allowed_users($id){
        $usersPermissions = DB::table('chapter_user')
        ->join('users','chapter_user.user_id','=','users.id')
        ->where('chapter_user.chapter_id', $id)
        // added because don't want to show the chapter creator in the share dialog
        ->where('chapter_user.permission','!=', 'admin-show-update-create-delete')
        ->select(['chapter_user.user_id', 'users.username', 'users.avatar', 'chapter_user.permission'])
        ->get();
        
        $data['chapter_id'] = $id;
        $data['usersPermissions'] = $usersPermissions;
        return $this->sendResponse($data);
    }

    public function get_available_topics(){
        $shared_topics = DB::table('chapter_user')
        ->join('chapters','chapter_user.chapter_id','=','chapters.id')
        ->join('topics','chapters.topic_id','=','topics.id')
        ->join('users','topics.user_id','=','users.id')
        ->where('chapter_user.user_id', auth()->id())
        // the reason for adding the coming line and compensating it with $created_topics is that for the topic to be retrieved, 
        // it should have a record in chapter_user table (have a shared chapter), so the user created topics without any chapters will not be retrieved.
        ->where('chapter_user.permission','!=', 'admin-show-update-create-delete')
        ->select(['topics.id', 'topics.title', 'users.email'])
        ->distinct()
        ->get();

        $created_topics = DB::table('topics')
        ->where('user_id', auth()->id())
        ->where('visibility', 0)
        ->select(['id', 'title'])
        ->get();

        $topics = $created_topics->merge($shared_topics);

        return $this->sendResponse($topics);
    }

    public function get_available_chapters($id){
        $topic = Topic::find($id);
        $topic->chapters = Chapter::where('topic_id', $id)
        ->join('chapter_user','chapter_user.chapter_id', '=', 'chapters.id')
        ->where('chapter_user.user_id', auth()->id())
        ->select([...Chapter::$common, 'chapter_user.permission'])
        ->get();
        return $this->sendResponse(new TopicWithChaptersResource($topic));
    }

    public function update(UpdateChaptersRequest $request, $id)
    {
        $chapter = Chapter::findOrFail($id);
        $chapter->update($request->validated());
        $chapter = Chapter::find($chapter->id);
        return $this->sendResponse(new ChapterResource($chapter));
    }

    // admin show chapter definitions
    public function show($id)
    {
        $chapter = Chapter::with('definitions')
        // ->join('chapter_user','chapter_user.chapter_id', '=', 'chapters.id')
        // ->where('chapter_user.user_id', auth()->id())
        ->select([...Chapter::$common])
        ->find($id);
        return $this->sendResponse(new ChapterWithDefinitionsResource($chapter));
    }

    // my datasets definitions
    public function showMydatasetsDefinitions($id)
    {
        $chapter = Chapter::with('definitions')
        ->join('chapter_user','chapter_user.chapter_id', '=', 'chapters.id')
        ->where('chapter_user.user_id', auth()->id())
        ->select([...Chapter::$common, 'chapter_user.permission'])
        ->find($id);
        return $this->sendResponse(new ChapterWithDefinitionsResource($chapter));
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
