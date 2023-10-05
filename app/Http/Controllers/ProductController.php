<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Jorenvh\Share\ShareFacade;
use TCG\Voyager\Facades\Voyager;

class ProductController extends Controller
{
    public function index(Request $request) {
        $search = $request->input('search', '');
        
        $meta = Page::all()->keyBy('slug');
        $seo = (object)[
            'title' => $meta->get('product')->meta_title ?? $meta->get('default')->meta_title,
            'desc' => $meta->get('product')->meta_desc ?? $meta->get('default')->meta_desc,
            'image' => Voyager::image($meta->get('product')->image) ?? Voyager::image($meta->get('default')->image),
            'keyword' => $meta->get('product')->meta_keyword ?? $meta->get('default')->meta_keyword,
        ];

        $categories = ProductCategory::all();
        $products = Product::query();
    
        // Lakukan filter berdasarkan kata kunci pencarian
        if (!empty($search)) {
            $products->where('title', 'like', "%$search%");
        }

        $products = $products->paginate(15);
        return view('product', compact('seo','products','categories'));
    }

    public function show($slug, Request $request) {
        $meta = Page::all()->keyBy('slug');
        $product = Product::where('slug','=',$slug)->firstOrFail();
        $seo = (object)[
            'title' => $product->title ?? $meta->get('default')->meta_title,
            'desc' => $product->meta_description ?? $meta->get('default')->meta_desc,
            'image' => Voyager::image($product->image) ?? Voyager::image($meta->get('default')->image),
            'keyword' => $product->meta_keyword ?? $meta->get('default')->meta_keyword,
        ];

        $suggests = [];
        
        $product_list1 = Product::latest()->limit(4)->get();
        $product_list = ProductCategory::where('slug',$product->category->slug)->firstOrFail();
        
        foreach ($product_list->products as $prod) {
            if ($prod->slug != $slug) {
                array_push($suggests, $prod);
            }
        }
        
        foreach ($product_list1 as $products1) {
            if(count($suggests) < 4){
                array_push($suggests,$products1);
            }else{
                break;
            }
        }

        $page = Page::where('slug','product-show')->firstOrFail();
        $banner = $page->banner;
        $shareLinks = ShareFacade::page($request->url(), "$seo->desc")
                ->facebook("$seo->desc")
                ->twitter("$seo->desc")
                ->linkedin("$seo->desc")
                ->whatsapp("$seo->desc")
                ->telegram("$seo->desc")
                ->getRawLinks();

        return view('product_item', compact('seo','product','suggests','banner','shareLinks'));
    }

    public function category(Request $request, $slug) {
        $search = $request->input('search', '');
        $category = ProductCategory::where('slug',$slug)->firstOrFail();
        
        $meta = Page::all()->keyBy('slug');
        $seo = (object)[
            'title' => $meta->get('product')->meta_title ?? $meta->get('default')->meta_title,
            'desc' => $meta->get('product')->meta_desc ?? $meta->get('default')->meta_desc,
            'image' => Voyager::image($meta->get('product')->image) ?? Voyager::image($meta->get('default')->image),
            'keyword' => $meta->get('product')->meta_keyword ?? $meta->get('default')->meta_keyword,
        ];

        $categories = ProductCategory::all();
        $products = Product::query();
    
        // Lakukan filter berdasarkan kata kunci pencarian
        if (!empty($search)) {
            $products->where('title', 'like', "%$search%");
        }

        $products->whereHas('category', function ($query) use ($slug) {
            $query->where('slug', $slug);
        });

        $products = $products->paginate(15);


        return view('product_category', compact('seo','products','category', 'categories'));
    }
}
