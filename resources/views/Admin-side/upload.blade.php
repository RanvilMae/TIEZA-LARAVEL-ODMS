@extends('Admin-side/admin_template')

@section('mybody')
@if(isset($message))
	<script type='text/javascript'>
		alert('{{$message}}')
	</script>
@endif

 <div class="container"> <br>
  <div class="jumbotron">
	<form action="uploadprocess" method="post" enctype="multipart/form-data">
      <div class="form-group">
			<h3><strong>UPLOAD</strong></h3>
			<hr>
			<input hidden class="form-control" type="text" name="department" id="department"  value="{{$tid->department}}">
      		<input hidden class="form-control"  type="text" name="fname" id="fname"  value="{{$tid->lname}} , {{$tid->fname}} {{$tid->mname}}">
      		<input hidden class="form-control" type="text"  name="tid" id="tid"   value="{{$tid->tid}}">
      		<input hidden class="form-control" type="text"  name="docu_id" value="{{$add_id}} ">
      
		<div class="row" required>
		<div class="col">
			<p><input type="radio" id="chk" name="restriction" value="Open to All" required />
			<label id="o"><strong>Open to All</strong></label></p>
		</div><br>
		<div class="col">
			<p><input type="radio" id="chk1" name="restriction" value="Restricted" required /> 
			<label id="oo"><strong>Restricted</strong></label></p>
		</div><br>
		<div class="col">
			<p><input type="radio" id="chk2" name="restriction" value="Confidential" required /> 
			<label id="ooo"><strong>Confidential</strong></label></p>
		</div><br>
	</div>
			<div class="row" required>
			<div class="col">
			<label><strong>Classification:</strong> </label>
				 <select class="form-control"  id="sel"  name="classification"  onchange="disableRadioValue(this)">
				 <option >--SELECT--</option>
					  <option value="Outgoing">Outgoing</option>
					  <option value="Incoming">Incoming</option>
				  </select>
			</div><br>
			<div class="col">
				<label><strong>Date: </strong></label>
				<input class="form-control" name="date" required readonly="read-only" value="{{$mytime}}" ><br>
			</div>
		</div>

			<div class="row"required>
				<div class="col">
					<label><strong>For / To:</strong> </label>
					
					 <select id="sel_depart" name="forw" class="form-control" id="forw" onchange="disableTextBox(this)" required>
						<option>--SELECT--</option>
						@foreach ($depts as $d)
								<option value="{{$d->department}}"> 
									<strong> {{$d->department}} - </strong>
									{{$d->narrative}}
								</option>
						@endforeach
							
					</select>
				</div>
		
	
		
		
				<div class="col">
					<label><strong>From / Signatory:</strong> </label>
					<select id="sel_departf" name="fromw" class="form-control" id="fromw"  onchange="disableTextBox2(this)" required>
						<option >--SELECT--</option>
						@foreach ($depts as $d)
								<option value="{{$d->department}}"> 
									<strong> {{$d->department}} - </strong>
									{{$d->narrative}}
								</option>
						@endforeach
					</select>
					<div class="clear"></div>
				</div>
			</div><br>	 
			
			<div class="row"required>
				<div class="col">
					<label><strong>Category: </strong></label>
					<select input name="category" class="form-control" id="category" required>
						<option >--SELECT--</option>
						@foreach ($category as $c)
								<option value="{{$c->category}}"> 
									{{$c->category}}
								</option>
						@endforeach	
	
					</select>
				</div><br>
		
				<div class="col">
					<label><strong>No. of Pages:</strong> </label>
					<input type="number" class="form-control" placeholder="No. of Pages" min="1" max="1000" name="pages" required /><br>
				</div>
			</div>	
			
		<label><strong>Subject / Re: </strong></label>
					<input type="text" class="form-control" placeholder="Subject" name="subject" required><br>

		<label><strong>File: </strong></label>	
        <input type="file" class="form-control" id="exampleFormControlFile1" name="myfile"><br>
		
		
		<button type="submit" title="UPLOAD" name="submit" class="btn btn-primary float-right">
			<i class="fas fa-upload"></i>
		</button>
		</div>	 
		{{csrf_field()}}
	</form>
</div>
	<br><br>
</div>


     
	<script type="text/javascript">
	function disableTextBox(v) {
	  if (v.value == 'EXTERNAL') {
		sel_user.style.display = "none";
		text1.style.display = "block";
	  } else {
		text1.style.display = "none";
		sel_user.style.display = "block";
	  }
	}
	</script>

	<script type="text/javascript">
	function disableTextBox2(v) {
	  if (v.value == 'EXTERNAL') {
		  sel_userf.style.display = "none";
		text2.style.display = "block";
	  } else {
		text2.style.display = "none";
		sel_userf.style.display = "block";
	  }
	}
	</script> 
        
 <script type="text/javascript">
    function disableRadioValue(restriction) {
        if (restriction.value == 'Outgoing')
		{
			chk.disabled = true;
			chk1.disabled = true;
			chk2.disabled = true;
		}
        else
		{
			chk.disabled = false;
			chk1.disabled = false;
			chk2.disabled = false;
		}
    }
</script>
<script type="text/javascript">
        $(document).ready(function(){

            $("#sel_depart").change(function(){
                var department = $(this).val();

                $.ajax({
                    url: 'getUsers.php',
                    type: 'post',
                    data: {depart:department},
                    dataType: 'json',
                    success:function(response){

                        var len = response.length;

                        $("#sel_user").empty();
						$("#sel_user").append("<option value='N/A'>N/A</option>");
						
                        for( var i = 0; i<len; i++){
                            var department = response[i]['department'];
							
							var lname = response[i]['lname'];
                            var fname = response[i]['fname'];
							var x = ", ";

                            $("#sel_user").append("<option value='"+lname+""+x+" "+fname+"'>"+lname+""+x+" "+fname+"</option>");

                        }
                    }
                });
            });

        });
    </script>
	
	<script type="text/javascript">
        $(document).ready(function(){

            $("#sel_departf").change(function(){
                var department = $(this).val();

                $.ajax({
                    url: 'getUsers.php',
                    type: 'post',
                    data: {depart:department},
                    dataType: 'json',
                    success:function(response){

                        var len = response.length;
							
                        $("#sel_userf").empty();
						
						$("#sel_userf").append("<option value='N/A'>N/A</option>");
                       for( var i = 0; i<len; i++){
                            var department = response[i]['department'];
							
							var lname = response[i]['lname'];
                            var fname = response[i]['fname'];
							var x = ", ";

                            $("#sel_userf").append("<option value='"+lname+""+x+" "+fname+"'>"+lname+""+x+" "+fname+"</option>");
							
                        }
                    }
                });
            });

        });
    </script>
@stop