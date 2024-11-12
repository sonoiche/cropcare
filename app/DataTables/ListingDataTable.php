<?php

namespace App\DataTables;

use App\Models\LandCrop;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ListingDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('created_at', function (LandCrop $item) {
                return $item->created_at->format('F d, Y');
            })
            ->editColumn('acre_value', function (LandCrop $item) {
                return 'P'.number_format($item->acre_value, 2);
            })
            ->addColumn('action', 'president.farms.action')
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(LandCrop $model): QueryBuilder
    {
        return $model->join('associations','associations.id','=','land_crops.association_id')
            ->select('land_crops.*','associations.name');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('listing-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
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
            Column::make(['data' => 'created_at', 'title' => 'Date Created']),
            Column::make(['data' => 'acres', 'title' => 'Acres'])
                ->addClass('text-center')
                ->searchable(false)
                ->orderable(false),
            Column::make(['data' => 'acre_value', 'title' => 'Acre Value']),
            Column::make(['data' => 'name', 'title' => 'Association', 'name' => 'associations.name']),
            Column::make(['data' => 'status', 'title' => 'Status'])
                ->addClass('text-center')
                ->searchable(false)
                ->orderable(false),
            Column::make(['data' => 'crop_name', 'title' => 'Crop Name']),
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
        return 'Listing_' . date('YmdHis');
    }
}
