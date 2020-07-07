@extends('layout_general.index_general') @section('content')
<div class="row page-titles m-t-40">
    <div class="col-sm col-md">
        <form method="POST" action="{{ Route('general.save.links') }}" enctype="multipart/form-data">
            @csrf
            <section class="add-upload-photo d-flex">
                <img width="70px" src="{{ asset('assets/images/user.svg') }}" class=""/>
                <div class="d-flex align-items-center">
                    <input type="file" name="foto" lass="form-control-file" id="exampleFormControlFile1" />
                </div>
            </section>
            <section class="add-status">
                <div class="form-group d-flex align-items-center m-t-20">
                    <input type="text" placeholder="tulis status anda" class="form-control" name="status"/>
                </div>
            </section>
            <section class="add-link">
                <a id="add-btn-link" class="btn btn-instagram text-white" style="width: 100%;"><i
                        class="mdi mdi-plus"></i> Tautan</a>
                <button type="submit" class="btn btn-instagram m-t-5 m-b-10 text-white" style="width: 100%;"><i
                        class="mdi mdi-content-save"></i> Simpan</button>
                <div id="linklist" class="link-list m-20 text-center">
                    <div id="first-your-link" class="mt-3 row" style="display: none">
                        <div class="col-md input-group ">
                            <div class="input-group-prepend">
                                <button id="dropdown-type-button" class="btn btn-outline-secondary dropdown-toggle"
                                    type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Tipe</button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#"><i id="gmail" class="mdi mdi-gmail"></i> Email</a>
                                    <a class="dropdown-item" href="#"><i id="youtube" class="mdi mdi-youtube-play"></i>
                                        Youtube</a>
                                    <a class="dropdown-item" href="#"><i id="whatsapp" class="mdi mdi-whatsapp"></i>
                                        Whatsapp</a>
                                </div>
                            </div>
                            <input type="text" id="social-links" name="social_links[]" style="display: none"
                                value="other">
                            <input type="text" name="links[]" class="form-control" placeholder="https://"
                                aria-label="Tautan">
                            <div class="input-group-append">
                                <span id="close-link" class="input-group-text"><i class="mdi mdi-close"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </form>
    </div>
    <div class="col-sm col-md text-center">
        <a target="_blank"
            href="{{ Route("username", "pinterus") }}">{{ Route("username", "pinterus") }}</a>
        <img style="width: 85%;" src="{{ asset('assets/images/home_phone.jpg') }}" />
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#add-btn-link").click(function () {
            // defining DOM
            const el = $("#first-your-link").clone().css('display', 'block');
            // insert clone element
            $('#linklist').append(el);
            // delete element
            el.find('#close-link').on("click", function () {
                el.remove();
            });
            //each dropdown click
            el.find('.dropdown-item').each(function (index) {
                $(this).on("click", function () {
                    const element = '<i class="' + $(this).find('i').attr('class') +
                        '"></i>';
                    el.find("#dropdown-type-button").html(element);
                    el.find('#social-links').val($(this).find('i').attr('id'));
                })
            })
        });
    });

</script>

@endsection
