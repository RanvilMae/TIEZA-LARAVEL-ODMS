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
    <form method="get" action="viewdata.php" style="float: right;">
    	<div class="row" > 

    			<label style="text-decoration-none;color:RED">Please search and scan barcode here..</label>
    		<div class="col-lg" >
    			<input type="text" class="form-control" name="str" placeholder="Search.." value="<?php echo (isset($_GET['str'])) ? $_GET['str'] : ''; ?>">
    		</div>
    		<div class="col-lg-3">
    			<label></label>
    			<button type="submit" class="btn btn-primary" value="1">Search</button>
    		</div>
    	</div>
    </form> <br>
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
									

									<button type="button" class="btn btn-primary" title="PREVIEW">
										<a href="http://localhost/ODMS-laravel/storage/app/public/my_uploads/{{$f->department}}/{{ $f->name }}" target="_blank" class="text-decoration-none" style="color:white;">
											<i class="fas fa-eye"></i>
										</a>
									</button>




								<!-- MODAL tag ----->
							<div class="modal fade" id="myTag{{$f->docu_id}}" aria-hidden="true">
						      <div class="modal-dialog modal-lg">
						        <div class="modal-content">
						          <div class="modal-header">

						          <h3 class="modal-title">TAGGING</h3>
						        </div>
						          <div class="modal-body">
						  					<p>
							  						<font face="verdana" color="green" class="float-left">
							  							<strong>{{$f->subject}} </strong>
							  						</font>
							  					</p><br>
							  					<hr>
						  						<p>
						  							<font face="Britannic Bold" class="float-left">
						  								<strong>DEPARTMENTS</strong>
						  							</font>
						  						</p>
						            <table class="table table-bordered">
						              <thead>
						                <tr>
										 					<th class="tablecell">TAGGED TO</th>
				 											<th class="tablecell">TAGGED DATE</th>
				  										<th class="tablecell">ACTION</th>
                  						<th class="tablecell" >VIEWED DATE</th>
						                </tr>
						             	</thead>
						             	<?php
														$tag_id = $f->id;
														$tag = DB::table('tags as t')
						                    ->where('id', $tag_id)
						                    ->get();
													?>
													@foreach($tag as $tag)
														<tr>
															<?php
																$tagtag = $tag->tag;
																$adminc = DB::table('admin as a')
						                    	->where('tid', $tagtag)
						                    	->count();
						                    if ($adminc > 0) {
																	$admin = DB::table('admin as a')
							                    	->where('tid', $tagtag)
							                    	->get();
						                    ?>
															
															<td>
																@foreach($admin as $a)
																<strong>{{$a->department}} -</strong> {{$a->lname}}, {{$a->fname}}
																@endforeach
															</td>
															<td> {{$tag->date}} </td>
															<td> {{$tag->action}} </td>
															<td> {{$tag->dateviewed}} </td>
															<?php
															}else{
						                    	
						                    }
															?>
														</tr>
													@endforeach
						            </table><br> <br>
						            <p>
						  							<font face="Britannic Bold" class="float-left">
						  								<strong>{{$department}} PERSONNEL/S</strong>
						  							</font>
						  					</p>
						  					<table class="table table-bordered">
						              <thead>
						                <tr>
										 					<th class="tablecell">TAGGED TO</th>
				 											<th class="tablecell">TAGGED DATE</th>
				  										<th class="tablecell">ACTION</th>
                  						<th class="tablecell" >VIEWED DATE</th>
						                </tr>
						             	</thead>
						             	<?php
														$tag_id = $f->id;
														$tag = DB::table('tags as t')
						                    ->where('id', $tag_id)
						                    ->get();
													?>
													@foreach($tag as $tag)
														<tr>
															<?php
																$tagtag = $tag->tag;
																$userc = DB::table('users as a')
						                    	->where('tid', $tagtag)
						                    	->count();
						                    if ($userc > 0) {
																	$user = DB::table('users as a')
							                    	->where('tid', $tagtag)
							                    	->get();
						                    ?>
															
															<td>
																@foreach($user as $a)
																<strong>{{$a->department}} -</strong> {{$a->lname}}, {{$a->fname}}
																@endforeach
															</td>
															<td> {{$tag->date}} </td>
															<td> {{$tag->action}} </td>
															<td> {{$tag->dateviewed}} </td>
															<?php
															}else{
						                    	
						                    }
															?>
														</tr>
													@endforeach
						            </table>
						          </div>
									<div class="modal-footer">
										<a href="{{ url('admin/pdf_tagging?id='.$f->id) }}" target="_blank" class="text-decoration-none">
											<button title="PREVIEW" type="button" class="btn btn-success" >
												<i class="fas fa-file-pdf"></i>
											</button>
										</a>
										<button title="ADD TAG" class="btn btn-primary nav-link dropdown-toggle dropdown-toggle-split " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-decoration-none;color:white;">
											<i class="fas fa-user-plus"></i>
										</button>
											<div class="dropdown-menu">
											    <a href="{{ url('admin/tag_tosector?id='.$f->id) }}" class="text-decoration-none" 		style="text-decoration-none;color:BLack;>">
													&nbsp;&nbsp;&nbsp;<i class="fas fa-user-plus">&nbsp;&nbsp;SECTOR</i>
												</a><br>
												<a href="{{ url('admin/tagtodept?id='.$f->id) }}" class="text-decoration-none" 		style="text-decoration-none;color:BLack;>">
													&nbsp;&nbsp;&nbsp;<i class="fas fa-user-plus">&nbsp;&nbsp;DEPARTMENT</i>
												</a><br>
												<?php
													$div = $tid->department;
													$divi = DB::table('department as id')
										            ->where('division', $department)
										            ->orderBy('department', 'ASC')
										            ->count();
												?>
												@if($divi > 0)
												<a href="{{ url('admin/tag_todiv?id='.$f->id) }}" class="text-decoration-none" 		style="text-decoration-none;color:BLack;>">
													&nbsp;&nbsp;&nbsp;<i class="fas fa-user-plus">&nbsp;&nbsp;DIVISION</i>
												</a><br>
												@else
												@endif
												<a href="{{ url('admin/tag_topersonnel?id='.$f->id) }}" class="text-decoration-none" style="text-decoration-none;color:BLack;>">
														&nbsp;&nbsp;&nbsp;<i class="fas fa-user-plus">&nbsp;&nbsp;{{$f->department}} PERSONNEL&nbsp;&nbsp;</i>
												</a>
											</div>
										<button class="btn btn-danger" type="button" data-dismiss="modal">
											<i class="fas fa-window-close"></i>
										</button>
					
									</div>

						        </div>
						        <!-- /.modal-content -->
						      </div>
						      <!-- /.modal-dialog -->
						    </div>
						    <!-- END MODAL tag----->


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
										<a href="{{ url('admin/pdf_status?id='.$f->id) }}" target="_blank" class="text-decoration-none">
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
																<a href="http://localhost/ODMS-laravel/storage/app/public/my_uploads/{{$f->department}}/{{ $sub->name }}" target="_blank" class="text-decoration-none">
																		<button class="btn btn-primary" >
																			VIEW
																		</button>
																</a>
															</td>
														</tr>
													@endforeach
						            </table>
						          </div>
									<div class="modal-footer">
										<a href="{{ url('admin/pdf_subfile?id='.$f->id) }}" target="_blank" class="text-decoration-none">
											<button title="PREVIEW" type="button" class="btn btn-success" >
												<i class="fas fa-file-pdf"></i>
											</button>
										</a>
										<a href="{{ url('admin/subfile?record_id='.$f->docu_id) }}" class="text-decoration-none">
											<button type="button" class="btn btn-primary" >
												<i class="fas fa-folder-plus"></i>
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
						  					</p> <br>
											<form action="update_file" method="post" enctype="multipart/form-data" >



						  						<input type="hidden" name="id" value='{{$f->id}}' />
						  						<input type="hidden" name="department" value='{{$f->department}}' />
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
													</div><br>
						  						@else
						  						<input type="hidden" name="restriction" value="Outgoing"/>	
						  						@endif
						  						<div class="row" required>
														<div class="col">
															<label for="forw"><strong>For / To:</strong></label>
															<input class="form-control" type="text" name="forw" placeholder="For:" 
															value="{{$f->forw}}" readonly="read-only" />
														</div><br>
														
														<div class="col">
															<label for="from"><strong>From / Signatory:</strong></label>
															<input class="form-control" type="text" name="fromw" placeholder="From:" 
															 value="{{$f->fromw}}" readonly="read-only"/>
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
																<input name="classification" class="form-control" rows="5"  type="text" readonly="read-only" value="{{$f->classification}}" />
															</div><br>
														</div><br>
														<div class="form-row">
															<div class="col"><br>
															 <label><strong>Category:</strong> </label>
															<input class="form-control"  name="category"
															 value="{{$f->category}}" readonly="read-only"/>
															</div><br>
															
															<div class="col"><br>
															 <label><strong># Pages:</strong> </label>
															<input class="form-control"  name="pages" placeholder="Pages:"
															 value="{{$f->pages}}" readonly="read-only"/>
															</div><br>
														</div><br><br>
														<div class="form-row">
															<div class="col"><br>
																<label><strong>Existing Filename:</strong></label>
																<textarea class="form-control" name="subject" rows="1" readonly="read-only">{{$f->name}} 
													 			</textarea>
													 		</div>
														</div><br>

														<div class="form-row">
															<div class="col"><br>
																<label><strong>File:</strong></label>
																<input type="file" name="myfile" class="form-control"> 
													 		</div><br>
														</div><br>
									
														<div class="modal-footer"><br>
															<button type="submit" name="submit" class="btn btn-primary">
																<i class="fas fa-upload"></i>
															</button>
															<button class="btn btn-danger" type="button" data-dismiss="modal">
																<span class="glyphicon glyphicon-remove"></span> 
																<i class="fas fa-window-close"></i>
															</button>
														</div> <br>
														{{csrf_field()}}
						  					</form>
						          </div>
									

						        </div>
						        <!-- /.modal-content -->
						      </div>
						      <!-- /.modal-dialog -->
						    </div>
						    <!-- END MODAL EDIT ----->


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
																<a href="http://localhost/ODMS-laravel/storage/app/public/my_uploads/{{$f->department}}/{{ $sub->name }}" target="_blank" class="text-decoration-none">
																		<button class="btn btn-primary" >
																			VIEW
																		</button>
																</a>
															</td>
														</tr>
													@endforeach
						            </table>
						          </div>
									<div class="modal-footer">
										<a href="{{ url('admin/pdf_subfile?id='.$f->id) }}" target="_blank" class="text-decoration-none">
											<button title="PREVIEW" type="button" class="btn btn-success" >
												<i class="fas fa-file-pdf"></i>
											</button>
										</a>
										<a href="{{ url('admin/subfile?record_id='.$f->docu_id) }}" class="text-decoration-none">
											<button type="button" class="btn btn-primary" >
												<i class="fas fa-folder-plus"></i>
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
