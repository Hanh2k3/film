<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset('admin/template/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('admin/template/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('admin/template/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('admin/template/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

<script src="{{ asset('admin/template/vendor/js/menu.js') }}"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('admin/template/vendor/libs/apex-charts/apexcharts.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('admin/template/js/main.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('admin/template/js/dashboards-analytics.js') }}"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

{{-- CKEditor --}}
<script src="{{ asset('admin/ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('editor1');
</script>
