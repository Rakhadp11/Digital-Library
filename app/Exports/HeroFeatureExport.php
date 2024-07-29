<?php

namespace App\Exports;

use App\Models\HeroFeature;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HeroFeatureExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return HeroFeature::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'Button',
            'Created At',
            'Updated At',
        ];
    }
}
