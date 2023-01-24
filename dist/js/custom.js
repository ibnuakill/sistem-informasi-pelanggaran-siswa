var placeholder = "Select a State";

$( ".select2" ).select2( {
  placeholder: placeholder,
} );

function DataTable(a){
  // DataTable initialisation
  $('.table').DataTable(
  {
   "dom": '<"dt-buttons"Bf><"clear">lirtp',
   "paging": true,
   "autoWidth": true,
   "columnDefs": [
   { "orderable": false, "targets": a }
   ],
   "buttons": [
   'excelHtml5',
   'print'
   ]
 }
 );
}

DataTable();