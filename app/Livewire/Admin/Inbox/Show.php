<?php

namespace App\Livewire\Admin\Inbox;

use App\Models\Contact;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Mary\Traits\Toast;

class Show extends Component
{
    use Toast;

    public Contact $contact;

    public function monut(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function updateStatus($status)
    {
        $this->contact->status = $status;
        $this->contact->save();
        $this->success(__(
            'The status of the message has been updated to'
        ).' '.__(Contact::STATUSES[$status]));
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.inbox.show', [
            'statuses' => Contact::STATUSES,
        ]);
    }
}
