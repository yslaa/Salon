<?php

namespace App\DataTables;

use App\Models\User;
use App\Models\AdminModel;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdminDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
             ->addColumn('action', function($row) {
                    return "<a href=". route('admin.edit', $row->id). " class=\"btn btn-warning\">Edit</a> 
                    <form action=". route('admin.destroy', $row->id). " method= \"POST\" >". csrf_field().
                    '<input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" type="submit">Delete</button>
                      </form>';
            })
            ->addColumn('images', function ($admins) { 
                        $images = explode('|',$admins->img_path);
                        $image_name = is_array($images);
                        $number = rand(0,3);
                        for ($i = $number; $i <= $image_name; $i++)
                        {
                            return '<img src=' . $images[$i] .' alt = "I am a Pic" height="100" width="100">';
                        }
            })
            ->rawColumns(['action', 'images']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\AdminDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
            $admins = User::join(
            "admins",
            "users.id",
            "=",
            "admins.user_id"
            )
            ->select(
                "users.id",
                "users.name",
                "users.images",
                "users.role",
                "users.deleted_at",
                "admins.user_id",
            )
            // ->where('users.id', '<>', Auth::user()->id)
            // ->orderBy("admins.user_id", "DESC")
            // ->withTrashed()
            ->get();
            return $admins;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('admins-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            Column::make('id'),
            Column::make('name')->title('adminName'),
            Column::make('email'),
            Column::make('role'),
            Column::make('images'),
            Column::make('created_at'),
            Column::make('updated_at'),
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

    public function filename(): string
    {
        return 'Admins_' . date('YmdHis');
    }
}
