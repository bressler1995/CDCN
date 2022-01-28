<?php
    add_shortcode('cdcn_testimonials', 'cdcn_tesimonials_function');

    function cdcn_tesimonials_function() {
        $result = '<div id="cdcn_testimonials" class="cdcn_testimonials">
                <div class="cdcn_testimonials_module">
                    <button id="ct_left" class="cdcn_tesimonials_arrow ct_left"><img src="' . get_stylesheet_directory_uri() . '/svg/prev.svg"></button>
                    <button id="ct_right" class="cdcn_tesimonials_arrow ct_right"><img src="' . get_stylesheet_directory_uri() . '/svg/next.svg"></button>
                    <div class="cdcn_testimonials_inner" id="cdcn_testimonials_inner">
                        <div class="cdcn_testimonials_content_holder" id="cdcn_testimonials_content_holder">
                            <div class="cdcn_testimonials_slide">
                                <a class="cdcn_tslide_imagelink" href="javascript:void(0)"><img src="' . get_stylesheet_directory_uri() . '/img/video-placeholder.jpg"></a>
                                <a class="cdcn_tslide_titlelink" href="javascript:void(0)">Lorem Ipsum</a>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                            </div>
                            <div class="cdcn_testimonials_slide">
                                <a class="cdcn_tslide_imagelink" href="javascript:void(0)"><img src="' . get_stylesheet_directory_uri() . '/img/video-placeholder.jpg"></a>
                                <a class="cdcn_tslide_titlelink" href="javascript:void(0)">Lorem Ipsum</a>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                            </div>
                            <div class="cdcn_testimonials_slide">
                                <a class="cdcn_tslide_imagelink" href="javascript:void(0)"><img src="' . get_stylesheet_directory_uri() . '/img/video-placeholder.jpg"></a>
                                <a class="cdcn_tslide_titlelink" href="javascript:void(0)">Lorem Ipsum</a>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                            </div>
                            <div class="cdcn_testimonials_slide">
                                <a class="cdcn_tslide_imagelink" href="javascript:void(0)"><img src="' . get_stylesheet_directory_uri() . '/img/video-placeholder.jpg"></a>
                                <a class="cdcn_tslide_titlelink" href="javascript:void(0)">Lorem Ipsum</a>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                            </div>
                        </div>
                    </div>
                </div>
        </div>';
        
        return $result;
    }
?>