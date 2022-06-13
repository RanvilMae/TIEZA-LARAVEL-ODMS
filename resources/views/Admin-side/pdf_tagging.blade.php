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
                <th class="tablecell">TAGGED TO</th>
				<th class="tablecell">TAGGED DATE</th>
				<th class="tablecell">ACTION</th>
                <th class="tablecell" >VIEWED DATE</th>
            </tr>
        </thead>
        <tbody>
		@foreach($tags as $tagp)
			<?php
				$tag_id = $tagp->tag;
				$u = DB::table('admin as u')
					->where('tid', $tag_id)
					->get();
			?>
			<tr>
				<td>
					@foreach ($u as $tag)
						<strong> {{$tag->lname}}, {{$tag->fname}}
					@endforeach
				</td>
				<td> {{$tagp->date}} </td>
				<td> {{$tagp->action}} </td>
				<td> {{$tagp->dateviewed}} </td>								
			</tr>
		@endforeach
            
        </tbody>
        
    </table>
</body>
</html>