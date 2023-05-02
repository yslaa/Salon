<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use DB;

class ProductDataTable extends DataTable
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
            $actionBtn = '<a href="' .  route('product.edit', $row->product_id) . '"  class="btn edit btn-primary">Edit</a> 
            <form action="'. route('product.destroy', $row->product_id) .'" method="POST" class="d-inline-block">
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
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $products =  DB::table('products as p')
        ->join('suppliers as s','s.id', '=', 'p.supplier_id')
        ->join('users as u','u.id', '=', 's.user_id')
        ->select('p.id as product_id', 'p.product', 'p.quantity', 'p.description', 'u.name')
        ->get();

        return $products;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('product-table')
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
                Column::make('product_id'),
                Column::make('product'),
                Column::make('quantity'),
                Column::make('description'),
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
        return 'Product_' . date('YmdHis');
    }
}
