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

                $btn = '<a href="' .route('product.edit',['product'=>$row->id]).'" data-edit="'.$row->id.'" class="btn btn-primary edit-product">Edit</a>';
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
        // $model = Product::with('productStock');
        // return $model->newQuery();
        $data = Product::query()
        ->select('products.id','products.product_name','products.product_description','products.product_price','product_stocks.opening_stock')
        ->leftJoin('product_stocks','products.id','=','product_stocks.product_id');
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
                    // ->dom('Bfrtip')
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
