<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $ids;

    public function __construct($ids)
    {
        $this->ids = $ids;
    }

    public function collection()
    {

        $fields = [];
        if(in_array('1', $this->ids))
        $fields[] = 'brand_name'; 
        if(in_array('2', $this->ids))
        $fields[] = 'product_name' ;
        if(in_array('3', $this->ids))
        $fields[]= 'sku' ;
        if(in_array('4', $this->ids))
        $fields[] = 'orginal_price';
        if(in_array('5', $this->ids))
        $fields[] = 'receive_date';
        if(in_array('6', $this->ids))
        $fields = 'exp_date';
        if(in_array('7', $this->ids))
        $fields[] = 'image_urls' ;
        
        return Product::select($fields)->get();
    }

}
