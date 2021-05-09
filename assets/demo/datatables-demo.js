// Call the dataTables jQuery plugin
//And setting the buttons option
$(document).ready(function() {
  $('#dataTable').DataTable( {
    dom: 'Bfrtip',
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ],
    responsive: true
} );
});
