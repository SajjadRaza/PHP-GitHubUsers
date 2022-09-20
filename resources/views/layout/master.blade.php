<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>All Employess</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
</head>
<body>
@yield('content')

<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<script>
    $(document).on('click', '.delete', function () {
        let url_to_hit = $(this).data('url');
        let id = '#' + $(this).data('table');
        deleteConfirmation(url_to_hit, id);
    });

    function deleteConfirmation(url_to_hit, id, table = '') {
        $.confirm({
            icon: 'fa fa-exclamation-triangle',
            closeIcon: true,
            closeIconClass: 'fa fa-close',
            title: 'Delete',
            content: 'Are you sure want to delete?<br>You can not undo this action.',
            buttons: {
                confirm: function () {
                    $.ajax({
                        url: url_to_hit,
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            if (response.status) {
                                if (table === '') {
                                    $(id).DataTable().ajax.reload(null, false);
                                } else {
                                    table.ajax.reload();
                                }
                                window.toastr.info(response.message);
                            } else {
                                window.toastr.error(response.message);
                            }
                        },
                        error: function (errors) {
                            const status_code = errors.status;
                            const er = $.parseJSON(errors.responseText);
                            if (status_code !== 422) {
                                window.toastr.error(er.message);
                            } else {
                                $.each(er.errors, function (fields, messages) {
                                    $.each(messages, function (index, message) {
                                        window.toastr.error(message);
                                    })
                                });
                            }
                        }
                    });
                },
                cancel: function () {
                },
            }
        });
    }
</script>

@yield('scripts')
</body>
</html>
