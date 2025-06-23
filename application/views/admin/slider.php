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
                              <table id="myTable" class="display">
                                 <thead>
                                    <tr>
                                       <th>Column 1</th>
                                       <th>Column 2</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td>Row 1 Data 1</td>
                                       <td>Row 1 Data 2</td>
                                    </tr>
                                    <tr>
                                       <td>Row 2 Data 1</td>
                                       <td>Row 2 Data 2</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- content-wrapper ends -->
               <!-- partial:../../partials/_footer.html -->
               <?php include('common/footer.php');?>
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