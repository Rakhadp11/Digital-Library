<?php

namespace App\Exports;

use App\Models\ExploreFeature;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExploreFeatureExport implements FromCollection
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
