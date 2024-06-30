<?php

namespace App\DataTables;

use App\Models\Hero;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class HeroDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('image', function ($data) {
                return '<img src="' . asset('storage/' . $data->image) . '" alt="Image" width="100">';
            })
            ->editColumn('actions', function ($row) {
                $action = "<button class='btn btn-warning btn-sm me-1 action' data-id='$row->id' data-jenis='edit' title='Edit'><i class='fa-regular fa-pen-to-square'></i></button>";
                $action .= "<button class='btn btn-danger btn-sm action' data-id='$row->id' data-jenis='delete' title='Delete'><i class='fa-sharp fa-solid fa-trash'></i></button>";
                return $action;
            })
            ->rawColumns(['actions', 'status', 'image']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Hero $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Hero $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('hero-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->buttons(
                'copy',
                'csv',
                'excel',
                'pdf',
                'print'
            );
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')
                ->title('No')
                ->width(25)
                ->addClass('dt-center align-text-top'),
            Column::make('image')
                ->title(__('Image'))
                ->orderable(false)
                ->width(180)
                ->searchable(false)
                ->addClass('dt-center align-text-top'),
            Column::make('title')->title(__('Title'))->addClass('dt-center align-text-top'),
            Column::make('deskripsi')->title(__('Deskripsi'))->addClass('dt-center align-text-top'),
            Column::make('button')->title(__('Button'))->addClass('dt-center align-text-top'),
            Column::computed('actions')
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('dt-center align-text-top')
                ->title(__('Action')),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Hero_' . date('YmdHis');
    }
}
