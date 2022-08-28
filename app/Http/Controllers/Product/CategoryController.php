<?php
namespace App\Http\Controllers\Product;
use Illuminate\Http\Request;
use App\Models\Product\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\GlobalHelper\SimilarResponse;

class CategoryController extends Controller
{
    public function productcategories(Request $request)
    {
        $data['results'] =  Category::get();
        return view('products.category.index' ,compact('data'));

    }

   public function productcategory($id=-1){
    $data['page_title'] = "Add Category";
    if($id!=-1){
        $data['page_title']="Update Category";
        $data['results'] =  Category::where("id",$id)->first();

    }
     return view("products.category.save",compact('data'));
   }

    public function saveproductcategory(Request $request)
    {
        $id = $request->id;
        $modal = new Category;
        $data = $request->all();
        //  dd($data);
        $action = "Added";
        if ($id) {
            $action = "Updated";
            $modal = Category::find($id);
            $affected_rows = $modal->update($data);
        } else {

            $affected_rows =  $modal::create($data);
        }

        return SimilarResponse::next("product Category $action Successfully!");
    }
    public function deleteproductcategory($id)
    {
        Category::find($id)->delete();
        return SimilarResponse::next("ok");
    }
  
}
?>
