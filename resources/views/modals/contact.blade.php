<div class="position-fixed bottom-0 end-0 m-3" style="z-index: 99;">
    <div class="d-flex flex-column gap-2">
        <div data-aos="fade-down" data-aos-delay="50" data-aos-duration="1000" class="flex-column gap-2" id="data-floating" style="display:none;transition: all 0.3s ease-in-out;">
            <div class="ms-auto">
                <div class="d-flex align-items-center cursor-pointer">
                    <div class="rounded-5 bg-primary text-white fw-semibold p-2 px-3" style="margin-right: -1em; border-top-right-radius: 0px !important ; border-bottom-right-radius: 0px !important ;">Call</div>
                    <a href="{{"telp:".setting('site.telp')}}" class="text-decoration-none d-inline-flex align-items-center justify-content-center rounded-5 p-2 bg-primary text-white"><span class="iconify fs-2" data-icon="ph:phone"></span></a>
                </div>
            </div>
            <div class="ms-auto">
                <div class="d-flex align-items-center cursor-pointer">
                    <div class="rounded-5 bg-success text-white fw-semibold p-2 px-3" style="margin-right: -1em; border-top-right-radius: 0px !important ; border-bottom-right-radius: 0px !important ;">WhatsApp</div>
                    <a href="{{url('https://wa.me/'.setting('site.whatsapp'))}}" class="text-decoration-none d-inline-flex align-items-center justify-content-center rounded-5 p-2 bg-success text-white"><span class="iconify fs-2" data-icon="bi:whatsapp"></span></a>
                </div>
            </div>
            <div class="ms-auto" id="close-floating">
                <div class="d-flex cursor-pointer align-items-center justify-content-center p-2 bg-dark text-white rounded-5 cursor-pointer">
                    <span class="iconify fs-3" data-icon="ci:close-md"></span>
                </div>
            </div>
        </div>
        <div class="ms-auto">
            <div class="d-flex align-items-center cursor-pointer" id="open-floating">
                <div class="rounded-5 bg-dark text-white fw-semibold p-2 px-3" style="margin-right: -1em; border-top-right-radius: 0px !important ; border-bottom-right-radius: 0px !important ;">Chat us</div>
                <div class="rounded-5 d-flex align-items-center justify-content-center p-2 bg-dark text-white">
                    <span class="iconify fs-2" data-icon="fluent:chat-24-filled"></span>
                </div>
            </div>
        </div>
    </div>
</div>