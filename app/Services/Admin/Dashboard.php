<?php

namespace App\Services\Admin;

use App\Models\Contact;

class Dashboard
{
    public $startDate;

    public $endDate;

    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    private function getData($is_read = null)
    {
        return Contact::query()
            ->when($this->startDate, function ($query) {
                $query->whereDate('created_at', '>=', $this->startDate);
            })
            ->when($this->endDate, function ($query) {
                $query->whereDate('created_at', '<=', $this->endDate);
            })
            ->when($is_read !== null, function ($query) use ($is_read) {
                $query->where('is_read', $is_read);
            });
    }

    public function getMessagesCountByType($type = null, $is_read = null)
    {
        return $this->getData($is_read)
            ->when($type !== null, function ($query) use ($type) {
                $query->where('type', $type);
            })
            ->count();
    }

    public function getMessagesCountByStatus($status = null, $is_read = null)
    {
        return $this->getData($is_read)
            ->when($status !== null, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->count();
    }
}
