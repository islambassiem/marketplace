<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\City;
use App\Models\Post;
use Mary\Traits\Toast;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Layout('components.layouts.admin')]
class Ads extends Component
{
    use Toast;
    use WithPagination;
    public $limit = 5;
    public $search = '';
    public $showModal = false;
    public $selectedPost;
    public $provinceId;
    public $cityId;
    public $categoryId;
    public $subCategoryId;

    public function load()
    {
        $this->limit += 5;
    }

    public function updating($property, $value)
    {
        if ($property == 'provinceId') {
            $this->cityId = null;
        }

        if ($property == 'categoryId') {
            $this->subCategoryId = null;
        }
    }

    public function delete($postId)
    {
        Post::findOrFail($postId)->delete();
        $this->dispatch('close-modal');
        $this->success(__('The ad has been deleted successfully'));
    }
    #[Computed()]
    public function provinces()
    {
        return City::whereNull('province_id')->get(['id', 'city_en', 'city_ar']);
    }

    #[Computed()]
    public function cities()
    {
        if (!is_null($this->provinceId)) {
            return City::where('province_id', $this->provinceId)->get(['id', 'city_en', 'city_ar']);
        }

        return collect();
    }
    #[Computed()]
    public function categories()
    {
        return Category::whereNull('parent_id')->get(['id', 'name_en', 'name_ar']);
    }

    #[Computed()]
    public function subCategories()
    {
        if (!is_null($this->categoryId)) {
            return Category::where('parent_id', $this->categoryId)->get(['id', 'name_en', 'name_ar']);
        }

        return collect();
    }

    #[Computed()]
    public function posts()
    {
        $posts = Post::withCount('media')
            ->with('user', 'category', 'city.parent')
            ->when($this->search, function ($query) {
                $search = "%{$this->search}%";
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', $search)
                        ->orWhere('description', 'like', $search)
                        ->orWhereHas('user', function ($q) use ($search) {
                            $q->where('name', 'like', $search)
                                ->orWhere('email', 'like', $search);
                        });
                });
            })
            ->when($this->provinceId, function ($query) {
                $province = City::find($this->provinceId);
                if ($province) {
                    $cityIds = $province->cities()->pluck('id');
                    return $query->whereIn('city_id', $cityIds);
                }
                return $query;
            })
            ->when($this->cityId, fn($q) => $q->where('city_id', $this->cityId))
            ->when($this->categoryId, function ($query) {
                $cat = Category::find($this->categoryId);
                if ($cat) {
                    $subIds = $cat->subCategories()->pluck('id');
                    return $query->whereIn('category_id', $subIds);
                }
                return $query;
            })
            ->when($this->subCategoryId, fn($q) => $q->where('category_id', $this->subCategoryId))
            ->latest()
            ->paginate($this->limit);

        $this->resetPage();

        return $posts;
    }
    public function render()
    {
        return view('livewire.admin.ads', [
            'posts' => $this->posts,
        ]);
    }
}
