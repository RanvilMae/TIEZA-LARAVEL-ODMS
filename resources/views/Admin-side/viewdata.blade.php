@extends('Admin-side/admin_template')

@section('mybody')
@if (session('error'))
				    <div class="alert alert-danger" align="center">
				    	<i class="fas fa-check-circle"></i>
				        {{ session('error') }}
				    </div>
@endif
@if (session('doubledata'))
				    <div class="alert alert-danger" align="center">
				       <i class="fas fa-exclamation-circle"></i> {{ session('doubledata') }}
				    </div>
@endif


<main role="main" class="container"> <br>
  <div class="jumbotron">
  	<h3> <strong> {{$department}} Files</strong></h3> <hr>
  	 <div class="row">
    	<div class="col-lg-12">
    		<table class="table table-primary table-bordered" id="data_table">
    			<thead >
    				<tr >
				        <th width="15%"><strong>RECORD ID</strong></th>
				        <th width="20%"><strong>FROM</strong></th>
						<th width="10%"><strong>CATEGORY</strong></th>
				        <th width="30%"><strong>SUBJECT</strong></th>
						<th width="10%"><strong>DATE</strong></th>
						<th width="10%"><strong>FILE TYPE</strong></th>
						<th align="center" width="15%"><strong>ACTION</strong></th>
				    </tr>
    			</thead>
    			<tbody class="table-light table-bordered">
    				@foreach($files as $f)
    				<tr>
    					<td >{{$f->docu_id}}</td>
					    <td >{{$f->fromw}}</td>
					    <td >{{$f->category}}</td>
					    <td >{{$f->subject}}</td>
					    <td >{{$f->date}}</td>
					    <td >{{$f->restriction}}</td>
					    <td >
					    	<div class="btn-group btn-group-justified">

					    		<!-- STATUS -->
						    	<button align="center" type="button" class="btn btn-primary" title="STATUS">
										<a class="notif" data-toggle="modal" data-target="#myModall{{$f->docu_id}}" style="text-decoration-none;color:white;">
											<i class="far fa-file"></i>
											<span class="badges count-notif" > 
													<?php
													$r_id = $f->id;
													$remarks = DB::table('remarks as r')
					                    ->where('r.id', $r_id)
					                    ->count();
													echo $remarks;
													?>
											</span>
										</a>
									</button>

									<!-- SUBFILE -->
									<button type="button" class="btn btn-primary" title="SUB FILE">
										<?php
											$r_id = $f->id;
											$subfile = DB::table('subfiles as sub')
					                    ->where('sub.id', $r_id)
					                    ->count();
										?>
										@if($subfile > 1)
											<a class="notif"  data-toggle="modal" data-target="#mySubfile{{$f->docu_id}}" style="text-decoration-none;color:#FF69B4">
												<i class="fas fa-file-upload"></i>
											</a>
										@else
											<a class="notif"  data-toggle="modal" data-target="#mySubfile{{$f->docu_id}}" style="text-decoration-none;color:WHITE;">
												<i class="fas fa-file-upload"></i>
											</a>
										@endif
									</button>

									<!-- EDIT -->
									<button type="button" class="btn btn-primary" title="EDIT">
											<a class="notif"  data-toggle="modal" data-target="#myEdit{{$f->docu_id}}" style="text-decoration-none;color:WHITE;">
												<i class="far fa-edit"></i>
											</a>
									</button>

									<!-- TAG -->
									<button type="button" class="btn btn-primary" title="TAG">
											<a class="notif"  data-toggle="modal" data-target="#myTag{{$f->docu_id}}" style="text-decoration-none;color:WHITE;">
												<i class="fas fa-tags"></i>
											</a>
									</button>


							<!-- MODAL STATUS ----->
							<div class="modal fade" id="myModall{{$f->docu_id}}" aria-hidden="true">
						      <div class="modal-dialog modal-lg">
						        <div class="modal-content">
						          <div class="modal-header">
						          	<h3 class="modal-title">HISTORY</h3>
						        	</div>
						          <div class="modal-body">
						  					<p>
						  						<font face="verdana" color="green" class="float-left">
						  							<strong>{{$f->subject}} </strong>
						  						</font>
						  					</p>
						            <table class="table table-bordered">
						              <thead>
						                <tr>
										 					<th class="tablecell">STATUS</th>
										  				<th class="tablecell">REMARKS</th>
						                  <th class="tablecell" width: "auto !important">DATE</th>
										  				<th class="tablecell">EMPLOYEE / OFFICER</th>
						                </tr>
						             	</thead>
						             	<?php
														$r_id = $f->id;
														$remarks = DB::table('remarks as r')
						                    ->where('r.id', $r_id)
						                    ->get();
													?>
													@foreach($remarks as $rm)
														<tr>
															<td> {{$rm->status}} </td>
															<td> {{$rm->remarks}} </td>
															<td> {{$rm->date}} </td>
															<td> {{$rm->action}} </td>
														</tr>
													@endforeach
						            </table>
						          </div>
									<div class="modal-footer">
										<a href="download_status?id={{$f->docu_id}}" target="_blank" class="text-decoration-none">
											<button title="PREVIEW" type="button" class="btn btn-success" >
												<i class="fas fa-file-pdf"></i>
											</button>
										</a>
										<a href="{{ url('admin/addremarks?record_id='.$f->docu_id) }}" class="text-decoration-none">
											<button type="button" class="btn btn-primary" >
												<i class="far fa-file"></i>
											</button>
										</a>
										<button class="btn btn-danger" type="button" data-dismiss="modal">
										<i class="fas fa-window-close"></i>
										</button>
									</div>

						        </div>
						        <!-- /.modal-content -->
						      </div>
						      <!-- /.modal-dialog -->
						    </div>
						    <!-- END MODAL STATUS ----->



						    <!-- MODAL SUB FILE ----->
							<div class="modal fade" id="mySubfile{{$f->docu_id}}" aria-hidden="true">
						      <div class="modal-dialog modal-lg">
						        <div class="modal-content">
						          <div class="modal-header">

						          <h3 class="modal-title">SUB FILES</h3>
						        </div>
						          <div class="modal-body">
						  					<p>
						  						<font face="verdana" color="green" class="float-left">
						  							<strong>{{$f->subject}} </strong>
						  						</font>
						  					</p>
						            <table class="table table-bordered">
						              <thead>
						                <tr>
										 					<th class="tablecell">FILE NAME</th>
															  <th class="tablecell">PAGES</th>
											          <th class="tablecell" width: "auto !important">DATE</th>
															  <th class="tablecell">DEPARTMENT</th>
															  <th class="tablecell">EMPLOYEE / OFFICER</th>
															  <th class="tablecell">PREVIEW</th>
						                </tr>
						             	</thead>
						             	<?php
														$r_id = $f->id;
														$subfiles = DB::table('subfiles as sub')
						                    ->where('sub.id', $r_id)
						                    ->get();
													?>
													@foreach($subfiles as $sub)
														<tr>
															<td> {{$sub->name}} </td>
															<td> {{$sub->pages}} </td>
															<td> {{$sub->date}} </td>
															<td> {{$sub->department}} </td>
															<td> {{$sub->action}} </td>
															<td> 
																<a href="https://localhost/ODMS-laravel/public/uploads/bg.png"></a>
															</td>
														</tr>
													@endforeach
						            </table>
						          </div>
									<div class="modal-footer">
										<a href="download_status?id={{$f->docu_id}}" target="_blank" class="text-decoration-none">
											<button title="PREVIEW" type="button" class="btn btn-success" >
												<i class="fas fa-file-pdf"></i>
											</button>
										</a>
										<a href="remarks?id={{$f->docu_id}}" class="text-decoration-none">
											<button type="button" class="btn btn-primary" >
												<i class="far fa-file"></i>
											</button>
										</a>
										<button class="btn btn-danger" type="button" data-dismiss="modal">
										<i class="fas fa-window-close"></i>
										</button>
									</div>

						        </div>
						        <!-- /.modal-content -->
						      </div>
						      <!-- /.modal-dialog -->
						    </div>
						    <!-- END MODAL SUB FILE ----->



						    <!-- MODAL EDIT ----->
							<div class="modal fade" id="myEdit{{$f->docu_id}}" aria-hidden="true">
						      <div class="modal-dialog modal-lg">
						        <div class="modal-content">
						          <div class="modal-header">

						          <h3 class="modal-title">UPDATE</h3>
						        </div>
						          <div class="modal-body">
						  					<p>
						  						<font face="verdana" color="green" class="float-left">
						  							<strong>{{$f->subject}} </strong>
						  						</font>
						  					</p>

						  					<form>
						  						<input type="hidden" name="id" value='{{$f->subject}}' />
						  						{{csrf_field()}}
						  						@if ($f->classification == 'Incoming')
						  						<div class="row">
														<div class="col" required>
															<p><input type="radio" id="chk" name="restriction" value="Open to All" required /> <label><strong>Open to All</strong></label></p>
														</div><br>
														<div class="col" required>
															<p><input type="radio" id="chk1" name="restriction" value="Restricted" required /> <label><strong>Restricted</strong></label></p>
														</div><br>
														<div class="col" required>
															<p><input type="radio" id="chk2" name="restriction" value="Confidential" required /> <label><strong>Confidential</strong></label></p>
														</div>
													</div>
						  						@else
						  						<input type="hidden" name="restriction" value="Outgoing"/>	
						  						@endif
						  						<div class="row" required>
														<div class="col">
															<label for="forw"><strong>For / To:</strong></label>
															<input class="form-control" type="text" name="forw" placeholder="For:" 
															value="{{$f->forw}}" />
														</div><br>
														
														<div class="col">
															<label for="from"><strong>From / Signatory:</strong></label>
															<input class="form-control" type="text" name="fromw" placeholder="From:" 
															 value="{{$f->fromw}}" />
															<br>
														</div><br>

														<div class="form-row">
															<div class="col">
															 	<label><strong>Date:</strong> </label>
																<input class="form-control"  name="date" placeholder="Date:" readonly="read-only"
															 value="{{$f->date}}"  /> 
															</div>
															<div class="col">
															 	<label><strong>Classification:</strong> </label>
																<input name="classification" class="form-control" rows="5"  type="text" placeholder="Classification:" 
															value="{{$f->classification}}" />
															</div>
														</div><br>
														<div class="form-row">
															<div class="col">
															 <label><strong>Category:</strong> </label>
															<input class="form-control"  name="category"
															 value="{{$f->category}}" />
															</div>
															
															<div class="col">
															 <label><strong># Pages:</strong> </label>
															<input class="form-control"  name="pages" placeholder="Pages:"
															 value="{{$f->pages}}" />
															</div>
														</div><br>
														<label><strong>Subject:</strong></label>
														<textarea class="form-control" name="subject" rows="3" >{{$f->subject}}
												 		</textarea><br>
									
														<div style="clear:both;"></div>
															<div class="modal-footer">
															<button type="submit" name="save" class="btn btn-primary"><i class="fas fa-upload"></i></button>
																<button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> <i class="fas fa-window-close"></i></button>
														</div>
														{{csrf_field()}}
						  					</form>
						          </div>
									

						        </div>
						        <!-- /.modal-content -->
						      </div>
						      <!-- /.modal-dialog -->
						    </div>
						    <!-- END MODAL EDIT ----->




					    </td>
    				</tr>
    				 @endforeach
    			</tbody>
    		</table>
    	</div>
    </div>
  </div>
	
</div>
	<br><br>
</main>

@stop