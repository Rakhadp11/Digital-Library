<?php

namespace App\Exports;

use App\Models\ReturnBook;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReturnBookExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ReturnBook::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Book_id',
            'User_id',
            'Borrowed_at',
            'Returned_at',
            'Created At',
            'Updated At',
        ];
    }
}
