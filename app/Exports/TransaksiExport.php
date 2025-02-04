<?php

namespace App\Exports;

use App\Models\Checkout;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransaksiExport implements FromCollection, WithHeadings, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Checkout::select('id', 'kode_transaksi', 'total_amount', 'payment_status', 'tanggal_pembayaran', 'status_pengiriman', 'alamat_pengiriman')->get();
    }

    /**
     * Menentukan header untuk file Excel
     */
    public function headings(): array
    {
        return ["ID", "Kode Transaksi", "Total Harga", "Status Pembayaran", "Tgl Pembayaran", "Status Pengiriman", "Alamat"];
    }

    /**
     * Menambahkan gaya pada header
     */
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFF'],
                'size' => 10,
                'allCaps' => true,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => '808080',
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ]);

        $sheet->mergeCells('A1:F1');
        $sheet->setCellValue('A1', 'Data Transaksi Masuk UD WIJOYO');

        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'size' => 12,
            ],
        ]);

        return [
            'A' => ['alignment' => ['horizontal' => 'center']],
        ];
    }

    public function startCell(): string
    {
        return 'A3';
    }
}
