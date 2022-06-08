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
        SUBFILE HISTORY
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
                <th class="tablecell">FILE NAME</th>
                <th class="tablecell">PAGES</th>
                <th class="tablecell" width: "auto !important">DATE</th>
                <th class="tablecell">DEPARTMENT</th>
                <th class="tablecell">EMPLOYEE / OFFICER</th>
            </tr>
        </thead>
        <tbody>
        @foreach($subfiles as $s)
            <tr>
                <td > {{$s->name}} </td>
                <td > {{$s->pages}} </td>
                <td > {{$s->date}} </td>
                <td > {{$s->department}} </td>
                <td > {{$s->action}} </td>
            </tr>
        @endforeach
            
        </tbody>
        
    </table>
</body>
</html>