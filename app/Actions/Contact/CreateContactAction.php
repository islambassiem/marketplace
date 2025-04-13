<?php

namespace App\Actions\Contact;

use Illuminate\Support\Facades\Auth;

class CreateContactAction
{
    public function handle($data)
    {
        if (Auth::check()) {
            $data['user_id'] = Auth::id();
        }

        return \App\Models\Contact::create($data);
    }
}
