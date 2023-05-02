<?php

namespace App\DataTables;

use App\Models\ServiceModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use DB;

class ServiceDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable($query)
    {
        return datatables()
        ->collection($query)
        ->addColumn('action',  function($row){
            $actionBtn = '<a href="' .  route('service.edit', $row->service_id) . '"  class="btn edit btn-primary">Edit</a> 
            <form action="'. route('service.destroy', $row->service_id) .'" method="POST" class="d-inline-block">
                      '. csrf_field() .'
                      '. method_field("PUT") .'
                      <button type="submit" class="btn delete btn-primary">Delete</button>
                  </form>
            <form action="'. '' .'" method="POST" class="d-inline-block">
                      '. csrf_field() .'
                      '. method_field("PUT") .'
                      <button type="submit" class="btn restore btn-primary">Restore</button>
                  </form>';

            return $actionBtn;
        })->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Service $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $services =  DB::table('services as s')
        ->join('products as p','p.id', '=', 's.product_id')
        ->join('employees as e','e.id', '=', 's.employee_id')
        ->join('users as u','u.id', '=', 'e.user_id')
        ->select('s.id as service_id', 's.service', 's.cost', 'p.product', 'u.name')
        ->get();

        return $services;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('service-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('service_id'),
            Column::make('service'),
            Column::make('cost'),
            Column::make('product'),
            Column::make('name'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Service_' . date('YmdHis');
    }
}
