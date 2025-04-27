<?php

namespace App\Actions\Admin\Dashboard;

use App\Models\Post;

class Ads
{
    public $startDate;

    public $endDate;

    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function getAdsCount()
    {
        $count = Post::query()
            ->when($this->startDate, function ($query) {
                $query->whereDate('created_at', '>=', $this->startDate);
            })
            ->when($this->endDate, function ($query) {
                $query->whereDate('created_at', '<=', $this->endDate);
            })
            ->count();

        return $count;
    }
}
