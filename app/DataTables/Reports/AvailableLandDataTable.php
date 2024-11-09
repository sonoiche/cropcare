<?php

namespace App\DataTables\Reports;

use Carbon\Carbon;
use App\Models\Geographic;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class AvailableLandDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('created_at', function (Geographic $geographic) {
                return $geographic->created_at->format('F d, Y');
            })
            ->editColumn('president_name', function (Geographic $geographic) {
                return $geographic->president->fullname ?? '';
            })
            ->editColumn('fname', function (Geographic $geographic) {
                return $geographic->fname . ' ' .$geographic->mname. ' ' . $geographic->lname;
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Geographic $model): QueryBuilder
    {
        $daterange      = $this->daterange;
        $president_id   = $this->president_id;
        $status         = $this->status;
        return $model->leftJoin('associations', 'associations.id', '=', 'geographics.association_id')
            ->join('farm_members','farm_members.id','=','geographics.farmer_id')
            ->select('geographics.*', 'associations.name','farm_members.fname','farm_members.mname','farm_members.lname','farm_members.suffix')
            ->when($daterange, function ($query, $daterange) {
                $date = explode('-', $daterange);
                $from = Carbon::parse($date[0])->format('Y-m-d');
                $to   = Carbon::parse($date[1])->format('Y-m-d');
                return $query->whereRaw("date(geographics.created_at) between ? and ?", [$from, $to]);
            })
            ->when($president_id, function ($query, $president_id) {
                return $query->where('geographics.president_id', $president_id);
            })
            ->when($status, function ($query, $status) {
                return $query->where('geographics.status', $status);
            });
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('availableland-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            // ->orderBy(1)
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
            Column::make(['data' => 'created_at', 'title' => 'Date Added']),
            Column::make(['data' => 'name', 'title' => 'Geographic Name']),
            Column::make(['data' => 'fname', 'title' => 'Farmer\'s Name']),
            Column::make(['data' => 'location', 'title' => 'Location']),
            Column::make(['data' => 'crop_name', 'title' => 'Crops']),
            Column::make(['data' => 'crop_count', 'title' => 'Crop Count']),
            Column::make(['data' => 'crop_yield', 'title' => 'Total Crop Yield']),
            Column::make(['data' => 'president_name', 'title' => 'President'])
                ->searchable(false)
                ->orderable(false),
            Column::make(['data' => 'status', 'title' => 'Status'])
                ->searchable(false)
                ->orderable(false),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'AvailableLand_' . date('YmdHis');
    }
}
