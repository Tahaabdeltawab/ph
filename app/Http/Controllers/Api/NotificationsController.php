<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UpdateNotificationsRequest;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Resources\NotificationResource;
use App\Notifications\CustomNotification;

class NotificationsController extends APIBaseController
{
    public function __construct()
    {
        $this->middleware('permission:create-notifications')->only(['store']);
        $this->middleware('permission:update-notifications')->only(['update']);
        $this->middleware('permission:delete-notifications')->only(['destroy']);
        $this->middleware('permission:show-notifications')->only(['show', 'index']);
    }
    
    
    // admin

    public function index()
    {
        $notifications = Notification::all();
        return $this->sendResponse( NotificationResource::collection($notifications));
    }
    
    public function store(UpdateNotificationsRequest $request)
    {
        $users = User::whereIn('id', $request->usersIds)->get();
        foreach ($users as $user) {
            $user->notify(new CustomNotification($request->title));
        }
        return $this->sendSuccess('sent successfully');
    }

    public function update(UpdateNotificationsRequest $request, $id)
    {
        $notification = Notification::findOrFail($id);

        $notification->update($request->validated());
        return $this->sendResponse( new NotificationResource( Notification::find($id) ), 'updated successfully' );
    }

    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();
        return $this->sendSuccess( 'Notification deleted successfully' );
    }

    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = Notification::whereIn('id', $request->input('ids'))->get();
            foreach ($entries as $entry) {
                $entry->delete();
            }
            return $this->sendSuccess( 'Notifications deleted successfully' );
        }
    }


    // user
    public function get_notifications()
    {
        try{
            $notifications = auth()->user()->notifications ;
            auth()->user()->unseenNotifications->markAsSeen();

            return $this->sendResponse(NotificationResource::collection($notifications), 'Notifications retrieved successfully');
        }
        catch(\Throwable $th)
        {
            return $this->sendError($th->getMessage(), 500);
        }
    }
    // user_unseen_notifications_count
    public function unseen_count()
    {
        return $this->sendResponse(['count' => auth()->user()->unseenNotifications->count()]);
    }
    // change notification to read
    public function markAsRead($id)
    {
        try{
            $notification = auth()->user()->unreadNotifications->where('id', $id)->first();
            if(!$notification)
            {
                return $this->sendError('Notification not found');
            }
            $notification->markAsRead();

            return $this->sendSuccess('Notifications read successfully');
        }catch(\Throwable $th){
            return $this->sendError($th->getMessage(), 500);
        }
    }
    // change notification back to unread
    public function markAsUnread($id)
    {
        try{
            $notification = auth()->user()->readNotifications->where('id', $id)->first();
            if(!$notification)
            {
                return $this->sendError('Notification not found');
            }
            $notification->markAsUnread();

            return $this->sendSuccess('Notifications unread successfully');
        }catch(\Throwable $th){
            return $this->sendError($th->getMessage(), 500);
        }
    }


    
}
