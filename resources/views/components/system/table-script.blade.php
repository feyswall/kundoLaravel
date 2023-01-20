<script>
    $ (document).ready (function () {
        $ (
            '#datatable'
        ).DataTable (), $ ('#{!! $id !!}')
            .DataTable ({
                lengthChange: !1, 
                buttons: ['excel', 'pdf'], 

                "order": [[ 1, "desc" ]],
                   columnDefs: [ {
                    orderable: false,
                    className: 'select-checkbox',
                    targets:   0
                    }],
                select: {
                style:    'os',
                selector: 'td:first-child'
                    },
                order: [[ 1, 'asc' ]]
            })
            .buttons ()
            .container ().appendTo ('#{!! $id !!}_wrapper .col-md-6:eq(0)'), $ ('.dataTables_length select')
            .addClass ('form-select form-select-sm');
    });  
</script>