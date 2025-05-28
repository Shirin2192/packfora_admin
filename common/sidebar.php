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
         <li class="nav-item">
             <a class="nav-link" href="<?= base_url(); ?>admin/current_opening">
                 <span class="menu-title">Current Opening</span>
                 <i class="mdi mdi-home menu-icon"></i>
             </a>
        </li>
		 <li class="nav-item">
             <a class="nav-link" href="<?= base_url(); ?>admin/contact_us">
                 <span class="menu-title">Contact Us</span>
                 <i class="mdi mdi-home menu-icon"></i>
             </a>
         </li>
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
         
     </ul>
 </nav>
