<?php

namespace App\DataTables\Reports;

use App\Models\FarmMember;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FarmerDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('created_at', function (FarmMember $farmer) {
                return $farmer->created_at->format('F d, Y');
            })
            ->editColumn('fname', function (FarmMember $farmer) {
                return $farmer->fullname;
            })
            ->setTotalRecords(-1)
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(FarmMember $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('farmer-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrt')
            ->orderBy(0)
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
            Column::make(['data' => 'created_at', 'title' => 'Registered Date']),
            Column::make(['data' => 'fname', 'title' => 'Farmer Name']),
            Column::make(['data' => 'contact_number', 'title' => 'Contact Number']),
            Column::make(['data' => 'barangay', 'title' => 'Barangay']),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Farmer_' . date('YmdHis');
    }
}
