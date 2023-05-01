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
        ->addColumn('id', function($admin) {
        $showUrl = route('admin.show', $admin->id);
        $id = '<span>'.$admin->id.'</span>';
        if (!$admin->deleted_at) {
            $id = '<a href="'.$showUrl.'">'.$admin->id.'</a>';
        }
        return $id;
        })
        ->addColumn('action', function($admin) {
            $editUrl = route('admin.edit', $admin->id);
            $csrf = csrf_field();

            if ($admin->deleted_at) {
                $restoreUrl = route('admin.restore', $admin->id);
                $restoreButton = '<a href="'.$restoreUrl.'" class="btn btn-success">Restore</a>';

                $forceDeleteUrl = route('admin.forceDelete', $admin->id);
                $method = method_field('GET');
                $forceDeleteButton = '<button class="btn btn-warning" type="submit">Destroy</button>';

                $csrf = csrf_field();
                $buttons = <<<EOT
                    $restoreButton
                    <form action="$forceDeleteUrl" method="POST">
                        $csrf
                        $method
                        $forceDeleteButton
                    </form>
                EOT;
            } else {
                $deleteUrl = route('admin.destroy', $admin->id);
                $method = method_field('DELETE');
                $deleteButton = '<button class="btn btn-danger" type="submit">Delete</button>';
                $buttons = <<<EOT
                    <a href="$editUrl" class="btn btn-warning">Edit</a>
                    <form action="$deleteUrl" method="POST">
                        $csrf
                        $method
                        $deleteButton
                    </form>
                EOT;
            }

            return $buttons;
        })
        ->rawColumns(['images', 'id', 'action']);
}

    /**
     * Get query source of dataTable.
     *
     * @param AdminModel $model
     * @return QueryBuilder
     */
public function query(AdminModel $model): QueryBuilder
{
    $loggedInUserId = auth()->user()->id;

    return $model->newQuery()
        ->join('users', 'admins.user_id', '=', 'users.id')
        ->select('users.name','users.email', 'users.id', 'users.images','users.deleted_at')
        ->where('users.id', '<>', $loggedInUserId)
        ->groupBy('users.name','users.email', 'users.id', 'users.images','users.deleted_at');
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
