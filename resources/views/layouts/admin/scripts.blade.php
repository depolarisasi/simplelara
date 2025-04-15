<!--begin::Global Javascript Bundle(mandatory for all pages)-->

{{-- Penting: hostUrl harus mengarah ke folder assets menggunakan asset() helper --}}
<script>var hostUrl = "{{ asset('assets/') }}/";</script>

{{-- Plugin bundle berisi jQuery, Bootstrap, Popper, dan library lainnya --}}
<script src="{{ asset('assets/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)--> 
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{ asset('assets/js/widgets.bundle.js') }}"></script> 