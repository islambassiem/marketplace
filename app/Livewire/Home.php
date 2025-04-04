<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\City;
use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Home extends Component
{
    public $limit = 6;

    public function load()
    {
        $this->limit += 3;
    }

    public string $search = '';

    public string $queryParam = '';

    public $slug;

    public $provinceId;

    public $cityId;

    public $minPrice;

    public $maxPrice;

    public $title;

    public $subCategories = [];

    public function mount($slug = null)
    {
        $request = request()->segment(1);

        if (is_numeric($request) && ! is_null($request)) {
            $activeCategory = Category::find(Post::find($request)->category_id);
        } else {
            $activeCategory = Category::where('slug', $request)->first();
        }

        $this->slug = $slug;
        $this->subCategories[] = $activeCategory;
        $this->title = app()->currentLocale() == 'ar' ? $activeCategory?->name_ar : ucfirst($activeCategory?->name_en);
    }

    public function query()
    {
        $this->queryParam = $this->search;
    }

    #[Computed()]
    public function categories()
    {
        return Category::whereNull('parent_id')->with('parent')->get();
    }

    #[Computed()]
    public function provinces()
    {
        return City::whereNull('province_id')->get(['id', 'city_en', 'city_ar']);
    }

    #[Computed()]
    public function cities()
    {
        if (! is_null($this->provinceId)) {
            return City::where('province_id', $this->provinceId)->get(['id', 'city_en', 'city_ar']);
        }

        return collect();
    }

    public function category($category)
    {
        $subCategories = Category::where('parent_id', $category)->get();
        $this->subCategories = $subCategories;
    }

    #[Computed()]
    public function posts()
    {
        return Post::query()
            ->when($this->slug, function ($query) {
                $category = Category::where('slug', $this->slug)->first();

                return $query->where('category_id', $category?->id);
            })
            ->when($this->search, function ($query) {
                return $query
                    ->where('title', 'like', '%'.$this->queryParam.'%')
                    ->orWhere('description', 'like', '%'.$this->queryParam.'%');
            })
            ->when($this->provinceId, function ($query) {
                $cities = City::find($this->provinceId);
                if (! is_null($cities)) {
                    $cities = $cities->cities();

                    return $query->whereIn('city_id', $cities);
                }

                return $query;
            })
            ->when($this->cityId, function ($query) {
                $query->where('city_id', $this->cityId);
            })
            ->when($this->minPrice, function ($query) {
                return $query->where('price', '>=', $this->minPrice);
            })
            ->when($this->maxPrice, function ($query) {
                return $query->where('price', '<=', $this->maxPrice);
            })
            ->with(['media', 'category'])
            ->take($this->limit)
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    #[Layout('components.layouts.home')]
    public function render()
    {
        return view('livewire.home', [
            'posts' => $this->posts,
        ])
            ->title($this->title);
    }
}
