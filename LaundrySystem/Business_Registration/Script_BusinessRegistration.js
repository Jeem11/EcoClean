/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */

document.addEventListener('DOMContentLoaded', function(){
    //Business Registration Form
    const B_form = document.getElementById('businessForm');
    
    //Section 1: class="business_infoSect" id ="Section1"
    const Business_info = document.getElementById('Section1');
    //Shop
    const ShopName = document.getElementById('b_name');
    //Business Owner Name:
    const Owner_lname = document.getElementById('lname');
    const Owner_fname = document.getElementById('fname');
    const Owner_mname = document.getElementById('mname');
    //Profile
    const Owner_pic = document.getElementById('F_Owner');
    const profileIcon = document.getElementById('uploadImage');
    const profilePreview = document.getElementById('profilePreview');
    //Business Address
    const Shop_Add = document.querySelector('[name="business_add"]');
    //Business Address City/Municipal Select
    const Shop_Muni = document.querySelector('[name="City"]');
    const Shop_Select = document.getElementById('city');
    //Business Address Barangay Select
    const Shop_Brgy = document.querySelector('[name="brgy"]');
    const Brgy_Select = document.getElementById('b_brgy');
    //Business Contact
    const B_contact = document.querySelector('[name="B_contact"]');
    const B_email = document.querySelector('[name="B_Email"]');
    //Button Section1:
    const next1 = document.querySelector('.next-btn');
    
    //Section 2: class="Additional_infoSect" id="Section2"
    const Additional_info = document.getElementById('Section2');
    //DTI No. + File
    const DTI_No = document.querySelector('[name="DTI"]');
    const DTI_File = document.getElementById('F_DTI');
    //TIN No. + File
    const TIN_No = document.querySelector('[name="TIN"]');
    const TIN_File = document.getElementById('F_TIN');
    //Business Logo
    const B_logo = document.getElementById('B_pic');
    const LogoIcon = document.getElementById('uploadFile');
    const LogoPreview = document.getElementById('LogoPreview');
    //Condition + Signature + Date
    const Agreement = document.getElementById('agreement');
    const Owner_Sign = document.getElementById('b_sign');
    const Sign_Date = document.querySelector('[name="registration_date"]');
    //Business Account Info
    const Business_usernm = document.querySelector('[name="B_username"]');
    const Business_userps = document.querySelector('[name="B_password"]');
    const Business_secps = document.querySelector('[name="Bsecure_pass"]');
    //Button Section2:
    const back2 = document.querySelector('.back-btn2');
    const sub2 = document.querySelector('.Reg-btn2');
    
    
    
    
    
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

    function displayLogoPicture(input, imgElement) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imgElement.src = e.target.result;
                imgElement.style.display = 'block';
                LogoIcon.style.display = 'none';
                
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
        Owner_pic.click();
    });
    
    Owner_pic.addEventListener('change', function() {
        const file = this.files[0];
        const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (validateFileType(file, validImageTypes)) {
            displayProfilePicture(this, profilePreview);
        } else {
            alert('Invalid file type. Please select a JPEG, PNG, or GIF image.');
        }
    });
    
    LogoIcon.addEventListener('click', function() {
        B_logo.click();
    });
    
    B_logo.addEventListener('change', function() {
        const file = this.files[0];
        const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (validateFileType(file, validImageTypes)) {
            displayLogoPicture(this, LogoPreview);
        } else {
            alert('Invalid file type. Please select a JPEG, PNG, or GIF image.');
        }
    });
    
    Owner_Sign.addEventListener('change', function() {
        const file = this.files[0];
        const maxFileSizeMB = 2; 
        const validFileTypes = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'];

        if (validateFileType(file, validFileTypes) && validateFileSize(file, maxFileSizeMB)) {
            setRegistrationDate();
        } else {
            let errorMessage = 'Invalid file. ';
            if (!validateFileType(file, validFileTypes)) {
                errorMessage += 'Please upload an image (JPEG, PNG, GIF) or a PDF file. ';
            }
            if (!validateFileSize(file, maxFileSizeMB)) {
                errorMessage += `File size should be less than ${maxFileSizeMB}MB.`;
            }
            alert(errorMessage);
        }
    });

    
    


    
    Shop_Select.addEventListener('change', function(){
        Brgy_Select.innerHTML = '';
        
        const placeholderOption = document.createElement('option');
        placeholderOption.disabled = true; 
        placeholderOption.selected = true;
        placeholderOption.textContent = 'Barangay';
        Brgy_Select.appendChild(placeholderOption);
        
        if (Shop_Select.value === 'Angono'){
            AddBrgy(['Bagumabayan', 'Kalayaan', 'Mahabang Parang', 'Poblacion Ibaba',
                'Poblacion Itaas', 'San Isidro', 'Santo Niño', 'San Pedro', 'San Roque', 
                'San Vicente']);
        }else if(Shop_Select.value === 'Antipolo'){
            AddBrgy(['Bagong Nayon', 'Beverly Hills', 'Calawis', 'Cupang', 'Dalig', 
                'Dela Paz', 'Inarawan', 'Mambugan', 'Mayamot', 'Muntingdilaw', 'San Isidro', 
                'San Jose', 'San Juan', 'San Luis', 'San Roque', 'Santa Cruz']);
        }else if(Shop_Select.value === 'Baras'){
            AddBrgy(['Conception', 'Evangelista', 'Mabini', 'Pinugay', 'Rizal', 'San Jose', 
                'San Juan', 'San Miguel', 'San Salvador', 'Santiago']);
        }else if(Shop_Select.value === 'Binangonan'){
            AddBrgy(['Bangad', 'Batingad', 'Bilibiran', 'Binitagan', 'Bombong', 'Buhangin', 
                'Calumpang', 'Ginoong Sanay', 'Gulod', 'Habatagan', 'Ithan', 'Janosa', 
                'Kalawaan', 'Kalinawan', 'Kasile', 'Kaytome', 'Kinaboogan', 'Kinagatan', 
                'Layuan', 'Libid', 'Libis', 'Limbon-limbon', 'Lunsad', 'Macamot', 'Mahabang Parang', 
                'Malakban', 'Mambog', 'Pag-asa', 'Palangoy', 'Pantok', 'Pila Pila', 'Pinagdilawan', 
                'Pipindan', 'Rayap', 'San Carlos', 'Sapang', 'Tabon', 'Tagpos', 'Tatala', 
                'Tayuman']);
        }else if(Shop_Select.value === 'Cainta'){
            AddBrgy(['San Andres', 'Sto. Domingo', 'San Isidro', 'San Juan', 'Sto. Niño', 
                'San Roque', 'Sta. Rosa']);
        }else if(Shop_Select.value === 'Cardona'){
            AddBrgy(['Balibago', 'Boor', 'Calahan', 'Dalig', 'Del Remedio', 'Iglesia', 
                'Lambac', 'Looc', 'Malanggam-Calubacan', 'Nagsulo', 'Navotas', 'Patunhay', 
                'Real', 'Sampad', 'San Roque', 'Subay', 'Ticulio', 'Tuna']);
        }else if(Shop_Select.value === 'Jalajala'){
            AddBrgy(['Bagumbong', 'Bayugo', 'Lubo', 'Paalaman', 'Pagkaliwanan', 'Palaypay', 
                'Punta', 'Second District', 'Sipsipin', 'Special District', 'Third District']);
        }else if(Shop_Select.value === 'Morong'){
            AddBrgy(['Bombongan', 'Can-Cal-Lan', 'Lagundi', 'Maybancal', 'San Guillermo', 
                'San Jose', 'San Juan', 'San Pedro']);
        }else if(Shop_Select.value === 'Pililla'){
            AddBrgy(['Bagumbayan', 'Halayhayin', 'Hulo', 'Imatong', 'Malaya', 'Niogan', 
                'Quisao', 'Takungan', 'Wawa']);
        }else if(Shop_Select.value === 'Rodriguez'){
            AddBrgy(['Balite', 'Burgos', 'Geronimo', 'Macabud', 'Manggahan', 'Mascap', 'Puray', 
                'Rosario', 'San Isidro', 'San Jose', 'San Rafael']);
        }else if(Shop_Select.value === 'San Mateo'){
            AddBrgy(['Ampid I', 'Ampid II', 'Banaba', 'Dulong Bayan 1', 'Dulong Bayan 2', 
                'Guinayang', 'Guitnang Bayan I', 'Guitnang Bayan II', 'Gulod Malaya', 'Malanday', 
                'Maly', 'Pintong Bocawe', 'Santa Ana', 'Santo Niño', 'Silangan']);
        }else if(Shop_Select.value === 'Tanay'){
            AddBrgy(['Cayabu', 'Cayumbay', 'Daraitan', 'Katipunan-Bayan', 'Kaybuto', 'Laiban', 
                'Magdilay-dilay', 'Mag-Ampon', 'Mamuyao', 'Pinagkamaligan', 'Plaza Aldea', 'Sampaloc', 
                'San Andres', 'San Isidro', 'Santa Inez', 'Santo Niño', 'Tabing Ilog', 'Tandang Kuyo', 
                'Tinucan', 'Wawa']);
        }else if(Shop_Select.value === 'Taytay'){
            AddBrgy(['Dolores', 'Muzon', 'San Isidro', 'San Juan', 'Santa Ana']);
        }else if(Shop_Select.value === 'Teresa'){
            AddBrgy(['Bagumbayan', 'Calumpang Santo Cristo', 'Dalig', 'Dulumbayan', 'May-iba', 
                'Poblacion', 'Prinza', 'San Gabriel', 'San Roque']);
        }
    });
    
    Owner_pic.addEventListener('change', function() {
        const file = this.files[0];
        const validImageTypes = ['image/jpeg', 'image/png'];
        if (validateFileType(file, validImageTypes)) {
            displayProfilePicture(this, document.getElementById('profilePreview'));
        } else {
            alert('Invalid file type. Please select a JPEG or PNG image.');
        }
    });
    
    B_logo.addEventListener('change', function() {
        const file = this.files[0];
        const validImageTypes = ['image/jpeg', 'image/png'];
        if (validateFileType(file, validImageTypes)) {
            displayLogoPicture(this, document.getElementById('LogoPreview'));
        } else {
            alert('Invalid file type. Please select a JPEG or PNG image.');
        }
    });
    
    next1.addEventListener('click', function(){
        event.preventDefault();
        const selected_ct = Shop_Muni.value;
        const selected_brgy = Shop_Brgy.value;
        let valid = false;
        
        if(Owner_lname.value === '' || !validateName(Owner_lname.value) ||
           Owner_fname.value === '' || !validateName(Owner_fname.value) ||
           (Owner_mname.value !== '' && !validateName(Owner_mname.value)) ||
           !Owner_pic.files || Owner_pic.files.length === 0 || !validateFileSize(Owner_pic.files[0], 2) ||
           !validateFileType(Owner_pic.files[0], ['image/jpeg', 'image/png', 'image/gif']) ||
           Shop_Add.value === '' || ShopName.value === '' ||
           selected_ct === null || selected_ct === '' ||
           selected_brgy === null || selected_brgy === '' || selected_brgy === 'Barangay' ||
           B_contact.value === '' || !validateNo(B_contact.value) ||
           B_email.value === '' || !validateEmail(B_email.value)){
       
       
           alert('Please complete the required fields with correct credentials.');
       
           if(ShopName.value === ''){
               ShopName.classList.add('invalid-input');
           }else{
               ShopName.classList.remove('invalid-input');
           }
       
           if(Owner_lname.value === '' || !validateName(Owner_lname.value)){
               Owner_lname.classList.add('invalid-input');
           }else{
               Owner_lname.classList.remove('invalid-input');
           }
           
           if(Owner_fname.value === '' || !validateName(Owner_fname.value)){
               Owner_fname.classList.add('invalid-input');
           }else{
               Owner_fname.classList.remove('invalid-input');
           }
           
           if(!validateName(Owner_mname.value)){
               Owner_mname.classList.add('invalid-input');
               if(Owner_mname.value === ''){
                    Owner_mname.classList.remove('invalid-input');
               }
           }else{
               Owner_mname.classList.remove('invalid-input');
           }
           
           if(!Owner_pic.files || Owner_pic.files.length === 0) {
                profileIcon.classList.add('invalid-input');
           }else{
                const file = Owner_pic.files[0];
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
           
           if(Shop_Add.value === ''){
               Shop_Add.classList.add('invalid-input');
           }else{
               Shop_Add.classList.remove('invalid-input');
           }
           
           if(selected_ct === null || selected_ct === ''){
               Shop_Muni.classList.add('invalid-input');
           }else{
               Shop_Muni.classList.remove('invalid-input');
           }
           
           if(selected_brgy === null || selected_brgy === '' || selected_brgy === 'Barangay'){
               Shop_Brgy.classList.add('invalid-input');
           }else{
               Shop_Brgy.classList.remove('invalid-input');
           }
           
           if(B_contact.value === '' || !validateNo(B_contact.value)){
               B_contact.classList.add('invalid-input');
           }else{
               B_contact.classList.remove('invalid-input');
           }
           
           if(B_email.value === '' || !validateEmail(B_email.value)){
               B_email.classList.add('invalid-input');
           }else{
               B_email.classList.remove('invalid-input');
           }
           console.log(valid);
           console.log("Incomplete credentials");
        }else{
            valid = true; //this one might change
        }
        
        if(valid){
            $.ajax({
                type: 'POST',
                url: 'BusinessVerifier.php',
                data:{
                    business_name: ShopName.value
                },
                success: function(response){
                    console.log('AJAX success. Response:'. response);
                    if(response === "exists"){
                        ShopName.classList.add('invalid-input');

                        alert('Business Name already exists.');
                        valid = false;
                    }else if(response === "not_exists"){
                        ShopName.classList.remove('invalid-input');
                    }


                    if(valid){
                        resetOutlineColor(ShopName, Owner_lname, Owner_fname, Owner_mname, profileIcon,
                            Shop_Add, Shop_Muni, Shop_Brgy, B_contact, B_email);
                        
                        
                        Business_info.style.display = 'none';
                        Additional_info.style.display = 'block';
                    }
                },
                error: function(){
                    console.log('AJAX error');
                    alert('Error connecting to BusinessVerifier');
                }
            });
        }
   
        //Final Condition to process to the next section
        
        
    });
    
    back2.addEventListener('click', function(){
        event.preventDefault();
        Additional_info.style.display = 'none';
        Business_info.style.display = 'block';
    });
    
    console.log('DTI_File:', DTI_File);
    console.log('TIN_File:', TIN_File);
    console.log('B_logo:', B_logo);
    console.log('Agreement:', Agreement);
    console.log('Owner_Sign:', Owner_Sign);
    
    sub2.addEventListener('click', function(){
        event.preventDefault();
        let valid2 = false;
        
        if(DTI_No.value === '' || TIN_No.value === '' ||
           !DTI_File.files || DTI_File.files.length === 0 || !validateFileSize(DTI_File.files[0], 2) || 
           !validateFileType(DTI_File.files[0], ['application/pdf']) ||
           !TIN_File.files || TIN_File.files.length === 0 || !validateFileSize(TIN_File.files[0], 2) ||
           !validateFileType(TIN_File.files[0], ['application/pdf']) ||
           !B_logo.files || B_logo.files.length === 0 || !validateFileSize(B_logo.files[0], 2) ||
           !validateFileType(B_logo.files[0], ['image/jpeg', 'image/png', 'image/gif']) ||
           !Agreement.checked ||
           !Owner_Sign.files || Owner_Sign.files.length === 0 || !validateFileSize(Owner_Sign.files[0], 2) ||
           !validateFileType(Owner_Sign.files[0], ['image/jpeg', 'image/png', 'image/gif', 'application/pdf']) ||
           Business_usernm.value === '' ||
           Business_userps.value === '' || Business_secps.value === '' ||
           (Business_userps.value !== Business_secps.value)){
            
            alert('Please complete the required fields with correct credentials.');
            
            if(DTI_No.value === ''){
                DTI_No.classList.add('invalid-input');
            }else{
                DTI_No.classList.remove('invalid-input');
            }
            
            if(TIN_No.value === ''){
                TIN_No.classList.add('invalid-input');
            }else{
                TIN_No.classList.remove('invalid-input');
            }
            
            if(!DTI_File.files || DTI_File.files.length === 0) {
                DTI_File.classList.add('invalid-input');
            }else{
                const file = DTI_File.files[0];
                if(!validateFileSize(file, 2)) {
                    DTI_File.classList.add('invalid-input');
                    alert('Please enter a valid PDF file that is less than 2MB.');
                }else if(!validateFileType(file, ['application/pdf'])) {
                    DTI_File.classList.add('invalid-input');
                    alert('Please upload a PDF file.');
                }else{
                    DTI_File.classList.remove('invalid-input');
                }
            }
            
            if(!TIN_File.files || TIN_File.files.length === 0) {
                TIN_File.classList.add('invalid-input');
            }else{
                const file = TIN_File.files[0];
                if(!validateFileSize(file, 2)) {
                    TIN_File.classList.add('invalid-input');
                    alert('Please enter a valid PDF file that is less than 2MB.');
                }else if(!validateFileType(file, ['application/pdf'])) {
                    TIN_File.classList.add('invalid-input');
                    alert('Please upload a PDF file.');
                }else{
                    TIN_File.classList.remove('invalid-input');
                }
            }
            
            if (!B_logo.files || B_logo.files.length === 0) {
                LogoIcon.classList.add('invalid-input');
                alert('Please select a logo image file.');
            } else {
                const file = B_logo.files[0];
                if (!validateFileSize(file, 2)) {
                    LogoIcon.classList.add('invalid-input');
                    alert('Please enter a valid image file that is less than 2MB.');
                } else if (!validateFileType(file, ['image/jpeg', 'image/png', 'image/gif'])) {
                    LogoIcon.classList.add('invalid-input');
                    alert('Please upload an image file of type: JPEG, PNG, GIF.');
                } else {
                    LogoIcon.classList.remove('invalid-input');
                }
            }
            
            if(!Agreement.checked){
                Agreement.classList.add('invalid-input');
            }else{
                Agreement.classList.remove('invalid-input');
            }
            
            if(Business_usernm.value === ''){
                Business_usernm.classList.add('invalid-input');
            }else{
                Business_usernm.classList.remove('invalid-input');
            }
            
            if(Business_userps.value === ''){
                Business_userps.classList.add('invalid-input');
            }else{
                Business_userps.classList.remove('invalid-input');
            }
            
            if(Business_secps.value === '' || (Business_userps.value !== Business_secps.value)){
                Business_secps.classList.add('invalid-input');
                if(Business_userps.value !== Business_secps.value){
                    Business_secps.classList.add('invalid-input');
                }
            }else{
                Business_secps.classList.remove('invalid-input');
            }
            
            if(!Owner_Sign.files || Owner_Sign.files.length === 0) {
                Owner_Sign.classList.add('invalid-input');
            }else{
                const file = Owner_Sign.files[0];
                if(!validateFileSize(file, 2)) {
                    Owner_Sign.classList.add('invalid-input');
                    alert('Please enter a valid image file that is less than 2MB.');
                }else if(!validateFileType(file, ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'])) {
                    Owner_Sign.classList.add('invalid-input');
                    alert('Please upload an image file of type: JPEG, PNG, GIF.');
                }else{
                    setRegistrationDate();
                    Owner_Sign.classList.remove('invalid-input');
                }
            }
            
        }else{
            valid2 = true;//this one might change
        }
        
        //Final Condition to process to submit
        if(valid2){
            resetOutlineColor(DTI_No, DTI_File, TIN_No, TIN_File, LogoIcon, Agreement,
            Owner_Sign, Sign_Date, Business_usernm, Business_userps, Business_secps);
            setRegistrationDate();
            const confirmation = confirm("Send Request?");
            event.preventDefault();

            if(confirmation){
                const businessData = new FormData(B_form);

                $.ajax({
                    type: 'POST',
                    url: 'Business_Request.php',
                    data: businessData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response){
                        console.log('AJAX success. Response:', response);
                        if(response.status === 'success'){
                            alert(response.message);
                            B_form.reset();
                            window.location.href = 'business_Form.php'; //will change, this is just for the sake of testing
                            const shopID = response.ShopID;
                            console.log('ShopID:', shopID);
                        }else{
                            alert(response.message);
                            console.error('Server returned error status:', response.status);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        console.error('AJAX error. Status:', textStatus, 'Error:', errorThrown);
                        alert('An error occurred while processing your request.');
                    }
                });
            }
        }else if(!valid2){
            alert('Please complete the required fields with correct credentials.');
        }else{
            B_form.reset();
        }
        
    });
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
});