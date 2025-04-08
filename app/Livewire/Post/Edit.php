<?php

namespace App\Livewire\Post;

use App\Actions\Post\EditPostAction;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\City;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Edit extends Component
{
    use Toast;

    public Post $post;

    public $title;

    public $description;

    public $price;

    public $patentId;

    public $provinceId;

    public $category_id;

    public $city_id;

    public $images;

    public function mount(Post $post): void
    {
        $this->authorize('view', $post);
        $this->post = $post;
        $this->title = $this->post->title;
        $this->description = $this->post->description;
        $this->price = $this->post->price;
        $this->patentId = $post->category->parent_id;
        $this->category_id = $post->category_id;
        $this->city_id = $post->city_id;
        $this->provinceId = City::find($post->city_id)->parent->id;
        $this->images = $post->getMedia();
    }

    #[Computed()]
    public function parents(): Collection
    {
        return Category::whereNull('parent_id')->get(['id', 'name_en', 'name_ar']);
    }

    #[Computed()]
    public function children(): Collection
    {
        if ($this->patentId !== null) {
            return Category::where('parent_id', $this->patentId)->get(['id', 'name_en', 'name_ar']);
        }

        return collect(new Category());
    }

    #[Computed()]
    public function provinces(): Collection
    {
        return City::whereNull('province_id')->get(['id', 'city_en', 'city_ar']);
    }

    #[Computed()]
    public function cities(): Collection
    {
        if (!is_null($this->provinceId)) {
            return City::where('province_id', $this->provinceId)->get(['id', 'city_en', 'city_ar']);
        }

        return collect(new City());
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

    public function delete($image): void
    {
        $media = Media::findOrFail($image);
        $images = $this->post->media->pluck('id')->toArray();
        abort_if(!in_array($media->id, $images), 403);
        if(count($images) > 1){
            $media->delete();
            $this->success(
                __('The image has been deleted successfully'),
            );
            $this->dispatch('media-deleted');
        }else{
            $this->error(
                __('This is the only image; you cannot deleted it'),
            );
        }
    }

    public function rules(): array
    {
        return (new UpdatePostRequest)->rules();
    }

    public function save(EditPostAction $action)
    {
        $validated = $this->validate();
        $this->authorize('update', $this->post);
        $action->handle($this->post->id, $validated);

        $this->success(
            __('The ad has been updated successfully'),
            redirectTo: route('dashboard')
        );
    }

    #[On('media-deleted')]
    public function render(): View
    {
        return view('livewire.post.edit');
    }
}
