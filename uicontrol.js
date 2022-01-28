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

    if(cdcn_testimonials_content_holder != null) {
        cdcn_testimonials_content_holder.addEventListener('touchstart', e => {
            touchstartX = e.changedTouches[0].screenX;
          });
      
          cdcn_testimonials_content_holder.addEventListener('touchend', e => {
              touchendX = e.changedTouches[0].screenX
              handleGesture();
         });
    }

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
            cdcn_testimonials_colw = (inner_width / inner_columns) - 14;

            console.log("Number Of Columns: " + inner_columns);
            console.log("Col Width: " + cdcn_testimonials_colw);
            console.log("Inner Width: " + cdcn_tesimonials_innerw);

            if(cdcn_testimonials_slides != null) {
                if(cdcn_testimonials_slides.length > 0) {
                    console.log(cdcn_testimonials_slides.length + " Slides Found");
                    cdcn_testimonials_contentw = ((cdcn_testimonials_colw + 14) * cdcn_testimonials_slides.length );
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

    window.addEventListener('resize', function(event) {
        cdcn_testimonials_resize();
    }, true);

    function cdcn_testimonials_navigate(direction) {
        if(direction == -1) {
            cdcn_testimonials_state -= 1;
        } else if(direction == 1) {
            cdcn_testimonials_state += 1;
        }

        cdcn_testimonials_content_holder.style.transform = "translateX(" + (cdcn_testimonials_state * (cdcn_testimonials_colw + 14)) + "px)";
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