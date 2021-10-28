<?php


namespace App\DataTables;

use App\Models\Category;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Rap2hpoutre\FastExcel\FastExcel;

class CategoryDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    protected $fastExcel = true;

    public function dataTable($query)
    {

        // dump($query);
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function($row){

                $btn = '<a href="' .route('category.edit',['category'=>$row->id]).'" class="btn btn-primary">Edit</a>';
                $btn = $btn.'<a href="' .route('category.destroy',['category'=>$row->id]).'" data-delete="'.$row->id.'" class="delete btn btn-danger  ">Delete!</a> ';

                 return $btn;
         });


    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Category $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Category $model)
    {
        $data = Category::query()
        ->select('categories.id','categories.title','categories.parent_id','cat.title as parent')
        ->leftJoin('categories AS cat','cat.id','=','categories.parent_id');
        return $data;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('category-table')
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


            // Column::make('id'),
            // Column::make('title'),
            // Column::make('parent'),
            // Column::computed('action')
            // ->exportable(true)
            // ->printable(true)
            // ->width(60)
            // ->addClass('text-center'),
            // '#',
            [ 'data' => 'id', 'name' => 'categories.id', 'title' => 'ID' ],
            [ 'data' => 'title', 'name' => 'categories.title', 'title' => 'Title'],
            [ 'data' => 'parent', 'name' => 'cat.title', 'title' => 'Parent' ],
            'action',


        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Category_' . date('YmdHis');
    }
}
