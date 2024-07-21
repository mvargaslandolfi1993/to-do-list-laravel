<?php

namespace App\Http\Controllers\Api;

use App\Actions\Reminder\CreateReminder;
use App\Dtos\Reminder\CreateReminderDto;
use App\Http\Resources\ReminderResource;
use App\Models\Reminder;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function store(Request $request)
    {
        $dto = CreateReminderDto::create($request->all());

        $reminder = CreateReminder::handle($dto);

        return new ReminderResource($reminder);
    }

    /**
     * Remove the specified resource from storage.
     * @param Reminder $reminder
     */
    public function destroy(Reminder $reminder)
    {
        $reminder->delete();

        return response(null, 204);
    }
}
