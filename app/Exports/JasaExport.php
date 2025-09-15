<?php

namespace App\Exports;

use App\Models\Jasa;
use App\Models\Orders;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class JasaExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Orders::with('user', 'teknisi', 'manageService')->withoutGlobalScopes()->get();
    }

    public function map($order): array
    {
        return [
            str_pad($order->id, 5, '0', STR_PAD_LEFT),
            $order->user->name,
            $order->manageService->name,
            $order->status,
            $order->teknisi ? $order->teknisi->name : 'Belum di Tugaskan',
            $order->created_at->format('Y-m-d'),
            $order->finish_time,
            $order->finish_time,
        ];
    }

    public function headings(): array
    {
        return [
            'ID Pesanan',
            'Pelanggan',
            'Jasa',
            'Status',
            'Teknisi',
            'Tanggal Pesan',
            'Tanggal Selesai',
            'Total Harga',
        ];
    }
}
