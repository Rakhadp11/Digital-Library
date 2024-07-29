<?php

namespace App\DataTables;

use App\Models\Borrowing;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BorrowingDataTable extends DataTable
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
            ->addColumn('status', function ($borrowing) {
                return $borrowing->approved ?
                    '<span class="badge badge-success">Approved</span>' :
                    '<span class="badge badge-warning">Pending</span>';
            })
            ->addColumn('action', function ($borrowing) {
                return view('backend.borrowing.action', ['borrowing' => $borrowing])->render();
            })
            ->editColumn('created_at', function ($borrow) {
                return $borrow->created_at->format('Y-m-d');
            })
            ->editColumn('updated_at', function ($borrow) {
                return $borrow->updated_at->format('Y-m-d');
            })
            ->setRowId('id')
            ->rawColumns(['status', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Borrowing $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Borrowing $model): QueryBuilder
    {
        return $model->newQuery()->with('user', 'book');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('borrowing-table')
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
                ->addClass('dt-center align-text-top')
                ->exportable(false)
                ->printable(false),
            Column::make('id')->title('ID'),
            Column::make('user.name')->title('Nama'),
            Column::make('user.email')->title('Email'),
            Column::make('book.title')->title('Judul Buku'),
            Column::make('borrowed_at')->title('Tanggal Pinjam'),
            Column::make('returned_at')->title('Tanggal Kembali'),
            Column::computed('status')->title('Status')->exportable(false)->printable(false),
            Column::make('created_at')->title(__('Created at'))->addClass('dt-center align-text-top'),
            Column::make('updated_at')->title(__('Updated at'))->addClass('dt-center align-text-top'),
            Column::computed('action')->exportable(false)->printable(false)->width(120)->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Borrowing_' . date('YmdHis');
    }
}
