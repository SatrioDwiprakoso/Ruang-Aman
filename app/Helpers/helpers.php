<?php

if (!function_exists('generateTrackingToken')) {
    function generateTrackingToken(): string
    {
        $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $part1 = substr(str_shuffle($characters), 0, 6);
        $part2 = date('ymd');
        return 'TKT-' . $part1 . '-' . $part2;
    }
}

if (!function_exists('statusColor')) {
    function statusColor(string $status): string
    {
        return match ($status) {
            'Pending' => 'amber',
            'Diproses' => 'blue',
            'Selesai' => 'emerald',
            'Ditolak' => 'red',
            default => 'slate',
        };
    }
}

if (!function_exists('weightColor')) {
    function weightColor(string $weight): string
    {
        return match ($weight) {
            'Rendah' => 'green',
            'Sedang' => 'amber',
            'Berat' => 'red',
            default => 'slate',
        };
    }
}

if (!function_exists('formatDate')) {
    function formatDate($date): string
    {
        if (!$date)
            return '-';
        return $date->locale('id')->translatedFormat('d F Y, H:i');
    }
}

if (!function_exists('weightStyle')) {
    function weightStyle(string $weight): string
    {
        return match ($weight) {
            'Rendah' => 'background:#22c55e; color:#ffffff; border-radius:50px; padding:3px 14px; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; display:inline-flex; align-items:center;',
            'Sedang' => 'background:#f59e0b; color:#ffffff; border-radius:50px; padding:3px 14px; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; display:inline-flex; align-items:center;',
            'Berat' => 'background:#ef4444; color:#ffffff; border-radius:50px; padding:3px 14px; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; display:inline-flex; align-items:center;',
            default => 'background:#94a3b8; color:#ffffff; border-radius:50px; padding:3px 14px; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; display:inline-flex; align-items:center;',
        };
    }
}

if (!function_exists('statusStyle')) {
    function statusStyle(string $status): string
    {
        return match ($status) {
            'Pending' => 'background:#f59e0b; color:#ffffff; border-radius:50px; padding:3px 14px; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; display:inline-flex; align-items:center;',
            'Diproses' => 'background:#3b82f6; color:#ffffff; border-radius:50px; padding:3px 14px; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; display:inline-flex; align-items:center;',
            'Selesai' => 'background:#10b981; color:#ffffff; border-radius:50px; padding:3px 14px; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; display:inline-flex; align-items:center;',
            'Ditolak' => 'background:#ef4444; color:#ffffff; border-radius:50px; padding:3px 14px; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; display:inline-flex; align-items:center;',
            default => 'background:#94a3b8; color:#ffffff; border-radius:50px; padding:3px 14px; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; display:inline-flex; align-items:center;',
        };
    }
}

if (!function_exists('anonimStyle')) {
    function anonimStyle(): string
    {
        return 'background:#dbeafe; color:#1d4ed8; border-radius:50px; padding:3px 14px; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; display:inline-flex; align-items:center; gap:5px;';
    }
}

if (!function_exists('weightBarColor')) {
    function weightBarColor(string $weight): string
    {
        return match ($weight) {
            'Rendah' => '#22c55e',
            'Sedang' => '#f59e0b',
            'Berat' => '#ef4444',
            default => '#cbd5e1',
        };
    }
}