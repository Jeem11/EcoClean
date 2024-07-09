<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <link rel="stylesheet" href="Style_BusinessRegistration.css" type="text/css"/>
        <title>Business Registration</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form action="Business_Request.php" id="businessForm" method="post" enctype="multipart/form-data">
            <div class="Box">
                <div class="Container">
                    <div class="Form">
                        <div class="head">
                            <p><span class="header_name">Business Registration</span></p>
                        </div>
                        <div class="business_infoSect" id ="Section1">
                            <p class ="tag">Business Information:</p>
                            <label>Laundry Shop Name</label>
                            <br>
                            <input type="text" name="business_name" id="b_name" required>
                            <br>
                            <label>Business Owner</label>
                            <br>
                            <input type="text" name="b_lname" id="lname" placeholder="Last Name" required>
                            <b>,</b>
                            <input type="text" name="b_fname" id="fname" placeholder="First Name" required>
                            <input type="text" name="b_mname" id="mname" placeholder="Middle Initial ex. Reyes (optional)">
                            <br>
                            <label>Profile</label>
                            <br>
                                <input type="file" name="Owner_File" id="F_Owner" accept="image/*" class="file-input">
                            <br>
                            <label>Business Address</label>
                            <br>
                            <input type="text" name="business_add" placeholder="Address" class="Add" required>
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
                            <select name="brgy" id="b_brgy">
                                <option value="" disabled selected hidden>Barangay</option>

                                <!-- BRGY under chosen municipality -->

                            </select>
                            <br>
                            <label>Business Contact No. </label>
                            <br>
                            <input type="tel" name="B_contact" placeholder="Business Tel no." required>
                            <br>
                            <label>Business Email Address </label>
                            <br>
                            <input type="email" name="B_Email" placeholder="Business Email" required>
                            <br>
                            <div class="btn">
                                <button class="sign-btn next-btn">Next</button>
                            </div>
                        </div>
                        <div class="Additional_infoSect" id="Section2">
                            <p class ="tag">Additional Business Information</p> 
                            <label>DTI Business Registration Number </label>
                            <br>
                            <input type="text" name="DTI" id="b_DTI" required>
                            <input type="file" name="DTI_File" id="F_DTI" accept="application/pdf" class="file-input">
                            <br>
                            <label>Tax Identification Number (TIN) </label>
                            <br>
                            <input type="text" name="TIN" id="b_TIN" required>
                            <input type="file" name="TIN_File" id="F_TIN" accept="application/pdf" class="file-input">
                            <br>
                            <label>Business Logo </label>
                            <br><br>
                                <input type="file" name="B_logo" id="B_pic" accept="image/*" class="file-input">
                            <br>
                            <p class="tag">Account Info</p>
                            <label>UserName/Email </label>
                            <br>
                            <input type="text" name="B_username" id="b_uname" placeholder="Email" required>
                            <br>
                            <label>Password </label>
                            <br>
                            <input type="password" name="B_password" id="b_pass" placeholder="Password" required>
                            <br>
                            <label>Re-Enter Password </label>
                            <br>
                            <input type="password" name="Bsecure_pass" id="b_rpass" placeholder="Password" required>
                            <br><br>
                            <label>Declaration</label>
                            <br><br>
                            <div class="Rule">
                                <input type="checkbox" name="condition" id="agreement" class="Agree" required>
                                <label class="CON">I hereby declare that the information provided is true 
                                and correct to the best of my knowledge. I understand that providing false information may result 
                                in the rejection of this registration.</label>
                            </div>
                            <br>
                            <label>Signature</label>
                            <br>
                            <input type="file" name="B_Sign" id="b_sign" accept="image/*,.pdf" class="file-input">
                            <br>
                            <label>Registration Date</label>
                            <input type="text" name="registration_date" id="reg_date" class="date" readonly>
                            <div class="btn2">
                                <button class="sign-btn2 back-btn2">Back</button>
                                <button class="sign-btn2 Reg-btn2">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </form>
        <script src="Script_BusinessRegistration.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </body>
</html>
