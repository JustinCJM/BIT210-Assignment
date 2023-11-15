
<?php
require_once 'includes/config_session.inc.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Travel Website</title>
    <link rel="icon" type="image/png" href="assets/logo.png" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <link rel="stylesheet" href="style.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	
    <link rel="stylesheet" href="style.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="style.css" />
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

  </head>
  <?php
  $userType = $_SESSION["user_type"] ?? null;  
  if ($userType === 'merchant') {
    include 'includes/headers/header_merchant.inc.php';
  } elseif ($userType === 'customer') {
    include 'includes/headers/header_customer.inc.php';
  } elseif ($userType === 'tourism_ministry_officer') {
    include 'includes/headers/header_officer.inc.php';
  } else {
    include 'includes/headers/defaultheader.inc.php';
  }
  ?>
  <body>
    <div class="vh-500">
    <div class="container py-5" style="height: 90%">
      <div class="row d-flex justify-content-center align-items-center h-100">
      <section class="ftco-section">
		<div class="container">
		
			<div class="row">
				<div class="col-md-12">
					<h4 class="text-center mb-4">Merchant Applications List</h4>
					<div class="table-wrap">
          
						<table id="example" table class="table table-bordered table-hover">
					    <thead class="table-dark">

					      <tr>
					        <th>ID</th>
					        <th>Username</th>
					        <th>Shop Name</th>
					        <th>Description</th>
					        <th>Status</th>
                  <th>Documentation</th>
					        <th>Approval</th>
					      </tr>
					    </thead>
					    <tbody>
              
              <?php

              require_once 'includes/dbh.inc.php';
              
              $query="SELECT * FROM merch_documents md right join merchant m on m.merchantID = md.merchantID WHERE regStatus = 'PENDING'"  ;
              $result=mysqli_query($mysqli,$query);
              if($result){
                  while($row=mysqli_fetch_assoc($result)){
                    $id = $row['merchantID'];
                    $uname = $row['username'];
                    $email = $row["email"];
                    $sname = $row['shopName'];
                    $contact = $row['contactNo'];
                    $description = $row['merchDescription'];
                    $status = $row['regStatus'];
                    $docPath = $row['document_path'];
                    $filePath = '/BIT210-Assignment'. $docPath;

                    $data = [
                      "email" =>$email,
                      "id" => $id,
                      "contact" => $contact,
                      "username" => $uname,
                    ];

                    $json = rawurlencode(json_encode($data));
                              
                    echo'
                    <tr>
                    <td>'.$id.'</td> 
                    <td>'.$uname.'</td>
                    <td>'.$sname.'</td>
                    <td>'.$description.'</td>
                    <td>'.$status.'</td>
                    
                    <td><a name="doc" class="btn btn-info" href="'.$docPath.'" download>PDF Document</a></td>
                    <td><button type="button" class="btn btn-primary" onclick="openModal(this)" data='.$json.'>View Details</button>
                  </td>
                </tr>';



                  }
              
            
            

            }
            ?>

                <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content" action ="sendmail.php" method="post">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Account detail page</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form class="" action ="sendmail.php" method="post">


                        <label for="ID">Merchant ID</label>
                        <input id="modal_merchid" name="merch_id" class="form-control" type="text" value="Disabled readonly input" aria-label="Disabled input example" readonly>

                        <label for="ID">Email</label>
                        <input class="form-control" id="modal_email" name='email' type="text" value="Readonly input here..." aria-label="readonly input example" readonly>


                        <label for="ID">Username</label>
                        <input id="modal_username" class="form-control" type="text" value="Disabled readonly input" aria-label="Disabled input example" disabled readonly>

                        <label for="ID">Contact</label>
                        <input id="modal_contact" class="form-control" type="text" value="Disabled readonly input" aria-label="Disabled input example" disabled readonly>

                      

    
                        <div class="form-group">
                          <label for="exampleFormControlTextarea1">Email Message & Remark</label>
                          <textarea class="form-control" name='message' id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                      
    
                  </div>
                  <div class="modal-footer">
                    <button type="submit" name ="send" class="btn btn-primary">Accept</button>

                    <button type="sumit"  name ="send1" class="btn btn-danger">Reject</button>

                  </div></form>
                </div>
              </div>
            </div>
					    </tbody>
					  </table>
					</div>
				</div>
			</div>

	  </div>
	</section>

  
   
 
      </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script src="js/app.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <script>
      function openModal(e){
        const json = JSON.parse(decodeURIComponent($(e).attr("data")))
        $("#modal_merchid").val(json.id)
        $("#modal_email").val(json.email)
        $("#modal_contact").val(json.contact)
        $("#modal_username").val(json.username)
        $("#exampleModal").modal("show")
      }     
      
    </script>
  </body>

  <footer class="text-center text-lg-start text-white" style="background-color: #1c2331">
    <!-- Section: Social media -->
    <section
      class="d-flex justify-content-center p-4"
      style="background-color: #6351ce"
      >
      <!-- Right -->
      <div>
        <a href="" class="text-white me-4">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-linkedin"></i>
        </a>
      </div>
      <!-- Right -->
    </section>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    
      <div>
        <!-- Grid row -->
        <div class="row mt-xl-4">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold"><img src="assets/logo.png" class="smalllogo" alt="...">Travurr</h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 60px; background-color: #7c4dff; height: 2px"
                />
            <p class="fw-bold">
              Unveiling the Extraordinary
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold">Products</h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 60px; background-color: #7c4dff; height: 2px"
                />
            <p>
              <a href="#!" class="text-white">Transport</a>
            </p>
            <p>
              <a href="#!" class="text-white">Accommodation</a>
            </p>
            <p>
              <a href="#!" class="text-white">Experiences</a>
            </p>
            <p>
              <a href="#!" class="text-white">Package Deals</a>
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold">Quick Links</h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 60px; background-color: #7c4dff; height: 2px"
                />
            <p>
              <a href="faq.php" class="text-white">FAQ</a>
            </p>
            <p>
              <a href="contact.php" class="text-white">Contact Us</a>
            </p>
            <p>
              <a href="about.php" class="text-white">About Us</a>
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold">Contact</h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 60px; background-color: #7c4dff; height: 2px"
                />
            <p><i class="fas fa-home mr-3"></i> Tower 3, Brunsfield Oasis, Oasis Square, Jalan PJU 1A/7A, Oasis Ara Damansara, 47301 Petaling Jaya, Selangor</p>
            <p><i class="fas fa-envelope mr-3"></i> Travurrtravels@gmail.com</p>
            <p><i class="fas fa-phone mr-3"></i> +60 3845 3984</p>
          </div>
          <!-- Grid column -->
          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          </div>
          <!-- Grid column -->
          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
    
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div
          class="text-center p-3"
          style="background-color: rgba(0, 0, 0, 0.2)"
          >
      © 2020 Copyright:
      <a class="text-white" href="https://mdbootstrap.com/"
          >MDBootstrap.com</a
        >
    </div>
    <!-- Copyright -->
  </footer>
  
  
</html>
