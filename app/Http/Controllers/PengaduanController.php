<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePengaduanRequest;
use App\Models\Category;
use App\Models\Evidence;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    public function create()
    {
        $categories = Category::orderBy('weight_level', 'desc')->get();
        return view('pelapor.report.create', compact('categories'));
    }

    public function store(StorePengaduanRequest $request)
    {
        $trackingToken = generateTrackingToken();

        $report = Report::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'address' => $request->address,
            'chronology' => $request->chronology,
            'is_anonymous' => $request->boolean('is_anonymous'),
            'tracking_token' => $trackingToken,
            'status' => 'Pending',
            'created_at' => now(),
        ]);

        if ($request->hasFile('evidences')) {
            foreach ($request->file('evidences') as $file) {
                $path = $file->store('evidences/' . $report->id_report, 'public');
                Evidence::create([
                    'report_id' => $report->id_report,
                    'file_path' => $path,
                ]);
            }
        }

        return redirect()->route('pelapor.report.show', $report->id_report)
            ->with('success', "Pengaduan berhasil dikirim! Simpan token pelacakan Anda: <strong class='font-mono text-justice-dark'>" . $trackingToken . "</strong>");
    }

    public function index()
    {
        $query = Report::where('user_id', Auth::id())->with('category');

        if (request('status') && request('status') !== 'Semua') {
            $query->where('status', request('status'));
        }

        $reports = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('pelapor.report.index', compact('reports'));
    }

    public function show(Report $report)
    {
        if ($report->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $report->load(['category', 'evidences', 'feedbackResponses.admin']);
        return view('pelapor.report.show', compact('report'));
    }
}