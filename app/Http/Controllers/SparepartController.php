<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Sparepart;
use App\Models\SparepartCategory;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;

class SparepartController extends Controller
{
    public function index(Request $request) {
        $search = $request->input('search', '');
        
        $meta = Page::all()->keyBy('slug');
        $seo = (object)[
            'title' => $meta->get('sparepart')->meta_title ?? $meta->get('default')->meta_title,
            'desc' => $meta->get('sparepart')->meta_desc ?? $meta->get('default')->meta_desc,
            'image' => Voyager::image($meta->get('sparepart')->image) ?? Voyager::image($meta->get('default')->image),
            'keyword' => $meta->get('sparepart')->meta_keyword ?? $meta->get('default')->meta_keyword,
        ];

        $categories = SparepartCategory::all();
        $spareparts = Sparepart::query();
    
        // Lakukan filter berdasarkan kata kunci pencarian
        if (!empty($search)) {
            $spareparts->where('title', 'like', "%$search%");
        }

        $spareparts = $spareparts->paginate(15);
        return view('sparepart', compact('seo','spareparts','categories'));
    }

    public function show($slug) {
        $meta = Page::all()->keyBy('slug');
        $sparepart = Sparepart::where('slug',$slug)->firstOrFail();
        $seo = (object)[
            'title' => $sparepart->title ?? $meta->get('default')->meta_title,
            'desc' => $sparepart->meta_description ?? $meta->get('default')->meta_desc,
            'image' => Voyager::image($sparepart->image) ?? Voyager::image($meta->get('default')->image),
            'keyword' => $sparepart->meta_keyword ?? $meta->get('default')->meta_keyword,
        ];

        $suggests = [];
        
        $sparepart_list1 = Sparepart::latest()->limit(4)->get();
        $sparepart_list = SparepartCategory::where('slug',$sparepart->category->slug)->firstOrFail();
        
        foreach ($sparepart_list->spareparts as $sparepart) {
            if ($sparepart->slug != $slug) {
                array_push($suggests, $sparepart);
            }
        }
        
        foreach ($sparepart_list1 as $spareparts1) {
            if(count($suggests) < 4){
                array_push($suggests,$spareparts1);
            }else{
                break;
            }
        }

        $page = Page::where('slug','sparepart-show')->firstOrFail();
        $banner = $page->banner;

        return view('sparepart_item', compact('seo','sparepart','suggests','banner'));
    }

    public function category(Request $request, $slug) {
        $search = $request->input('search', '');
        $category = SparepartCategory::where('slug',$slug)->firstOrFail();
        
        $meta = Page::all()->keyBy('slug');
        $seo = (object)[
            'title' => $meta->get('sparepart')->meta_title ?? $meta->get('default')->meta_title,
            'desc' => $meta->get('sparepart')->meta_desc ?? $meta->get('default')->meta_desc,
            'image' => Voyager::image($meta->get('sparepart')->image) ?? Voyager::image($meta->get('default')->image),
            'keyword' => $meta->get('sparepart')->meta_keyword ?? $meta->get('default')->meta_keyword,
        ];

        $categories = SparepartCategory::all();
        $spareparts = Sparepart::query();
    
        // Lakukan filter berdasarkan kata kunci pencarian
        if (!empty($search)) {
            $spareparts->where('title', 'like', "%$search%");
        }

        $spareparts->whereHas('category', function ($query) use ($slug) {
            $query->where('slug', $slug);
        });

        $spareparts = $spareparts->paginate(15);

        return view('sparepart_category', compact('seo','spareparts','category', 'categories'));
    }
}
