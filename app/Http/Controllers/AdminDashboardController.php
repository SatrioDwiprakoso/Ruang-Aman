<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        $totalPending = Report::where('status', 'Pending')->count();
        $totalDiproses = Report::where('status', 'Diproses')->count();
        $totalSelesai = Report::where('status', 'Selesai')->count();
        $totalDitolak = Report::where('status', 'Ditolak')->count();
        $totalKasus = Report::count();

        $chartData = Category::withCount([
            'reports' => function ($q) {
                $q->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
            }
        ])->orderBy('reports_count', 'desc')->get();

        $recentReports = Report::with(['category', 'user'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalPending',
            'totalDiproses',
            'totalSelesai',
            'totalDitolak',
            'totalKasus',
            'chartData',
            'recentReports'
        ));
    }

    public function reports()
    {
        $query = Report::with(['category', 'user']);

        if (request('status') && request('status') !== 'Semua') {
            $query->where('status', request('status'));
        }
        if (request('search')) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('tracking_token', 'like', '%' . request('search') . '%');
        }

        $reports = $query->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.report.index', compact('reports'));
    }

    public function showReport(Report $report)
    {
        $report->load(['category', 'user', 'evidences', 'feedbackResponses.admin']);
        return view('admin.report.show', compact('report'));
    }
}