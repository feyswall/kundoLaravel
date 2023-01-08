        // DataTable with Column Search by Text Inputs
        document.addEventListener("DOMContentLoaded", function() {
            // Setup - add a text input to each footer cell
            $("#datatable-column-search-text-inputs tfoot th").each(function() {
                var title = $(this).text();
                $(this).html("<input type=\"text\" class=\"form-control\" placeholder=\"Search " + title + "\" />");
            });
            // DataTable
            let table = $("#datatable-column-search-text-inputs").DataTable({
                "pageLength": 7,
                "lengthMenu": [7, 10, 25, 50, 75, 100]
            });
            // Apply the search
            table.columns().every(function() {
                var that = this;
                $("input", this.footer()).on("keyup change clear", function() {
                    if (that.search() !== this.value) {
                        that
                            .search(this.value)
                            .draw();
                    }
                });
            });
        });



        document.addEventListener("DOMContentLoaded", function() {
            // Datatable with Buttons
            var datatableButtons = $("#datatable-buttons").DataTable({
                retrieve: true,
                paging: false,
                responsive: true,
                lengthChange: !1,
                buttons: ["print"]
            });
            datatableButtons.buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");
        });
