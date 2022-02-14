<?php

namespace App\DataTables;

use App\Models\StaffMember;
use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StaffMemberDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
        ->order(function($query){
               $query->orderBy('created_at', 'desc');
        })->addIndexColumn()
        ->addColumn('action', function ($row) {   
            $edit_icon = asset('assets/images/icon-edit.png');
            return '<td>
                        <a href="'.route('staff-members.edit', base64_encode($row->id)) .'">
                            <img src="'.$edit_icon.'">
                        </a>
                    </td>';   
        })->addColumn('checkbox', function ($row) {
              $checkBox = `<input type="checkbox" class="sub_chk" data-encoded-id="`.$row->encoded_id.`" data-id="`.$row->id.`">`;
             return $checkBox;
        })->rawColumns(['action', 'checkbox']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\StaffMember $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->with('teams')->where('user_type', 'staffmember');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('staffmember-table')
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
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('add your columns'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'StaffMember_' . date('YmdHis');
    }
}
