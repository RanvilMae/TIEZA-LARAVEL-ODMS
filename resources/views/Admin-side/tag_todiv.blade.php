@extends('Admin-side/admin_template')

@section('mybody')
@if(Session::has('error_message'))
		<script type='text/javascript'>
				alert("{{ Session::get('error_message') }}")
		</script>

@endif



 <div class="container"> <br>
  	<div class="jumbotron">
		<form action="save_tagdiv" method="post" enctype="multipart/form-data">
	      <div class="form-group">
				<h3><strong>DOCUMENT TAGGING</strong></h3><hr>
				<div id="form-group">
					<div class="row">
						<div class="col-md-5">	
							<input type="hidden" class="form-control" name="id" value="{{$newdocu_id}}"/>
							<input type="hidden" name="subject" value="{{$newsubject}}"/>
							<input type="hidden" name="docu_id" value="{{$newrecord_id}}"/>
							<input type="hidden" name="action" value="{{$tid->fname}} {{$tid->lname}}"/>
												
							<label><strong>Subject:</strong></label>
							<textarea class="form-control"name="subject" disabled rows="3" >{{$newsubject}}</textarea><br>
												
							<label><strong>Record ID Number:</strong></label>
							<input class="form-control" type="text" name="record_id" disabled value="{{$newrecord_id}}" /><br>
												
												
							 <label><strong>Date: </strong></label>
							<input class="form-control" name="date" readonly="read-only" value="{{$mytime}}"><br> <!--  -->
												
							<label><strong>TAGGED TO:</strong></label>
							<div style="overflow-x:auto;">
								<table class="table table-bordered"  style="border: 2px solid black;">  
									<td align="center" style="border: 2px solid black;">
										<strong>NAME</strong>
									</td> 
									<td align="center" style="border: 2px solid black;" >
										<strong>DATE TAGGED</strong>
									</td>
									<tbody>
										@foreach($get_tags as $gt)
										<tr>
											<?php
												$tag_id = $gt->tag;
								        $admin = DB::table('admin as u')
								               ->where('tid', $tag_id)
								               ->get();
											?>
								      	<td style="border: 2px solid black;">
								      		@foreach($admin as $a)
								      			<strong>{{$a->department}} -</strong> {{$a->lname}}, {{$a->fname}}
								      		@endforeach
								      	</td>
											<td style="border: 2px solid black;">{{$gt->date}}</td>
							      </tr>
							      @endforeach
							    </tbody>
								</table>
						</div>
					</div>

				<div class="col-md-7">
					<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="example">
					<label><strong>TAG TO:</strong></label>
						<tbody>
							<br>
							
							<label><input type="checkbox" class="cb-selector" data-for="selector\[" />  Select All</label>
							@foreach ($div as $d)
							<?php
							$divi = $d->department;
							$tagging = DB::table('admin as id')
		            ->where('department', $divi)
		            ->orderBy('department', 'ASC')
		            ->get();
							?>
								@foreach ($tagging as $tag)
								<tr>
									<td>
										<input name="selector[]" type="checkbox" value=" {{$tag->tid}} "> 
									</td>

									<td>
										<strong> {{$tag->department}}</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{$tag->fname}} {{$tag->lname}}
									</td>
								</tr>
								@endforeach
							@endforeach
						</tbody>
					</table>	
				</div>
			</div>
			<div style="clear:both;"></div>
				<div class=" float-right">
					<button name="save" type="submit" class="btn btn-primary">
						<i class="fas fa-upload"></i>
					</button>
					<a href="{{ url('/admin/viewdata')}}" class="text-decoration-none">
						<button type="button" class="btn btn-danger" >
							<i class="fas fa-window-close"></i>
						</button>
					</a><br>
													
				</div>	
				
			{{csrf_field()}}
		</form>
	</div>
</div>


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  	<!-- Script to enable Select all of checkboxes -->	
	<script type='text/javascript'>
	!function($) {
		$('input[type=checkbox][class=cb-selector]').click(function() {
			var cb = $(this),
				name = cb.attr('data-for');
			
			if(name == null)
				return false;
			$('input[type=checkbox][name^='+name+']')
				.prop('checked', cb.prop('checked'))
				.click(function() {
					if(!$(this).prop('checked'))
						cb.prop('checked', false);
				});
		});
	}(jQuery);
</script>

@stop
