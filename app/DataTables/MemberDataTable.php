<?php

namespace App\DataTables;

use App\Models\Member;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MemberDataTable extends DataTable
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
            ->editColumn('actions', function ($row) {
                $action = "<button class='btn btn-danger btn-sm action' data-id='$row->id' data-jenis='delete' title='Delete'><i class='fa-sharp fa-solid fa-trash'></i></button>";
                return $action;
            })
            ->editColumn('created_at', function ($member) {
                return $member->created_at->format('Y-m-d');
            })
            ->editColumn('updated_at', function ($member) {
                return $member->updated_at->format('Y-m-d');
            })
            ->rawColumns(['actions']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Member $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Member $model): QueryBuilder
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
            ->setTableId('member-table')
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
            Column::make('name')->title(__('Name'))->addClass('dt-center align-text-top'),
            Column::make('email')->title(__('Email'))->addClass('dt-center align-text-top'),
            Column::make('phone')->title(__('Phone'))->addClass('dt-center align-text-top'),
            Column::make('city')->title(__('City'))->addClass('dt-center align-text-top'),
            Column::make('address')->title(__('Address'))->addClass('dt-center align-text-top'),
            Column::make('study')->title(__('Study'))->addClass('dt-center align-text-top'),
            Column::make('created_at')->title(__('Created at'))->addClass('dt-center align-text-top'),
            Column::make('updated_at')->title(__('Updated at'))->addClass('dt-center align-text-top'),
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
        return 'Member_' . date('YmdHis');
    }
}
