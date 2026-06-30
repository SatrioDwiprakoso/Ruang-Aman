<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function generate(Report $report)
    {
        $report->load(['category', 'user', 'evidences', 'feedbackResponses.admin']);

        $nomorSurat = $this->generateNomorSurat($report);

        $data = [
            'report' => $report,
            'nomor_surat' => $nomorSurat,
            'tanggal' => now()->locale('id')->translatedFormat('d F Y'),
            'kepsek' => 'Dr. Ellena Gracia, M.Pd.',
            'nip_kepsek' => '196805121993032003',
        ];

        $pdf = Pdf::loadView('surat.pdf-template', $data);
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption('isRemoteEnabled', true);

        return $pdf->stream('Surat_Pengaduan_' . $report->tracking_token . '.pdf');
    }

    private function generateNomorSurat(Report $report): string
    {
        $month = $report->created_at->format('m');
        $year = $report->created_at->format('Y');
        $seq = str_pad($report->id_report, 3, '0', STR_PAD_LEFT);
        return "421.1/" . $seq . "/LAPOR/" . $month . "/" . $year;
    }
}