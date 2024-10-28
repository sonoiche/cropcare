<?php

namespace App\DataTables;

use App\Models\Geographic;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class GeographicDataTable extends DataTable
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
            ->addColumn('action', 'president.geographics.action')
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Geographic $model): QueryBuilder
    {
        $role = auth()->user()->role;
        $president_id = $this->president_id;
        return $model->join('farm_members','farm_members.id','=','geographics.farmer_id')
            ->select('geographics.*','farm_members.fname','farm_members.mname','farm_members.lname','farm_members.suffix')
            ->with('president')
            ->when($role, function ($query, $role) {
                if ($role == 'President') {
                    $query->where('geographics.president_id', auth()->user()->id);
                }
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
            ->setTableId('geographic-table')
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
            Column::make(['data' => 'created_at', 'title' => 'Date Added']),
            Column::make(['data' => 'fname', 'title' => 'Farmer\'s Name']),
            Column::make(['data' => 'location', 'title' => 'Location']),
            Column::make(['data' => 'crop_name', 'title' => 'Crops']),
            Column::make(['data' => 'crop_count', 'title' => 'Crop Count']),
            Column::make(['data' => 'crop_yield', 'title' => 'Total Crop Yield']),
            Column::make(['data' => 'president_name', 'title' => 'President'])
                ->searchable(false)
                ->orderable(false),
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
        return 'Geographic_' . date('YmdHis');
    }
}
