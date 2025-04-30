<?php

namespace App\Livewire\Admin;

use App\Actions\Admin\Dashboard\Ads;
use App\Actions\Admin\Dashboard\Images;
use App\Actions\Admin\Dashboard\Users;
use App\Models\Contact;
use App\Services\Admin\Dashboard as DashboardService;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class Dashboard extends Component
{
    public $startDate;

    public $endDate;

    #[Computed()]
    public function usersCount(): int
    {
        $users = new Users($this->startDate, $this->endDate);

        return $users->getUsersCount();
    }

    #[Computed()]
    public function adsCount()
    {
        $ads = new Ads($this->startDate, $this->endDate);

        return $ads->getAdsCount();
    }

    #[Computed()]
    public function imagesCount()
    {
        return (new Images($this->startDate, $this->endDate))
            ->getImagesCount();
    }

    #[Computed()]
    public function messagesCount()
    {
        return (new DashboardService($this->startDate, $this->endDate))
            ->getMessagesCountByType();
    }

    // ############################### Complaints #############################

    #[Computed()]
    public function complaintsCount()
    {
        return (new DashboardService($this->startDate, $this->endDate))
            ->getMessagesCountByType(type: array_flip(Contact::TYPES)['Complaint']);
    }

    #[Computed()]
    public function complaintsReadCount()
    {
        return (new DashboardService($this->startDate, $this->endDate))
            ->getMessagesCountByType(type: array_flip(Contact::TYPES)['Complaint'], is_read: 1);
    }

    #[Computed()]
    public function complaintsUnReadCount()
    {
        return (new DashboardService($this->startDate, $this->endDate))
            ->getMessagesCountByType(type: array_flip(Contact::TYPES)['Complaint'], is_read: 0);
    }

    // ############################### Complaints #############################

    // ############################### Suggestions #############################

    #[Computed()]
    public function suggestionsCount()
    {
        return (new DashboardService($this->startDate, $this->endDate))
            ->getMessagesCountByType(type: array_flip(Contact::TYPES)['Suggestion']);
    }

    #[Computed()]
    public function suggestionsReadCount()
    {
        return (new DashboardService($this->startDate, $this->endDate))
            ->getMessagesCountByType(type: array_flip(Contact::TYPES)['Suggestion'], is_read: 1);
    }

    #[Computed()]
    public function suggestionsUnReadCount()
    {
        return (new DashboardService($this->startDate, $this->endDate))
            ->getMessagesCountByType(type: array_flip(Contact::TYPES)['Suggestion'], is_read: 0);
    }

    // ############################### Suggestions #############################

    // ############################### Suggestions #############################

    #[Computed()]
    public function questionsCount()
    {
        return (new DashboardService($this->startDate, $this->endDate))
            ->getMessagesCountByType(type: array_flip(Contact::TYPES)['Question']);
    }

    #[Computed()]
    public function questionsReadCount()
    {
        return (new DashboardService($this->startDate, $this->endDate))
            ->getMessagesCountByType(type: array_flip(Contact::TYPES)['Question'], is_read: 1);
    }

    #[Computed()]
    public function questionsUnReadCount()
    {
        return (new DashboardService($this->startDate, $this->endDate))
            ->getMessagesCountByType(type: array_flip(Contact::TYPES)['Question'], is_read: 0);
    }

    // ############################### Suggestions #############################

    // ############################### Other #############################

    #[Computed()]
    public function otherCount()
    {
        return (new DashboardService($this->startDate, $this->endDate))
            ->getMessagesCountByType(type: array_flip(Contact::TYPES)['Other']);
    }

    #[Computed()]
    public function otherReadCount()
    {
        return (new DashboardService($this->startDate, $this->endDate))
            ->getMessagesCountByType(type: array_flip(Contact::TYPES)['Other'], is_read: 1);
    }

    #[Computed()]
    public function otherUnReadCount()
    {
        return (new DashboardService($this->startDate, $this->endDate))
            ->getMessagesCountByType(type: array_flip(Contact::TYPES)['Other'], is_read: 0);
    }

    // ############################### Other #############################

    // ############################### Pending #############################

    #[Computed()]
    public function pendingCount()
    {
        return (new DashboardService($this->startDate, $this->endDate))
            ->getMessagesCountByStatus(status: array_flip(Contact::STATUSES)['Pending']);
    }

    #[Computed()]
    public function pendingReadCount()
    {

        return (new DashboardService($this->startDate, $this->endDate))
            ->getMessagesCountByStatus(status: array_flip(Contact::STATUSES)['Pending'], is_read: 1);
    }

    #[Computed()]
    public function pendingUnReadCount()
    {
        return (new DashboardService($this->startDate, $this->endDate))
            ->getMessagesCountByStatus(status: array_flip(Contact::STATUSES)['Pending'], is_read: 0);
    }

    // ############################### Pending #############################

    // ############################### In Process #############################

    #[Computed()]
    public function inProcessCount()
    {
        return (new DashboardService($this->startDate, $this->endDate))
            ->getMessagesCountByStatus(status: array_flip(Contact::STATUSES)['In Progress']);
    }

    #[Computed()]
    public function inProcessReadCount()
    {

        return (new DashboardService($this->startDate, $this->endDate))
            ->getMessagesCountByStatus(status: array_flip(Contact::STATUSES)['In Progress'], is_read: 1);
    }

    #[Computed()]
    public function inProcessUnReadCount()
    {
        return (new DashboardService($this->startDate, $this->endDate))
            ->getMessagesCountByStatus(status: array_flip(Contact::STATUSES)['In Progress'], is_read: 0);
    }

    // ############################### In Process #############################

    // ############################### Completed #############################

    #[Computed()]
    public function completedCount()
    {
        return (new DashboardService($this->startDate, $this->endDate))
            ->getMessagesCountByStatus(status: array_flip(Contact::STATUSES)['Completed']);
    }

    #[Computed()]
    public function completedReadCount()
    {

        return (new DashboardService($this->startDate, $this->endDate))
            ->getMessagesCountByStatus(status: array_flip(Contact::STATUSES)['Completed'], is_read: 1);
    }

    #[Computed()]
    public function completedUnReadCount()
    {
        return (new DashboardService($this->startDate, $this->endDate))
            ->getMessagesCountByStatus(status: array_flip(Contact::STATUSES)['Completed'], is_read: 0);
    }

    // ############################### Completed #############################

    // ############################### Resolved #############################

    #[Computed()]
    public function resolvedCount()
    {
        return (new DashboardService($this->startDate, $this->endDate))
            ->getMessagesCountByStatus(status: array_flip(Contact::STATUSES)['Resolved']);
    }

    #[Computed()]
    public function resolvedReadCount()
    {

        return (new DashboardService($this->startDate, $this->endDate))
            ->getMessagesCountByStatus(status: array_flip(Contact::STATUSES)['Resolved'], is_read: 1);
    }

    #[Computed()]
    public function resolvedUnReadCount()
    {
        return (new DashboardService($this->startDate, $this->endDate))
            ->getMessagesCountByStatus(status: array_flip(Contact::STATUSES)['Resolved'], is_read: 0);
    }

    // ############################### Resolved #############################

    public function reender()
    {
        return $this->usersCount();
    }

    public function render()
    {
        return view('livewire.admin.dashboard')
            ->title(__('Admin Dashboard'));
    }
}
