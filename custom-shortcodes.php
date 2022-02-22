<?php
    add_shortcode('cdcn_testimonials', 'cdcn_tesimonials_function');

    function cdcn_tesimonials_function() {
        $slides_output = '';
        $slides_count = 0;

        $args = array(  
            'post_type' => 'testimonial',
            'post_status' => 'publish',
            'posts_per_page' => -1, 
            'orderby' => 'date', 
            'order' => 'DESC',
        );
    
        $loop = new WP_Query( $args ); 
            
        while ( $loop->have_posts() ) : $loop->the_post(); 
            $slides_count++;
            $the_id = get_the_ID();
            $the_featured_image = get_the_post_thumbnail_url( $the_id, 'large' );
            $the_title = get_the_title();

            $cdcn_videos_customfields = pods( 'testimonial', $the_id );
            $cdcn_videos_description = $cdcn_videos_customfields->field( 'description' );
            $cdcn_videos_youtube = $cdcn_videos_customfields->field( 'youtube_link' );
            $trimmed_description = '';

            if(empty($cdcn_videos_description) == false && isset($cdcn_videos_description) == true) {
                $trimmed_description = strlen($cdcn_videos_description) > 55 ? substr($cdcn_videos_description,0,55)."..." : $cdcn_videos_description;
            } else {
                $trimmed_description = 'No Description Available For This Item...';
            }

            if(str_contains($cdcn_videos_youtube, 'youtube.com/watch?v') == true) {
                $cdcn_videos_youtube = $cdcn_videos_youtube;
            } else if(str_contains($cdcn_videos_youtube, 'youtu.be/') == true) {
                $cdcn_videos_youtube = $cdcn_videos_youtube;
            } else {
                $cdcn_videos_youtube = '-1';
            }

            if(empty($the_featured_image) == false && isset($the_featured_image)) {
                $slides_output .= '<div class="cdcn_testimonials_slide">
                    <a data-title="' . $the_title . '" data-desc="' . $cdcn_videos_description . '" data-link="' . $cdcn_videos_youtube . '" class="cdcn_tslide_imagelink" href="javascript:void(0)"><img class="cdcn_tslide_img" src="' . $the_featured_image . '"><img class="cdcn_tslide_icon" src="' . get_stylesheet_directory_uri() . '/svg/inlineplay.svg"></a>
                    <a data-title="' . $the_title . '" data-desc="' . $cdcn_videos_description . '" data-link="' . $cdcn_videos_youtube . '" class="cdcn_tslide_titlelink" href="javascript:void(0)">' . $the_title . '</a>
                    <p>' . $trimmed_description . '</p>
                </div>';
            }

        endwhile;
    
        wp_reset_postdata();

        if($slides_count > 0) {
            $result = '<div id="cdcn_testimonials" class="cdcn_testimonials">
                <div class="cdcn_testimonials_module">
                    <button id="ct_left" class="cdcn_tesimonials_arrow ct_left"><img src="' . get_stylesheet_directory_uri() . '/svg/prev.svg"></button>
                    <button id="ct_right" class="cdcn_tesimonials_arrow ct_right"><img src="' . get_stylesheet_directory_uri() . '/svg/next.svg"></button>
                    <div class="cdcn_testimonials_inner" id="cdcn_testimonials_inner">
                        <div class="cdcn_testimonials_content_holder" id="cdcn_testimonials_content_holder">' . 
                            $slides_output . 
                        '</div>
                    </div>
                </div>
            </div>';
        } else {
            $result = '<div class="notestimonials">Error: No Testimonials Available...</div>';
        }
        
        return $result;
    }

    add_shortcode('cdcn_videos', 'cdcn_videos_function');

    function cdcn_videos_function() {
        $cdcn_videos_perpage = 16;
        $cdcn_videos_output = '';

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $cdcn_videos_param = array( 'posts_per_page'=>$cdcn_videos_perpage,
            'post_type'=>'video',
            'post_status' => 'publish',
            'paged' => $paged);
        $cdcn_videos_query = new WP_Query($cdcn_videos_param);
        $cdcn_videos_counter = 0;
        

        while ($cdcn_videos_query -> have_posts()) { 
            $cdcn_videos_query -> the_post();
            $cdcn_videos_classes = '';
            $the_title = get_the_title();
            $trimmed_description = '';
            $the_id = get_the_ID();
            $the_featured_image = get_the_post_thumbnail_url( $the_id, 'large' );
            $cdcn_videos_customfields = pods( 'video', $the_id );
            $cdcn_videos_description = $cdcn_videos_customfields->field( 'description' );
            $cdcn_videos_youtube = $cdcn_videos_customfields->field( 'youtube_link' );
            $trimmed_description_alt = '';
            $cdcn_videos_counter += 1;
            $cdcn_description_output = '';

            if(str_contains($cdcn_videos_youtube, 'youtube.com/watch?v') == true) {
                $cdcn_videos_youtube = $cdcn_videos_youtube;
            } else if(str_contains($cdcn_videos_youtube, 'youtu.be/') == true) {
                $cdcn_videos_youtube = $cdcn_videos_youtube;
            } else {
                $cdcn_videos_youtube = '-1';
            }

            if($cdcn_videos_counter == 1 && 1 == $paged) {
                $cdcn_videos_classes = 'cdcn_video_item larger';
                $trimmed_description = $cdcn_videos_description;
                $trimmed_description_alt = strlen($cdcn_videos_description) > 55 ? substr($cdcn_videos_description,0,55)."..." : $cdcn_videos_description;
                $cdcn_description_output = '<span class="cdcn_video_excerpt">' . $trimmed_description . '</span><span class="cdcn_video_excerpt">' . $trimmed_description_alt . '</span>';
            } else {
                $cdcn_videos_classes = 'cdcn_video_item';
                $trimmed_description = strlen($cdcn_videos_description) > 55 ? substr($cdcn_videos_description,0,55)."..." : $cdcn_videos_description;
                $cdcn_description_output = '<span class="cdcn_video_excerpt">' . $trimmed_description . '</span>';
            }

            if(empty($the_featured_image) == false && isset($the_featured_image)) {
                $cdcn_videos_output .= '<a data-title="'. $the_title . '" data-desc="' . $cdcn_videos_description . '" data-link="' . $cdcn_videos_youtube . '" class="' . $cdcn_videos_classes . '" href="javascript:void(0)"><img class="cdcn_video_mainimage" src="' . $the_featured_image . '"><div class="cdcn_video_textholder"><img class="cdcn_video_icon" src="' . get_stylesheet_directory_uri() . '/svg/inlineplay.svg"><h4 class="cdcn_video_title">' . $the_title . '</h4>' . $cdcn_description_output. '</div></a>';
            }

        }

        //pagination
        $big = 999999999;
        $the_pagination_links = paginate_links( array(
            'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $cdcn_videos_query->max_num_pages,
            'prev_next' => false
        ));

        wp_reset_postdata();
        
        $result = '<div id="cdcn_videos" class="cdcn_videos">' . 
            $cdcn_videos_output . 
        '</div>
        <div class="cdcn_videos_pagination">' .
            $the_pagination_links .
        '</div>';

        return $result;
    }
?>