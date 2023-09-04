<div class="position-fixed top-0 end-0 bottom-0 start-0 d-flex align-items-center justify-content-center pt-5" style="z-index: 999;background:#00000059" id="popup">
    <div class="container position-relative mt-5">
        <div class="text-end position-absolute top-0 end-0 p-3  px-4">
            <div id="close-popup" class="cursor-pointer d-inline-flex align-items-center bg-danger text-white justify-content-center p-2 rounded-5 shadow">
                <span class="iconify" data-icon="ci:close-md"></span>
            </div>
        </div>
        <div class="rounded-4 p-3 bg-white text-dark shadow">
            <div class="row">
                <div class="col-12 col-lg-6 p-4">
                    <h1>{{$popup->title}}</h1>
                    <p>{{$popup->desc}}</p>
                    <a href="{{$popup->btn_link}}" class="btn btn-danger">{{$popup->btn_text}}</a>
                </div>
                <div class="col-12 col-lg-6">
                    <img src="{{Voyager::image($popup->image)}}" alt="{{$popup->title}} Image" class="w-100 d-block rounded-3">
                </div>
            </div>
        </div>
    </div>
</div>