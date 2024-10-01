<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppContentWrapper extends Component
{

    public function render(): View
    {
        return view('slicing.index');
    }
}
