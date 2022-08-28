<?php

namespace App\Http\Controllers\Product;

use Auth;
use Imagick;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Setting\Settings;
use App\Models\Product\Category;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\Product\Product;
use App\Http\GlobalHelper\SimilarResponse;

class ProductController extends Controller
{
    public function products()
    {

        $data['page_title'] = "Products";
        $data['results'] =  Product::orderBy('created_at', 'desc')->get();
        return view('products.product.index', compact('data'));
    }
    public function product($id = -1)
    {
        $data['page_title'] = "Add Product" ;
        if ($id != -1) {
            $data['page_title'] = "Update Product";
            $data['results'] =  Product::where("id", $id)->first();
           
        }

        $data['categories'] =  Category::get();

        return view('products.product.save', compact('data'));
    }
    public function saveproduct(Request $request)
    {
        $id = $request->id;
        $modal = new Product;
        $data = $request->all();
       
        $action = "Added";

        if ($id) {
            $action = "Updated";
            $modal = Product::find($id);
            $affected_rows = $modal->update($data);
        } else {

            $affected_rows =  $modal::create($data);
        }
        return SimilarResponse::next("Product $action Successfully!");

    }
   
    public function deleteproduct($id)
    {
        Product::find($id)->delete();
        return SimilarResponse::next("ok");
    }
    public function upload_file2(Request $request)
    {
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . "." . $extension;
        $file->move('uploads/tutorials/', $filename);
        $data['upload_file'] = '/uploads/tutorials/' . $filename;
        return response()->json(['success' => $filename]);
    }

    public function upload_file(Request $request){
        if (!empty($_FILES)) {
            echo uploadToDiskStorage($request->file('file'), Settings::DISK_COLLECTION[$_GET['url']]);
        } else {
            echo 'No files';
        }
    }
    public function deletefiles(Request $request)
    {
        $ds = DIRECTORY_SEPARATOR;  // Store directory separator (DIRECTORY_SEPARATOR) to a simple variable. This is just a personal preference as we hate to type long variable name.
        $storeFolder = 'uploads';
        $fileList = $_POST['fileList'];
        $path = $_POST['path'];
        $targetPath = getcwd() . $fileList;
        $path = str_replace('/', '/', $path);
        //dd(trim($fileList));
        if (isset($fileList)) {
            unlink($targetPath . $fileList);
        }
    }
}
