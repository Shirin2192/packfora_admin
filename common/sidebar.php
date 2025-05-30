<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <!-- Profile -->
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="<?= base_url(); ?>assets/images/faces/face1.jpg" alt="profile" />
                    <span class="login-status online"></span>
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">Admin</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>

        <!-- Main Items -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url(); ?>admin/index">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>   
         <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#homeMenu" aria-expanded="false" aria-controls="homeMenu">
                <span class="menu-title">Home</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              </a>
              <div class="collapse" id="homeMenu">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="<?= base_url(); ?>admin/slider">Home Slider</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?= base_url(); ?>admin/intro">Intro</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?= base_url(); ?>admin/our_services">Our Services</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?= base_url(); ?>admin/our_clients">Our Clients</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?= base_url(); ?>admin/our_impact">Our Impact</a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" href="<?= base_url(); ?>admin/case_study">Case Studies</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?= base_url(); ?>admin/knowledge_centre">Knowledge Centre</a>
                  </li>
                </ul>
              </div>
            </li>
        <!-- Who We Are -->
         <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#whoWeAreMenu" aria-expanded="false" aria-controls="whoWeAreMenu">
                <span class="menu-title">Who We Are</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            </a>
            <div class="collapse" id="whoWeAreMenu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><span class="menu-sub-header">Why Packfora</span></li>
                    <!-- <li class="nav-item ps-3"><span class="menu-child-header">Talent Flex</span></li> -->
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/how_we_do_it">How We Do It?</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/our_promise">Our Promise</a></li>                  
                </ul>
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><span class="menu-sub-header">Our Leadership</span></li>
                   
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/leadership_team">Leadership Team</a></li>                    
                </ul>
            </div>
        </li>
        <!-- What We Do -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#whatWeDoMenu" aria-expanded="false" aria-controls="whatWeDoMenu">
                <span class="menu-title">What We Do</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            </a>
            <div class="collapse" id="whatWeDoMenu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><span class="menu-sub-header">Services</span></li>
                    <li class="nav-item ps-3"><span class="menu-child-header">Talent Flex</span></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/our_offerings">Our Offerings</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/discover_the_benefits_of_talent_flex">Discover the Benefits of Talent Flex</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/success_stories">Success Stories</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/our_leaders">Our Leaders</a></li>

                    <li class="nav-item ps-3"><span class="menu-child-header">Sustainability</span></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/market_trends">Market Trends</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/sustainability_our_offerings">Our Offerings</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/our_approach">Our Approach</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/sustainability_success_stories">Success Stories</a></li>

                    <li class="nav-item ps-3"><span class="menu-child-header">Supply Chain Automation</span></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/market_trends">Market Trends</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/supply_chain_our_offerings">Our Offerings</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/discover_the_benefits_of_supply_chain_automation">Discover the Benefits</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/supply_chain_success_stories">Success Stories</a></li>

                    <li class="nav-item ps-3"><span class="menu-child-header">Design To Value</span></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/design_to_value_our_offerings">Our Offerings</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/discover_the_benefits_of_design_to_value">Discover the Benefits</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/design_to_value_success_stories">Success Stories</a></li>

                    <li class="nav-item ps-3"><span class="menu-child-header">Packaging Innovation & Engineering</span></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/packaging_innovation_our_offerings">Our Offerings</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/discover_the_benefits_of_packaging_innovation">Discover the Benefits</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/packaging_innovation_success_stories">Success Stories</a></li>

                    <li class="nav-item ps-3"><span class="menu-child-header">Packaging Procurement</span></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/packaging_procurement_our_offerings">Our Offerings</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/discover_the_benefits_of_packaging_procurement">Discover the Benefits</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/packaging_procurement_success_stories">Success Stories</a></li>
                </ul>
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><span class="menu-sub-header">Digital</span></li>
                    <li class="nav-item ps-3"><span class="menu-child-header">MaxMold</span></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/built_reliability">Built for Reliability. Backed by Results.</a></li>                    
                </ul>
            </div>
        </li>

        <!-- How We Do It -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#howWeDoItMenu" aria-expanded="false" aria-controls="howWeDoItMenu">
                <span class="menu-title">How We Do It</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            </a>
            <div class="collapse" id="howWeDoItMenu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><span class="menu-sub-header">Case Studies</span></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/packaging_that_drives_business_impact">Packaging that Drives Business Impact</a></li>

                    <li class="nav-item"><span class="menu-sub-header">Knowledge Centre</span></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/Blog">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/more_blogs">More Blogs</a></li>

                    <li class="nav-item"><span class="menu-sub-header">Events Packforum</span></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/video_banner">Video Banner</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/event_slider">Sliders</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/global_dialogue">A Global Dialogue with Real Impact</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/future_force">From Smart Packaging to Circular Systems</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/featured_speakers">Featured Speakers</a></li>
                </ul>
            </div>
        </li>

        <!-- Career -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#careerMenu" aria-expanded="false" aria-controls="careerMenu">
                <span class="menu-title">Career</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            </a>
            <div class="collapse" id="careerMenu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><span class="menu-sub-header">Explore Opportunities</span></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/shine_with_us">Shine With Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/current_opening">Current Opening</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/carrer_form_data">Career Form Data</a></li>

                    <li class="nav-item"><span class="menu-sub-header">Why Join Packfora</span></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/why_people_choose_packfora">Why People Choose Packfora</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/student_talent_economy">Student Talent Economy</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/global_culture">A Global Culture</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/work_with_technocarts">Work with Technocrats</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/life_at_packfora">Life at Packfora</a></li>
                </ul>
            </div>
        </li>

        <!-- Let's Connect -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#connectMenu" aria-expanded="false" aria-controls="connectMenu">
                <span class="menu-title">Let's Connect</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            </a>
            <div class="collapse" id="connectMenu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/contact_us">Contact Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>admin/enquiry_data">Contact Us Enquiry Data</a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
