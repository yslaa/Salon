<?php

namespace App\DataTables;

use App\Models\AdminModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use DB;

class AdminDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))->setRowId('id')
->addColumn('images', function ($admin) {
    $images = explode('|', $admin->images);
    $html = '';
    foreach ($images as $image) {
        $html .= '<img src="' . asset($image) . '" alt="I am a Pic" height="100" width="100">';
    }
    return $html;
})
            ->addColumn('action', function($admin) {
                $editUrl = route('admin.edit', $admin->id);
                $deleteUrl = route('admin.destroy', $admin->id);
                $csrf = csrf_field();
                $method = method_field('DELETE');
                $buttons = <<<EOT
                    <a href="$editUrl" class="btn btn-warning">Edit</a>
                    <form action="$deleteUrl" method="POST">
                        $csrf
                        $method
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                EOT;
                return $buttons;
            })
            ->rawColumns(['images', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param AdminModel $model
     * @return QueryBuilder
     */
    public function query(AdminModel $model): QueryBuilder
    {
        return $model->newQuery()
            ->join('users', 'admins.user_id', '=', 'users.id')
            ->select('admins.id', 'users.name','users.email', 'users.images')
            ->groupBy('admins.id', 'users.name', 'users.email','users.images');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('admin-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle();
                    // ->buttons([
                    //     Button::make('excel'),
                    //     Button::make('csv'),
                    //     Button::make('pdf'),
                    //     Button::make('print'),
                    //     Button::make('reset'),
                    //     Button::make('reload')
                    // ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name')->title('adminName'),
            Column::make('email'),
            Column::make('images'),
            Column::make('action')
                ->exportable(false)
                ->printable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Admin_' . date('YmdHis');
    }
}
