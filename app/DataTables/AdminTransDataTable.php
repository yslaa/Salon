<?php

namespace App\DataTables;

use App\Models\AdminTran;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use DB;

class AdminTransDataTable extends DataTable
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
            $actionBtn = '<a href="' .  route('transacDetails', $row->transaction_id) . '"  class="btn details btn-primary">Details</a> 
            <a href="'.  route('sendEmail', $row->transaction_id) . '" class="btn email btn-primary"> Send Email</a>';
            return $actionBtn;
        })->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\AdminTran $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $transacs =  DB::table('transactions as t')
        ->join('customers as c','c.id', '=', 't.customer_id')
        ->join('users as u','u.id', '=', 'c.user_id')
        ->join('transaction_line as tl','t.id', '=', 'tl.transaction_id')
        ->join('services as s','s.id', '=', 'tl.service_id')
        ->join('products as p','p.id', '=', 's.product_id')
        ->select('tl.transaction_id', 't.Status', 't.date_placed', 'u.name', 's.service', 'p.product', DB::raw('SUM(s.cost) as total'))
        ->groupBy('tl.transaction_id', 't.Status', 't.date_placed', 'u.name', 's.service', 'p.product')
        ->get();

        return $transacs;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('admintrans-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
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
            Column::make('transaction_id'),
            Column::make('Status'),
            Column::make('date_placed'),
            Column::make('name'),
            Column::make('service'),
            Column::make('product'),
            Column::make('total'),
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
        return 'AdminTrans_' . date('YmdHis');
    }
}
