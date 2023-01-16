<script>
    $ (document).ready (function () {
        $ (
            '#datatable'
        ).DataTable (), $ ('#{!! $id !!}')
            .DataTable ({lengthChange: !1, buttons: ['excel', 'pdf'], "order": [[ 1, "desc" ]]})
            .buttons ()
            .container ().appendTo ('#{!! $id !!}_wrapper .col-md-6:eq(0)'), $ ('.dataTables_length select')
            .addClass ('form-select form-select-sm');
    });  
</script>