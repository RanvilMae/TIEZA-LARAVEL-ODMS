<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TIEZA Portal</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/floating-labels/">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" >

    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" >

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


	<style>
      	.bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      	}
	 	 body, html {
			background-image: url("images/bg.png");
			height: 100%;
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
		}
		.jumbotron{
			background-image: url("images/bg.png");
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
		}
     	 @media (min-width: 768px) {
        	.bd-placeholder-img-lg {
          	font-size: 3.5rem;
        	}
      	}
    </style>
</head>
<body>
	<header>
		<div class="navbar navbar-dark bg-dark shadow-sm ">
		    <div class="container d-flex justify-content-between float-right">
		      	<a href="#" class="navbar-brand d-flex align-items-center">
		        <span style="padding-right: 3px;">
		        	<i class="fas fa-network-wired"></i>
		        	<strong>TIEZA PORTAL</strong>
		        </span>
		      	</a>
			  
				<div class="float-right">
					<div class="collapse" id="navbarToggleExternalContent">
					  <div class="bg-dark p-4">
					    <center><h4 style="color:WHITE;" >For inquiries and concerns</h4></center>
					    <div class="list-group">
							<div href="#" class="list-group-item">
							  <h6 class="list-group-item-heading">Please create a ticket using ITSR</h6>
							</div>
							 <div href="#" class="list-group-item">
							  <h6 class="list-group-item-heading">Please dial loc. 609</h6>
							</div>
							 <div href="#" class="list-group-item">
							  <h5 class="list-group-item-heading">Please email:</h5>
							  <h6 class="list-group-item-heading">&nbsp;&nbsp;<strong>Systems / Database concerns:</strong></h6>
							  <p class="list-group-item-text" style="color:blue;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i> infosysdev@tieza.gov.ph</p>
							  
							  <h6 class="list-group-item-heading">&nbsp;&nbsp;<strong>Network & Computer concerns:</strong></h6>
							  <p class="list-group-item-text" style="color:blue;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i> netcompservices@tieza.gov.ph</p>
							  
							   <h6 class="list-group-item-heading">&nbsp;&nbsp;<strong>IS Planning / Inventory concerns:</strong></h6>
							  <p class="list-group-item-text" style="color:blue;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i> isplanning@tieza.gov.ph</p>
							  
							  <h6 class="list-group-item-heading">&nbsp;&nbsp;<strong>Email / Web concers:</strong></h6>
							  <p class="list-group-item-text" style="color:blue;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i> webmaster@tieza.gov.ph</p>
							</div>
						</div><br>
						<div class=" text-monospace float-right dropdown text-decoration-none " style="color:WHITE">
							<i class='fas fa-calendar-alt'></i> &nbsp;{{$month}} <br>
							<i  class='fas fa-clock'></i> &nbsp;{{$date}} <br>
							<a class="text-monospace " href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" style="color:WHITE" >
						 		<i class="fas fa-user"></i> {{$tid->lname}}, {{$tid->fname}} {{$tid->mname}}
							</a>
						</div>

						<!-- Modal -->
						<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLabel">
						        	<strong>MY PROFILE</strong>
						        </h5>
						        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						      </div>
						      <div style="overflow-x:auto;">
							      <div class="modal-body">
							      	
                        <table class="table">
                              <tr>
                                <th scope="col"><strong>TIEZA ID Number:</strong>
                                <th scope="col">{{$tid->tid}}<br>
                              </tr>
                              <tr>
                                <th scope="col"><strong>First Name:</strong>
                                <th scope="col">{{$tid->fname}}<br>
                              </tr>
                                <tr>
                                <th scope="col"><strong>Middle Name:</strong>
                                <th scope="col">{{$tid->mname}}<br>
                              </tr>
                                <tr>
                                <th scope="col"><strong>Last Name:</strong>
                                <th scope="col">{{$tid->lname}}<br>
                              </tr>
                              <tr>
                                <th scope="col"><strong>Email:</strong>
                                <th scope="col">{{$tid->email}}<br>
                              </tr>
                              <tr>  
                              <th scope="col"><strong>Department:</strong>
                              <th scope="col">{{$tid->department}}<br>
                              </tr>
                              <tr>
                              <th scope="col"><strong>Date Registered:</strong>
                              <th scope="col">{{$tid->date}}<br>
                              </tr>
                              <tr>
                              <th scope="col"><strong>User Level:</strong>
                              <th scope="col">{{$tid->position}}<br>
                              </tr>
                            </table>
							      </div>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						        <button type="button" class="btn btn-primary">Save changes</button>
						      </div>
						    </div>
						  </div>
						</div>

					  </div>
					</div>

					<nav class="navbar navbar-dark bg-dark">
					  <div class="container-fluid">
					    <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
					      <span class="navbar-toggler-icon"></span>
					    </button> &nbsp;
					  
						<!-- Button trigger modal -->
						<button type="button" class="navbar-toggler btn btn-danger" data-bs-toggle="modal" data-bs-target="#logout">
						  <i class="fas fa-power-off"></i>
						</button>

						<!-- Modal -->
						<div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog modal-dialog-centered">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title"><strong>LOG OUT</strong></h5>
						      </div>
						      <div class="modal-body">
						        <strong> {{$tid->fname}} </strong> are you sure you want to logout?
						      </div>
						      <div class="modal-footer">
						      	<button type="button" class="btn btn-danger"> 
						      		<a  style="text-decoration:none;color:white;" href="admin/logout">
									  Logout
									</a>
								</button>
						        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
						        	Close
						        </button>
						      </div>
						    </div>
						  </div>
						</div>
					  </div>
					</nav>
	</header>
