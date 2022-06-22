<?php

namespace App\Exports;

use App\Models\Product;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection, WithHeadings
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
        if(in_array('1', $this->ids)){
            $fields[] = 'product_table.brand_name';
        }
        if(in_array('2', $this->ids)){
            $fields[] = 'product_name';
        }
        if(in_array('3', $this->ids)){
            $fields[]= 'sku';
        }
        if(in_array('4', $this->ids)){
            $fields[] = 'original_price';
        }
        if(in_array('5', $this->ids)){
            $fields[] = 'recieve_date';
        }
        if(in_array('6', $this->ids)){
            $fields = 'exp_date';
        }
        if(in_array('7', $this->ids)){
            $fields[] = 'image_urls' ;
        }
        if(in_array('0', $this->ids)){
            $fields[] = 'product_master_table.category'; 
        
            return Product::join('product_master_table', 'product_table.category_id', '=', 'product_master_table.id')->select($fields)->get();
        }else{
            return Product::select($fields)->get();
        }
    }

    public function headings(): array
    {

        $headings = [];
        if(in_array('1', $this->ids)){
            $headings[] = 'Brand Name';
        }
        if(in_array('2', $this->ids)){
            $headings[] = 'Product Name';
        }
        if(in_array('3', $this->ids)){
            $headings[] = 'SKU';
        }
        if(in_array('4', $this->ids)){
            $headings[] = 'Original Price';
        }
        if(in_array('5', $this->ids)){
            $headings[] = 'Recieve date';
        }
        if(in_array('6', $this->ids)){
            $headings[] = 'Expiry date';
        }
        if(in_array('7', $this->ids)){
            $headings[] = 'Image url';
        }
        if(in_array('0', $this->ids)){
            $headings[] = 'Category';
        }
        return $headings;
    }


}
