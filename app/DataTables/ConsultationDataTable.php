<?php

namespace App\DataTables;

use App\Models\Consultation;
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
            ->editColumn('created_at', function (Consultation $consultation) {
                return $consultation->created_at->format('F d, Y');
            })
            ->addColumn('action', function (Consultation $consultation) {
                return view('president.consultations.action', compact('consultation'));
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Consultation $model): QueryBuilder
    {
        $role = $this->role;
        return $model->when($role, function ($query, $role) {
            if ($role === 'President') {
                return $query->where('consultations.president_id', auth()->user()->id);
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
        if ($this->role === 'Agriculturist') {
            return [
                Column::make(['data' => 'created_at', 'title' => 'Created Date']),
                Column::make(['data' => 'title']),
                Column::make(['data' => 'farmer_fullname', 'title' => 'Farmer Name']),
                Column::make(['data' => 'location']),
                Column::make(['data' => 'status']),
                Column::make(['data' => 'concern', 'title' => 'Cover Letter / Concern'])
                    ->width(250)
            ];
        }

        return [
            Column::make(['data' => 'created_at', 'title' => 'Created Date']),
            Column::make(['data' => 'title']),
            Column::make(['data' => 'farmer_fullname', 'title' => 'Farmer Name']),
            Column::make(['data' => 'location']),
            Column::make(['data' => 'status']),
            Column::make(['data' => 'concern', 'title' => 'Cover Letter / Concern'])
                ->width(200),
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
        return 'Consultation_' . date('YmdHis');
    }
}
