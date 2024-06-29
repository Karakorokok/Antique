function initDataTable(tableID) {
    var table = $('#' + tableID).DataTable({
        buttons: [{
            extend: 'collection',
            text: '<i class="fa-solid fa-file me-2"></i>Export',
            buttons: [
                { 
                    extend: 'copy', 
                    exportOptions: { columns: ':visible' }, 
                    text: '<i class="fa-solid fa-clone me-2 text-secondary"></i>Copy' 
                },
                { 
                    extend: 'excel', 
                    exportOptions: { columns: ':visible' }, 
                    text: '<i class="fa-solid fa-table-cells-large me-2 text-secondary"></i>Excel' 
                },
                { 
                    extend: 'pdf', 
                    exportOptions: { columns: ':visible' }, 
                    text: '<i class="fa-solid fa-file-pdf me-2 text-secondary"></i>PDF' 
                },
                { 
                    extend: 'print', 
                    exportOptions: { columns: ':visible' }, 
                    text: '<i class="fa-solid fa-print me-2 text-secondary"></i>Print' 
                },
            ],        
            className: 'btn-primary rounded-end'
        },
        {
            extend: 'colvis',
            text: '<i class="fa-solid fa-check me-2"></i>Columns',
            className: 'btn-primary ms-2 rounded-start'
        }],
      
    });
    table.buttons().container().appendTo('#' + tableID + '_wrapper .col-md-6:eq(0)').addClass('my-3');
}