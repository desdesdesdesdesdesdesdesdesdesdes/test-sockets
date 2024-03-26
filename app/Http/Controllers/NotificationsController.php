<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationSaveRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Notification;
use App\Events\NotificationCreated;

class NotificationsController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('Notifications/Index', [
            'notifications' => Notification::all(),
        ]);
    }

    public function create(Request $request): Response
    {
        return Inertia::render('Notifications/Create');
    }

    public function store(NotificationSaveRequest $request): redirectResponse
    {
        $notification = Notification::create($request->validated());
        NotificationCreated::dispatch($notification);

        return redirect()->route('notifications');
    }

    public function edit(Request $request, int $id): Response
    {
        return Inertia::render('Notifications/Edit', [
            'notification' => Notification::findOrFail($id),
        ]);
    }

    public function update(NotificationSaveRequest $request, int $id): RedirectResponse
    {
        $notification = Notification::findOrFail($id);
        $notification->fill($request->validated())->save();

        return Redirect::route('notifications');
    }

    public function delete(Request $request, int $id): void
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();
    }

    public function viewed(Request $request, int $id): void
    {
        $notification = Notification::findOrFail($id);
        $notification->viewed++;
        $notification->save();
    }

}
