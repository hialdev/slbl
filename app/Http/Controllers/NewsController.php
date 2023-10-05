<?php

namespace App\Http\Controllers;

use App\Models\ImageContent;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\Page;
use Illuminate\Http\Request;
use Jorenvh\Share\ShareFacade;
use TCG\Voyager\Facades\Voyager;

class NewsController extends Controller
{
    public function index(Request $request) {
        $orderBy = (string) $request->input('order', '0');
        $limit = (int) $request->input('limit', '10');
        $search = $request->input('search', '');
        
        $meta = Page::all()->keyBy('slug');
        $seo = (object)[
            'title' => $meta->get('news')->meta_title ?? $meta->get('default')->meta_title,
            'desc' => $meta->get('news')->meta_desc ?? $meta->get('default')->meta_desc,
            'image' => Voyager::image($meta->get('news')->image) ?? Voyager::image($meta->get('default')->image),
            'keyword' => $meta->get('news')->meta_keyword ?? $meta->get('default')->meta_keyword,
        ];

        $news = News::query();
    
        // Lakukan filter berdasarkan kata kunci pencarian
        if (!empty($search)) {
            $news->where('title', 'like', "%$search%");
        }
    
        // Lakukan pengurutan berdasarkan pilihan pengguna
        if ($orderBy === '1') {
            $news->orderBy('created_at', 'asc');
        } else if($orderBy === '0'){
            $news->orderBy('created_at', 'desc');
        }
    
        $news = $news->paginate($limit);
        $image = ImageContent::where('code','=','news')->firstOrFail();
        $tags = NewsCategory::all();
        
        
        return view('news', compact('seo','news', 'tags','image'));
    }

    public function show($slug, Request $request) {
        $meta = Page::all()->keyBy('slug');
        $news = News::where('slug',$slug)->firstOrFail();
        $seo = (object)[
            'title' => $news->title ?? $meta->get('default')->meta_title,
            'desc' => $news->meta_description ?? $meta->get('default')->meta_desc,
            'image' => Voyager::image($news->image) ?? Voyager::image($meta->get('default')->image),
            'keyword' => $news->meta_keyword ?? $meta->get('default')->meta_keyword,
        ];
        $suggests = [];
        
        $news_list1 = News::latest()->limit(4)->get();
        $news_list = NewsCategory::where('slug',$news->categories[0]->slug)->firstOrFail();
        
        foreach ($news_list->news as $new) {
            if ($new->slug != $slug) {
                array_push($suggests, $new);
            }
        }
        
        foreach ($news_list1 as $news1) {
            if(count($suggests) < 4){
                array_push($suggests,$news1);
            }else{
                break;
            }
        }

        $shareLinks = ShareFacade::page($request->url(), "Lihat $news->title")
                ->facebook()
                ->twitter()
                ->linkedin()
                ->whatsapp()
                ->telegram()
                ->getRawLinks();

        return view('news_item', compact('seo','news','suggests','shareLinks'));
    }

    public function category(Request $request, $slug) {
        $category = NewsCategory::where('slug',$slug)->firstOrFail();
        $meta = Page::all()->keyBy('slug');
        $seo = (object)[
            'title' => $category->name ?? $meta->get('default')->meta_title,
            'desc' => $category->meta_desc ?? $meta->get('default')->meta_desc,
            'image' => Voyager::image($category->meta_image) ?? Voyager::image($meta->get('default')->image),
            'keyword' => $category->meta_keyword ?? $meta->get('default')->meta_keyword,
        ];

        $orderBy = (string) $request->input('order', '0');
        $limit = (int) $request->input('limit', '10');
        $search = $request->input('search', '');

        $news = News::query();
    
        // Lakukan filter berdasarkan kata kunci pencarian
        if (!empty($search)) {
            $news->where('title', 'like', "%$search%");
        }
    
        // Lakukan pengurutan berdasarkan pilihan pengguna
        if ($orderBy === '1') {
            $news->orderBy('created_at', 'asc');
        } else if($orderBy === '0'){
            $news->orderBy('created_at', 'desc');
        }

        $news->whereHas('categories', function ($query) use ($slug) {
        
            $query->where('slug', $slug);

        });

        $news = $news->paginate($limit);

        $tags = NewsCategory::all();
        
        return view('news_category', compact('seo','category','news', 'tags'));
    }
}
