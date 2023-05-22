<script>
    datatable = @json($datatables);
    myColumns = [];

    myColumns.push({data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%'});
    $.each(datatable.columns, (key, value) => myColumns.push({data: key, name: value}));
    myColumns.push({data: 'created_at', name: 'created_at', searchable: false});
    myColumns.push({data: 'actions', name: 'actions', searchable: false, sortable: false, width: '20%'});

    let Table = $('#data-table').DataTable({
        dom: "tiplr",
        scrollY: '500px',
        sScrollX: "100%",
        scrollCollapse: true,
        serverSide: true,
        processing: true,
        language: {
            url: "{{ asset('admin_assets/datatable-lang/' . app()->getLocale() . '.json') }}"
        },
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

    $(document).on('change', '.status', function (e) {
        e.preventDefault();

        let url    = datatable.route_status;
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
            },

        });//end of ajax call

    });//end of delete

</script>
