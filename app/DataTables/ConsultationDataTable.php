<?php

namespace App\DataTables;

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
            ->editColumn('pres_name', function (Consultation $consultation) {
                return $consultation->president->fullname ?? '';
            })
            ->editColumn('created_at', function (Consultation $consultation) {
                return $consultation->created_at->format('M d, Y');
            })
            ->editColumn('schedule', function (Consultation $consultation) {
                $today = now();
                if(isset($consultation->schedule) && $consultation->schedule < $today) {
                    return '<span class="text-danger">'.Carbon::parse($consultation->schedule)->format('F d, Y h:i A').'</span>';
                }

                if(isset($consultation->schedule)) {
                    return Carbon::parse($consultation->schedule)->format('F d, Y h:i A');
                }
            })
            ->editColumn('status', function (Consultation $consultation) {
                $html  = '<div class="text-center">'.$consultation->status.'</div>';
                return $html;
            })
            ->addColumn('action', function (Consultation $consultation) {
                if(auth()->user()->role == 'President') {
                    return view('president.consultations.action', compact('consultation'));
                }

                if(auth()->user()->role == 'Agriculturist') {
                    return view('agriculturist.consultations.action', compact('consultation'));
                }
            })
            ->setRowId('id')
            ->rawColumns(['schedule','status','action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Consultation $model): QueryBuilder
    {
        $role = auth()->user()->role;
        $status = $this->status;
        return $model->when($role, function ($query, $role) use ($status) {
            if ($role == 'President') {
                return $query->where('consultations.president_id', auth()->user()->id);
            }

            if ($role == 'Agriculturist' && $status == '') {
                return $query->where('consultations.agriculture_id', auth()->user()->id)
                    ->where(function ($query) {
                        $query->where('schedule', '>', Carbon::now()) // Get future schedules
                            ->orWhere(function ($subQuery) {
                                $subQuery->where('schedule', '<=', Carbon::now())
                                    ->where('status', '!=', 'Resolve'); // Exclude resolved past schedules
                            });
                });
            }

            if ($role == 'Agriculturist' && $status != '') {
                return $query->where('consultations.agriculture_id', auth()->user()->id);
            }
        })
        ->when($status, function ($query, $status) {
            return $query->where('status', $status);
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
        if ($this->role === 'Agriculturist') {
            return [
                Column::make(['data' => 'created_at', 'title' => 'Created Date']),
                Column::make(['data' => 'title']),
                Column::make(['data' => 'pres_name', 'title' => 'President']),
                Column::make(['data' => 'farmer_fullname', 'title' => 'Farmer Name']),
                Column::make(['data' => 'location']),
                Column::make(['data' => 'status'])
                    ->searchable(false)
                    ->sortable(false)
                    ->addClass('text-center'),
                Column::make(['data' => 'schedule']),
                Column::make(['data' => 'concern', 'title' => 'Cover Letter / Concern'])
                    ->width(250),
                Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->width(150)
                    ->addClass('text-center')
            ];
        }

        return [
            Column::make(['data' => 'created_at', 'title' => 'Created Date']),
            Column::make(['data' => 'title']),
            Column::make(['data' => 'farmer_fullname', 'title' => 'Farmer Name']),
            Column::make(['data' => 'location']),
            Column::make(['data' => 'status'])
                ->searchable(false)
                ->sortable(false),
            Column::make(['data' => 'schedule']),
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
