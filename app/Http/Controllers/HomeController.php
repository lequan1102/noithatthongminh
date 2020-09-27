<?php

namespace App\Http\Controllers;

use App\Settings;
use App\Products;
use App\Banner;
use App\Categories;
use App\Talkaboutus;
use App\Posts;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS;
use Cart;
class HomeController extends Controller
{
    //TRANG CHỦ
    public function index()
    {
        $data['banner']           = Banner::orderBy('order', 'DESC')->limit(4)->get();

        $data['products']         = Products::orderBy('order')->limit(10)->get();
        $data['products_future']  = Products::orderBy('order')->where('featured', '1')->limit(12)->get();
        $data['products_selling'] = Products::orderBy('order')->where('selling','<>', 0)->limit(12)->get();

        $data['news']             = Posts::orderBy('order','DESC')->limit(7)->get();

        $data['talkaboutus']      = Talkaboutus::orderBy('order','DESC')->limit(7)->get();

        return view('home', $data);
    }
    //TRANG CHUYÊN MỤC
    public function cate($slug)
    {
        $data['category_title'] = Categories::where('slug', $slug)->first();
        if ($data['category_title']){
            $data['cate'] = Products::orderBy('id','DESC')
                            ->where('category_id', $data['category_title']->id)
                            ->where('status', 'Hiển thị')
                            ->paginate(6);
        }
        return view('category.category', $data);
    }
    //TIN TỨC
    public function cate_news()
    {
        $data['cate'] = Posts::orderBy('id','DESC')->where('status', 'PUBLISHED')->paginate(8);
        return view('category.news', $data);
    }
    public function article_news($slug)
    {
        $data['article'] = Posts::where('slug', $slug)->first();
        $data['related'] = Posts::where('slug','<>',$slug)->where('status', 'PUBLISHED')->limit(8)->get();
        return view('article.news', $data);
    }
}
