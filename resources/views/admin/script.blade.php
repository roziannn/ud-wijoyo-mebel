<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="/frontend/admin_frontend/elaadmin/assets/js/main.js"></script>


<script src="/frontend/admin_frontend/elaadmin/assets/js/lib/data-table/datatables.min.js"></script>
<script src="/frontend/admin_frontend/elaadmin/assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
<script src="/frontend/admin_frontend/elaadmin/assets/js/lib/data-table/dataTables.buttons.min.js"></script>
<script src="/frontend/admin_frontend/elaadmin/assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
<script src="/frontend/admin_frontend/elaadmin/assets/js/lib/data-table/jszip.min.js"></script>
<script src="/frontend/admin_frontend/elaadmin/assets/js/lib/data-table/vfs_fonts.js"></script>
<script src="/frontend/admin_frontend/elaadmin/assets/js/lib/data-table/buttons.html5.min.js"></script>
<script src="/frontend/admin_frontend/elaadmin/assets/js/lib/data-table/buttons.print.min.js"></script>
<script src="/frontend/admin_frontend/elaadmin/assets/js/lib/data-table/buttons.colVis.min.js"></script>
<script src="/frontend/admin_frontend/elaadmin/assets/js/init/datatables-init.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#bootstrap-data-table-export').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        $(".delete-item").on('click', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Data yang terhapus tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus data!',
            }).then((result) => {
                if (result
                    .isConfirmed
                ) { // isConfirmed untuk mengecek apakah tombol konfirmasi ditekan
                    $.ajax({
                        method: 'DELETE',
                        url: url,
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            window.location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr);
                            Swal.fire(xhr.responseJSON
                                .message, {
                                    icon: 'error',
                                });
                        }
                    });
                }
            });
        });
    });
</script>
