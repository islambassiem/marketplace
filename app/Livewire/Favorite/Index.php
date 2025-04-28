<?php

namespace App\Livewire\Favorite;

use App\Models\FavotiteUser;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
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
    }

    public function render()
    {
        return view('livewire.favorite.index', [
            'posts' => $this->posts,
        ]);
    }
}
