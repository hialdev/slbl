<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;

class ServiceController extends Controller
{
    public function index(Request $request) {
        $search = $request->input('search', '');
        
        $meta = Page::all()->keyBy('slug');
        $seo = (object)[
            'title' => $meta->get('service')->meta_title ?? $meta->get('default')->meta_title,
            'desc' => $meta->get('service')->meta_desc ?? $meta->get('default')->meta_desc,
            'image' => Voyager::image($meta->get('service')->image) ?? Voyager::image($meta->get('default')->image),
            'keyword' => $meta->get('service')->meta_keyword ?? $meta->get('default')->meta_keyword,
        ];

        $categories = ServiceCategory::all();
        $services = Service::query();
    
        // Lakukan filter berdasarkan kata kunci pencarian
        if (!empty($search)) {
            $services->where('title', 'like', "%$search%");
        }

        $services = $services->paginate(15);
        return view('service', compact('seo','services','categories'));
    }

    public function show($slug) {
        $meta = Page::all()->keyBy('slug');
        $service = Service::where('slug',$slug)->firstOrFail();
        $seo = (object)[
            'title' => $service->title ?? $meta->get('default')->meta_title,
            'desc' => $service->meta_description ?? $meta->get('default')->meta_desc,
            'image' => Voyager::image($service->image) ?? Voyager::image($meta->get('default')->image),
            'keyword' => $service->meta_keyword ?? $meta->get('default')->meta_keyword,
        ];

        $suggests = [];
        
        $service_list1 = Service::latest()->limit(4)->get();
        $service_list = ServiceCategory::where('slug',$service->category->slug)->firstOrFail();
        
        foreach ($service_list->services as $service) {
            if ($service->slug != $slug) {
                array_push($suggests, $service);
            }
        }
        
        foreach ($service_list1 as $services1) {
            if(count($suggests) < 3){
                array_push($suggests,$services1);
            }else{
                break;
            }
        }

        $page = Page::where('slug','service-show')->firstOrFail();
        $banner = $page->banner;

        return view('service_item', compact('seo','service','suggests','banner'));
    }

    public function category(Request $request, $slug) {
        $search = $request->input('search', '');
        $category = ServiceCategory::where('slug',$slug)->firstOrFail();
        
        $meta = Page::all()->keyBy('slug');
        $seo = (object)[
            'title' => $meta->get('service')->meta_title ?? $meta->get('default')->meta_title,
            'desc' => $meta->get('service')->meta_desc ?? $meta->get('default')->meta_desc,
            'image' => Voyager::image($meta->get('service')->image) ?? Voyager::image($meta->get('default')->image),
            'keyword' => $meta->get('service')->meta_keyword ?? $meta->get('default')->meta_keyword,
        ];

        $categories = ServiceCategory::all();
        $services = Service::query();
    
        // Lakukan filter berdasarkan kata kunci pencarian
        if (!empty($search)) {
            $services->where('title', 'like', "%$search%");
        }

        $services->whereHas('category', function ($query) use ($slug) {
            $query->where('slug', $slug);
        });

        $services = $services->paginate(15);

        return view('service_category', compact('seo','services','category', 'categories'));
    }
}
