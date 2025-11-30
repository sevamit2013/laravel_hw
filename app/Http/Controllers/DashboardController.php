<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Base query for tickets
        $ticketsQuery = Ticket::query();
        
        // Filter based on role
        if (!$user->hasAnyRole(['hw-admin', 'hw-subadmin', 'superadmin'])) {
            $ticketsQuery->where('created_by', $user->id);
        }
        
        // Ticket status summary
        $statusSummary = (clone $ticketsQuery)
            ->select('status_id', DB::raw('count(*) as count'))
            ->with('ticket_status')
            ->groupBy('status_id')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->ticket_status->name => $item->count];
            });
        
        // Department-wise ticket counts
        $departmentStats = (clone $ticketsQuery)
            ->select('loc_code', DB::raw('count(*) as count'))
            ->with('location')
            ->groupBy('loc_code')
            ->get()
            ->map(function ($item) {
                return [
                    'department' => $item->location->location_name,
                    'count' => $item->count
                ];
            });
        
        // Monthly tickets (current year)
        $monthlyTickets = (clone $ticketsQuery)
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('count(*) as count')
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('count', 'month');
        
        // Dashboard metrics
        $totalTickets = (clone $ticketsQuery)->count();
        $openTickets = (clone $ticketsQuery)
            ->whereHas('ticket_status', function ($q) {
                $q->where('name', 'Open');
            })
            ->count();
        $closedTickets = (clone $ticketsQuery)
            ->where('is_closed', true)
            ->count();
        $lateTickets = (clone $ticketsQuery)
            ->where('due_date', '<', now())
            ->where('is_closed', false)
            ->count();
        
        // Pending tickets
        $pendingTickets = (clone $ticketsQuery)
            ->whereHas('ticket_status', function ($q) {
                $q->where('name', '!=', 'Closed');
            })
            ->count();
        
        return view('dashboard', compact(
            'statusSummary',
            'departmentStats',
            'monthlyTickets',
            'totalTickets',
            'openTickets',
            'closedTickets',
            'lateTickets',
            'pendingTickets'
        ));
    }
}