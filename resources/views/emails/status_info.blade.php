<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SRN Status Information</title>
</head>
<body>
   
    <p>
        Hi, The Request has been closed. Kindly, find the details below:
    <p><strong>Created On:</strong>{{ date('d/m/Y h:i:s a', strtotime($ticket->created_at)) }}</p>
    <p><strong>Brand:</strong> {{ ucfirst($ticket->brand) }}</p>
    <p><strong>Title:</strong> {{ ucfirst($ticket->title) }}</p>
    <p><strong>Category:</strong> {{ ucfirst($ticket->category_name) }}</p>
    <p><strong>Summary:</strong> {{ $ticket->summary }}</p>
    <p><strong>Priority:</strong> {{ ucfirst($ticket->priority) }}</p>
    <p><strong>Closed On:</strong> {{ date('d-m-Y h:i:s a') }}</p>

    </p>

 
 
 </body>
</html>