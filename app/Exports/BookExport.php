<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Book::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'Category',
            'Cover Book',
            'Author',
            'Publisher',
            'Year',
            'Pages',
            'Description',
            'File PDF',
            'Status',
            'Created At',
            'Updated At',
        ];
    }
}
