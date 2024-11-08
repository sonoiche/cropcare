<?php

namespace App\DataTables;

use App\Models\Association;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AssociationDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('created_at', function (Association $item) {
                return $item->created_at->format('F d, Y');
            })
            ->editColumn('fname', function (Association $item) {
                return $item->fname . ' ' . $item->mname . ' ' . $item->lname;
            })
            ->addColumn('action', 'admin.associations.action')
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Association $model): QueryBuilder
    {
        return $model->leftJoin('users','users.id','=','associations.president_id')
            ->select('associations.*','users.fname','users.mname','users.lname');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('association-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(0,'asc')
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make(['data' => 'name', 'title' => 'Association Name']),
            Column::make(['data' => 'fname', 'title' => 'President Name']),
            Column::make(['data' => 'created_at', 'title' => 'Created Date']),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Association_' . date('YmdHis');
    }
}
