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
        $baseQuery = BreachEvent::query();

        if ($this->selectedIdentity !== 'all') {
            $baseQuery->where('identity_id', $this->selectedIdentity);
        }

        return [
            'resolved' => (clone $baseQuery)->where('status', 'Resolved')->count(),
            'unresolved' => (clone $baseQuery)->where('status', 'Unresolved')->count(),
        ];
    }

    public function getSeverityStatsProperty()
    {
        $baseQuery = BreachEvent::query();

        if ($this->selectedIdentity !== 'all') {
            $baseQuery->where('identity_id', $this->selectedIdentity);
        }

        return [
            'Critical' => (clone $baseQuery)->where('severity', 'Critical')->count(),
            'High' => (clone $baseQuery)->where('severity', 'High')->count(),
            'Medium' => (clone $baseQuery)->where('severity', 'Medium')->count(),
            'Low' => (clone $baseQuery)->where('severity', 'Low')->count(),
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

    protected $listeners = ['refreshCharts' => '$refresh'];

    public function updatedSelectedIdentity()
    {
        $this->resetPage();
        $this->emit('refreshCharts', [
            'resolution' => array_values($this->resolutionStats),
            'severity' => array_values($this->severityStats),
        ]);
    }

}
