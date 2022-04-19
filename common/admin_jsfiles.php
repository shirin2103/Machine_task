<!-- JavaScript files-->
<script src="<?= base_url();?>assets/vendor/jquery/jquery-3.1.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<!-- <script src="<?= base_url();?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->
<script src="<?= base_url();?>assets/js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
<script src="<?= base_url();?>assets/vendor/jquery.cookie/jquery.cookie.js"> </script>
<!-- <script src="<?= base_url();?>assets/vendor/chart.js/Chart.min.js"></script> -->
<script src="<?= base_url();?>assets/vendor/jquery-validation/jquery.validate.min.js"></script>
<script src="<?= base_url();?>assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js">
</script>
<!-- <script src="<?= base_url();?>assets/js/charts-home.js"></script> -->
<script src="<?= base_url();?>assets/plugins/js/chosen/chosen.jquery.js"></script>
<script src="<?= base_url();?>assets/plugins/js/chosen/prism.js"></script>
<script src="<?= base_url();?>assets/plugins/js/chosen/init.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url();?>assets/plugins/js/mdtimepicker.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script> -->
<!-- Main File-->
<script src="<?= base_url();?>assets/js/front.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js"></script>
<!-- <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script> -->
<script src="<?= base_url();?>assets/plugins/js/jquery.simplePagination.js"></script>

<!-- <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script> -->
<script src="<?= base_url();?>assets/js/toastr.min.js"></script>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->
<script src="<?=base_url()?>assets/js/button-inline-loader.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
<script src="<?= base_url();?>assets/plugins/js/contextMenu.min.js"></script>
<script src="<?=base_url()?>assets/view_js/form.js"></script>

<script>
    setTimeout(function () {
            document.getElementById('header_loader').style.visibility = "hidden";
        }, 2000);
    $(document).ready(function () {
        resizeChosen();
        jQuery(window).on('resize', resizeChosen);
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-center",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    });

    function resizeChosen() {
        $(".chosen-container").each(function () {
            $(this).attr('style', 'width: 100%');
        });
    }

    function success_msg(t) {
        toastr.success(t);
    }

    function success_error(t) {
        toastr.error(t);
    }

    function success_warningt(t) {
        toastr.warning(t);
    }
</script>

<script type="text/javascript">
    var frontend_path = "<?=base_url()?>";
</script>