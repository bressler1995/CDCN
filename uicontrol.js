jQuery(document).ready(function($){

    console.log("Starting Eccentrik UI...");

    let elementoriframe = document.getElementById("elementor-preview-iframe");
    let cdcn_testimonials_inner, cdcn_testimonials_content_holder, contentdoc;
    let cdcn_testimonials_colw = 0;
    let cdcn_tesimonials_innerw = 0;
    let cdcn_testimonials_contentw = 0;
    let cdcn_testimonials_state = 0;
    let ct_left = document.getElementById("ct_left");
    let ct_right = document.getElementById("ct_right");
    let cdcn_videos = document.getElementById("cdcn_videos");
    let cdcn_vlb_overlay = document.getElementById("cdcn_vlb_overlay");
    let cdcn_vlb_content = document.getElementById("cdcn_vlb_content");
    let cdcn_vlb_title = document.getElementById("cdcn_vlb_title");
    let cdcn_vlb_description = document.getElementById("cdcn_vlb_description");
    let cdcn_vlb_iframe = document.getElementById("cdcn_vlb_iframe");
    let cdcn_vlb_close = document.getElementById("cdcn_vlb_close");
    let eccent_header_toggle = document.getElementById("eccent_header_toggle");
    let eccent_mobile_wrapper = document.getElementById("eccent_mobile_wrapper");
    let eccent_mobile_close = document.getElementById("eccent_mobile_close");
    let eccent_mobile_controls = document.getElementById("eccent_mobile_controls");
    let eccent_mobile_social = document.getElementById("eccent_mobile_social");
    let touchstartX = 0;
    let touchendX = 0;
    
    if(elementoriframe == null) {
        cdcn_testimonials_inner = document.getElementById("cdcn_testimonials_inner");
        cdcn_testimonials_content_holder = document.getElementById("cdcn_testimonials_content_holder");
    } else {
        console.log("Editor Mode Detected");
        check_elementor_container();
    }

    if(ct_left != null) {
        ct_left.addEventListener("click", function() {
            cdcn_testimonials_navigate(1);
        });
    }

    if(ct_right != null) {
        ct_right.addEventListener("click", function() {
            cdcn_testimonials_navigate(-1);
        });
    }

    if(eccent_header_toggle != null && eccent_mobile_wrapper != null && eccent_mobile_close != null) {
        eccent_header_toggle.addEventListener("click", function(){
            setTimeout(function(){
                show_navigation();
            }, 300);
        });

        eccent_mobile_close.addEventListener("click", function(){
            close_navigation();
        });
    }

    if(cdcn_testimonials_content_holder != null) {
        cdcn_testimonials_content_holder.addEventListener('touchstart', e => {
            touchstartX = e.changedTouches[0].screenX;
          });
      
          cdcn_testimonials_content_holder.addEventListener('touchend', e => {
              touchendX = e.changedTouches[0].screenX
              handleGesture();
         });
    }

    window.addEventListener('resize', function(event) {
        cdcn_testimonials_resize();
        cdcn_videos_resize();
    }, true);

    function cdcn_testimonials_resize() {
        if(cdcn_testimonials_inner != null && cdcn_testimonials_content_holder != null) {
            cdcn_testimonials_content_holder.style.transform = "translateX(0px)";
            cdcn_testimonials_state = 0;

            

            let cdcn_testimonials_slides = cdcn_testimonials_content_holder.getElementsByClassName("cdcn_testimonials_slide");

            let inner_bounds = cdcn_testimonials_inner.getBoundingClientRect();
            let inner_width = inner_bounds.width;
            let inner_columns = 0;

            let onphone = window.matchMedia('(max-width: 767.9px)');
            let ontablet = window.matchMedia('(min-width: 768px) and (max-width: 1024.9px)');
            let ondesktop = window.matchMedia('(min-width: 1025px)');
            
            // Check if the media query is true
            if (onphone.matches) {
                inner_columns = 1;
            } else if(ontablet.matches) {
                inner_columns = 2;
            } else if(ondesktop.matches) {
                inner_columns = 4;
            }

            cdcn_tesimonials_innerw = inner_width;
            cdcn_testimonials_colw = (inner_width / inner_columns) - 20;

            console.log("Number Of Columns: " + inner_columns);
            console.log("Col Width: " + cdcn_testimonials_colw);
            console.log("Inner Width: " + cdcn_tesimonials_innerw);

            if(cdcn_testimonials_slides != null) {
                if(cdcn_testimonials_slides.length > 0) {
                    console.log(cdcn_testimonials_slides.length + " Slides Found");
                    cdcn_testimonials_contentw = ((cdcn_testimonials_colw + 20) * cdcn_testimonials_slides.length );
                    console.log("Content Width: " + cdcn_tesimonials_innerw);

                    for(i = 0; i < cdcn_testimonials_slides.length; i++) {
                        cdcn_testimonials_slides[i].style.width = cdcn_testimonials_colw + "px";
                    }

                    cdcn_testimonials_content_holder.style.width = cdcn_testimonials_contentw + "px";
                }
            }
        }
    }

    cdcn_testimonials_resize();

    function cdcn_testimonials_inject() {

        if(cdcn_testimonials_inner != null && cdcn_testimonials_content_holder != null) {
            let cdcn_testimonials_slides = cdcn_testimonials_content_holder.getElementsByClassName("cdcn_testimonials_slide");

            if(cdcn_testimonials_slides != null) {
                if(cdcn_testimonials_slides.length > 0) {
                    for(i = 0; i < cdcn_testimonials_slides.length; i++) {
                        let current_item = cdcn_testimonials_slides[i];
                        let current_links = current_item.getElementsByTagName("a");

                        if(current_links != null) {
                            if(current_links.length == 2) {
                                current_links[0].addEventListener("click", function(event) {
                                    show_vlightbox(this.dataset.title, this.dataset.desc, this.dataset.link);
                                });

                                current_links[1].addEventListener("click", function(event) {
                                    show_vlightbox(this.dataset.title, this.dataset.desc, this.dataset.link);
                                });
                                
                            }
                        }
                        
                    }

                    if(cdcn_vlb_close != null) {
                        cdcn_vlb_close.addEventListener("click", function(){
                            close_vlightbox();
                        });
                    }
                }
            }
        }
        
    }

    cdcn_testimonials_inject();

    function cdcn_testimonials_navigate(direction) {
        if(direction == -1) {

            let onphone = window.matchMedia('(max-width: 767.9px)');
            let ontablet = window.matchMedia('(min-width: 768px) and (max-width: 1024.9px)');
            let ondesktop = window.matchMedia('(min-width: 1025px)');
            
            // Check if the media query is true
            if (onphone.matches) {
                let currentposition = (cdcn_testimonials_state * (cdcn_testimonials_colw + 20));
                let limiter = (0 * (cdcn_testimonials_colw + 20));
                let stoplength = 0 - cdcn_testimonials_contentw + limiter;
                
                if(currentposition - (cdcn_testimonials_colw + 20) > stoplength) {
                    cdcn_testimonials_state -= 1;
                }
            } else if(ontablet.matches) {
                let currentposition = (cdcn_testimonials_state * (cdcn_testimonials_colw + 20));
                let limiter = (1 * (cdcn_testimonials_colw + 20));
                let stoplength = 0 - cdcn_testimonials_contentw + limiter;
                
                if(currentposition - (cdcn_testimonials_colw + 20) > stoplength) {
                    cdcn_testimonials_state -= 1;
                }
            } else if(ondesktop.matches) {
                let currentposition = (cdcn_testimonials_state * (cdcn_testimonials_colw + 20));
                let limiter = (3 * (cdcn_testimonials_colw + 20));
                let stoplength = 0 - cdcn_testimonials_contentw + limiter;
                
                if(currentposition - (cdcn_testimonials_colw + 20) > stoplength) {
                    cdcn_testimonials_state -= 1;
                }

                
            }
            
        } else if(direction == 1) {

            if(cdcn_testimonials_state * (cdcn_testimonials_colw + 20) < 0) {
                cdcn_testimonials_state += 1;
            }
        }

        console.log('Testimonials Content W: ' + cdcn_testimonials_contentw);
        console.log('Testimonials Nav State: ' + cdcn_testimonials_state);
        console.log("Testimonals TranslateX: " + (cdcn_testimonials_state * (cdcn_testimonials_colw + 20)));

        cdcn_testimonials_content_holder.style.transform = "translateX(" + (cdcn_testimonials_state * (cdcn_testimonials_colw + 20)) + "px)";
    }

    function check_elementor_container() { 

        contentdoc = elementoriframe.contentDocument || elementoriframe.contentWindow.document;
        
        if(contentdoc != null) {
            cdcn_testimonials_inner = contentdoc.getElementById("cdcn_testimonials_inner");

            if(cdcn_testimonials_inner != null) {
                cdcn_testimonials_content_holder = contentdoc.getElementById("cdcn_testimonials_content_holder");
    
                let elementorpanel = document.getElementById("elementor-panel");
    
                if(elementorpanel != null) {
                    elementorpanel.addEventListener("resize", function(event){
                        cdcn_testimonials_resize();
                    });
                }
                    
                    
                cdcn_testimonials_resize();
            } else {
                setTimeout(function(){
                    check_elementor_container();
                }, 2000);
            }
        } else {
            setTimeout(function(){
                check_elementor_container();
            }, 2000);
        }   
        
    }

    function cdcn_videos_resize() {
        if(cdcn_videos != null) {
            let cdcn_videos_items = cdcn_videos.getElementsByClassName("cdcn_video_item");

            if(cdcn_videos_items != null) {
                if(cdcn_videos_items.length > 0) {
                    for(i = 0; i < cdcn_videos_items.length; i++) {
                        let current_item = cdcn_videos_items[i];
                        if(current_item.classList.contains("larger") == true) {
                            let cdcn_video_icon = current_item.getElementsByClassName("cdcn_video_icon");
                            let cdcn_video_title = current_item.getElementsByClassName("cdcn_video_title");
                            let cdcn_video_excerpt = current_item.getElementsByClassName("cdcn_video_excerpt");

                            if(cdcn_video_icon != null && cdcn_video_title != null && cdcn_video_excerpt != null) {
                                if(cdcn_video_icon.length == 1 && cdcn_video_title.length == 1 && cdcn_video_excerpt.length > 0) {
                                    let video_icon_height = cdcn_video_title[0].offsetHeight + 8 + cdcn_video_excerpt[0].offsetHeight;
                                
                                    if (window.matchMedia('(max-width: 767.9px)').matches) {
                                        cdcn_video_icon[0].style.minHeight = "initial";
                                    } else if (window.matchMedia('(min-width: 768px)').matches) {
                                        cdcn_video_icon[0].style.minHeight = video_icon_height + "px";
                                    }
                                }
                            }
                        }

                    }
                } 
            }

        }
    }

    cdcn_videos_resize();

    function cdcn_videos_inject() {
        if(cdcn_videos != null) {
            let cdcn_videos_items = cdcn_videos.getElementsByClassName("cdcn_video_item");

            if(cdcn_videos_items != null) {
                if(cdcn_videos_items.length > 0) {
                    for(i = 0; i < cdcn_videos_items.length; i++) {
                        let current_item = cdcn_videos_items[i];

                        current_item.addEventListener("click", function(event){
                            show_vlightbox(this.dataset.title, this.dataset.desc, this.dataset.link);
                        });
                    }
                }
            }

            if(cdcn_vlb_close != null) {
                cdcn_vlb_close.addEventListener("click", function(){
                    close_vlightbox();
                });
            }
            
        }
    }

    cdcn_videos_inject();

    function show_vlightbox(titleParam, descParam, linkParam) {
        let linkpass = false;
        let splitresult = '';
        let finalstring = '';
        console.log("Title: " + titleParam + ", Description: " + descParam + ", Link: " + linkParam);

        if(eccent_mobile_wrapper != null) {
            if(eccent_mobile_wrapper.classList.contains("show") == true) {
                close_navigation();
            }
        }

        if(linkParam.includes('youtube.com/watch?v=')) {
            linkpass = true;
            splitresult = linkParam.split("watch?v=");
        } else if(linkParam.includes('youtu.be/')) {
            linkpass = true;
            splitresult = linkParam.split("be/");
        } else {
            if(linkParam == "-1") {
                linkpass = false;
            }
        }

        if(splitresult != null & splitresult != '') {
            if(splitresult.length == 2) {
                finalstring = 'https://www.youtube.com/embed/' + splitresult[1];
            } else {
                linkpass = false;
            }
        } else {
            linkpass = false;
        }

        if(cdcn_vlb_overlay != null && cdcn_vlb_content != null && linkpass == true) {
            if(cdcn_vlb_title != null && cdcn_vlb_description != null && cdcn_vlb_iframe != null) {
                cdcn_vlb_title.innerHTML = titleParam;
                cdcn_vlb_description.innerHTML = descParam;
                cdcn_vlb_iframe.src = finalstring;
            }

            cdcn_vlb_overlay.style.zIndex = "99998";
            cdcn_vlb_content.style.zIndex = "99999";
            cdcn_vlb_overlay.style.pointerEvents = "initial";
            cdcn_vlb_content.style.pointerEvents = "initial";

            setTimeout(function(){
                if(cdcn_vlb_overlay.classList.contains("show") == false) {
                    cdcn_vlb_overlay.classList.add("show");
                }

            }, 200);

            setTimeout(function(){
                if(cdcn_vlb_content.classList.contains("show") == false) {
                    cdcn_vlb_content.classList.add("show");
                }
            }, 600);
        }
    }

    function close_vlightbox() {
        if(cdcn_vlb_overlay != null && cdcn_vlb_content != null) {

            if(cdcn_vlb_content.classList.contains("show") == true) {
                cdcn_vlb_content.classList.remove("show");
            }

            setTimeout(function(){
                if(cdcn_vlb_overlay.classList.contains("show") == true) {
                    cdcn_vlb_overlay.classList.remove("show");
                }

                if(cdcn_vlb_iframe != null) {
                    cdcn_vlb_iframe.src = '';
                }

                cdcn_vlb_overlay.style.zIndex = "-99998";
                cdcn_vlb_content.style.zIndex = "-99999";
                cdcn_vlb_overlay.style.pointerEvents = "none";
                cdcn_vlb_content.style.pointerEvents = "none";
            }, 500);
        }
    }

    function show_navigation() {
        if(eccent_mobile_wrapper.classList.contains("show") == false) {
            eccent_mobile_wrapper.classList.add("show");
        }

        let eccent_mobile_menu = eccent_mobile_wrapper.getElementsByClassName("eccent_mobile_menu");

        if(eccent_mobile_menu != null) {
            if(eccent_mobile_menu.length == 1) {
                let themenuitems = eccent_mobile_menu[0].getElementsByTagName("li");

                if(themenuitems != null) {
                    if(themenuitems.length > 0) {
                        for(i = 0; i < themenuitems.length; i++) {
                            let thecurrentitem = themenuitems[i];
                            setTimeout(function(){
                                if(thecurrentitem.classList.contains("show") == false) {
                                    thecurrentitem.classList.add("show");
                                }
                            }, (i * 200));
                        }
                    }
                }
            }
        }

        setTimeout(function(){
            if(eccent_mobile_controls != null) {
                if(eccent_mobile_controls.classList.contains("show") == false) {
                    eccent_mobile_controls.classList.add("show");
                }
            }
        }, 150);

        setTimeout(function(){
            if(eccent_mobile_social != null) {
                let eccent_mobile_social_a = eccent_mobile_social.getElementsByTagName("a");

                if(eccent_mobile_social_a != null) {
                    if(eccent_mobile_social_a.length > 0) {
                        for(i = 0; i < eccent_mobile_social_a.length; i++) {
                            let thecurrentitem = eccent_mobile_social_a[i];

                            setTimeout(function(){
                                if(thecurrentitem.classList.contains("show") == false) {
                                    thecurrentitem.classList.add("show");
                                }
                            }, (i * 200));
                        }
                    }
                }
            }
        }, 300);

        if(cdcn_vlb_overlay.classList.contains("show") == true) {
            close_vlightbox();
        }
    }

    function close_navigation() {
        if(eccent_mobile_wrapper.classList.contains("show") == true) {
            eccent_mobile_wrapper.classList.remove("show");
        }

        setTimeout(function(){
            let eccent_mobile_menu = eccent_mobile_wrapper.getElementsByClassName("eccent_mobile_menu");

            if(eccent_mobile_menu != null) {
                if(eccent_mobile_menu.length == 1) {
                    let themenuitems = eccent_mobile_menu[0].getElementsByTagName("li");

                    if(themenuitems != null) {
                        if(themenuitems.length > 0) {
                            for(i = 0; i < themenuitems.length; i++) {
                                let thecurrentitem = themenuitems[i];
                                if(thecurrentitem.classList.contains("show") == true) {
                                    thecurrentitem.classList.remove("show");
                                }
                            }
                        }
                    }
                }
            }

            if(eccent_mobile_controls != null) {
                if(eccent_mobile_controls.classList.contains("show") == true) {
                    eccent_mobile_controls.classList.remove("show");
                }
            }

            if(eccent_mobile_social != null) {
                let eccent_mobile_social_a = eccent_mobile_social.getElementsByTagName("a");

                if(eccent_mobile_social_a != null) {
                    if(eccent_mobile_social_a.length > 0) {
                        for(i = 0; i < eccent_mobile_social_a.length; i++) {
                            let thecurrentitem = eccent_mobile_social_a[i];

                            setTimeout(function(){
                                if(thecurrentitem.classList.contains("show") == true) {
                                    thecurrentitem.classList.remove("show");
                                }
                            }, (i * 200));
                        }
                    }
                }
            }
        }, 400);
    }

    function handleGesture() {
        if (touchendX < touchstartX) {
            console.log("Swiped left");
            cdcn_testimonials_navigate(-1);
        }

        if (touchendX > touchstartX) {
            console.log("Swiped right");
            cdcn_testimonials_navigate(1);
        }
    }
    
});