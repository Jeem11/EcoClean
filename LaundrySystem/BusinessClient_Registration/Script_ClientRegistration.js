/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */

document.addEventListener('DOMContentLoaded', function(){
    //Client Registration Form
    const C_form = document.getElementById('client_form');
    
    //Section 1: class="Client_Info" id="Section1"
    const Client_info = document.getElementById('Section1');
    //Profile
    const Client_pic = document.getElementById('F_Client');
    const profileIcon = document.getElementById('uploadImage');
    const profilePreview = document.getElementById('profilePreview');
    //Employee Name:
    const Client_lname = document.getElementById('lname');
    const Client_fname = document.getElementById('fname');
    const Client_mname = document.getElementById('mname');
    //Client Contact
    const C_contact = document.querySelector('[name="C_contact"]');
    const C_email = document.querySelector('[name="C_Email"]');
    //Employee Address
    const Cli_Add = document.querySelector('[name="client_add"]');
    //Employee Address City/Municipal Select
    const Cli_Muni = document.querySelector('[name="City"]');
    const Cli_Select = document.getElementById('city');
    //Employee Address Barangay Select
    const Cli_Brgy = document.querySelector('[name="brgy"]');
    const Brgy_Select = document.getElementById('c_brgy');
    //Condition + Date
    const Agreement = document.getElementById('agreement');
    const Sign_Date = document.querySelector('[name="registration_date"]');
    //Button Section 1
    const next1 = document.querySelector('.next-btn');
    
    //Section 2: class="Account_Info" id="Section2"
    const Account_info = document.getElementById('Section2');
    //Client Account Info
    const Client_usernm = document.querySelector('[name="C_username"]');
    const Client_userps = document.querySelector('[name="C_password"]');
    const Client_secps = document.querySelector('[name="Csecure_pass"]');
    //Button Section2
    const back2 = document.querySelector('.back-btn2');
    const sub2 = document.querySelector('.sub-btn2');
    
    
    
    
    
    //Functions
    function validateName(input){
        const name = /^[A-Za-z\s]+$/;
        return name.test(input);
    }
    
    function validateNo(input){
        const mobileNo = /^(09|\+639)\d{9}$/;
        return mobileNo.test(input);
    }
    
    function validateEmail(email){
        const emailPattern =  /^[^\s@]+@[^\s@]+\.[^\s@]+$/s;
        return emailPattern.test(email);
    }
    
    function resetOutlineColor(...fields){
        fields.forEach(field => {
            console.log(field);
            field.classList.remove('invalid-input');
        });
    }
    
    function AddBrgy(values) {
        console.log('Adding options:', values);
        values.forEach(value => {
            const option = document.createElement('option');
            option.value = value;
            option.textContent = value;
            Brgy_Select.appendChild(option);
        });
    }
    
    function validateFileSize(file, maxSizeMB) {
        const maxSizeBytes = maxSizeMB * 1024 * 1024; 
        return file.size <= maxSizeBytes;
    }

    function validateFileType(file, validTypes) {
        if (!file || !file.type) {
            return false;
        }
        return validTypes.includes(file.type);
    }
    
    function displayProfilePicture(input, imgElement) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imgElement.src = e.target.result;
                imgElement.style.display = 'block';
                profileIcon.style.display = 'none';
                
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    
    function setRegistrationDate() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); 
        var yyyy = today.getFullYear();

        var formattedDate = mm + '/' + dd + '/' + yyyy;
        
        Sign_Date.value = formattedDate;
    }
    
    
    
    
    
    //Event Listeners
    profileIcon.addEventListener('click', function() {
        Client_pic.click();
    });

    Client_pic.addEventListener('change', function() {
        const file = this.files[0];
        const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (validateFileType(file, validImageTypes)) {
            displayProfilePicture(this, profilePreview);
        } else {
            alert('Invalid file type. Please select a JPEG, PNG, or GIF image.');
        }
    });
    
    Agreement.addEventListener('change', function() {
        if (Agreement.checked) {
            setRegistrationDate();
        } else {
            Sign_Date.value = '';
        }
    });
    
    Cli_Select.addEventListener('change', function(){
        Brgy_Select.innerHTML = '';
        
        const placeholderOption = document.createElement('option');
        placeholderOption.disabled = true; 
        placeholderOption.selected = true;
        placeholderOption.textContent = 'Barangay';
        Brgy_Select.appendChild(placeholderOption);
        
        if (Cli_Select.value === 'Angono'){
            AddBrgy(['Bagumabayan', 'Kalayaan', 'Mahabang Parang', 'Poblacion Ibaba',
                'Poblacion Itaas', 'San Isidro', 'Santo Niño', 'San Pedro', 'San Roque', 
                'San Vicente']);
        }else if(Cli_Select.value === 'Antipolo'){
            AddBrgy(['Bagong Nayon', 'Beverly Hills', 'Calawis', 'Cupang', 'Dalig', 
                'Dela Paz', 'Inarawan', 'Mambugan', 'Mayamot', 'Muntingdilaw', 'San Isidro', 
                'San Jose', 'San Juan', 'San Luis', 'San Roque', 'Santa Cruz']);
        }else if(Cli_Select.value === 'Baras'){
            AddBrgy(['Conception', 'Evangelista', 'Mabini', 'Pinugay', 'Rizal', 'San Jose', 
                'San Juan', 'San Miguel', 'San Salvador', 'Santiago']);
        }else if(Cli_Select.value === 'Binangonan'){
            AddBrgy(['Bangad', 'Batingad', 'Bilibiran', 'Binitagan', 'Bombong', 'Buhangin', 
                'Calumpang', 'Ginoong Sanay', 'Gulod', 'Habatagan', 'Ithan', 'Janosa', 
                'Kalawaan', 'Kalinawan', 'Kasile', 'Kaytome', 'Kinaboogan', 'Kinagatan', 
                'Layuan', 'Libid', 'Libis', 'Limbon-limbon', 'Lunsad', 'Macamot', 'Mahabang Parang', 
                'Malakban', 'Mambog', 'Pag-asa', 'Palangoy', 'Pantok', 'Pila Pila', 'Pinagdilawan', 
                'Pipindan', 'Rayap', 'San Carlos', 'Sapang', 'Tabon', 'Tagpos', 'Tatala', 
                'Tayuman']);
        }else if(Cli_Select.value === 'Cainta'){
            AddBrgy(['San Andres', 'Sto. Domingo', 'San Isidro', 'San Juan', 'Sto. Niño', 
                'San Roque', 'Sta. Rosa']);
        }else if(Cli_Select.value === 'Cardona'){
            AddBrgy(['Balibago', 'Boor', 'Calahan', 'Dalig', 'Del Remedio', 'Iglesia', 
                'Lambac', 'Looc', 'Malanggam-Calubacan', 'Nagsulo', 'Navotas', 'Patunhay', 
                'Real', 'Sampad', 'San Roque', 'Subay', 'Ticulio', 'Tuna']);
        }else if(Cli_Select.value === 'Jalajala'){
            AddBrgy(['Bagumbong', 'Bayugo', 'Lubo', 'Paalaman', 'Pagkaliwanan', 'Palaypay', 
                'Punta', 'Second District', 'Sipsipin', 'Special District', 'Third District']);
        }else if(Cli_Select.value === 'Morong'){
            AddBrgy(['Bombongan', 'Can-Cal-Lan', 'Lagundi', 'Maybancal', 'San Guillermo', 
                'San Jose', 'San Juan', 'San Pedro']);
        }else if(Cli_Select.value === 'Pililla'){
            AddBrgy(['Bagumbayan', 'Halayhayin', 'Hulo', 'Imatong', 'Malaya', 'Niogan', 
                'Quisao', 'Takungan', 'Wawa']);
        }else if(Cli_Select.value === 'Rodriguez'){
            AddBrgy(['Balite', 'Burgos', 'Geronimo', 'Macabud', 'Manggahan', 'Mascap', 'Puray', 
                'Rosario', 'San Isidro', 'San Jose', 'San Rafael']);
        }else if(Cli_Select.value === 'San Mateo'){
            AddBrgy(['Ampid I', 'Ampid II', 'Banaba', 'Dulong Bayan 1', 'Dulong Bayan 2', 
                'Guinayang', 'Guitnang Bayan I', 'Guitnang Bayan II', 'Gulod Malaya', 'Malanday', 
                'Maly', 'Pintong Bocawe', 'Santa Ana', 'Santo Niño', 'Silangan']);
        }else if(Cli_Select.value === 'Tanay'){
            AddBrgy(['Cayabu', 'Cayumbay', 'Daraitan', 'Katipunan-Bayan', 'Kaybuto', 'Laiban', 
                'Magdilay-dilay', 'Mag-Ampon', 'Mamuyao', 'Pinagkamaligan', 'Plaza Aldea', 'Sampaloc', 
                'San Andres', 'San Isidro', 'Santa Inez', 'Santo Niño', 'Tabing Ilog', 'Tandang Kuyo', 
                'Tinucan', 'Wawa']);
        }else if(Cli_Select.value === 'Taytay'){
            AddBrgy(['Dolores', 'Muzon', 'San Isidro', 'San Juan', 'Santa Ana']);
        }else if(Cli_Select.value === 'Teresa'){
            AddBrgy(['Bagumbayan', 'Calumpang Santo Cristo', 'Dalig', 'Dulumbayan', 'May-iba', 
                'Poblacion', 'Prinza', 'San Gabriel', 'San Roque']);
        }
    });
    
    Client_pic.addEventListener('change', function() {
        const file = this.files[0];
        const validImageTypes = ['image/jpeg', 'image/png'];
        if (validateFileType(file, validImageTypes)) {
            displayProfilePicture(this, document.getElementById('profilePreview'));
        } else {
            alert('Invalid file type. Please select a JPEG or PNG image.');
        }
    });
    
    next1.addEventListener('click', function(){
        event.preventDefault();
        const selected_ct = Cli_Muni.value;
        const selected_brgy = Cli_Brgy.value;
        let valid = false;
        
        if(!Client_pic.files || Client_pic.files.length === 0 || !validateFileSize(Client_pic.files[0], 2) ||
           !validateFileType(Client_pic.files[0], ['image/jpeg', 'image/png', 'image/gif']) ||
           Client_lname.value === '' || !validateName(Client_lname.value) ||
           Client_fname.value === '' || !validateName(Client_fname.value) ||
           (Client_mname.value !== '' && !validateName(Client_mname.value)) ||
           C_contact.value === '' || !validateNo(C_contact.value) ||
           C_email.value === '' || !validateEmail(C_email.value) || 
           Cli_Add.value === '' ||
           selected_ct === null || selected_ct === '' ||
           selected_brgy === null || selected_brgy === '' || selected_brgy === 'Barangay' ||
           !Agreement.checked){
           
            alert('Please complete the required fields with correct credentials.');
            
            if(!Client_pic.files || Client_pic.files.length === 0) {
                profileIcon.classList.add('invalid-input');
            }else{
                const file = Client_pic.files[0];
                if(!validateFileSize(file, 2)) {
                    profileIcon.classList.add('invalid-input');
                    alert('Please enter a valid image file that is less than 2MB.');
                }else if(!validateFileType(file, ['image/jpeg', 'image/png', 'image/gif'])) {
                    profileIcon.classList.add('invalid-input');
                    alert('Please upload an image file of type: JPEG, PNG, GIF.');
                }else{
                    profileIcon.classList.remove('invalid-input');
                }
            }
            
            if(Client_lname.value === '' || !validateName(Client_lname.value)){
               Client_lname.classList.add('invalid-input');
            }else{
               Client_lname.classList.remove('invalid-input');
            }
            
            if(Client_fname.value === '' || !validateName(Client_fname.value)){
               Client_fname.classList.add('invalid-input');
            }else{
               Client_fname.classList.remove('invalid-input');
            }
            
            if(!validateName(Client_mname.value)){
                Client_mname.classList.add('invalid-input');
                if(Client_mname.value === ''){
                    Client_mname.classList.remove('invalid-input');
                }
            }else{
                Client_mname.classList.remove('invalid-input');
            }
            
            if(C_contact.value === '' || !validateNo(C_contact.value)){
                C_contact.classList.add('invalid-input');
            }else{
                C_contact.classList.remove('invalid-input');
            }
           
            if(C_email.value === '' || !validateEmail(C_email.value)){
                C_email.classList.add('invalid-input');
            }else{
                C_email.classList.remove('invalid-input');
            }   
            
            
            if(selected_ct === null || selected_ct === ''){
                Cli_Muni.classList.add('invalid-input');
            }else{
                Cli_Muni.classList.remove('invalid-input');
            }
            
            if(Cli_Add.value === ''){
                Cli_Add.classList.add('invalid-input');
            }else{
                Cli_Add.classList.remove('invalid-input');
            }
           
            if(selected_brgy === null || selected_brgy === '' || selected_brgy === 'Barangay'){
                Cli_Brgy.classList.add('invalid-input');
            }else{
                Cli_Brgy.classList.remove('invalid-input');
            }
            
            if(!Agreement.checked){
                Agreement.classList.add('invalid-input');
            }else{
                Agreement.classList.remove('invalid-input');
            }
            
        }else{
            valid = true;
        }
        
        if(valid){
            $.ajax({
                type: 'POST',
                url: 'UserVerifier.php',
                data:{
                    C_lname: Client_lname.value,
                    C_fname: Client_fname.value,
                    C_mname: Client_mname.value,
                    C_Email: C_email.value
                },
                success: function (response){
                    console.log('AJAX success. Response:', response);
                    if(response === 'exists'){
                        Client_lname.classList.add('invalid-input');
                        Client_fname.classList.add('invalid-input');
                        C_email.classList.add('invalid-input');

                        if(Client_mname.value !== ''){
                            Client_mname.classList.add('invalid-input');
                        }

                        alert('User or Email already exists. Please check your information');
                        valid = false;
                    }else if(response === 'not_exists'){
                        Client_lname.classList.remove('invalid-input');
                        Client_fname.classList.remove('invalid-input');
                        C_email.classList.remove('invalid-input');

                        if(Client_mname.value !== ''){
                            Client_mname.classList.remove('invalid-input');
                        }
                    }

                    if(valid){
                        resetOutlineColor(Client_pic, Client_lname, Client_fname, Client_mname, C_contact,
                        C_email, Cli_Add, Cli_Muni, Cli_Brgy, Agreement);

                        Client_info.style.display = 'none';
                        Account_info.style.display = 'block';
                    }
                },
                error: function (){
                    console.log('AJAX error');
                    alert('Error connecting to UserVerifier.php');
                }
            });
    }
    });
    
    back2.addEventListener('click', function(){
        event.preventDefault();
        Account_info.style.display = 'none';
        Client_info.style.display = 'block';
    });
    
    sub2.addEventListener('click', function(){
       event.preventDefault();
       let valid2 = false;
       
       if(Client_usernm.value === '' || Client_userps.value === '' || Client_secps.value === '' ||
         (Client_userps.value !== Client_secps.value)){
            
            alert('Please complete the required fields.');
            
            if(Client_usernm.value === ''){
                Client_usernm.classList.add('invalid-input');
            }else{
                Client_usernm.classList.remove('invalid-input');
            }
            
            if(Client_userps.value === ''){
                Client_userps.classList.add('invalid-input');
            }else{
                Client_userps.classList.remove('invalid-input');
            }
            
            if(Client_secps.value === '' || (Client_userps.value !== Client_secps.value)){
                Client_secps.classList.add('invalid-input');
                if(Client_userps.value !== Client_secps.value){
                    Client_secps.classList.add('invalid-input');
                }
            }else{
                Client_secps.classList.remove('invalid-input');
            }
        }else{
            valid2 = true;
        }
       
        if (valid2){
            resetOutlineColor(Client_usernm, Client_userps, Client_secps);
            const confirmation = confirm("Send Request?");
            event.preventDefault();

            if (confirmation){
                const clientData = new FormData(C_form);

                $.ajax({
                    type: 'POST',
                    url: 'User_Request.php',
                    data: clientData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log('AJAX success. Response:', response);
                        if (response.status === 'success') {
                            alert(response.message);
                            C_form.reset();
                            window.location.href = 'client_Form.php'; // Change as needed
                            const userID = response.UserID;
                            console.log('UserID:', userID);
                        } else {
                            alert(response.message);
                            console.error('AJAX error. Response:', response);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX error. Status:', textStatus, 'Error:', errorThrown);
                        alert('An error occurred while processing your request.');
                    }
                });

            }else if(!valid2){
                alert('Please complete the required fields with correct credentials.');
            } else {
                C_form.reset();
            }
        }
    });
    
 });
