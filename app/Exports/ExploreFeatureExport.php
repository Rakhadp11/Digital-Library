<?php

namespace App\Exports;

use App\Models\ExploreFeature;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExploreFeatureExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ExploreFeature::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'Deskripsi',
            'Card Title',
            'Card Deskripsi',
            'Button',
            'Image',
            'Created At',
            'Updated At',
        ];
    }
}
