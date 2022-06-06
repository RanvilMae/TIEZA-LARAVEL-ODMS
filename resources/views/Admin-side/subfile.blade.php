@extends('Admin-side/admin_template')

@section('mybody')
@if(isset($message))
	<script type='text/javascript'>
		alert("{{$message}}")
	</script>
@endif


 <div class="container"> 
  	<div class="jumbotron">
		<form action="save_sub" method="post" enctype="multipart/form-data" >
	      <div class="form-group">
				<div id="form-group">
					<div class="row">
						<div class="col-md-5">	
							<input type="hidden" class="form-control" name="docu_id" value="{{$newid}}"/>
							<input type="hidden" name="action" value="{{$tid->fname}} {{$tid->lname}}"/>
							<input type="hidden" name="tid" value="{{$tid->tid}}"/>
							<input type="hidden" name="department" value="{{$tid->department}}"/>
							<input type="hidden" name="qr_Code" value="{{$newdocu_id}}"/>
							<input type="hidden" name="subject" value="{{$files->subject}}"/>
							<input type="hidden" name="record_id" value="{{$record_id}}"/>
												
							<label><strong>Subject:</strong></label>
							<textarea class="form-control" disabled rows="3">{{$files->subject}}</textarea><br>
												
							<label><strong>Record ID Number:</strong></label>
							<input class="form-control" type="text"  disabled value="{{$record_id}}" /><br>

							<label><strong>Department:</strong></label>
							<input class="form-control" type="text" name="department" disabled value="{{$tid->department}}" /><br>
												
							<label><strong>Sub Document Name:</strong> </label>
							<input type="text" class="form-control" placeholder="Subject" name="sub_docu" required /><br>

							<label><strong>Remarks: </strong></label> 
							<textarea class="form-control" rows="5" placeholder="Remarks" name="remarks"  ></textarea><br>
												
							<label><strong>No. of Pages:</strong> </label>
							<input type="number" class="form-control" placeholder="No. of Pages" min="1" max="1000" name="pages" required /><br>
				
											
							<label><strong>File: </strong></label>	
							<input type="file" class="form-control" id="exampleFormControlFile1" name="myfile"><br>
					</div>

				<div class="col-md-7">
					<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="example">
					<label><strong>DOCUMENT HISTORY</strong></label>
						<td align="center" style="border: 2px solid black;" ><strong>FILE NAME</strong></td>
						<td align="center" style="border: 2px solid black;" ><strong>PAGES</strong></td>
						<td align="center" style="border: 2px solid black;"><strong>DATE</strong></td> 
						<td align="center" style="border: 2px solid black;"><strong>REMARKS</strong></td> 
						<td align="center" style="border: 2px solid black;"><strong>DEPARTMENT</strong></td> 
						<td align="center" style="border: 2px solid black;"><strong>EMPLOYEE / OFFICER</strong></td>
						<tbody>
						<?php
							$subf = DB::table('subfiles as r')
						        ->where('r.id', $newid)
						        ->count();
							$subfiles = DB::table('subfiles as r')
						        ->where('r.id', $newid)
						        ->get();
						?>
						@if($subf > 0)
							@foreach($subfiles as $r)
							<tr>
								<td style="border: 2px solid black;"> {{$r->name}} </td>
								<td style="border: 2px solid black;"> {{$r->pages}} </td>
								<td style="border: 2px solid black;"> {{$r->date}} </td>
								<td style="border: 2px solid black;"> {{$r->remarks}} </td>
								<td style="border: 2px solid black;"> {{$r->department}} </td>
								<td style="border: 2px solid black;"> {{$r->action}} </td>
								
							</tr>
							@endforeach
						@endif
						</tbody> 
					</table>	
				</div>
			</div>
			<div style="clear:both;"></div>
				<div class=" float-right">
					<button  name="submit" type="submit" class="btn btn-primary" >
						<i class="fas fa-upload"></i>
					</button>
					<a href="{{ url('/subfile')}}" class="text-decoration-none">
						<button  type="button" class="btn btn-danger" >
							<i class="fas fa-window-close"></i>
						</button>
					</a>						
				</div>	
			{{csrf_field()}}
		</form>
	</div>
</div><br>


@stop
