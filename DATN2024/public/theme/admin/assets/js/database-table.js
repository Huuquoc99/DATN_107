$(document).ready(function () {
    var table = $('#example').DataTable({
        order: [[0, 'desc']],
        responsive: true,
        dom: 'rtip',
        paging: false,
        info: false,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
})
