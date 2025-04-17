<?php

namespace App\Livewire;

use App\Actions\Contact\CreateContactAction;
use App\Http\Requests\CreateContactRequest;
use Livewire\Component;

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
        session()->flash('success', __('Your message has been sent successfully!'));
        $this->redirectIntended(route('home'), true);
    }

    public function render()
    {
        return view('livewire.contact', [
            'data' => \App\Models\Contact::TYPES,
        ]);
    }
}
