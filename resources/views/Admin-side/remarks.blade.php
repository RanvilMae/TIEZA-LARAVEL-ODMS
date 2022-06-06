@extends('Admin-side/admin_template')

@section('mybody')
@if(isset($message))
	<script type='text/javascript'>
		alert("{{$message}}")
	</script>
@endif


 <div class="container"> 
  	<div class="jumbotron">
		<form action="save_remarks" method="post" enctype="multipart/form-data" >
	      <div class="form-group">
				<div id="form-group">
					<div class="row">
						<div class="col-md-5">	
							<input type="hidden" class="form-control" name="id" value="{{$newid}}"/>
							<input type="hidden" name="action" value="{{$tid->fname}} {{$tid->lname}}"/>
							<input type="hidden" name="tid" value="{{$tid->tid}}"/>
							<input type="hidden" name="department" value="{{$tid->department}}"/>
							<input type="hidden" name="qr_Code" value="{{$newdocu_id}}"/>
												
							<label><strong>Subject:</strong></label>
							<textarea class="form-control"name="subject" disabled rows="3" >{{$newsubject}}</textarea><br>
												
							<label><strong>Record ID Number:</strong></label>
							<input class="form-control" type="text" name="docu_id" disabled value="{{$newdocu_id}}" /><br>
												
												
							 <label><strong>Date: </strong></label>
							<input class="form-control" name="date" readonly="read-only" value="{{$mytime}}"><br> <!--  -->

							<label><strong>Status: </strong></label><br>
							<select input name="status" class="form-control" id="status" required>	
								@foreach($status as $stat)
									<option value="{{$stat->status}}"> {{$stat->status}}</option>
								@endforeach
							</select><br>
												
							<br><label><strong>Remarks: </strong></label> <br> <label style="color:RED;">Special characters are not acceptable. (`!@#$%^&*_+=) etc.</label>
							<textarea class="form-control" rows="5" placeholder="Remarks" name="remarks"  ></textarea>
					</div>

				<div class="col-md-7">
					<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="example">
					<label><strong>DOCUMENT HISTORY</strong></label>
						<td align="center" style="border: 2px solid black;" ><strong>STATUS</strong></td>
						<td align="center" style="border: 2px solid black;" ><strong>REMARKS</strong></td>
						<td align="center" style="border: 2px solid black;"><strong>DATE</strong></td> 
						<td align="center" style="border: 2px solid black;"><strong>EMPLOYEE / OFFICER</strong></td>
						<tbody>
						<?php
							$rem = DB::table('remarks as r')
						        ->where('r.id', $newid)
						        ->count();
							$remarks = DB::table('remarks as r')
						        ->where('r.id', $newid)
						        ->get();
						?>
						@if($rem > 0)
							@foreach($remarks as $r)
							<tr>
								<td style="border: 2px solid black;"> {{$r->status}} </td>
								<td style="border: 2px solid black;"> {{$r->remarks}} </td>
								<td style="border: 2px solid black;"> {{$r->date}} </td>
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
					<button  name="save" type="submit" class="btn btn-primary" >
						<i class="fas fa-upload"></i>
					</button>
					<a href="{{ url('tagging')}}" class="text-decoration-none">
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
