<?php

namespace App\Actions\Nofications;

use App\Models\Notification;
use Illuminate\Support\Facades\Validator;

class CreateNewNotification
{
    public function create(array $input): Notification
    {
        Validator::make($input, [
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'user_id' => ['required', 'integer'],
        ])->validate();

        return Notification::create([
            'title' => $input['title'],
            'body' => $input['body'],
            'user_id' => $input['user_id'],
        ]);
    }
}
