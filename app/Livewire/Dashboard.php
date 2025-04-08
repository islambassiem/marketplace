<?php

namespace App\Livewire;

use App\Actions\Post\DeleteAction;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class Dashboard extends Component
{
    use Toast;
    use WithoutUrlPagination, WithPagination;

    public $orderBy = 'updated_at';

    public $orderDirection = 'desc';

    public $search = '';

    public $perPage = 10;

    public function sortBy($field)
    {
        if ($this->orderBy === $field) {
            $this->orderDirection = $this->orderDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->orderDirection = 'asc';
        }

        $this->orderBy = $field;
    }

    public function setItemsPerPage($perPage)
    {
        $this->perPage = $perPage;
    }

    public function refresh(Post $post)
    {
        $this->authorize('refresh', $post);
        $post->touch();
        $this->success(__('The ad has been refreshed successfully'));
    }

    public function delete(Post $post, DeleteAction $action)
    {
        $this->authorize('delete', $post);
        $action->handle($post);
        $this->success(__('The ad has been deleted successfully'));
    }

    #[computed]
    public function posts()
    {
        $categoryField = app()->getLocale() === 'ar' ? 'name_ar' : 'name_en';

        return Auth::user()
            ->posts()
            ->when($this->search, function ($query) {
                return $query->where('title', 'like', "%{$this->search}%");
            })
            ->join('categories', 'categories.id', '=', 'posts.category_id')
            ->select('posts.*', "categories.{$categoryField} as category_name")
            ->with(['media', 'category'])
            ->orderBy($this->orderBy, $this->orderDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.dashboard', [
            'posts' => $this->posts,
        ]);
    }
}
