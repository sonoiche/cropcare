<?php

namespace App\DataTables\Reports;

use App\Models\Consultation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ConsultationDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('fname', function (Consultation $consultation) {
                return $consultation->fname . ' ' . $consultation->lname;
            })
            ->editColumn('schedule', function (Consultation $consultation) {
                return isset($consultation->schedule) ? Carbon::parse($consultation->schedule)->format('F d, Y H:i A') : 'None';
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Consultation $model): QueryBuilder
    {
        $type = $this->consultation_type;
        return $model->when($type, function ($query, $type) {
            $today = Carbon::now()->format('Y-m-d');
            switch ($type) {
                case 'past':
                    
                    return $query->where('schedule', '<', $today);

                    break;

                case 'upcoming':
                
                    return $query->where('schedule', '>=', $today);

                    break;
                
                default:
                    # code...
                    break;
            }
        });
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('consultation-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
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
            Column::make(['data' => 'schedule', 'title' => 'Schedule Date']),
            Column::make(['data' => 'title']),
            Column::make(['data' => 'farmer_fullname', 'title' => 'Farmer Name']),
            Column::make(['data' => 'location']),
            Column::make(['data' => 'status']),
            Column::make(['data' => 'concern', 'title' => 'Cover Letter / Concern'])
                ->width(250)
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Consultation_' . date('YmdHis');
    }
}
