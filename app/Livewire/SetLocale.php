<?php

namespace App\Livewire;

use Livewire\Component;

class SetLocale extends Component
{
    public $locale;

    public function mount()
    {
        $this->locale = session()->get('locale', config('app.locale'));
    }

    public function switchLanguage()
    {
        $locale = app()->currentLocale() === 'en' ? 'ar' : 'en';
        if ($locale === 'ar') {
            app()->setLocale('en');
        } else {
            app()->setLocale('ar');
        }
        session()->put('locale', $locale);
        $this->dispatch('language-switched');
    }

    public function render()
    {
        return view('livewire.set-locale');
    }
}
