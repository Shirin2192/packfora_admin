 <nav class="sidebar sidebar-offcanvas" id="sidebar">
     <ul class="nav">
         <li class="nav-item nav-profile">
             <a href="#" class="nav-link">
                 <div class="nav-profile-image">
                     <img src="<?= base_url();?>assets/images/faces/face1.jpg" alt="profile" />
                     <span class="login-status online"></span>
                     <!--change to offline or busy as needed-->
                 </div>
                 <div class="nav-profile-text d-flex flex-column">
                     <span class="font-weight-bold mb-2">Admin</span>
                     <!-- <span class="text-secondary text-small">Project Manager</span> -->
                 </div>
                 <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" href="<?= base_url();?>admin">
                 <span class="menu-title">Dashboard</span>
                 <i class="mdi mdi-home menu-icon"></i>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" href="<?= base_url();?>admin/slider">
                 <span class="menu-title">Slider</span>
                 <i class="mdi mdi-square menu-icon"></i>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" href="<?= base_url();?>admin/our_clients">
                 <span class="menu-title">Our Clients</span>
                 <i class="mdi mdi-square menu-icon"></i>
             </a>
         </li>

         <!-- <li class="nav-item">
             <a class="nav-link" href="<?= base_url(); ?>admin/contact_us">
                 <span class="menu-title">Contact Us</span>
                 <i class="mdi mdi-home menu-icon"></i>
             </a>
         </li> -->
         <li class="nav-item">
             <a class="nav-link" href="<?= base_url(); ?>admin/enquiry_data">
                 <span class="menu-title">Enquiry Data</span>
                 <i class="mdi mdi-home menu-icon"></i>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" href="<?= base_url(); ?>admin/carrer_form_data">
                 <span class="menu-title">Carrer Formn Data</span>
                 <i class="mdi mdi-home menu-icon"></i>
             </a>
         </li>
           <li class="nav-item">
             <!-- Main Header -->
             <a class="nav-link" data-bs-toggle="collapse" href="#how-we-do-it" aria-expanded="false"
                 aria-controls="how-we-do-it">
                 <span class="menu-title">How We Do It</span>
                 <i class="menu-arrow"></i>
                 <i class="mdi mdi-crosshairs-gps menu-icon"></i>
             </a>

             <!-- Sub Header & List -->
             <div class="collapse" id="how-we-do-it">
                 <ul class="nav flex-column sub-menu">
                     <!-- Sub Header (optional if you want to label it) -->
                     <li class="nav-item">
                         <span class="menu-sub-header">Case Studies</span>
                     </li>
                     <!-- List Items -->
                      <li class="nav-item">
                         <a class="nav-link" href="<?= base_url(); ?>admin/packaging_that_drives_business_impact">Packaging that Drives Business Impact</a>
                     </li>
                 </ul>
                 <ul class="nav flex-column sub-menu">
                     <!-- Sub Header (optional if you want to label it) -->
                     <li class="nav-item">
                         <span class="menu-sub-header">Knowledge Centre</span>
                     </li>
                     <!-- List Items -->
                      <li class="nav-item">
                         <a class="nav-link" href="<?= base_url(); ?>admin/Blog">Blog</a>
                     </li>
                       <li class="nav-item">
                         <a class="nav-link" href="<?= base_url(); ?>admin/more_blogs">More Blogs</a>
                     </li>
                 </ul>
                 <ul class="nav flex-column sub-menu">
                     <!-- Sub Header (optional if you want to label it) -->
                     <li class="nav-item">
                         <span class="menu-sub-header">Events Packforum</span>
                     </li>
                     <!-- List Items -->
                      <li class="nav-item">
                         <a class="nav-link" href="<?= base_url(); ?>admin/video_banner">Video Banner</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="<?= base_url(); ?>admin/event_slider">Slider</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="<?= base_url(); ?>admin/global_dialogue">A Global Dialogue with Real Impact</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="<?= base_url(); ?>admin/future_force">From Smart Packaging to Circular Systems</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="<?= base_url(); ?>admin/featured_speakers">Featured Speakers</a>
                     </li>
                 </ul>
                 
             </div>
         </li>
         <li class="nav-item">
             <!-- Main Header -->
             <a class="nav-link" data-bs-toggle="collapse" href="#how-we-do-it" aria-expanded="false"
                 aria-controls="how-we-do-it">
                 <span class="menu-title">Carrer</span>
                 <i class="menu-arrow"></i>
                 <i class="mdi mdi-crosshairs-gps menu-icon"></i>
             </a>
             <!-- Sub Header & List -->
             <div class="collapse" id="how-we-do-it">
                 <ul class="nav flex-column sub-menu">
                     <!-- Sub Header (optional if you want to label it) -->
                     <li class="nav-item">
                         <span class="menu-sub-header">Explore Opportunities</span>
                     </li>
                     <!-- List Items -->
                     <li class="nav-item">
                         <a class="nav-link" href="<?= base_url(); ?>admin/shine_with_us">Shine With Us</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="<?= base_url(); ?>admin/current_opening">Current Opening</a>
                     </li>
                 </ul>
                 <ul class="nav flex-column sub-menu">
                     <!-- Sub Header (optional if you want to label it) -->
                     <li class="nav-item">
                         <span class="menu-sub-header">Why Join Packfora</span>
                     </li>
                     <!-- List Items -->
                     <li class="nav-item">
                         <a class="nav-link" href="<?= base_url(); ?>admin/why_people_choose_packfora">Why People Choose Packfora</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="<?= base_url(); ?>admin/student_talent_economy">Student Talent Economy</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="<?= base_url(); ?>admin/global_culture">A Global Culture</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="<?= base_url(); ?>admin/work_with_technocarts">Work with technocrats</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="<?= base_url(); ?>admin/life_at_packfora">Life at Packfora</a>
                     </li>
                 </ul>
             </div>
         </li>

         <li class="nav-item">
             <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                 aria-controls="ui-basic">
                 <span class="menu-title">Lets Connect</span>
                 <i class="menu-arrow"></i>
                 <i class="mdi mdi-crosshairs-gps menu-icon"></i>
             </a>
             <div class="collapse" id="ui-basic">
                 <ul class="nav flex-column sub-menu">
                     <li class="nav-item">
                         <a class="nav-link" href="<?= base_url(); ?>admin/contact_us">Contact Us</a>
                     </li>

                 </ul>
             </div>
         </li>

     </ul>
 </nav>