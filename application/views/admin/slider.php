o<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Purple Admin</title>
      <!-- plugins:css -->
      <?php include('common/css_files.php');?>
   </head>
   <body>
      <div class="container-scroller">
         <!-- partial:../../partials/_navbar.html -->
         <?php include('common/nav_head.php');?>
         <!-- partial -->
         <div class="container-fluid page-body-wrapper">
            <!-- partial:../../partials/_sidebar.html -->
            <?php include('common/sidebar.php');?>
            <!-- partial -->
            <div class="main-panel">
               <div class="content-wrapper">
                  <div class="page-header">
                     <h3 class="page-title">Slider </h3>
                     <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                           <li class="breadcrumb-item"><a href="#">Home</a></li>
                           <li class="breadcrumb-item active" aria-current="page">Slider</li>
                        </ol>
                     </nav>
                  </div>
                  <div class="row">
                     <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                           <div class="card-body">
                              <form id="SliderForm" class="forms-sample" enctype="multipart/form-data">
                                 <div class="row">
                                    <!-- Title -->
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="title">Slider Title <span class="text-danger">*</span></label>
                                          <input type="text" class="form-control" name="title" id="title" placeholder="Enter title">
                                          <div class="text-danger" id="error_title"></div>
                                       </div>
                                    </div>
                                    <!-- Subtitle -->
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="subtitle">Subtitle</label>
                                          <input type="text" class="form-control" name="subtitle" id="subtitle" placeholder="Enter subtitle">
                                          <div class="text-danger" id="error_subtitle"></div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <!-- Button Text -->
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="button_text">Button Text</label>
                                          <input type="text" class="form-control" name="button_text" id="button_text" placeholder="Enter button label">
                                          <div class="text-danger" id="error_button_text"></div>
                                       </div>
                                    </div>
                                    <!-- Button Link -->
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="button_link">Button Link</label>
                                          <input type="text" class="form-control" name="button_link" id="button_link" placeholder="https://example.com">
                                          <div class="text-danger" id="error_button_link"></div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <!-- Slide Order -->
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="slide_order">Slide Order</label>
                                          <input type="number" class="form-control" name="slide_order" id="slide_order" placeholder="1, 2, 3...">
                                          <div class="text-danger" id="error_slide_order"></div>
                                       </div>
                                    </div>
                                    <!-- Image Upload -->
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label>Slider Image <span class="text-danger">*</span></label>
                                          <input type="file" name="image" class="file-upload-default" id="img">
                                          <div class="text-danger" id="error_img"></div>
                                          <div class="input-group">
                                             <input type="text" class="form-control file-upload-info" disabled placeholder="Upload image">
                                             <span class="input-group-append">
                                             <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                             </span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- Hidden ID for edit -->
                                 <input type="hidden" name="id" id="slider_id">
                                 <button type="submit" class="btn btn-gradient-primary me-2 mt-3">Submit</button>
                              </form>
                           </div>
                        </div>
                     </div>
                     <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                           <div class="card-body">
                              <table id="SliderTable" class="display">
                                 <thead>
                                    <tr>
                                       <th>Sr. No</th>
                                       <th>Title</th>
                                       <th>Sub Title</th>
                                       <th>Image</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- content-wrapper ends -->
               <!-- partial:../../partials/_footer.html -->
               <?php include('common/footer.php');?>
                <!-- Modal -->
         <div class="modal fade" id="ViewModal" tabindex="-1" aria-labelledby="ViewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="ViewModalLabel">View Slider</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body" id="modalBodyContent">
                     <div class="row">                        
                        <div class="col-md-6">
                           <label for="view_title">Title</label>
                           <p id="view_title"></p>
                        </div>
                        <div class="col-md-6">
                           <label for="view_sub_title">Sub Title</label>
                           <p id="view_sub_title"></p>
                        </div>
                        <div class="col-md-6">
                           <label for="view_button_text">Button Text</label>
                           <p id="view_button_text"></p>
                        </div>
                        <div class="col-md-6">
                           <label for="view_button_link">Button Link</label>
                           <p id="view_button_link"></p>
                        </div>
                        <div class="col-md-6">
                           <label for="view_image">Image</label>
                           <div id="view_image"></div>
                        </div>                        
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="EditModalLabel">Edit Story Behind Maxmold</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form id="EditSliderForm" enctype="multipart/form-data">
                     <div class="modal-body" id="modalBodyContent">
                        <input type="hidden" id="edit_id" name="id">
                        <input type="hidden" id="edit_previous_image" name="edit_previous_image">
                        <div class="row mb-3">
                            
                            <div class="col-md-6">
                              <label for="edit_title" class="form-label">Title</label>
                              <input type="text" class="form-control" id="edit_title" name="edit_title">
                              <div class="text-danger" id="error_edit_title"></div>
                           </div>
                           <div class="col-md-6">
                              <label for="edit_subtitle" class="form-label">Sub Title</label>
                              <input type="text" class="form-control" id="edit_subtitle" name="edit_subtitle">
                              <div class="text-danger" id="error_edit_subtitle"></div>
                           </div>
                           <div class="col-md-6">
                              <label for="edit_button_text" class="form-label">Button Text</label>
                              <input type="text" class="form-control" id="edit_button_text" name="edit_button_text">
                              <div class="text-danger" id="error_edit_button_text"></div>
                           </div>
                           <div class="col-md-6">
                              <label for="edit_button_link" class="form-label">Button Link</label>
                              <input type="text" class="form-control" id="edit_button_link" name="edit_button_link">
                              <div class="text-danger" id="error_edit_button_link"></div>
                           </div>
                           <div class="col-md-6">
                              <label for="edit_slide_order" class="form-label">Slide Order</label>
                              <input type="text" class="form-control" id="edit_slide_order" name="edit_slide_order">
                              <div class="text-danger" id="error_edit_slide_order"></div>
                           </div>
                           <div class="col-md-6">
                              <label for="edit_image" class="form-label">Image</label>
                              <input type="file" class="form-control" id="edit_image" name="edit_image">
                              <div id="current_image" class="mt-2"></div>
                              <div class="text-danger" id="error_edit_image"></div>
                           </div>                        
                           
                        </div>
                        <div class="row mb-3">
                           <div id="edit_image_preview"></div>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
               <!-- partial -->
            </div>
            <!-- main-panel ends -->
         </div>
         <!-- page-body-wrapper ends -->
      </div>
      <!-- container-scroller -->
      <!-- plugins:js -->
      <?php include('common/js_files.php');?>
      <script src="<?= base_url()?>assets/view_js/slider.js"></script>
      <!-- End custom js for this page -->
      <script>
         $(document).ready(function() {
             $('#myTable').DataTable({
                 "paging": true,
                 "searching": true,
                 "ordering": true,
                 "info": true
             });
         });
      </script>
   </body>
</html>