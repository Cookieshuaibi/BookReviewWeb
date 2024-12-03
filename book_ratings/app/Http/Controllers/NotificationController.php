<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use  App\Models\Notification;
use  Illuminate\Support\Facades\Auth;
class NotificationController extends Controller
{
    public function unreadCount(Request $request)
    {
        $user = $request->user();
        $unreadCount = $user->unreadNotifications->count();
        return response()->json(['unreadCount' => $unreadCount]);
    }

    public function top(Request $request)
    {
        $user = $request->user();
        $notifications = $user->notifications()->whereNull('read_at')->take(10)->get(); // 获取前10条消息
        return response()->json(['notifications' => $notifications]);
    }
    public function index(Request $request)
    {
        $user = $request->user();
        $notifications = $user->notifications()->paginate(10); // 获取全部消息
        return view('notification.index', compact('notifications'));
    }
    public function show(Request $request, $id)
    {
        $user = $request->user();
        $notification = $user->notifications()->find($id);
        $notification->markAsRead();
        return view('notification.show', compact('notification'));
    }
}