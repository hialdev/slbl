<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Client;
use App\Models\HeroBanner;
use App\Models\News;
use App\Models\Office;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Service;
use App\Models\Sosmed;
use App\Models\Sparepart;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;

class PageController extends Controller
{
    public function index() {
        $meta = Page::all()->keyBy('slug');
        $seo = (object)[
            'title' => $meta->get('home')->meta_title ?? $meta->get('default')->meta_title,
            'desc' => $meta->get('home')->meta_desc ?? $meta->get('default')->meta_desc,
            'image' => Voyager::image($meta->get('home')->image) ?? Voyager::image($meta->get('default')->image),
            'keyword' => $meta->get('home')->meta_keyword ?? $meta->get('default')->meta_keyword,
        ];

        $heros = HeroBanner::all();
        $products = Product::where('featured',1)->limit(3)->get();
        $categories = ProductCategory::all();
        $services = Service::latest()->limit(5)->get();
        $brands = Brand::all();
        $clients = Client::all();
        $news = News::latest()->limit(4)->get();

        return view('index', compact('heros','news','products','brands','clients','categories','services','seo'));
    }

    public function about(){
        $meta = Page::all()->keyBy('slug');
        $seo = (object)[
            'title' => $meta->get('home')->meta_title ?? $meta->get('default')->meta_title,
            'desc' => $meta->get('home')->meta_desc ?? $meta->get('default')->meta_desc,
            'image' => Voyager::image($meta->get('home')->image) ?? Voyager::image($meta->get('default')->image),
            'keyword' => $meta->get('home')->meta_keyword ?? $meta->get('default')->meta_keyword,
        ];
        
        return view('about',compact('seo'));
    }

    public function contact(){
        $meta = Page::all()->keyBy('slug');
        $seo = (object)[
            'title' => $meta->get('contact')->meta_title ?? $meta->get('default')->meta_title,
            'desc' => $meta->get('contact')->meta_desc ?? $meta->get('default')->meta_desc,
            'image' => Voyager::image($meta->get('contact')->image) ?? Voyager::image($meta->get('default')->image),
            'keyword' => $meta->get('contact')->meta_keyword ?? $meta->get('default')->meta_keyword,
        ];

        $offices = Office::all();
        $sosmeds = Sosmed::all();

        return view('contact', compact('seo','offices','sosmeds'));
    }

    public function privacy(){
        $meta = Page::all()->keyBy('slug');

        $seo = (object)[
            'title' => $meta->get('privacy-policy')->meta_title ?? $meta->get('default')->meta_title,
            'desc' => $meta->get('privacy-policy')->meta_desc ?? $meta->get('default')->meta_desc,
            'image' => Voyager::image($meta->get('privacy-policy')->image) ?? Voyager::image($meta->get('default')->image),
            'keyword' => $meta->get('privacy-policy')->meta_keyword ?? $meta->get('default')->meta_keyword,
        ];

        return view('privacy', compact('seo'));
    }

    public function tos(){
        $meta = Page::all()->keyBy('slug');

        $seo = (object)[
            'title' => $meta->get('terms-of-services')->meta_title ?? $meta->get('default')->meta_title,
            'desc' => $meta->get('terms-of-services')->meta_desc ?? $meta->get('default')->meta_desc,
            'image' => Voyager::image($meta->get('terms-of-services')->image) ?? Voyager::image($meta->get('default')->image),
            'keyword' => $meta->get('terms-of-services')->meta_keyword ?? $meta->get('default')->meta_keyword,
        ];

        return view('tos', compact('seo'));
    }

    public function search($q) {
        $meta = Page::all()->keyBy('slug');

        $seo = (object)[
            'title' => $q ? 'Cari di Scissor Lift Boom Lift - '.$q : 'Cari di Scissor Lift Boom Lift',
            'desc' => $meta->get('default')->meta_desc,
            'image' => Voyager::image($meta->get('default')->image),
            'keyword' => $meta->get('default')->meta_keyword,
        ];

        $services = Service::where('title','like','%'.$q.'%')->limit(4)->get();
        $spareparts = Sparepart::where('title','like','%'.$q.'%')->limit(4)->get();
        $products = Product::where('title','like','%'.$q.'%')->limit(4)->get();

        return view('search', compact('seo','q','products','spareparts','services'));
    }
}
