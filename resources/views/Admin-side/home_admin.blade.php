@extends('Admin-side/admin_template')

@section('mybody')

<!-- Begin Page Content -->
	<div class="container-fluid">
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
		<script type="text/javascript">  
			google.charts.load('current', {'packages':['corechart']});  
			google.charts.setOnLoadCallback(drawChart);  
			function drawChart()
			{  
    			var data = google.visualization.arrayToDataTable([  
              	['Restriction', 'Number'],  

              	 <?php

	          	$servername = "localhost";
				$username = "odmstiezagov";
				$password = "1221";
				$dbname = "odmstiez_tieza_portal";
				$department = $department;

	          	$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
				  die("Connection failed: " . $conn->connect_error);
				}

				$sql = "SELECT restriction, count(*) as number FROM files WHERE department = '$department' GROUP BY restriction";
					$query = $conn->query($sql);
	              	while($row = $query->fetch_assoc()){  
	               		echo "['".$row["restriction"]."', ".$row["number"]."],";  
	              	}  
              	?> 

         		]);  
			    var options = {  
			          		title: 'Type of Files Uploaded Percentage',  
			          		//is3D:true,  
			          		pieHole: 0.3
			         	};  
			    var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
			    chart.draw(data, options);  
			}  
		</script>

	    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	    <script type="text/javascript">
	      google.charts.load('current', {'packages':['corechart']});
	      google.charts.setOnLoadCallback(drawChart);

	      function drawChart() {
	        var data = google.visualization.arrayToDataTable([
	          ['Year', 'Uploads'], 
	          <?php

	          	$servername = "localhost";
				$username = "odmstiezagov";
				$password = "1221";
				$dbname = "odmstiez_tieza_portal";
				$department = $department;

	          	$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
				  die("Connection failed: " . $conn->connect_error);
				}

				$sql = "SELECT date, count(*) as number FROM files WHERE department = '$department' GROUP BY Month(date)";
				
				$query = $conn->query($sql);
	              	while($row = $query->fetch_assoc()){  
	               		echo "['".$row["date"]."', ".$row["number"]."],";  
	              	}  
              	?> 
	        ]);
	        var options = {
	          title: 'Number of Uploaded Files per Month',
	          curveType: 'function',
	          legend: { position: 'center' }
	        };
	        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

	        chart.draw(data, options);
	      }
    	</script>	

    	<!-- Begin Page Content -->
		<div class="container-fluid"> <br>

		  <!-- Page Heading -->
		  <div class="d-sm-flex align-items-center justify-content-between mb-4">
		    <h1 class="h3 mb-0 text-gray-800"><strong>Dashboard</strong></h1>
		    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
		  </div>

		  <!-- Content Row -->
		  <div class="row">

		    <!-- FILES -->
		    <div class="col-xl-3 col-md-6 mb-4">
		      <div class="card border-left-primary shadow h-100 py-2">
		        <div class="card-body">
		          <div class="row no-gutters align-items-center">
		            <div class="col mr-2">
		              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">UPLOADED FILE/S</div>
		              <div class="h5 mb-0 font-weight-bold text-gray-800">
					  	{{$files}}
					  </div>
		            </div>
		            <div class="col-auto">
		              <i class="fas fa-file fa-2x text-gray-300"></i>
		            </div>
		          </div>
		        </div>
		      </div>
		    </div>

		    <!-- ARCHIVE -->
		    <div class="col-xl-3 col-md-6 mb-4">
		      <div class="card border-left-success shadow h-100 py-2">
		        <div class="card-body">
		          <div class="row no-gutters align-items-center">
		            <div class="col mr-2">
		              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">ARCHIVED FILE/S</div>
		              <div class="h5 mb-0 font-weight-bold text-gray-800">
					  	{{$archive}}
		              </div>
		            </div>
		            <div class="col-auto">
		              <i class="fas fa-archive fa-2x text-gray-300"></i>
		            </div>
		            </div>
		        </div>
		      </div>
		  	</div>

		  	 <!-- ADMIN -->
		    <div class="col-xl-3 col-md-6 mb-4">
		      <div class="card border-left-warning shadow h-100 py-2">
		        <div class="card-body">
		          <div class="row no-gutters align-items-center">
		            <div class="col mr-2">
		              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">NUMBER OF ADMIN/S</div>
		              <div class="h5 mb-0 font-weight-bold text-gray-800">
						{{$admin}}
					  </div>
		            </div>
		            <div class="col-auto">
		            	<i class="fas fa-users-cog fa-2x text-gray-300"></i>
		            </div>
		          </div>
		        </div>
		      </div>
		    </div>


		  	 <!-- USER -->
		    <div class="col-xl-3 col-md-6 mb-4">
		      <div class="card border-left-warning shadow h-100 py-2">
		        <div class="card-body">
		          <div class="row no-gutters align-items-center">
		            <div class="col mr-2">
		              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">NUMBER OF USER/S</div>
		              <div class="h5 mb-0 font-weight-bold text-gray-800">
						{{$users}}
					  </div>
		            </div>
		            <div class="col-auto">
		               <i class="fas fa-users fa-2x text-gray-300"></i>
		            </div>
		          </div>
		        </div>
		      </div>
		    </div>
		  </div>

		  <!-- Content Row -->

		  <div class="row">

		    <!-- Area Chart -->
		    <div class="col-xl-8 col-lg-7">
		      <div class="card shadow mb-4">
		        <!-- Card Header - Dropdown -->
		        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		          <h6 class="m-0 font-weight-bold text-primary">Uploads Overview</h6>
		            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
		              <div class="dropdown-header">Dropdown Header:</div>
		              <a class="dropdown-item" href="#">Action</a>
		              <a class="dropdown-item" href="#">Another action</a>
		              <div class="dropdown-divider"></div>
		              <a class="dropdown-item" href="#">Something else here</a>
		          </div>
		        </div>
		        <!-- Card Body -->
		        <div class="card-body">
		         <div id="curve_chart" style="width: 100%; height: 350px"></div>
		        </div>
		      </div>
		    </div>

		    <!-- Pie Chart -->
		    <div class="col-xl-4 col-lg-5">
			<div style="container-fluid" class="mx-auto" >
		      <div class="card shadow mb-4">
		        <!-- Card Header - Dropdown -->
		        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		          <h6 class="m-0 font-weight-bold text-primary">Percentage</h6>
		            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
		              <div class="dropdown-header">Dropdown Header:</div>
		              <a class="dropdown-item" href="#">Action</a>
		              <a class="dropdown-item" href="#">Another action</a>
		              <div class="dropdown-divider"></div>
		              <a class="dropdown-item" href="#">Something else here</a>
		          </div>
		        </div>
		        <!-- Card Body -->
					<div id="piechart" style="height:350px; width: 100%;"></div>
				</div> 
		        </div>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
@stop