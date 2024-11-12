<?php

namespace App\DataTables;

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
            ->editColumn('photo', function (FarmMember $farmer) {
                return '<img src="' . $farmer->display_photo . '" class="img-fluid rounded" style="width: 60px; height: 60px; object-fit: cover; border-radius: 99999px; border: 1px solid #333" />';
            })
            ->editColumn('created_at', function (FarmMember $farmer) {
                return $farmer->created_at->format('F d, Y');
            })
            ->editColumn('fname', function (FarmMember $farmer) {
                return $farmer->fname .' '.$farmer->mname. ' ' .$farmer->lname. ' ' .$farmer->suffix;
            })
            ->addColumn('action', 'president.farmers.action')
            ->setRowId('id')
            ->rawColumns(['photo', 'action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(FarmMember $model): QueryBuilder
    {
        $user_id = auth()->user()->id;
        return $model->join('associations', 'farm_members.association_id', '=', 'associations.id')
            ->select('farm_members.*', 'associations.name')
            ->where('farm_members.president_id', $user_id);
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
            Column::make(['data' => 'photo', 'title' => ''])
                ->searchable(false)
                ->orderable(false)
                ->addClass('text-center'),
            Column::make(['data' => 'created_at', 'title' => 'Created Date']),
            Column::make(['data' => 'fname', 'title' => 'Fullname']),
            Column::make(['data' => 'contact_number', 'title' => 'Contact Number']),
            Column::make(['data' => 'name', 'title' => 'Association', 'name' => 'associations.name']),
            Column::make(['data' => 'barangay', 'title' => 'Barangay']),
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
        return 'Farmer_' . date('YmdHis');
    }
}
