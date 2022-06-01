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

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="{{ url('/datatable/datatable.css')}}">
  <script type="text/javascript" src="{{ url('datatable/datatable.js')}}"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

  <script type="text/javascript" src="http://code.jquery.com/jquery-2.0.2.js"></script>
 




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
      background-image: url("{{ url('/images/bg.png')}}");
      height: 100%;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
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

    .notification .badge {
    position: absolute;
    padding: 2px 10px;
    border-radius: 50%;
    background-color: red;
    color: white;
    }
        .count-notif{
      vertical-align:middle;
      margin-left:-10px;
      margin-top: -15px;
      font-size:13px;
      color: RED;
      
    } 
.notif .badges {
    position: absolute;
    padding: 0px 6px;
    border-radius: 100%;
    background-color: white;
 }
        .footer {
        position: fixed;
        left: 0;
        bottom: 2px;
        width: 100%;
        font-size: 15px;
        color: Black;
        text-align: center;
        height: 4rem;
        font-family: ITC Franklin Gothic;
    }
    </style>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#"><strong> Online Document Management System v4.1     </strong> </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="{{ url('/admin')}}">PORTAL</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="{{ url('/admin/home-admin')}}">HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="{{ url('/admin/upload')}}">UPLOAD</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{ url('/admin/viewdata')}}" >
             {{$tid->department}} FILES
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link  active" href="{{ url('/admin/incoming')}}">
              INCOMING
            </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#">ARCHIVE</a>
        </li>
      </ul>
    </div>
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
  </nav>
  
  <main role="main" class="flex-shrink-0">
    @yield('mybody')
  </main>
</body>
<footer class="footer">
    <div class="inner"> <br>
    Copyright &copy; 2019. All rights reserved.<br>Management Information Systems Department. <br>
    <div class="float-right d-none d-sm-inline-block">
    </div>
    </div>
</footer>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" ></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" ></script>


  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
    $(document).ready( function () {
        $('#data_table').DataTable();
    } );
  </script>



</body>
</html>