<script>

    //use for data table
    function initializeDataTable(ajaxRoute, columnsConfig) {
        if ($.fn.DataTable.isDataTable('#datatable')) {
        $('#datatable').DataTable().clear().destroy();
    }
        $(document).ready(function () {
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                serverSide: true,
                ajax: ajaxRoute, // Replace with the actual route
                columns: columnsConfig,
                initComplete: function () {
                    // console.log(this.api().ajax.json()); // Log the response data
                }
            });
        });
    }

    function initializeDataTable2(ajaxRoute, columnsConfig) {
    $(document).ready(function() {
        $('#data_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: ajaxRoute, // URL from your route
                data: function(d) {
                    console.log(d);
                    // Add the branch_id to the request
                    d.branch_id = $('#branch_id').val();
                }
            },
            columns: columnsConfig,
            initComplete: function() {
                //console.log(this.api().ajax.json()); // Log the response data
            }
        });
    });
}


    // use for delete
    $(document).ready(function() {
    var userIdToDelete = null;
    var model = null;

    // Open delete modal and set variables
    $(document).on('click', '.delete-user', function () {
        userIdToDelete = $(this).data('id');
        model = $(this).data('model');
        $('#deleteUserModal').modal('show');
    });

    // Handle the form submission for deletion
    $('#deleteUserForm').on('submit', function (e) {
        e.preventDefault();
        if (userIdToDelete !== null && model !== null) {
            $.ajax({
                url: "{{ url('/') }}/" + model + "/destroy",
                type: 'Delete',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id': userIdToDelete
                },
                success: function (data) {
                    $('#datatable').DataTable().ajax.reload();
                },
                error: function (xhr, status, error) {
                    console.error(error);
                },
                complete: function() {
                    $('#deleteUserModal').modal('hide');
                    $('.modal-backdrop').remove();

                }
            });
        }
    });

    // Close modal handler
    $('#deleteUserModal').find('.close, button[data-dismiss="modal"]').on('click', function() {
        $('#deleteUserModal').modal('hide');
    });
});
</script>
