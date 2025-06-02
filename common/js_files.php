 <script src="<?= base_url();?>assets/vendors/js/vendor.bundle.base.js"></script>
 <script src="<?= base_url();?>assets/vendors/select2/select2.min.js"></script>
 <script src="<?= base_url();?>assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
 <script src="<?= base_url();?>assets/vendors/chart.js/chart.umd.js"></script>
 <script src="<?= base_url();?>assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
 <script src="https://cdn.datatables.net/2.3.1/js/dataTables.js"></script>
 <script src="<?= base_url();?>assets/js/off-canvas.js"></script>
 <script src="<?= base_url();?>assets/js/misc.js"></script>
 <script src="<?= base_url();?>assets/js/settings.js"></script>
 <script src="<?= base_url();?>assets/js/todolist.js"></script>
 <script src="<?= base_url();?>assets/js/jquery.cookie.js"></script>
 <script src="<?= base_url();?>assets/js/file-upload.js"></script>
 <script src="<?= base_url();?>assets/js/typeahead.js"></script>
 <script src="<?= base_url();?>assets/js/select2.js"></script>
 <script src="<?= base_url();?>assets/js/dashboard.js"></script>
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
    document.getElementById("year").textContent = new Date().getFullYear();
</script>
<script>
    var frontend = "<?= base_url();?>";
    var controllerName = "<?= $this->router->fetch_class(); ?>";
</script>