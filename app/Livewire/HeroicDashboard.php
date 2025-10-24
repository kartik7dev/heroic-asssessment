<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Identity;
use App\Models\BreachEvent;

class HeroicDashboard extends Component
{
   use WithPagination;

    public $selectedIdentity = 'all';
    public $identities;

    public function mount()
    {
        $this->identities = Identity::all();
    }

    public function updatingSelectedIdentity()
    {
        $this->resetPage();
    }

    public function getRecordsProperty()
    {
        $query = BreachEvent::with('identity');

        if ($this->selectedIdentity !== 'all') {
            $query->where('identity_id', $this->selectedIdentity);
        }

        return $query->paginate(10);
    }

    public function getResolutionStatsProperty()
    {
        $query = BreachEvent::query();

        if ($this->selectedIdentity !== 'all') {
            $query->where('identity_id', $this->selectedIdentity);
        }

        return [
            'resolved' => $query->where('status', 'Resolved')->count(),
            'unresolved' => $query->where('status', 'Unresolved')->count(),
        ];
    }

    public function getSeverityStatsProperty()
    {
        $query = BreachEvent::query();

        if ($this->selectedIdentity !== 'all') {
            $query->where('identity_id', $this->selectedIdentity);
        }

        return [
            'Critical' => $query->where('severity', 'Critical')->count(),
            'High' => $query->where('severity', 'High')->count(),
            'Medium' => $query->where('severity', 'Medium')->count(),
            'Low' => $query->where('severity', 'Low')->count(),
        ];
    }

    public function render()
    {
        return view('livewire.heroic-dashboard', [
            'records' => $this->records,
            'resolutionStats' => $this->resolutionStats,
            'severityStats' => $this->severityStats,
        ])->layout('layouts.app');
    }
}
