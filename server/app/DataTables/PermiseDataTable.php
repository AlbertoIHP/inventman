<?php

namespace App\DataTables;

use App\Models\Permise;
use Form;
use Yajra\Datatables\Services\DataTable;

class PermiseDataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', 'permises.datatables_actions')
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $permises = Permise::query();

        return $this->applyScopes($permises);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->addAction(['width' => '10%'])
            ->ajax('')
            ->parameters([
                'dom' => 'Bfrtip',
                'scrollX' => false,
                'buttons' => [
                    'print',
                    'reset',
                    'reload',
                    [
                         'extend'  => 'collection',
                         'text'    => '<i class="fa fa-download"></i> Export',
                         'buttons' => [
                             'csv',
                             'excel',
                             'pdf',
                         ],
                    ],
                    'colvis'
                ]
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    private function getColumns()
    {
        return [
            'functionalities_id' => ['name' => 'functionalities_id', 'data' => 'functionalities_id'],
            'userstypes_id' => ['name' => 'userstypes_id', 'data' => 'userstypes_id'],
            'write' => ['name' => 'write', 'data' => 'write'],
            'delete' => ['name' => 'delete', 'data' => 'delete'],
            'read' => ['name' => 'read', 'data' => 'read'],
            'edit' => ['name' => 'edit', 'data' => 'edit']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'permises';
    }
}
