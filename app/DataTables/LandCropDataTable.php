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

class LandCropDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setTotalRecords(-1)
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
            ->setTableId('landcrop-table')
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
            Column::make(['data' => 'created_at', 'title' => 'Date']),
            Column::make(['data' => 'name', 'title' => 'Association']),
            Column::make(['data' => 'status', 'title' => 'Status']),
            Column::make(['data' => 'crop_name', 'title' => 'Crop Name']),
            Column::make(['data' => 'crop_count', 'title' => 'Crop Count']),
            Column::make(['data' => 'crop_yield', 'title' => 'Crop Yield']),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'LandCrop_' . date('YmdHis');
    }
}
