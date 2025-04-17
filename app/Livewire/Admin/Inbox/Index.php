<?php

namespace App\Livewire\Admin\Inbox;

use App\Models\Contact;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public int $perPage = 10;

    public array $filteredTypes = [];

    public array $filteredStatuses = [];

    public array $filteredRead = [];

    public $readStatus = 'test';

    public function toggleFilterType($key)
    {
        $this->resetPage();
        if (in_array($key, $this->filteredTypes)) {
            $this->filteredTypes = array_diff($this->filteredTypes, [$key]);
        } else {
            $this->filteredTypes[] = $key;
        }
    }

    public function toggleFilterStatus($key)
    {
        $this->resetPage();
        if (in_array($key, $this->filteredStatuses)) {
            $this->filteredStatuses = array_diff($this->filteredStatuses, [$key]);
        } else {
            $this->filteredStatuses[] = $key;
        }
    }

    public function toggleFilterRead($key)
    {
        if (in_array($key, $this->filteredRead)) {
            $this->filteredRead = array_diff($this->filteredRead, [$key]);
        } else {
            $this->filteredRead[] = $key;
        }
    }

    public function toggleRead($id)
    {
        $contact = Contact::find($id);
        $contact->is_read ? $contact->is_read = 0 : $contact->is_read = 1;
        $contact->save();
    }

    #[Computed()]
    public function contacts()
    {
        return Contact::query()
            ->when($this->filteredTypes !== [], function ($query) {
                $query->whereIn('type', $this->filteredTypes);
            })
            ->when($this->filteredStatuses !== [], function ($query) {
                $query->whereIn('status', $this->filteredStatuses);
            })
            ->when($this->filteredRead !== [], function ($query) {
                $query->whereIn('is_read', $this->filteredRead);
            })
            ->orderBy('is_read')
            ->orderByDesc('created_at')
            ->paginate($this->perPage);
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.inbox.index', [
            'types' => Contact::TYPES,
            'statuses' => Contact::STATUSES,
        ]);
    }
}
