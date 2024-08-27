<?php

namespace App\DataTables;

use App\Models\User;
use App\Models\FarmMember;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class PresidentDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('fname', function (User $user) {
                return $user->fullname;
            })
            ->editColumn('members', function (User $user) {
                return FarmMember::where('association_id', $user->association_id)->count();
            })
            ->addColumn('action', 'admin.presidents.action')
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->join('associations','associations.id','=','users.association_id')
            ->select('associations.name', 'associations.id as association_id', 'users.*')
            ->where('role', User::ROLE_PRESIDENT);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('president-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip', 'asc')
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
            Column::make(['data' => 'fname', 'title' => 'Name']),
            Column::make(['data' => 'barangay', 'title' => 'Barangay']),
            Column::make(['data' => 'name', 'title' => 'Association Name']),
            Column::make(['data' => 'members', 'title' => 'Members'])
                ->searchable(false)
                ->sortable(false)
                ->addClass('text-center'),
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
        return 'President_' . date('YmdHis');
    }
}
