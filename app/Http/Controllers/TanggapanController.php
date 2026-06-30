<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTanggapanRequest;
use App\Models\FeedbackResponse;
use App\Models\Notification;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TanggapanController extends Controller
{
    public function store(StoreTanggapanRequest $request, Report $report)
    {
        $feedback = FeedbackResponse::create([
            'report_id' => $report->id_report,
            'admin_id' => Auth::id(),
            'response_text' => $request->response_text,
        ]);

        $report->update(['status' => $request->status]);

        Notification::create([
            'user_id' => $report->user_id,
            'message' => "Pengaduan Anda \"{$report->title}\" telah diperbarui menjadi status \"{$request->status}\". Tim BK telah memberikan tanggapan baru.",
            'is_read' => false,
        ]);

        return back()->with('success', 'Tanggapan berhasil dikirim dan notifikasi telah dikirim ke pelapor.');
    }
}