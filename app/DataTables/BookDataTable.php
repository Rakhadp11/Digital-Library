<?php

namespace App\DataTables;

use App\Models\Book;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BookDataTable extends DataTable
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
            ->editColumn('cover_image', function ($data) {
                return '<img src="' . asset('storage/' . $data->cover_image) . '" alt="Image" width="100">';
            })
            ->editColumn('pdf_file', function ($data) {
                if (empty($data->pdf_file)) {
                    return '<span style="color: #ff0000;">PDF tidak tersedia</span>';
                } else {
                    return '<a href="' . asset('storage/' . $data->pdf_file) . '" target="_blank"><i class="fa-regular fa-file-pdf fa-3x" style="color: #ff0000;"></i> View PDF</a>';
                }
            })
            ->editColumn('actions', function ($row) {
                $action = "<button class='btn btn-warning btn-sm me-1 action' data-id='$row->id' data-jenis='edit' title='Edit'><i class='fa-regular fa-pen-to-square'></i></button>";
                $action .= "<button class='btn btn-danger btn-sm action' data-id='$row->id' data-jenis='delete' title='Delete'><i class='fa-sharp fa-solid fa-trash'></i></button>";
                return $action;
            })
            ->editColumn('is_available', function ($row) {
                $status = $row->is_available ? 'Available' : 'Not Available';
                $btnClass = $row->is_available ? 'btn-success' : 'btn-danger';
                return '<button class="btn ' . $btnClass . ' btn-sm toggle-availability" id="toggle-availability" data-id="' . $row->id . '">' . $status . '</button>';
            })
            ->rawColumns(['actions', 'is_available', 'cover_image', 'pdf_file']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Book $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Book $model): QueryBuilder
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
            ->setTableId('book-table')
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
            Column::make('cover_image')
                ->title(__('Image'))
                ->orderable(false)
                ->width(180)
                ->searchable(false)
                ->addClass('dt-center align-text-top'),
            Column::make('pdf_file')
                ->title(__('File PDF'))
                ->orderable(false)
                ->searchable(false)
                ->addClass('dt-center align-text-top'),
            Column::make('title')->title(__('Title'))->addClass('dt-center align-text-top'),
            Column::make('category')->title(__('Category'))->addClass('dt-center align-text-top'),
            Column::make('author')->title(__('Author'))->addClass('dt-center align-text-top'),
            Column::make('author')->title(__('Author'))->addClass('dt-center align-text-top'),
            Column::make('publisher')->title(__('publisher'))->addClass('dt-center align-text-top'),
            Column::make('year')->title(__('year'))->addClass('dt-center align-text-top'),
            Column::make('pages')->title(__('pages'))->addClass('dt-center align-text-top'),
            Column::make('description')->title(__('description'))->addClass('dt-center align-text-top'),
            Column::make('is_available')->title(__('is_available'))->addClass('dt-center align-text-top'),
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
        return 'Book_' . date('YmdHis');
    }
}
