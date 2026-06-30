<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <style>
        @page {
            margin: 25mm 20mm 25mm 30mm;
            size: A4;
        }

        * {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.6;
            color: #1a1a1a;
        }

        body {
            margin: 0;
            padding: 0;
        }

        .kop {
            border-bottom: 3px double #1a1a1a;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }

        .kop-header {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .kop-logo {
            width: 75px;
            height: 75px;
            border: 1px solid #1a1a1a;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .kop-logo-text {
            font-size: 10pt;
            font-weight: bold;
            text-align: center;
            color: #1a1a1a;
            line-height: 1.3;
        }

        .kop-title {
            text-align: center;
            flex: 1;
        }

        .kop-title h1 {
            font-size: 16pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 0;
            line-height: 1.2;
        }

        .kop-title h2 {
            font-size: 13pt;
            font-weight: bold;
            text-transform: uppercase;
            margin: 2px 0;
            line-height: 1.2;
        }

        .kop-title p {
            font-size: 10pt;
            margin: 2px 0;
            line-height: 1.3;
        }

        .nomor-surat {
            text-align: right;
            margin-bottom: 20px;
            font-size: 11pt;
        }

        .perihal {
            margin-bottom: 5px;
            font-size: 12pt;
        }

        .tujuan {
            margin-bottom: 20px;
            font-size: 12pt;
            line-height: 1.8;
        }

        .tujuan p {
            margin: 0;
        }

        .isi-surat {
            margin-bottom: 25px;
            text-align: justify;
        }

        .isi-surat p {
            margin: 0 0 10px 0;
            text-indent: 40px;
        }

        .isi-surat p.no-indent {
            text-indent: 0;
        }

        .detail-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            font-size: 11pt;
        }

        .detail-table td {
            padding: 6px 10px;
            vertical-align: top;
            border: none;
        }

        .detail-table .label {
            width: 160px;
            font-weight: bold;
        }

        .divider {
            border-top: 1px solid #1a1a1a;
            margin: 20px 0;
        }

        .penutup {
            text-align: justify;
            margin-bottom: 30px;
        }

        .penutup p {
            margin: 0 0 10px 0;
            text-indent: 40px;
        }

        .ttd-area {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .ttd-box {
            text-align: center;
            width: 250px;
        }

        .ttd-box p {
            margin: 0 0 5px 0;
        }

        .ttd-nama {
            font-weight: bold;
            text-decoration: underline;
            margin-top: 80px;
        }

        .ttd-nip {
            font-size: 10pt;
        }

        .badge-box {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 3px;
            font-size: 10pt;
            font-weight: bold;
        }

        .badge-berat {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-sedang {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-rendah {
            background: #dcfce7;
            color: #166534;
        }

        .catatan-box {
            border: 1px solid #1a1a1a;
            padding: 10px 15px;
            margin: 15px 0;
            font-size: 11pt;
            background: #f9fafb;
        }

        .lampiran {
            font-size: 11pt;
            margin-bottom: 20px;
        }

        .tembusan {
            font-size: 10pt;
            margin-top: 40px;
            line-height: 1.8;
        }
    </style>
</head>

<body>

    <!-- KOP SURAT -->
    <div class="kop">
        <div class="kop-header">
            <div class="kop-logo">
                <span class="kop-logo-text">LOGO<br>SEKOLAH</span>
            </div>
            <div class="kop-title">
                <h1>YAYASAN PENDIDIKAN NUSANTARA</h1>
                <h2>SMA Dirgantara</h2>
                <p>Jl. Pendidikan No. 123, Kecamatan Bogor Selatan, Kota Bogor, Provinsi Jawa Barat 45123</p>
                <p>Telp: (021) 123-4567 | Email: smandirgantara@sch.id | Website: www.smandirgantara.sch.id</p>
            </div>
        </div>
    </div>

    <!-- NOMOR SURAT -->
    <div class="nomor-surat">
        <p style="margin:0;"><strong>Nomor</strong>: {{ $nomor_surat }}</p>
        <p style="margin:0;"><strong>Lampiran</strong>:
            {{ $report->evidences->count() > 0 ? $report->evidences->count() . ' berkas' : '-' }}</p>
        <p style="margin:0;"><strong>Perihal</strong>: Laporan Pengaduan Perundungan / Pelanggaran Etik</p>
    </div>

    <!-- TUJUAN -->
    <div class="tujuan">
        <p>Yth. <strong>Kepala Dinas Pendidikan</strong></p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kota / Kabupaten Contoh</p>
        <p>di Tempat</p>
    </div>

    <!-- ISI SURAT -->
    <div class="isi-surat">
        <p>Selamat Pagi</p>
        <p>Yang bertanda tangan di bawah ini, Kepala SMA Dirgantaara Kota Bogor, dengan ini menyampaikan laporan resmi
            terkait kasus perundungan dan/atau pelanggaran etik yang terjadi di lingkungan sekolah kami, sebagaimana
            rincian berikut:</p>

        <table class="detail-table">
            <tr>
                <td class="label">Nomor Tiket</td>
                <td>: {{ $report->tracking_token }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Kejadian</td>
                <td>: {{ $report->created_at->locale('id')->translatedFormat('d F Y, H:i WIB') }}</td>
            </tr>
            <tr>
                <td class="label">Lokasi Kejadian</td>
                <td>: {{ $report->address }}</td>
            </tr>
            <tr>
                <td class="label">Kategori Kasus</td>
                <td>: {{ $report->category->category_name }}</td>
            </tr>
            <tr>
                <td class="label">Tingkat Urgensi</td>
                <td>: <span
                        class="badge-box badge-{{ strtolower($report->category->weight_level) }}">{{ $report->category->weight_level }}</span>
                </td>
            </tr>
            <tr>
                <td class="label">Status Saat Ini</td>
                <td>: <strong>{{ $report->status }}</strong></td>
            </tr>
            @if(!$report->is_anonymous)
                <tr>
                    <td class="label">Identitas Pelapor</td>
                    <td>: {{ $report->user->username }} ({{ $report->user->email }})</td>
                </tr>
            @else
                <tr>
                    <td class="label">Identitas Pelapor</td>
                    <td>: <em>Dilindungi (Anonim) sesuai amanat Permendikbud No. 82/2015</em></td>
                </tr>
            @endif
        </table>

        <p class="no-indent"><strong>Kronologi Kejadian:</strong></p>
        <p>{{ $report->chronology }}</p>

        @if($report->evidences->count() > 0)
            <div class="catatan-box">
                <strong>Bukti Pendukung:</strong> Terlampir {{ $report->evidences->count() }} berkas
                (foto/screenshot/dokumen) yang menjadi bagian tidak terpisahkan dari surat ini.
            </div>
        @endif

        @if($report->feedbackResponses->count() > 0)
            <p class="no-indent"><strong>Tindak Lanjut yang Telah Diambil:</strong></p>
            @foreach($report->feedbackResponses as $idx => $response)
                <p>{{ $idx + 1 }}. {{ $response->response_text }} (oleh {{ $response->admin->username }},
                    {{ $response->created_at->locale('id')->translatedFormat('d F Y') }})</p>
            @endforeach
        @endif

        <div class="penutup">
            <p>Demikian surat laporan ini kami sampaikan untuk dapat ditindaklanjuti sesuai dengan ketentuan peraturan
                perundang-undangan yang berlaku, khususnya Permendikbud Nomor 82 Tahun 2015 tentang Pencegahan dan
                Penanganan Kekerasan di Lingkungan Satuan Pendidikan serta Peraturan Menteri Pendidikan Nomor 70 Tahun
                2013 tentang Tata Tertib Pelajar.</p>
            <p>Atas perhatian dan kerjasamanya, kami ucapkan terima kasih.</p>
            <p></p>
        </div>
    </div>

    <!-- TANDA TANGAN -->
    <div class="ttd-area">
        <div class="ttd-box">
            <p>Kota Bogor, {{ $tanggal }}</p>
            <p>Kepala Sekolah,</p>
            <p class="ttd-nama">{{ $kepsek }}</p>
            <p class="ttd-nip">NIP. {{ $nip_kepsek }}</p>
        </div>
        <div class="ttd-box">
            <p>Contoh Kota, {{ $tanggal }}</p>
            <p>Ketua TPPK Sekolah,</p>
            <p class="ttd-nama">_________________________</p>
            <p class="ttd-nip">NIP. _________________________</p>
        </div>
    </div>

    <!-- TEMBUSAN -->
    <div class="tembusan">
        <p><strong>Tembusan:</strong></p>
        <p>1. Kepala Dinas Pendidikan Kota/Kab. Bogor</p>
        <p>2. Koordinator TPPK Provinsi Jawa Barat</p>
        <p>3. Arsip</p>
    </div>

</body>

</html>