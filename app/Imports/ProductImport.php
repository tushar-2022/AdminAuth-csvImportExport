<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
      foreach ($rows as $importData) 
      {
        Product::firstOrCreate([
            'brand_name' => $importData[2],
            'product_name' => $importData[3],
            'sku' => $importData[4],
            'recieve_date' => $importData[5],
            'exp_date' => $importData[6],
            'original_price' => $importData[7],
            'image_urls' => $importData[8]
        ]);
                    
        Category::firstOrCreate([
            'category' => $importData[1],
            'brand_name' => $importData[2]
        ]);
                    
     }
   }
}
