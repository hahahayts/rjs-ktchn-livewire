<?php

namespace App\Livewire\AdminPage;

use App\Models\User;
use Livewire\Component;

class ManageUsersPage extends Component
{
    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    public $showDeleteModal = false;
    public $userIdBeingDeleted = null;

    protected $listeners = ['refresh' => '$refresh'];

    public function updatingSearch()
    {
        // Optional: clear pagination or filters here
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function confirmUserDeletion($userId)
    {
        $this->userIdBeingDeleted = $userId;
        $this->showDeleteModal = true;
    }

    public function deleteUser()
    {
        $user = User::findOrFail($this->userIdBeingDeleted);
        $user->delete();

        $this->closeDeleteModal();
        // Removed: dispatchBrowserEvent
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->userIdBeingDeleted = null;
    }

    public function render()
    {
        $users = User::query()
            ->whereHas('roles', function ($query) {
                $query->where('name', 'user');
            })
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                          ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->get();

        return view('livewire.admin-page.manage-users-page', [
            'users' => $users,
        ]);
    }
}
