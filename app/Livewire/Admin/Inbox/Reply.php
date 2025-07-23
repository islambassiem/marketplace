<?php

namespace App\Livewire\Admin\Inbox;

use App\Mail\ReplyMail;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Mary\Traits\Toast;

class Reply extends Component
{
    use Toast;

    public string $subject = '';

    public string $body = '';

    public Contact $contact;
    public function mount(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function rules()
    {
        return [
            'subject' => 'required',
            'body' => 'required',
        ];
    }

    public function send()
    {
        $this->validate();
        Mail::to($this->contact->email)->send(new ReplyMail(
            subject: $this->subject,
            intro: 'Hi ' . $this->contact->name,
            content: $this->body,
            outro: 'Have a nice day!',
        ));
        $this->contact->status = 2;
        $this->contact->save();
        session()->flash('success', __('Your message has been sent successfully!'));
        $this->reset('subject', 'body');
        $this->redirect(route('admin.inbox.show', true));
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.reply');
    }
}
