<?php

namespace App\Livewire\Post;

use App\Models\City;
use Mary\Traits\Toast;
use Livewire\Component;
use App\Models\Category;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use App\Actions\Post\CreatePostAction;
use App\Http\Requests\CreatePostRequest;

class Create extends Component
{
    use Toast;
    public $patentId;

    public $provinceId;

    public $city_id;

    public $category_id;

    public $title;

    public $price;

    public $description;

    #[Computed()]
    public function parents()
    {
        return Category::whereNull('parent_id')->get(['id', 'name_en', 'name_ar']);
    }

    #[Computed()]
    public function children()
    {
        if ($this->patentId !== null) {
            return Category::where('parent_id', $this->patentId)->get(['id', 'name_en', 'name_ar']);
        }

        return collect();
    }

    #[Computed()]
    public function provinces()
    {
        return City::whereNull('province_id')->get(['id', 'city_en', 'city_ar']);
    }

    #[Computed()]
    public function cities()
    {
        if ($this->provinceId !== null) {
            return City::where('province_id', $this->provinceId)->get(['id', 'city_en', 'city_ar']);
        }

        return collect();
    }

    public function updating($property, $value): void
    {
        if ($property === 'patentId') {
            $this->category_id = null;
        }

        if ($property === 'provinceId') {
            $this->city_id = null;
        }
    }

    public function rules(): array
    {
        return (new CreatePostRequest)->rules();
    }

    public function store(CreatePostAction $request): void
    {
        $validated = $this->validate();
        $request->handle($validated);
        $this->success(
        __('Ad has been created successfully'),
            redirectTo: route('dashboard')
        );
    }

    public function render(): View
    {
        return view('livewire.create-post', [
            'parents' => $this->parents(),
            'children' => $this->children(),
            'provinces' => $this->provinces(),
            'cities' => $this->cities(),
        ]);
    }
}
