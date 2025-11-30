<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function monthly(Request $request)
    {
        $year = $request->get('year', date('Y'));
        $month = $request->get('month', date('m'));
        
        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        $endDate = Carbon::create($year, $month, 1)->endOfMonth();
        
        $tickets = Ticket::with(['ticket_status', 'priority', 'createdBy', 'assignedTo', 'location'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();
        
        $stats = [
            'total' => $tickets->count(),
            'open' => $tickets->where('ticket_status.name', 'Open')->count(),
            'closed' => $tickets->where('is_closed', true)->count(),
            'late' => $tickets->filter(function($ticket) {
                return $ticket->isLate();
            })->count(),
        ];
        
        return view('reports.monthly', compact('tickets', 'stats', 'year', 'month'));
    }

    public function pending()
    {
        $tickets = Ticket::with(['ticket_status', 'priority', 'createdBy', 'assignedTo', 'location'])
            ->where('is_closed', false)
            ->orderBy('due_date', 'asc')
            ->get();
        
        return view('reports.pending', compact('tickets'));
    }

    public function completed(Request $request)
    {
        $startDate = $request->get('start_date', now()->subMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', now()->format('Y-m-d'));
        
        $tickets = Ticket::with(['ticket_status', 'priority', 'createdBy', 'assignedTo', 'location'])
            ->where('is_closed', true)
            ->whereBetween('updated_at', [$startDate, $endDate])
            ->orderBy('updated_at', 'desc')
            ->get();
        
        return view('reports.completed', compact('tickets', 'startDate', 'endDate'));
    }

    public function seekerWise()
    {
        $seekerStats = Ticket::select('seeker_name', DB::raw('count(*) as total'))
            ->selectRaw('SUM(CASE WHEN is_closed = 1 THEN 1 ELSE 0 END) as closed')
            ->selectRaw('SUM(CASE WHEN is_closed = 0 THEN 1 ELSE 0 END) as open')
            ->groupBy('seeker_name')
            ->orderBy('total', 'desc')
            ->get();
        
        return view('reports.seeker-wise', compact('seekerStats'));
    }

    public function departmentWise()
    {
        $departmentStats = Ticket::select('loc_code', DB::raw('count(*) as total'))
            ->selectRaw('SUM(CASE WHEN is_closed = 1 THEN 1 ELSE 0 END) as closed')
            ->selectRaw('SUM(CASE WHEN is_closed = 0 THEN 1 ELSE 0 END) as open')
            ->with('location')
            ->groupBy('loc_code')
            ->orderBy('total', 'desc')
            ->get();
        
        return view('reports.department-wise', compact('departmentStats'));
    }

    public function assigneeWise()
    {
        $assigneeStats = Ticket::select('assign_id', DB::raw('count(*) as total'))
            ->selectRaw('SUM(CASE WHEN is_closed = 1 THEN 1 ELSE 0 END) as closed')
            ->selectRaw('SUM(CASE WHEN is_closed = 0 THEN 1 ELSE 0 END) as open')
            ->selectRaw('AVG(actual_time_hours) as avg_time')
            ->whereNotNull('assign_id')
            ->with('assignedTo')
            ->groupBy('assign_id')
            ->orderBy('total', 'desc')
            ->get();
        
        return view('reports.assignee-wise', compact('assigneeStats'));
    }

    public function export(Request $request)
    {
        $type = $request->get('type', 'all');
        $format = $request->get('format', 'csv');
        
        $query = Ticket::with(['ticket_status', 'priority', 'createdBy', 'assignedTo', 'location']);
        
        switch($type) {
            case 'pending':
                $query->where('is_closed', false);
                break;
            case 'completed':
                $query->where('is_closed', true);
                break;
            case 'late':
                $query->where('is_closed', false)
                      ->where('due_date', '<', now());
                break;
        }
        
        $tickets = $query->get();
        
        if ($format === 'csv') {
            return $this->exportToCsv($tickets);
        } elseif ($format === 'pdf') {
            return $this->exportToPdf($tickets);
        }
        
        return redirect()->back()->with('error', 'Invalid export format');
    }

    private function exportToCsv($tickets)
    {
        $filename = 'tickets_' . date('Y-m-d_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];
        
        $callback = function() use ($tickets) {
            $file = fopen('php://output', 'w');
            
            // Headers
            fputcsv($file, [
                'Ticket ID',
                'Title',
                'Status',
                'Priority',
                'Department',
                'Seeker',
                'Assigned To',
                'Created Date',
                'Due Date',
                'Closed Date'
            ]);
            
            // Data
            foreach ($tickets as $ticket) {
                fputcsv($file, [
                    $ticket->tkt_id,
                    $ticket->title,
                    $ticket->ticket_status->name,
                    $ticket->priority->name,
                    $ticket->location->location_name,
                    $ticket->seeker_name,
                    $ticket->assignedTo ? $ticket->assignedTo->name : 'Unassigned',
                    $ticket->created_at->format('Y-m-d H:i:s'),
                    $ticket->due_date->format('Y-m-d'),
                    $ticket->is_closed ? $ticket->updated_at->format('Y-m-d H:i:s') : 'N/A'
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    private function exportToPdf($tickets)
    {
        // For PDF export, you would integrate with a library like DomPDF or mPDF
        // This is a placeholder implementation
        return redirect()->back()->with('info', 'PDF export is under development');
    }
}