<?php

namespace App\Http\Controllers;

use Config;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Exports\ProductExport;
use App\Imports\ProductImport;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;


class FileController extends Controller
{

    public function getImport(){

        return view('product/products-import-export');
    }

    public function parseImport(Request $request){

        $file = $request->file('csv_file');
         
        if($file) {

            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension(); //Get extension of uploaded file
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize(); //Get size of uploaded file in bytes
            //Check for file extension and size
            $this->checkUploadedFileProperties($extension, $fileSize);

            $import = new ProductImport();
            if ($request->has('header')) {
                $import->setStartRow(2);
                Excel::import($import, $file);

            }else{
                Excel::import($import, $file);
            }

            

            //Where uploaded file will be stored on the server 
            /*$location = 'uploads'; //Created an "uploads" folder for that
            // Upload file
            $file->move($location, $filename);
                // In case the uploaded file path is to be stored in the database 
            $filepath = public_path($location . "/" . $filename);
            // Reading file
            $file = fopen($filepath, "r");
            $importData_arr = array(); // Read through the file and store the contents as an array
            $i = 0;
            //Read the contents of the uploaded file 
            while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                $num = count($filedata);
                // Skip first row (Remove below comment if you want to skip  the first row)
                if ($i == 0) {
                    $i++;
                    continue;
                }
                for ($c = 0; $c < $num; $c++) {
                    $importData_arr[$i][] = $filedata[$c];
                }
                $i++;
            }
            fclose($file); //Close after reading

            $j = 0;

            foreach ($importData_arr as $importData) {
                $j++;
                try{
                    DB::beginTransaction();
                    Product::create([
                        'brand_name' => $importData[2],
                        'product_name' => $importData[3],
                        'sku' => $importData[4],
                        'recieve_date' => $importData[5],
                        'exp_date' => $importData[6],
                        'orginal_price' => $importData[7],
                        'image_urls' => $importData[8]
                    ]);
                    
                    Category::firstOrCreate([
                        'category' => $importData[1],
                        'brand_name' => $importData[2]
                    ]);
                    DB::commit();
                } catch (\Exception $e) {
                    //throw $j;
                    DB::rollBack();
                    $j--;
                }
               
            }*/

            return back()->with( 'success', $import->getRowCount() ." records successfully uploaded" );
        } else {
            //no file was uploaded
            throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);
        }
    
    }

    public function checkUploadedFileProperties($extension, $fileSize){
        $valid_extension = array("csv"); //Only csv files
        $maxFileSize = 2097152; // Uploaded file size limit is 2mb
        if (in_array(strtolower($extension), $valid_extension)) {
            if ($fileSize <= $maxFileSize) {
            } else {
                throw new \Exception('No file was uploaded', Response::HTTP_REQUEST_ENTITY_TOO_LARGE); //413 error
            }
        } else {
            throw new \Exception('Invalid file extension', Response::HTTP_UNSUPPORTED_MEDIA_TYPE); //415 error
        }
    }

    public function exportProducts(Request $request){
        $request->validate([
            'name' => 'required|max:7', 
            'ids' => 'required|min:1'
        ]);

        return Excel::download(new ProductExport($request->ids), 'Product.csv');
    }

    public function downloadDemoFile(){
        $file =   public_path('Downloads/Dummy.csv');
        return Response::download($file);
    }
}