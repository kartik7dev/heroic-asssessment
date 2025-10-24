<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Identity;
use Livewire\Attributes\Computed;
use App\Models\BreachEvent;

class HeroicDashboard extends Component
{
   use WithPagination;

   protected $paginationTheme = 'bootstrap';

    public $selected = 'all';
    public $identities;
    public array $resolutionStats = [];
    public array $severityStats = [];

    public function mount()
    {
        $this->identities = Identity::all();
        $this->updateStats();
    }

    public function updatedSelected($value)
    {
        $this->updateStats();
        $this->dispatch('refreshCharts', [
            'resolution' => array_values($this->resolutionStats),
            'severity' => array_values($this->severityStats),
        ]);
    }

    protected function updateStats(): void
    {
        $baseQuery = BreachEvent::query();

        if ($this->selected !== 'all') {
            $baseQuery->where('identity_id', $this->selected);
        }
        
        $this->resolutionStats = [
            'resolved' => (clone $baseQuery)->where('status', 'Resolved')->count(),
            'unresolved' => (clone $baseQuery)->where('status', 'Unresolved')->count(),
        ];
        
        $this->severityStats = [
            'Critical' => (clone $baseQuery)->where('severity', 'Critical')->count(),
            'High' => (clone $baseQuery)->where('severity', 'High')->count(),
            'Medium' => (clone $baseQuery)->where('severity', 'Medium')->count(),
            'Low' => (clone $baseQuery)->where('severity', 'Low')->count(),
        ];
    }

    #[Computed]
    public function getRecordsProperty()
    {
        $query = BreachEvent::with('identity');

        if ($this->selected !== 'all') {
            $query->where('identity_id', $this->selected);
        }

        return $query->paginate(10);
    }

    public function render()
    {
        return view('livewire.heroic-dashboard', [
            'records' => $this->records,
            'resolutionStats' => $this->resolutionStats,
            'severityStats' => $this->severityStats,
        ]);
    }
}
