<?php
session_start();
if(!isset($_SESSION['email'])) {
    header("Location:../views/login.php");
    die();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>
        <meta charset="utf-8" />
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0" />

        <!-- Latest compiled and minified Bootstrap 4.6.1 CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

        <!-- Latest Font-Awesome CDN -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light px-5">
            <a class="navbar-brand" href="#">Clinic</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <a href="../actions/logoutAction.php" class="btn btn-primary btn-sm ml-auto">Logout</a>
            </div>
        </nav>

        <div class="container py-5">
            <div class="row">
                <div class="col-12 text-center mb-4">
                    <h1>Our patients</h1>
                </div>
            </div>
        </div>

        <div class="container-fluid bg-light">
            <div class="row ">
                <div class="col-6 offset-6 d-flex justify-content-end p-3">
                    <form id="searchPatient">
                        <div class="form-group mb-0 d-flex">
                            <input type="number" min="1001" required id="patientClinicId" class='form-control' name="clinic_id" placeholder="Search patient by clinic id..." class="p-2">
                            <button type="submit" name="search" class="btn btn-secondary ml-3">Search</button>
                        </div>
                    </form>                                
                </div>
            </div>
        </div>
        <div class="container-fluid bg-dark">
            <table class="table table-dark mb-0">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Clinic id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone number</th>
                        <th scope="col">Address</th>
                        <th scope="col">Medical condition</th>
                        <th scope="col">Blood type</th>
                        <th scope="col" colspan="3">Action</th>
                    </tr>
                </thead>
                <tbody id="patientsInfo">
                    
                </tbody>
            </table>                                        
        </div>

        <div class="modal" id="patientModal" tabindex="-1" role="dialog" aria-hidden="true">
            
            <div class="modal-dialog modal-lg" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Patient info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <div id="result">
                        
                        </div>
                        <form id="updatePatientInfo">

                            <div class="row">

                                <div class="col-6">

                                    <div class="form-group">
                                        <input type="hidden" id="updatePatient" name="id" />
                                        <label for="editName">Name</label>
                                        <input type="text" class="form-control" id="editName" name="name">
                                    </div>


                                    <div class="form-group">
                                        <label for="editEmail">Email</label>
                                        <input type="text" class="form-control" id="editEmail" name="email">
                                    </div>

                                    <div class="form-group">
                                        <label for="editPhone">Phone Number</label>
                                        <input type="text" class="form-control" id="editPhone" name="phone_number">
                                    </div>


                                </div>

                                <div class="col-6">


                                    <div class="form-group">
                                        <label for="editAddress">Address</label>
                                        <input type="text" class="form-control" id="editAddress" name="address">
                                    </div>

                                    <div class="form-group">
                                        <label for="editMedicalCondition">Medical condition</label>
                                        <input type="text" class="form-control" id="editMedicalCondition" name="medical_condition" >
                                    </div>

                                    <div class="form-group">
                                        <label for="editBloodType">Blood type</label>
                                        <input type="text" class="form-control" id="editBloodType" name="blood_type" >
                                    </div>


                                </div>

                                

                            </div> 

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="updatePatientInfoBtn" class="btn btn-primary">Save changes</button>
                            </div>

                        </form> 
                                                        
                    </div>

                   

                </div>
            </div>
                            
                
        </div>
        
        
        
        <!-- jQuery library -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        
        <!-- Latest Compiled Bootstrap 4.6.1 JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>

        

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <script src="../scripts/fetchPatients.js"></script>
    </body>
</html>