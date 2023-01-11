<html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AVITA INDIA | Request Portal</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<style>
div.dataTables_wrapper div.dataTables_filter{
   display:none!important;
}
</style>
    <!-- Styles -->

 </head>
 <body>
 <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('home') }}">
                   <img src="{{ asset('images/logo.png') }}" style="width:75px;">
                  </a>
               </div>
        </nav>

  <div class="container">
     <br />
     <br />
   <div class="table-responsive">
    <table class="table table-bordered table-striped" id="ticket_table">
     <thead>
      <tr>
       <th>Date</th>
       <th>SRN</th>
       <th>SRN MI</th>
       <th>Brand</th>
       <th>Project Title</th>
       <th>Category</th>
       <th>Priority</th>
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
    "order": [[ 1, "desc" ]], //or asc
   processing: true,
   serverSide: true,
   ajax: {
    url:"{{ route('show_ticket.index') }}",
    data: {
            status:status,
         }
   },
   columns:[
    {
     data: 'created_at',
     name: 'created_at'
    },
    {
    data: 'no',
    name: 'no',
    },
    {
     data: 'job_no',
     name: 'job_no',
    },
    {
     data: 'brand',
     name: 'brand',
    },
    {
     data: 'title',
     name: 'title',
     fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
            $(nTd).html("<a href='/ticket/detail/"+oData.no+"'>"+oData.title+"</a>");
           }
       },
    {{--  {
     data: 'name',
     name: 'name',
    },  --}}
    {
        data: 'category_name',
        name: 'category_name',
       },
    {
     data: 'priority',
     name: 'priority',
    },
    {
     data:'status',
     name:'status',
     orderable: false
    },

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
