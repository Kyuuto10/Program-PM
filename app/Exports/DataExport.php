<?php

namespace App\Exports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Project::all();
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
            "item","tgl_pengiriman","status1","tgl_kembali","status2",
            "created_at","updated_at"
        ];
    }
}
