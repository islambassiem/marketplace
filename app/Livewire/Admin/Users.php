<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

#[Layout('components.layouts.admin')]
class Users extends Component
{
    use Toast;
    use WithPagination;

    public $limit = 5;

    public $search = '';

    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    #[Computed()]
    public function users()
    {
        $users = User::withCount('posts')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('email', 'like', '%'.$this->search.'%');
            })
            ->where('id', '!=', auth()->id())
            ->latest()
            ->paginate($this->limit);

        $this->resetPage();

        return $users;
    }

    public function toggleAdmin(User $user)
    {
        $user->is_admin = ! $user->is_admin;
        $user->save();
        $this->dispatch('privilege-updated');
        $this->success(
            __('The user privilege has been updated successfully.')
        );
    }

    #[On('privilege-updated')]
    public function render()
    {
        return view('livewire.admin.users', [
            'users' => $this->users,
        ])
            ->title(__('Users'));
    }
}
