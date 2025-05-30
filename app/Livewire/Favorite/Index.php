<?php

namespace App\Livewire\Favorite;

use App\Models\FavotiteUser;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Mary\Traits\Toast;

class Index extends Component
{
    use Toast;

    #[Computed()]
    public function posts()
    {
        return auth()->user()->favoritePosts()->with('media')->get();
    }

    public function remove($id)
    {
        $favorite = FavotiteUser::query()
            ->where('post_id', $id)
            ->where('user_id', auth()->user()->id)
            ->first();
        if ($favorite?->user_id !== auth()->user()->id) {
            abort(403, 'Unauthorized action.');
        }
        $favorite->delete();
        $this->dispatch('postDeleted', $id);
        $this->success(__('The ad has been deleted successfully'));
    }

    public function render()
    {
        return view('livewire.favorite.index', [
            'posts' => $this->posts,
        ])
            ->title(__('Favorite Ads'));
    }
}
