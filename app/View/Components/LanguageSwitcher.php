<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\App;

class LanguageSwitcher extends Component
{
    public $languages;
    public $currentLocale;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->languages = ['en', 'jp']; // Add your supported languages here
        $this->currentLocale = App::getLocale();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.language-switcher');
    }
}
