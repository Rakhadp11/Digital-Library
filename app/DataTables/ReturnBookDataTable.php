<?php

namespace App\DataTables;

use App\Models\ReturnBook;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ReturnBookDataTable extends DataTable
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
            ->addColumn('action', function ($row) {
                return view('backend.return-book.action', ['id' => $row->id])->render();
            })
            ->editColumn('created_at', function ($return) {
                return $return->created_at->format('Y-m-d');
            })
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ReturnBook $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ReturnBook $model): QueryBuilder
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
            ->setTableId('returnbook-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
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
            Column::make('book_id')->title(__('ID Buku'))->addClass('dt-center align-text-top'),
            Column::make('user_id')->title(__('ID User'))->addClass('dt-center align-text-top'),
            Column::make('borrowed_at')->title(__('Tanggal Pinjam'))->addClass('dt-center align-text-top'),
            Column::make('returned_at')->title(__('Tanggal Kembali'))->addClass('dt-center align-text-top'),
            Column::make('created_at')->title(__('Created at'))->addClass('dt-center align-text-top'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'ReturnBook_' . date('YmdHis');
    }
}
