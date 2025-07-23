<?php

namespace App\Livewire;

use App\Actions\Contact\CreateContactAction;
use App\Http\Requests\CreateContactRequest;
use App\Mail\ContactMail;
use App\Models\Contact as ModelsContact;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

use function PHPSTORM_META\type;

class Contact extends Component
{
    public $name;

    public $email;

    public $subject;

    public $body;

    public $type;

    public function rules()
    {
        return (new CreateContactRequest)->rules();
    }

    public function messages()
    {
        return (new CreateContactRequest)->messages();
    }

    public function send(CreateContactAction $action)
    {
        $validated = $this->validate();
        $action->handle($validated);
        $admins = User::where('is_admin', true)->get()->pluck('email', 'name')->toArray();

        foreach ($admins as $name => $email) {
            Mail::to($email)->send(new ContactMail(
                subject: $this->subject,
                intro: 'Hi ' . $name,
                content: $this->body,
                type: ModelsContact::TYPES[$validated['type']],
            ));
        }

        session()->flash('success', __('Your message has been sent successfully!'));
        $this->redirectIntended(route('home'), true);
    }

    public function render()
    {
        return view('livewire.contact', [
            'data' => \App\Models\Contact::TYPES,
        ])
            ->title(__('Contact us'));
    }
}
