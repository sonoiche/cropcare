<?php

namespace App\DataTables;

use App\Models\Geographic;
use Carbon\Carbon;
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
            ->editColumn('created_at', function (Geographic $land) {
                return $land->created_at->format('F d, Y');
            })
            ->editColumn('fname', function (Geographic $land) {
                return $land->fname . ' '.$land->mname.' ' . $land->lname . ' ' . $land->suffix;
            })
            ->setTotalRecords(-1)
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Geographic $model): QueryBuilder
    {
        $daterange      = $this->daterange;
        $president_id   = $this->president_id;
        return $model->leftJoin('associations', 'associations.id', '=', 'geographics.association_id')
            ->leftJoin('farm_members','farm_members.id','=','geographics.farmer_id')
            ->select('geographics.*', 'associations.name', 'farm_members.fname','farm_members.lname','farm_members.mname')
            ->when($daterange, function ($query, $daterange) {
                $date = explode('-', $daterange);
                $from = Carbon::parse($date[0])->format('Y-m-d');
                $to   = Carbon::parse($date[1])->format('Y-m-d');
                return $query->whereRaw("date(geographics.created_at) between ? and ?", [$from, $to]);
            })
            ->when($president_id, function ($query, $president_id) {
                return $query->where('geographics.president_id', $president_id);
            });
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
            Column::make(['data' => 'fname', 'title' => 'Farmer\'s Name']),
            Column::make(['data' => 'name', 'title' => 'Association']),
            Column::make(['data' => 'location', 'title' => 'Location']),
            Column::make(['data' => 'crop_name', 'title' => 'Crop Name']),
            Column::make(['data' => 'crop_count', 'title' => 'Crop Count'])
                ->addClass('text-center'),
            Column::make(['data' => 'crop_yield', 'title' => 'Crop Yield'])
                ->addClass('text-center'),
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
