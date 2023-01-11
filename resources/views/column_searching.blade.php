<html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laravel 5.8 Tutorial - Datatables Individual Column Searching using Ajax</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 </head>
 <body>
  <div class="container">    
     <br />
     <br />
   <div class="table-responsive">
    <table class="table table-bordered table-striped" id="ticket_table">
     <thead>
      <tr>
       <th>SRN</th>
       <th>Title</th>
       <th>Category</th>
       <th>
       <select name="status_filter" id="status_filter" class="form-control">
         <option value="">Select Status</option>
             @foreach($statuses as $status)
         <option value="{{ $status->name }}">{{ $status->name }}</option>
             @endforeach
        </select>
       </th>
      </tr>
     </thead>
    </table>
   </div>
   <br />
   <br />
  </div>
 </body>
</html>


<script>
$(document).ready(function(){

 fetch_data();

 function fetch_data(status = '' )
 {
  $('#ticket_table').DataTable({
   processing: true,
   serverSide: true,
   ajax: {
    url:"{{ route('column-searching.index') }}",
    data: {
            status:status
         }
   },
   columns:[
    {
     data: 'no',
     name: 'no'
    },
    {
     data: 'title',
     name: 'title'
    },
    {
     data: 'name',
     name: 'name',
    },
    {
     data:'status',
     name:'status',
     orderable: false
    }
   ]
  });
 }


  $('#status_filter').change(function(){
  var status = $('#status_filter').val();
  $('#ticket_table').DataTable().destroy();
  fetch_data(status);
 });

});
</script>