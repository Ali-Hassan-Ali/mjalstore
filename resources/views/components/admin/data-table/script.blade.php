<script>
    datatable = @json($datatables);
    myColumns = [];

    myColumns.push({data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%'});
    $.each(datatable.columns, (key, value) => myColumns.push({data: key, name: value}));
    myColumns.push({data: 'created_at', name: 'created_at', searchable: false});
    myColumns.push({data: 'actions', name: 'actions', searchable: false, sortable: false, width: '20%'});
    
    @php($lang = in_array(app()->getLocale(), ['ar', 'en']) ? app()->getLocale() : 'en')

    let Table = $('#data-table').DataTable({
        dom: "tiplr",
        scrollY: '500px',
        sScrollX: "100%",
        scrollCollapse: true,
        serverSide: true,
        processing: true,
        language: {url: "{{ asset('admin_assets/datatable-lang/' . $lang . '.json') }}"},
        ajax: {url: datatable.route},
        columns: myColumns,
        drawCallback: function (settings) {
            $('.record__select').prop('checked', false);
            $('#record__select-all').prop('checked', false);
            $('#record-ids').val();
            $('#bulk-delete').attr('disabled', true);
        }
    });

    $('#data-table-search').keyup(function () {
        Table.search(this.value).draw();
    })

    if (datatable.checkbox) {

        $(document).on('change', '.checkbox', function (e) {
        e.preventDefault();

        let type   = $(this).data('type');
        let url    = datatable.checkbox[type];
        let method = 'post';
        let id     = $(this).data('id');

        $.ajax({
            url: url,
            data: {id: id},
            method: method,
            success: function (response) {

                $('.datatable').DataTable().ajax.reload();

                new Noty({
                    layout: 'topRight',
                    type: 'alert',
                    text: response,
                    killer: true,
                    timeout: 2000,
                }).show();

            },error: function (response) {

                    data = response.responseJSON.message;

                    swal({
                        title: data + '😥',
                        type: 'error',
                        icon: 'error',
                        buttons: false,
                        timer: 15000
                    }); //end of swal

                }, //end of error - success

        });//end of ajax call

    });//end of delete

    }//end of if

</script>