<main role="main" class="flex-shrink-0">
    <div class="container">
    	<br><br><br>
      <div class="row">
         
		 <!-- ODMS -->
          <div class="col-sm">
			<a href="admin/home-admin" style="text-decoration: none;">
				<div class="card text-white mb-3" style="background-color: #448AFF;">
				  <div class="card-header"></div>
				  <div class="card-body">
				  <div class="row no-gutters align-items-center">
					<div class="col mr-2">
					  <div class="h5 font-weight text-uppercase mb-1"><strong>ODMS</strong></div>
					  <div class="font-weight mb-1">ONLINE DOCUMENT MANAGEMENT SYSTEM</br></br></div>
					</div>
					<div class="col-auto">
					  <i class="far fa-file fa-3x"></i>
					</div>
				  </div>
				  </div>
				</div>
			</a>
          </div>
		  
		  <!-- TIME KEEPING -->
          <div class="col-sm">
			<a href="http://oas.tieza.gov.ph/" target="_blank" style="text-decoration: none;">
            <div class="card text-white mb-3" style="background-color: #607D8B;">
              <div class="card-header"></div>
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="h5 font-weight text-uppercase mb-1"><strong>ONLINE ATTENDANCE SYSTEM</strong></div>
                    <div class="font-weight mb-1">ONLINE ATTENDANCE</br></br></div>
                  </div>
                  <div class="col-auto">
                    <i class="far fa-clock fa-3x"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
		</a>

         <div class="row">
         
		 	<!-- OFFICIAL DOCUMENTS -->
          <div class="col-sm">
			<a href="ocuments_admin.php" style="text-decoration: none;">
				<div class="card text-white mb-3" style="background-color: #37474f;">
				  <div class="card-header"></div>
				  <div class="card-body">
				  <div class="row no-gutters align-items-center">
					<div class="col mr-2">
					  <div class="h5 font-weight text-uppercase mb-1"><strong>TIEZA OFFICIAL DOCUMENTS</strong></div>
					  <div class="font-weight mb-1">DOWNLOADABLE</br></br></div>
					</div>
					<div class="col-auto">
					  <i class="far fa-file fa-3x"></i>
					</div>
				  </div>
				  </div>
				</div>
			</a>
          </div>
		  
		  <!-- OFFICIAL FORMS -->
          <div class="col-sm">
			<a href="http://oas.tieza.gov.ph/" target="_blank" style="text-decoration: none;">
            <div class="card text-white mb-3" style="background-color: #00796B;">
              <div class="card-header"></div>
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="h5 font-weight text-uppercase mb-1"><strong>TIEZA OFFICIAL FORMS</strong></div>
                    <div class="font-weight mb-1">DOWNLOADABLE</br></br></div>
                  </div>
                  <div class="col-auto">
                    <i class="far fa-clock fa-3x"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
		</a>

	
	<!-- OCOS-->
	@if($department == 'OCOS')
	<div class="row justify-content-md-center">
		<div class="col-6">
		<!-- BOARD RESOLUTIONS -->
			<a href="home_br.php" style="text-decoration: none;">
			<div class="card text-white mb-3" style="background-color: #cda45c;">
				<div class="card-header"></div>
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="h5 font-weight text-uppercase mb-1"><strong>BOARD RESOLUTIONS</strong></div>
							<div class="font-weight mb-1">DOWNLOADABLE</br></br></div>
										  </div>
							<div class="col-auto">
								<i class="far fa-file fa-3x"></i>
							</div>
						</div>
					</div>
				</div>
				</div>
			</div>
			</a>
		</div>
  </div>
  @endif

</main>
</body>
</html>