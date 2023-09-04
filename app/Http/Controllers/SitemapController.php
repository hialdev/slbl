<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategory;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Sparepart;
use App\Models\SparepartCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class SitemapController extends Controller
{
    public function index()
    {
        // Inisialisasi array untuk menyimpan rute
        $routes = [];

        $routes[] = '/';
        $routes[] = '/about';
        $routes[] = '/contact';
        $routes[] = '/terms-of-service';
        $routes[] = '/privacy-policy';

        // News
        $news_ctg = NewsCategory::all();
        $news = News::all();
        // Tambahkan rute
        foreach ($news_ctg as $nw_ctg) {
            $routes[] = "/news/category/{$nw_ctg->slug}";
        }
        foreach ($news as $new) {
            $routes[] = "/news/{$new->slug}";
        }

        // Product
        $product_ctg = ProductCategory::all();
        $products = Product::all();
        // Tambahkan rute
        foreach ($product_ctg as $pd_ctg) {
            $routes[] = "/product/category/{$pd_ctg->slug}";
        }
        foreach ($products as $product) {
            $routes[] = "/product/{$product->slug}";
        }

        // Service
        $service_ctg = ServiceCategory::all();
        $services = Service::all();
        // Tambahkan rute
        foreach ($service_ctg as $sv_ctg) {
            $routes[] = "/service/category/{$sv_ctg->slug}";
        }
        foreach ($services as $service) {
            $routes[] = "/service/{$service->slug}";
        }

        // Sparepart
        $sparepart_ctg = SparepartCategory::all();
        $spareparts = Sparepart::all();
        // Tambahkan rute
        foreach ($sparepart_ctg as $sp_ctg) {
            $routes[] = "/sparepart/category/{$sp_ctg->slug}";
        }
        foreach ($spareparts as $sparepart) {
            $routes[] = "/sparepart/{$sparepart->slug}";
        }

        // Generate XML sitemap
        $sitemap = View::make('sitemap.index', ['routes' => $routes]);
        $response = Response::make($sitemap, 200);
        $response->header('Content-Type', 'text/xml');

        return $response;
    }
}
