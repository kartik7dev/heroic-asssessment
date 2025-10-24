<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BreachEvent;

class BreachEventController extends Controller
{
    public function index($identity = null)
    {
        $query = BreachEvent::with('identity');

        if ($identity && $identity !== 'all') {
            $query->where('identity_id', $identity);
        }

        $events = $query->orderBy('date', 'desc')->get();

        // Format the response nicely
        $data = $events->map(function ($event) {
            return [
                'id' => $event->id,
                'identity' => [
                    'id' => $event->identity->id,
                    'email' => $event->identity->email,
                ],
                'source' => $event->source,
                'date' => $event->date->toDateString(),
                'severity' => $event->severity,
                'status' => $event->status,
                'data_types' => is_array($event->data_types) ? $event->data_types : [$event->data_types],
                'endpoint' => $event->endpoint,
            ];
        });

        return response()->json([
            'success' => true,
            'count' => $events->count(),
            'data' => $data,
        ]);
    }
}
