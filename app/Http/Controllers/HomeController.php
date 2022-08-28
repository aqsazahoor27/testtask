<?php

namespace App\Http\Controllers;

use App\Models\Product\Product;
use App\Models\Product\Category;
use App\Models\User;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth');

    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $data['results'] = Product::count();
        $data['categories'] = Category::get();
        $cats=[];
        foreach($data['categories'] as $key=>$value){
                $count = Product::where('category_id', $value->id)->count();
            $series[$key]['name']=$value->name;
            $series[$key]['data']=[];
                        $cats[] = $value->name;
                        $series[$key]['data'][] = $count;


        }

        $data['chart'] = [
            "series" => $series,
            "categories" => $cats,
        ];

        return view('dashboard.index', compact('data'));
    }
public function adminlogout(){
        Auth::logout();
        return redirect('/admin/login');
    }
 

}
