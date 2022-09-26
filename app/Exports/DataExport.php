<?php

namespace App\Exports;

use App\Models\Data;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Data::all();
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return [
            "id","tanggal", "nama_instansi", "nama_lokasi","nama_teknisi",
            "produk","warranty","priority","jobdesk","deskripsi","status",
            "item","tgl_pengiriman","status_pengiriman","tgl_kembali","status_kembali",
            "created_at","updated_at"
        ];
    }
}
