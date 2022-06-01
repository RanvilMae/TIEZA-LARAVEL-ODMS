<!DOCTYPE html>
<html>
<head>
    <title>Download Status </title>

<style>
table, td, th{
    border: 1px solid black;
}
</style>
</head>
<body>
    <h4>
        STATUS HISTORY
    </h4>
    <h4>
        Document ID:  <u>{{ $files->docu_id }}</u>
    </h4>
    <h4>
        Document Name:  <u>{{ $files->subject }}</u>
    </h4>
    
    <table style="width:100%">
        <thead>
            <tr>
                <th class="tablecell">STATUS</th>
                <th class="tablecell">REMARKS</th>
                <th class="tablecell" width: "auto !important">DATE</th>
                <th class="tablecell">EMPLOYEE / OFFICER</th>
            </tr>
        </thead>
        <tbody>
        @foreach($remarks as $rm)
            <tr>
                <td > {{$rm->date}} </td>
                <td > {{$rm->remarks}} </td>
                <td > {{$rm->date}} </td>
                <td > {{$rm->action}} </td>
            </tr>
        @endforeach
            
        </tbody>
        
    </table>
</body>
</html>