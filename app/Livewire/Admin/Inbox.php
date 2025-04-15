<?php

namespace App\Livewire\Admin;

use App\Models\Contact;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Inbox extends Component
{
    use WithPagination;

    public int $perPage = 10;

    public array $filteredTypes = [];

    public function addFilter($key)
    {
        if (! in_array($key, $this->filteredTypes)) {
            $this->filteredTypes[] = $key;
        }

    }

    public function toggleFilter($key)
    {
        $this->resetPage();
        if (in_array($key, $this->filteredTypes)) {
            $this->filteredTypes = array_diff($this->filteredTypes, [$key]);
        } else {
            $this->filteredTypes[] = $key;
        }
    }

    public function selectAll()
    {
        $this->resetPage();
        $this->filteredTypes = array_keys(Contact::TYPES);
    }

    public function removeFilter($key)
    {
        $this->resetPage();
        if (in_array($key, $this->filteredTypes)) {
            $this->filteredTypes = array_diff($this->filteredTypes, [$key]);
        }
    }

    #[Computed()]
    public function contacts()
    {
        return Contact::query()
            ->when($this->filteredTypes !== [], function ($query) {
                $query->whereIn('type', $this->filteredTypes);
            })
            ->latest()
            ->paginate($this->perPage);
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.inbox', [
            'types' => Contact::TYPES,
        ]);
    }
}
