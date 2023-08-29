<footer class="bg-dark text-white">
    <div class="container py-5">
        <div class="row justify-content-around">
            <div data-aos="fade-down" data-aos-delay="0" data-aos-duration="1000" class="mb-3 col-12 col-lg-3 pe-4">
                <img src="{{Voyager::image(setting('footer.logo'))}}" alt="{{setting('site.title')}} Logo brand" class="d-block mb-3" style="aspect-ratio:100/60;max-height:5em;">
                <p>{{setting('footer.desc')}}</p>
            </div>
            <div data-aos="fade-down" data-aos-delay="150" data-aos-duration="1000" class="mb-3 col-6 col-lg-3">
                <h5 class="mb-2">Links</h5>
                <div class="p-1 bg-danger mb-3" style="width: 2em;"></div>
                <ul class="list-unstyled d-flex flex-column gap-3">
                    <li><a href="{{route('about')}}" class="text-decoration-none text-white">About</a></li>
                    <li><a href="{{route('news')}}" class="text-decoration-none text-white">News</a></li>
                    <li><a href="{{route('product')}}" class="text-decoration-none text-white">Product</a></li>
                    <li><a href="{{route('sparepart')}}" class="text-decoration-none text-white">Sparepart</a></li>
                    <li><a href="{{route('service')}}" class="text-decoration-none text-white">Service</a></li>
                    <li><a href="{{route('contact')}}" class="text-decoration-none text-white">Contact</a></li>
                    <li><a href="{{route('privacy')}}" class="text-decoration-none text-white">Privacy Policy</a></li>
                    <li><a href="{{route('tos')}}" class="text-decoration-none text-white">Terms of Service</a></li>
                </ul>
            </div>
            <div data-aos="fade-down" data-aos-delay="300" data-aos-duration="1000" class="mb-3 col-6 col-lg-3">
                <h5 class="mb-2">Products</h5>
                <div class="p-1 bg-danger mb-3" style="width: 2em;"></div>
                <ul class="list-unstyled d-flex flex-column gap-3">
                    @foreach ($products as $product)
                    <li><a href="{{route('product.show',$product->slug)}}" class="text-decoration-none text-white">{{$product->slug}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div data-aos="fade-down" data-aos-delay="500" data-aos-duration="1000" class="mb-3 col-12 col-lg-3">
                <h5>Meet with us</h5>
                <p>{{setting('footer.address')}}</p>
                <iframe src="{{setting('site.gmap')}}" style="border:0;min-height: 10em;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div data-aos="fade" data-aos-delay="0" data-aos-duration="1000" class="mb-3 col-12 pt-5">
                &copy; {{setting('footer.credit')}}
            </div>
        </div>
    </div>
</footer>