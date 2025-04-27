<?php

namespace App\Actions\Admin\Dashboard;

use App\Models\User as UsersModel;

class Users
{
    public $startDate;

    public $endDate;

    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function getUsersCount()
    {
        $count = UsersModel::query()
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
