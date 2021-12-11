<?php

namespace App\Http\Controllers\API;

use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateFeedbacksRequest;
use App\Http\Resources\FeedbackResource;

class FeedbacksController extends APIBaseController
{
    public function __construct()
    {
        //$this->middleware('admin');
    }

    /**
     * Display a listing of Feedback.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedbacks = auth()->user()->checkRole('admin') ? Feedback::all() : auth()->user()->feedbacks;
        return $this->sendResponse(FeedbackResource::collection($feedbacks));
    }

    /**
     * Show the form for creating new Feedback.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('feedbacks.create');
    }

    /**
     * Store a newly created Feedback in storage.
     *
     * @param  \App\Http\Requests\UpdateFeedbacksRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdateFeedbacksRequest $request)
    {
        $feedback = Feedback::create([
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        return $this->sendResponse(new FeedbackResource($feedback));
    }


    /**
     * Show the form for editing Feedback.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feedback = Feedback::findOrFail($id);

        return view('feedbacks.edit', compact('feedback'));
    }

    /**
     * Update Feedback in storage.
     *
     * @param  \App\Http\Requests\UpdateFeedbacksRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFeedbacksRequest $request, $id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->update($request->validated());
        return $this->sendResponse(new FeedbackResource($feedback));
    }


    /**
     * Display Feedback.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $feedback = Feedback::findOrFail($id);
        return $this->sendResponse(new FeedbackResource($feedback));
    }


    /**
     * Remove Feedback from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();
        return $this->sendSuccess('success');
    }

    /**
     * Delete all selected Feedback at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = Feedback::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }

            return $this->sendSuccess('success');

        }
    }

}
