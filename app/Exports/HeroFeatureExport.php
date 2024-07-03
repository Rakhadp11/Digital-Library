<?php

namespace App\Exports;

use App\Models\HeroFeature;
use Maatwebsite\Excel\Concerns\FromCollection;

class HeroFeatureExport implements FromCollection
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
