<div>
    
    <!-- Dropdown Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">HEROIC Cyber Breach Data</h4>
        <select wire:model="selectedIdentity" class="form-select w-auto">
            <option value="all">All Identities</option>
            @foreach($identities as $identity)
                <option value="{{ $identity->id }}">{{ $identity->email }}</option>
            @endforeach
        </select>
    </div>

    <!-- Table Section -->
    <div class="table-responsive mb-5">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>IDENTITY</th>
                    <th>SOURCE</th>
                    <th>DATE</th>
                    <th>SEVERITY</th>
                    <th>STATUS</th>
                    <th>DATA TYPES</th>
                    <th>ENDPOINT</th>
                </tr>
            </thead>
            <tbody>
                @forelse($records as $record)
                    <tr>
                        <td>{{ $record->identity->email }}</td>
                        <td>{{ $record->source }}</td>
                        <td>{{ $record->date->format('m-d-Y') }}</td>
                        <td>{{ $record->severity }}</td>
                        <td>{{ $record->status }}</td>
                        <td>{{ $record->data_types }}</td>
                        <td><a href="{{ $record->endpoint }}" target="_blank">{{ $record->endpoint }}</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">No records found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $records->links() }}
    </div>

    <!-- Charts Section -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="p-4 bg-white shadow-sm rounded">
                <h6 class="fw-semibold mb-3">Resolution Progress</h6>
                <canvas id="resolutionChart"></canvas>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="p-4 bg-white shadow-sm rounded">
                <h6 class="fw-semibold mb-3">Severity Overview</h6>
                <canvas id="severityChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function () {
        const resolutionCtx = document.getElementById('resolutionChart');
        const severityCtx = document.getElementById('severityChart');

        // Example dummy chart data
        const resolutionChart = new Chart(resolutionCtx, {
            type: 'doughnut',
            data: {
                labels: ['Resolved', 'Unresolved'],
                datasets: [{
                    data: [70, 30],
                    backgroundColor: ['#28a745', '#dc3545']
                }]
            }
        });

        const severityChart = new Chart(severityCtx, {
            type: 'bar',
            data: {
                labels: ['Critical', 'High', 'Medium', 'Low'],
                datasets: [{
                    label: 'Breach Count',
                    data: [12, 24, 36, 18],
                    backgroundColor: ['#dc3545', '#fd7e14', '#ffc107', '#198754']
                }]
            },
            options: { scales: { y: { beginAtZero: true } } }
        });
    });
</script>
