<?php

namespace App\Actions\Admin\Dashboard;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Images
{
    public $startDate;

    public $endDate;

    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function getImagesCount()
    {
        return Media::query()
            ->when($this->startDate, function ($query) {
                $query->whereDate('created_at', '>=', $this->startDate);
            })
            ->when($this->endDate, function ($query) {
                $query->whereDate('created_at', '<=', $this->endDate);
            })
            ->count();
    }
}
