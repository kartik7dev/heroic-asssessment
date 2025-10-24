<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;

class HeroicDashboard extends Component
{
    use WithPagination;

    public $selectedIdentity = 'all';
    public $identities;

    // Remove public $records

    public function mount()
    {
        $this->identities = collect([
            (object)['id' => 1, 'email' => 'emma.rodriguez@heroic.com'],
            (object)['id' => 2, 'email' => 'alex.turner@heroic.com'],
            (object)['id' => 3, 'email' => 'david.kim@heroic.com'],
        ]);
    }

    public function updatingSelectedIdentity()
    {
        $this->resetPage(); // reset pagination when identity changes
    }

    public function getRecordsProperty()
    {
        $data = collect([
            (object) [
                'identity_id' => 1,
                'identity' => (object) ['email' => 'emma.rodriguez@heroic.com'],
                'source' => 'dropbox.com',
                'date' => now()->subDays(2),
                'severity' => 'High',
                'status' => 'Resolved',
                'data_types' => 'Emails, Passwords',
                'endpoint' => 'https://dropbox.com/breach'
            ],
            (object) [
                'identity_id' => 2,
                'identity' => (object) ['email' => 'alex.turner@heroic.com'],
                'source' => 'linkedin.com',
                'date' => now()->subDays(10),
                'severity' => 'Medium',
                'status' => 'Unresolved',
                'data_types' => 'Profiles, Emails',
                'endpoint' => 'https://linkedin.com/breach'
            ]
        ]);

        if ($this->selectedIdentity !== 'all') {
            $data = $data->filter(fn($item) => $item->identity_id == $this->selectedIdentity);
        }

        $page = Paginator::resolveCurrentPage('page'); // current page from Livewire pagination magic
        $perPage = 10;
        $items = $data->forPage($page, $perPage);
        return new LengthAwarePaginator(
            $items->values(),
            $data->count(),
            $perPage,
            $page,
            ['path' => url('/'), 'pageName' => 'page']
        );
    }

    public function render()
    {
        return view('livewire.heroic-dashboard', [
            'records' => $this->records,
        ])->layout('layouts.app');
    }
}
