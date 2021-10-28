<?php

namespace App\DataTables;

use App\Models\Product;
use App\Models\ProductStock;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductsDataTable extends DataTable
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
            ->addColumn('action', function($row){

                $btn = '<a href="' .route('product.edit',['product'=>$row->id]).'" data-edit="'.$row->id.'" class=" edit-product" title="Click here for edit content" ><i class="fas fa-edit" aria-hidden="true"></i></a>';
                $btn.= '<a href="' .route('product.destroy',['product'=>$row->id]).'" data-delete="'.$row->id.'" class="delete-product" title="Click here for delete content" >&nbsp;<i class="fas fa-trash-alt" aria-hidden="true"></i></a>';
                 return $btn;
              });
            //   ->addColumn('stock', function(Product $Product) {
            //     return $Product->productStock->opening_stock;
            // });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        // $model = Product::with('product_stock');
        // return $model->newQuery();
        $product_name = $this->request()->get('product_name');
        $product_price = $this->request()->get('product_price');

        $data = Product::query();
        $data->select('products.id','products.product_name','products.product_description','products.product_price','product_stocks.opening_stock');
        $data->leftJoin('product_stocks','products.id','=','product_stocks.product_id');
        if($product_name != ''){
            $data->where('products.product_name', 'like', '%' . $product_name  . '%');
        }
        if($product_price != ''){
            $data->where('products.product_price', 'like', '%' . $product_price  . '%');
         }
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
                    ->setTableId('products-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom("<'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>")
                    ->parameters([
                        // 'drawCallback' => 'function() { alert("Table Draw Callback") }',
                        'responsive'      => TRUE,
                        'orderCellsTop'   => TRUE,
                    ])
                    ->orderBy(0,'ase');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            [ 'data' => 'id', 'name' => 'products.id', 'title' => 'Id'],
            [ 'data' => 'product_name', 'name' => 'products.product_name', 'title' => 'Product Name'],
            [ 'data' => 'product_description', 'name' => 'products.product_description', 'title' => 'Product Description'],
            [ 'data' => 'product_price', 'name' => 'products.product_price', 'title' => 'Product Price'],
            [ 'data' => 'opening_stock', 'name' => 'product_stocks.opening_stock', 'title' => 'Opening Stock'],
            // 'stock',
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
        return 'Products_' . date('YmdHis');
    }
}
