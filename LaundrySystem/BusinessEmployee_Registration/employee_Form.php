<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <link rel="stylesheet" href="Style_EmployeeRegistration.css" type="text/css"/>
        <title>Employee Registration</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form action="Employee_Request.php" id="employee_form" method="post" enctype="multipart/form-data">
            <div class="Box">
                <div class="Container">
                    <div class="Form">
                        <div class="head">
                            <p><span class="header_name">Employee Registration</span></p>
                        </div>
                        <div class="Employee_Info" id="Section1">
                            <p class ="tag">Personal Information:</p>
                            <label>Profile </label>
                            <br><br>
                                <input type="file" name="Employee_File" id="F_Employee" accept="image/*">
                            <br>
                            <label>Name </label>
                            <br>
                            <input type="text" name="E_lname" id="lname" placeholder="Last Name" required>
                            <b>,</b>
                            <input type="text" name="E_fname" id="fname" placeholder="First Name" required>
                            <input type="text" name="E_mname" id="mname" placeholder="Middle Initial ex. Reyes (optional)">
                            <br>
                            <label>Birth Date </label>
                            <br>
                            <input type="date" name="EBday" required>
                            <br>
                            <label>Contact No. </label>
                            <br>
                            <input type="tel" name="E_contact" placeholder="Contact No." required>
                            <br>
                            <label>Email </label>
                            <br>
                            <input type="email" name="E_Email" placeholder="Email"  required>
                            <br>
                            <label>Address </label>
                            <br>
                            <input type="text" name="employee_add" placeholder="Address" class="Add" required>
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
                            <select name="brgy" id="e_brgy">
                                <option value="" disabled selected hidden>Barangay</option>

                                <!-- BRGY under chosen municipality -->

                            </select>
                            <br>
                            <label>Affiliated Laundry Shop </label>
                            <br>
                            <select name="LaundryShop" id="shop">
                                <option value="" disabled selected hidden>Shop</option>

                                <!-- Registered Shops via DB -->

                            </select>
                            <br>
                            <p class ="tag">Additional Information:</p>
                            <p>Fill and upload at least one of the following requirements ( <u>SSS required</u> ):</p>
                            <br>
                            <label>SSS Registration Number </label>
                            <br>
                            <input type="text" name="SSS" id="e_SSS" required>
                            <input type="file" name="SSS_File" id="F_SSS" accept="application/pdf">
                            <br>
                            <label>PhilHealth Registration Number </label>
                            <br>
                            <input type="text" name="PHealth" id="e_PHealth">
                            <input type="file" name="PHealth_File" id="F_PHealth" accept="application/pdf">
                            <br>
                            <label>Pag-IBIG Registration Number </label>
                            <br>
                            <input type="text" name="P_Ibig" id="e_PIbig">
                            <input type="file" name="PIbig_File" id="F_PIbig" accept="application/pdf">
                            <br><br>
                            <label>Declaration</label>
                            <br><br>
                            <div class="Rule">
                                <input type="checkbox" name="condition" id="agreement" class="Agree" required="">
                                <label class="CON">I hereby declare that the information provided is true 
                                and correct to the best of my knowledge. I understand that providing false information may result 
                                in the rejection of this registration.</label>
                            </div>
                            <br><br>
                            <label>Signature</label>
                            <br>
                            <input type="file" name="E_Sign" id="e_sign" accept="image/*,.pdf" required>
                            <br>
                            <label>Registration Date</label>
                            <input type="text" name="registration_date" id="reg_date" class="date" readonly>
                            <br>
                            <div class="btn">
                                <button class="sign-btn next-btn">Next</button>
                            </div>
                        </div>
                        <div class="Account_Info" id="Section2">
                            <p class="tag">Account Info</p>
                            <label>UserName/Email </label>
                            <br>
                            <input type="text" name="E_username" id="e_uname" placeholder="Email" required>
                            <br>
                            <label>Password </label>
                            <br>
                            <input type="password" name="E_password" id="e_pass" placeholder="Password" required>
                            <br>
                            <label>Re-Enter Password </label>
                            <br>
                            <input type="password" name="Esecure_pass" id="e_rpass" placeholder="Password" required>
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
        <script src="Script_EmployeeRegistration.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </body>
</html>
