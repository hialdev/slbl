<header>
    <div class="bg-dark text-white py-1">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between gap-4">
                <div class="d-none d-md-block"><marquee behavior="" direction="">{{setting('site.walk_text')}}</marquee></div>
                <div class="d-flex items-center ms-auto">
                    <a href="{{setting('site.link_address')}}" target="_blank" class="text-decoration-none d-flex text-white text-nowrap gap-2 align-items-center px-3 border-end">
                        <span class="iconify" data-icon="fa-solid:map-marker-alt"></span>
                        Office
                    </a>
                    <a href="{{'mailto:'.setting('site.mail')}}" target="_blank" class="text-decoration-none d-flex text-white text-nowrap gap-2 align-items-center px-3 border-end">
                        <span class="iconify" data-icon="pajamas:mail"></span>
                        Mail
                    </a>
                    <a href="{{'telp:'.setting('site.telp')}}" target="_blank" class="text-decoration-none d-flex text-white text-nowrap gap-2 align-items-center px-3 border-end">
                        <span class="iconify" data-icon="teenyicons:phone-outline"></span>
                        Telp
                    </a>
                    <div class="d-flex align-items-center gap-3 ms-3">
                        @foreach ($sosmeds as $sosmed)
                        <a href="{{$sosmed->link}}" target="_blank" class="text-decoration-none d-flex text-white align-items-center justify-content-center">
                            <span class="iconify" data-icon="{{$sosmed->icon}}"></span>
                        </a>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="shadow-lg py-2 md:py-3 menu-box">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between gap-3 position-relative">
                <a href="{{route('home')}}" class="d-block"><img src="{{Voyager::image(setting('site.logo'))}}" alt="Logo brand" style="width:100px;height:60px;"></a>
                <nav class="d-flex align-items-center gap-5 menu">
                    <div class="order-last order-md-first d-flex align-items-center border border-2 rounded-4 overflow-hidden">
                        <input type="text" class="form-control border-0 w-100 outline-0 rounded-0" id="searchInput" placeholder="Cari disini..">
                        <button class="btn d-flex align-items-center justify-content-center bg-danger text-white rounded-0 h-100" style="padding: 0.55em;" id="searchButton">
                            <span class="iconify" data-icon="iconamoon:search"></span>
                        </button>
                    </div>
                    <button class="btn p-0 d-flex align-items-center d-lg-none" id="menu-close">
                        <span class="iconify fs-2" data-icon="pajamas:long-arrow"></span>
                    </button>
                    <a href="{{route('about')}}" class="{{ request()->is('about') ? 'active' : '' }} text-decoration-none">About</a>
                    <a href="{{route('news')}}" class="{{ request()->is('news*') ? 'active' : '' }} text-decoration-none">News</a>
                    <div>
                        <a href="#" id="menu-product-btn" class="text-decoration-none d-flex align-items-center gap-2 {{ request()->is('product*') ? 'active' : '' }}">Product <span class="iconify color-inherit" data-icon="icon-park-outline:down"></span>
                        </a>
                        <div style="width: 100%;display: none;" class="dropdown" id="menu-product-dropdown">
                            <ul class="list-unstyled bg-light p-3 rounded-4 row">
                                <li class="col-12 mb-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="fw-semibold fs-5 text-dark">Product</div>
                                        <a href="{{route('product')}}" class="d-inline-flex p-2 px-3 align-items-center gap-3 text-decoration-none text-dark border border-dark ">Go to Product <span class="iconify" data-icon="pajamas:long-arrow"></span></a>
                                    </div>
                                </li>
                                @forelse ($product_category as $category)
                                <li class="col-12 col-lg-3">
                                    <a href="{{route('product.category',$category->slug)}}" class="d-flex gap-3 align-items-center text-decoration-none text-dark">
                                        <div class="rounded-4 bg-white d-flex align-items-center justify-content-center p-3 p-lg-4 mb-2" style="height:6em;width:6em">
                                            @if (isset($category->icon))
                                            <span class="iconify fs-1" data-icon="{{$category->icon}}"></span>
                                            @else
                                            <img src="{{Voyager::image($category->image_icon)}}" alt="{{$category->name}} Category" class="d-block rounded-2" style="aspect-ratio:1/1;max-width: 4em;">
                                            @endif
                                        </div>
                                        <h6>{{$category->name}}</h6>
                                    </a>
                                </li>
                                @empty
                                <li class="p-4 col-12">No Data Category</li>
                                @endforelse
                                <li class="col-12">
                                    <div class="row mt-4">
                                        @forelse ($products as $product)
                                        <div data-aos="fade-down" data-aos-delay="50" data-aos-duration="1000" class="col-4 col-md-4 col-lg-2 mb-3">
                                            <a href="{{route('product.show',$product->slug)}}" class="text-decoration-none d-block text-dark">
                                                <img src="{{ Voyager::image($product->thumbnail('cropped')) == "" ? Voyager::image($product->thumbnail('cropped')) : Voyager::image($product->image)}}" alt="Product {{$product->title}}" class="w-100 mb-3" style="aspect-ratio:1/1;object-fit:cover;">
                                                <h6 style="font-size: 12px;">{{$product->title}}</h6>
                                            </a>
                                        </div>
                                        @empty
                                        <div class="p-4 text-center">No Product Featured - Atur max 3 product menjadi featured</div>
                                        @endforelse
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <a href="{{route('sparepart')}}" class="{{ request()->is('sparepart*') ? 'active' : '' }} text-decoration-none">Sparepart</a>
                    <a href="{{route('service')}}" class="{{ request()->is('service*') ? 'active' : '' }} text-decoration-none">Service</a>
                    <a href="{{route('contact')}}" class="{{ request()->is('contact') ? 'active' : '' }} text-decoration-none">Contact</a>
                </nav>
                <button class="btn p-0 d-flex align-items-center d-lg-none" id="menu-open">
                    <span class="iconify fs-2" data-icon="fluent:text-align-right-16-filled"></span>
                </button>
            </div>
        </div>
    </div>
</header>