<?php

namespace App\Actions\Reminder;

use App\Dtos\Reminder\CreateReminderDto;
use App\Models\Reminder;

class CreateReminder
{
    /**
     * Handle the create tag action
     * @param CreateTagDto $dto
     */
    public static function handle(CreateReminderDto $dto): Reminder
    {  
        return Reminder::create((array) $dto);
    }
}
