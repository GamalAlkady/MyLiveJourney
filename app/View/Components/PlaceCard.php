<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Collection;

class PlaceCard extends Component
{
    public $places;
    public $size;
    public $details;

    public function __construct($place = null, $places = null, $size = 'normal', $details = true)
    {
        // قبول إما متغير place أو places
        if ($places) {
            $this->places = $this->normalizePlaces($places);
        } elseif ($place) {
            $this->places = collect([$place]);
        } else {
            $this->places = collect(); // فارغ
        }

        $this->size = $size;
        $this->details = $details;
    }

    protected function normalizePlaces($places)
    {
        if ($places instanceof \Illuminate\Pagination\LengthAwarePaginator) {
            return collect($places->items()); // اجعلها Collection من العناصر فقط
        }

        if ($places instanceof Collection) {
            return $places;
        }

        // تحويل المصفوفة إلى Collection
        return collect(is_array($places) ? $places : [$places]);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.place-card');
    }
}
