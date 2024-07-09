<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <link rel="stylesheet" href="Style_ClientRegistration.css" type="text/css"/>
        <title>User Registration</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form action="User_Request.php" id="client_form" method="post" enctype="multipart/form-data">
            <div class="Box">
                <div class="Container">
                    <div class="Form">
                        <div class="head">
                            <p><span class="header_name">Registration</span></p>
                        </div>
                        <div class="Client_Info" id="Section1">
                            <p class="tag">Personal Information</p>
                            <br>
                            <label>Profile </label>
                            <br><br>
                            <div class="custom-file-input">
                                <input type="file" name="Client_File" id="F_Client" accept="image/*">
                                <img src="Profile.png" alt="Upload Icon" id="uploadImage">
                                <img src="" alt="Profile Preview" id="profilePreview" style="display:none;">
                            </div>
                            <br>
                            <label>Name </label>
                            <br>
                            <input type="text" name="C_lname" id="lname" placeholder="Last Name" required>
                            <b>,</b>
                            <input type="text" name="C_fname" id="fname" placeholder="First Name" required>
                            <input type="text" name="C_mname" id="mname" placeholder="Middle Initial ex. Reyes (optional)">
                            <br>
                            <label>Contact No. </label>
                            <br>
                            <input type="tel" name="C_contact" placeholder="Contact No."  required>
                            <br>
                            <label>Email </label>
                            <br>
                            <input type="email" name="C_Email" placeholder="Email"  required>
                            <br>
                            <label>Address </label>
                            <br>
                            <input type="text" name="client_add" placeholder="Address" required>
                            <br>
                            <select name="City" id="city">
                                <option value="" disabled selected hidden>City/Municipality</option>
                                <option value="Angono">Angono</option>
                                <option value="Antipolo">Antipolo</option>
                                <option value="Baras">Baras</option>
                                <option value="Binangonan">Binangonan</option>
                                <option value="Cainta">Cainta</option>
                                <option value="Cardona">Cardona</option>
                                <option value="Jalajala">Jalajala</option>
                                <option value="Morong">Morong</option>
                                <option value="Pililla">Pililla</option>
                                <option value="Rodriguez">Rodriguez</option>
                                <option value="San Mateo">San Mateo</option>
                                <option value="Tanay">Tanay</option>
                                <option value="Taytay">Taytay</option>
                                <option value="Teresa">Teresa</option>
                            </select>
                            <select name="brgy" id="c_brgy">
                                <option value="" disabled selected hidden>Barangay</option>

                                <!-- BRGY under chosen municipality -->

                            </select>
                            <br><br>
                            <label>Declaration</label>
                            <br><br>
                            <div class="Rule">
                                <input type="checkbox" name="condition" id="agreement" class='Agree' required>
                                <label class="CON">I hereby declare that the information provided is true 
                                and correct to the best of my knowledge. I understand that providing false information may result 
                                in the rejection of this registration.</label>
                            </div>
                            <br>
                            <label>Registration Date</label>
                            <input type="text" name="registration_date" id="reg_date" class="date" readonly>
                            <br>
                            <div class="btn">
                                <button class="sign-btn next-btn">Next</button>
                            </div>
                        </div>
                        <div class="Account_Info" id="Section2">
                            <p class="tag">Account Info:</p>
                            <label>UserName/Email </label>
                            <br>
                            <input type="text" name="C_username" id="c_uname" placeholder="Email" required>
                            <br>
                            <label>Password </label>
                            <br>
                            <input type="password" name="C_password" id="c_pass" placeholder="Password" required>
                            <br>
                            <label>Re-Enter Password </label>
                            <br>
                            <input type="password" name="Csecure_pass" id="c_rpass" placeholder="Password" required>
                            <br>
                            <div class="btn2">
                                <button class="sign-btn2 back-btn2">Back</button>
                                <button class="sign-btn2 sub-btn2">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <script src="Script_ClientRegistration.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </body>
</html>
