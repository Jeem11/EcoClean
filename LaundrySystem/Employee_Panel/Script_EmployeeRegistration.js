/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */

document.addEventListener('DOMContentLoaded', function(){
    //Employee Registration Form
    const E_form = document.getElementById('employee_form');
    
    //Section1: class="Employee_Info" id="Section1"
    const Employee_info = document.getElementById('Section1');
    //Profile
    const Employee_pic = document.getElementById('F_Employee');
    //Employee Name:
    const Employee_lname = document.getElementById('lname');
    const Employee_fname = document.getElementById('fname');
    const Employee_mname = document.getElementById('mname');
    //Birthday
    const Employee_bday = document.querySelector('[name="EBday"]');
    //Employee Contact
    const E_contact = document.querySelector('[name="E_contact"]');
    const E_email = document.querySelector('[name="E_Email"]');
    //Employee Address
    const Emp_Add = document.querySelector('[name="employee_add"]');
    //Employee Address City/Municipal Select
    const Emp_Muni = document.querySelector('[name="City"]');
    const Emp_Select = document.getElementById('city');
    //Employee Address Barangay Select
    const Emp_Brgy = document.querySelector('[name="brgy"]');
    const Brgy_Select = document.getElementById('e_brgy');
    //Affiliated Laundry Shop
    const Job_shop = document.querySelector('[name="LaundryShop"]');
    const Job_select = document.getElementById('shop');
    //Requirements
    //SSS No. + File
    const SSS_No = document.querySelector('[name="SSS"]');
    const SSS_File = document.getElementById('F_SSS');
    //PhilHealth No. + File
    const PhilH_No = document.querySelector('[name="PHealth"]');
    const PhilH_File = document.getElementById('F_PHealth');
    //Pag-IBIG No. + File
    const PIbig_No = document.querySelector('[name="P_Ibig"]');
    const PIbig_File = document.getElementById('F_PIbig');
    //Condition + Sign + Date
    const Agreement = document.getElementById('agreement');
    const Emp_Sign = document.getElementById('e_sign');
    const Sign_Date = document.querySelector('[name="registration_date"]');
    //Button Section1:
    const next1 = document.querySelector('.next-btn');
    
    //Section 2: class="Account_Info" id="Section2"
    const Account_info = document.getElementById('Section2');
    //Employee Account Info
    const Employee_usernm = document.querySelector('[name="E_username"]');
    const Employee_userps = document.querySelector('[name="E_password"]');
    const Employee_secps = document.querySelector('[name="Esecure_pass"]');
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
    
    function setRegistrationDate() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); 
        var yyyy = today.getFullYear();

        var formattedDate = mm + '/' + dd + '/' + yyyy;
        
        Sign_Date.value = formattedDate;
    }
    
    function validateAge(birthdate){
        const today = new Date();
        const dob = new Date(birthdate);
        const age = today.getFullYear() - dob.getFullYear();
        const monthDiff = today.getMonth() - dob.getMonth();
    
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
            return age - 1;
        }
        return age;
    }

    function fetchLaundryShops() {
        const brgyValue = Brgy_Select.value;
        const cityValue = Emp_Select.value;
    
        const url = `fetch_shop.php?brgy=${encodeURIComponent(brgyValue)}&job=${encodeURIComponent(cityValue)}`;
    
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Fetched data:', data);
                Job_select.innerHTML = '';

                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = 'Shop';
                defaultOption.disabled = true;
                defaultOption.selected = true;
                Job_select.appendChild(defaultOption);

                data.forEach(shop => {
                    const option = document.createElement('option');
                    option.value = shop;
                    option.textContent = shop;
                    Job_select.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching laundry shops:', error);
                alert('Error fetching laundry shops. Please try again later.');
            });
    }

    function clearJobSelect() {
        Job_select.innerHTML = '';
        const defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.textContent = 'Shop';
        defaultOption.disabled = true;
        defaultOption.selected = true;
        Job_select.appendChild(defaultOption);
    }
    
    
    

    
    
    
    
    
    
    //Event Listeners
    
    Emp_Sign.addEventListener('change', function() {
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
    
    
    
    
    
    Emp_Select.addEventListener('change', function(){
        clearJobSelect();
        Brgy_Select.innerHTML = '';
        
        const placeholderOption = document.createElement('option');
        placeholderOption.disabled = true; 
        placeholderOption.selected = true;
        placeholderOption.textContent = 'Barangay';
        Brgy_Select.appendChild(placeholderOption);
        
        if (Emp_Select.value === 'Angono'){
            AddBrgy(['Bagumabayan', 'Kalayaan', 'Mahabang Parang', 'Poblacion Ibaba',
                'Poblacion Itaas', 'San Isidro', 'Santo Niño', 'San Pedro', 'San Roque', 
                'San Vicente']);
        }else if(Emp_Select.value === 'Antipolo'){
            AddBrgy(['Bagong Nayon', 'Beverly Hills', 'Calawis', 'Cupang', 'Dalig', 
                'Dela Paz', 'Inarawan', 'Mambugan', 'Mayamot', 'Muntingdilaw', 'San Isidro', 
                'San Jose', 'San Juan', 'San Luis', 'San Roque', 'Santa Cruz']);
        }else if(Emp_Select.value === 'Baras'){
            AddBrgy(['Conception', 'Evangelista', 'Mabini', 'Pinugay', 'Rizal', 'San Jose', 
                'San Juan', 'San Miguel', 'San Salvador', 'Santiago']);
        }else if(Emp_Select.value === 'Binangonan'){
            AddBrgy(['Bangad', 'Batingad', 'Bilibiran', 'Binitagan', 'Bombong', 'Buhangin', 
                'Calumpang', 'Ginoong Sanay', 'Gulod', 'Habatagan', 'Ithan', 'Janosa', 
                'Kalawaan', 'Kalinawan', 'Kasile', 'Kaytome', 'Kinaboogan', 'Kinagatan', 
                'Layuan', 'Libid', 'Libis', 'Limbon-limbon', 'Lunsad', 'Macamot', 'Mahabang Parang', 
                'Malakban', 'Mambog', 'Pag-asa', 'Palangoy', 'Pantok', 'Pila Pila', 'Pinagdilawan', 
                'Pipindan', 'Rayap', 'San Carlos', 'Sapang', 'Tabon', 'Tagpos', 'Tatala', 
                'Tayuman']);
        }else if(Emp_Select.value === 'Cainta'){
            AddBrgy(['San Andres', 'Sto. Domingo', 'San Isidro', 'San Juan', 'Sto. Niño', 
                'San Roque', 'Sta. Rosa']);
        }else if(Emp_Select.value === 'Cardona'){
            AddBrgy(['Balibago', 'Boor', 'Calahan', 'Dalig', 'Del Remedio', 'Iglesia', 
                'Lambac', 'Looc', 'Malanggam-Calubacan', 'Nagsulo', 'Navotas', 'Patunhay', 
                'Real', 'Sampad', 'San Roque', 'Subay', 'Ticulio', 'Tuna']);
        }else if(Emp_Select.value === 'Jalajala'){
            AddBrgy(['Bagumbong', 'Bayugo', 'Lubo', 'Paalaman', 'Pagkaliwanan', 'Palaypay', 
                'Punta', 'Second District', 'Sipsipin', 'Special District', 'Third District']);
        }else if(Emp_Select.value === 'Morong'){
            AddBrgy(['Bombongan', 'Can-Cal-Lan', 'Lagundi', 'Maybancal', 'San Guillermo', 
                'San Jose', 'San Juan', 'San Pedro']);
        }else if(Emp_Select.value === 'Pililla'){
            AddBrgy(['Bagumbayan', 'Halayhayin', 'Hulo', 'Imatong', 'Malaya', 'Niogan', 
                'Quisao', 'Takungan', 'Wawa']);
        }else if(Emp_Select.value === 'Rodriguez'){
            AddBrgy(['Balite', 'Burgos', 'Geronimo', 'Macabud', 'Manggahan', 'Mascap', 'Puray', 
                'Rosario', 'San Isidro', 'San Jose', 'San Rafael']);
        }else if(Emp_Select.value === 'San Mateo'){
            AddBrgy(['Ampid I', 'Ampid II', 'Banaba', 'Dulong Bayan 1', 'Dulong Bayan 2', 
                'Guinayang', 'Guitnang Bayan I', 'Guitnang Bayan II', 'Gulod Malaya', 'Malanday', 
                'Maly', 'Pintong Bocawe', 'Santa Ana', 'Santo Niño', 'Silangan']);
        }else if(Emp_Select.value === 'Tanay'){
            AddBrgy(['Cayabu', 'Cayumbay', 'Daraitan', 'Katipunan-Bayan', 'Kaybuto', 'Laiban', 
                'Magdilay-dilay', 'Mag-Ampon', 'Mamuyao', 'Pinagkamaligan', 'Plaza Aldea', 'Sampaloc', 
                'San Andres', 'San Isidro', 'Santa Inez', 'Santo Niño', 'Tabing Ilog', 'Tandang Kuyo', 
                'Tinucan', 'Wawa']);
        }else if(Emp_Select.value === 'Taytay'){
            AddBrgy(['Dolores', 'Muzon', 'San Isidro', 'San Juan', 'Santa Ana']);
        }else if(Emp_Select.value === 'Teresa'){
            AddBrgy(['Bagumbayan', 'Calumpang Santo Cristo', 'Dalig', 'Dulumbayan', 'May-iba', 
                'Poblacion', 'Prinza', 'San Gabriel', 'San Roque']);
        }
    });

    Brgy_Select.addEventListener('change', function(){
        fetchLaundryShops();
        clearJobSelect();
    });
    
    Employee_pic.addEventListener('change', function() {
        const file = this.files[0];
        const validImageTypes = ['image/jpeg', 'image/png'];
        if (validateFileType(file, validImageTypes)) {
            console.log('Profile Accepted');
        } else {
            alert('Invalid file type. Please select a JPEG or PNG image.');
        }
    });
    
    next1.addEventListener('click', function(){
        event.preventDefault();
        const selected_ct = Emp_Muni.value;
        const selected_brgy = Emp_Brgy.value;
        const selected_shop = Job_shop.value;
        
        const philHealthNo = PhilH_No.value;
        const philHealthFileInput = document.getElementById('F_PHealth');
        
        const PIbigNo = PIbig_No.value;
        const PIbigFileInput = document.getElementById('F_PIbig');
        
        const age = validateAge(Employee_bday.value);
        let valid = false;
        
        if(Employee_lname.value === '' || !validateName(Employee_lname.value) ||
           Employee_fname.value === '' || !validateName(Employee_fname.value) ||
           (Employee_mname.value !== '' && !validateName(Employee_mname.value)) ||
           !Employee_pic.files || Employee_pic.files.length === 0 || !validateFileSize(Employee_pic.files[0], 2) ||
           !validateFileType(Employee_pic.files[0], ['image/jpeg', 'image/png', 'image/gif']) ||
           selected_ct === null || selected_ct === '' ||
           selected_brgy === null || selected_brgy === '' || selected_brgy === 'Barangay' ||
           selected_shop === null || selected_shop === '' || selected_shop === 'Shop' ||
           E_contact.value === '' || !validateNo(E_contact.value) ||
           E_email.value === '' || !validateEmail(E_email.value) || 
           //Extra Condition for the shop affiliation (To update from DB) insert here
           SSS_No.value === '' || SSS_File.files.length === 0 || !validateFileSize(SSS_File.files[0], 2) ||
           (PhilH_No.value !== '' && (PhilH_File.files.length === 0 || !validateFileSize(PhilH_File.files[0], 2))) ||
           (PIbig_No.value !== '' && (PIbig_File.files.length === 0 || !validateFileSize(PIbig_File.files[0], 2))) ||
           !Agreement.checked || Employee_bday.value === '' || 
           !Emp_Sign.files || Emp_Sign.files.length === 0 || !validateFileSize(Emp_Sign.files[0], 2) ||
           !validateFileType(Emp_Sign.files[0], ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'])){
               
            alert('Please complete the required fields with correct credentials.');
            
            if(!Employee_pic.files || Employee_pic.files.length === 0) {
                Employee_pic.classList.add('invalid-input');
            }else{
                const file = Employee_pic.files[0];
                if(!validateFileSize(file, 2)) {
                    Employee_pic.classList.add('invalid-input');
                    alert('Please enter a valid image file that is less than 2MB.');
                }else if(!validateFileType(file, ['image/jpeg', 'image/png', 'image/gif'])) {
                    Employee_pic.classList.add('invalid-input');
                    alert('Please upload an image file of type: JPEG, PNG, GIF.');
                }else{
                    Employee_pic.classList.remove('invalid-input');
                }
            }
            
            if(Employee_lname.value === '' || !validateName(Employee_lname.value)){
               Employee_lname.classList.add('invalid-input');
            }else{
               Employee_lname.classList.remove('invalid-input');
            }
            
            if(Employee_fname.value === '' || !validateName(Employee_fname.value)){
               Employee_fname.classList.add('invalid-input');
            }else{
               Employee_fname.classList.remove('invalid-input');
            }
            
            if(!validateName(Employee_mname.value)){
                Employee_mname.classList.add('invalid-input');
                if(Employee_mname.value === ''){
                    Employee_mname.classList.remove('invalid-input');
                }
            }else{
                Employee_mname.classList.remove('invalid-input');
            }
            
            if(Employee_bday.value === '' || age < 18){
                Employee_bday.classList.add('invalid-input');
            }
            
            if(selected_ct === null || selected_ct === ''){
                Emp_Muni.classList.add('invalid-input');
            }else{
                Emp_Muni.classList.remove('invalid-input');
            }
            
            if(Emp_Add.value === ''){
                Emp_Add.classList.add('invalid-input');
            }else{
                Emp_Add.classList.remove('invalid-input');
            }
           
            if(selected_brgy === null || selected_brgy === '' || selected_brgy === 'Barangay'){
                Emp_Brgy.classList.add('invalid-input');
            }else{
                Emp_Brgy.classList.remove('invalid-input');
            }

            if(selected_shop === null || selected_shop === '' || selected_shop === 'Shop'){
                Job_shop.classList.add('invalid-input');
            }else{
                Job_shop.classList.remove('invalid-input');
            }
               
            if(E_contact.value === '' || !validateNo(E_contact.value)){
                E_contact.classList.add('invalid-input');
            }else{
                E_contact.classList.remove('invalid-input');
            }
           
            if(E_email.value === '' || !validateEmail(E_email.value)){
                E_email.classList.add('invalid-input');
            }else{
                E_email.classList.remove('invalid-input');
            }   
               
            if(SSS_No.value === ''){
                SSS_No.classList.add('invalid-input');
            }else{
                SSS_No.classList.remove('invalid-input');
            }   
               
            if(!SSS_File.files || SSS_File.files.length === 0) {
                SSS_File.classList.add('invalid-input');
            }else{
                const file = SSS_File.files[0];
                if(!validateFileSize(file, 2)) {
                    SSS_File.classList.add('invalid-input');
                    alert('Please enter a valid PDF file that is less than 2MB.');
                }else if(!validateFileType(file, ['application/pdf'])) {
                    SSS_File.classList.add('invalid-input');
                    alert('Please upload a PDF file.');
                }else{
                    SSS_File.classList.remove('invalid-input');
                }
            }   
               
            if(PhilH_No.value !== ''){
                if(!PhilH_File.files || PhilH_File.files.length === 0) {
                    PhilH_File.classList.add('invalid-input');
                }else{
                    const file = PhilH_File.files[0];
                    if(!validateFileSize(file, 2)) {
                        PhilH_File.classList.add('invalid-input');
                        alert('Please enter a valid PDF file that is less than 2MB.');
                    }else if(!validateFileType(file, ['application/pdf'])) {
                        PhilH_File.classList.add('invalid-input');
                        alert('Please upload a PDF file.');
                    }else{
                        PhilH_File.classList.remove('invalid-input');
                    }
                }   
            }
            
            if(PhilH_No.value === ''){
                PhilH_File.classList.remove('invalid-input');
            }
            
            if(PIbig_No.value !== ''){
                if(!PIbig_File.files || PIbig_File.files.length === 0) {
                    PIbig_File.classList.add('invalid-input');
                }else{
                    const file = PIbig_File.files[0];
                    if(!validateFileSize(file, 2)) {
                        PIbig_File.classList.add('invalid-input');
                        alert('Please enter a valid PDF file that is less than 2MB.');
                    }else if(!validateFileType(file, ['application/pdf'])) {
                        PIbig_File.classList.add('invalid-input');
                        alert('Please upload a PDF file.');
                    }else{
                        PIbig_File.classList.remove('invalid-input');
                    }
                }   
            }
            
            if(PIbig_No.value === ''){
                PIbig_File.classList.remove('invalid-input');
            }
            
            if(!Agreement.checked){
                Agreement.classList.add('invalid-input');
            }else{
                Agreement.classList.remove('invalid-input');
            }
            
            if(!Emp_Sign.files || Emp_Sign.files.length === 0) {
                Emp_Sign.classList.add('invalid-input');
            }else{
                const file = Emp_Sign.files[0];
                if(!validateFileSize(file, 2)) {
                    Emp_Sign.classList.add('invalid-input');
                    alert('Please enter a valid image file that is less than 2MB.');
                }else if(!validateFileType(file, ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'])) {
                    Emp_Sign.classList.add('invalid-input');
                    alert('Please upload an image file of type: JPEG, PNG, GIF.');
                }else{
                    setRegistrationDate();
                    Emp_Sign.classList.remove('invalid-input');
                }
            }
            
        }else if(age < 18){
            resetOutlineColor(Employee_pic, Employee_pic, Employee_lname, Employee_fname,
            Employee_mname, E_contact, E_email, Emp_Add, Emp_Muni,
            Emp_Brgy, Job_shop, SSS_No, SSS_File, PhilH_No, PhilH_File, PIbig_No, PIbig_File,
            Agreement, Emp_Sign);
            
            alert('You must be 18 years old or above to register.');
            Employee_bday.classList.add('invalid-input'); 
        }else{
            valid = true;
        }
        
        if (philHealthNo === '') {
            if (philHealthFileInput) {
                philHealthFileInput.value = '';
            }
        }
        
        if (PIbigNo === '') {
            if (PIbigFileInput) {
                PIbigFileInput.value = ''; 
            }
        }

        if(valid){
            $.ajax({
                type: 'POST',
                url: 'EmployeeVerifier.php',
                data:{
                    E_lname: Employee_lname.value,
                    E_fname: Employee_fname.value,
                    E_mname: Employee_mname.value,
                    E_Email: E_email.value
                },
                success: function (response){
                    console.log('AJAX success. Response:'. response);
                    if(response === "exists"){
                        Employee_lname.classList.add('invalid-input');
                        Employee_fname.classList.add('invalid-input');
                        E_email.classList.add('invalid-input');

                        if(Employee_mname.value !== ''){
                            Employee_mname.classList.add('invalid-input');
                        }else{
                            Employee_mname.classList.remove('invalid-input');
                        }

                        alert('User or Email alread exists. Please check your information');
                        valid = false;
                    }else if(response === "not_exists"){
                        Employee_lname.classList.remove('invalid-input');
                        Employee_fname.classList.remove('invalid-input');
                        E_email.classList.remove('invalid-input');

                        if(Employee_mname.value !== ''){
                            Employee_mname.classList.remove('invalid-input');
                        }
                    }

                    if(valid){
                        resetOutlineColor(Employee_pic, Employee_pic, Employee_lname, Employee_fname,
                        Employee_mname, Employee_bday, E_contact, E_email, Emp_Add, Emp_Muni,
                        Emp_Brgy, Job_shop, SSS_No, SSS_File, PhilH_No, PhilH_File, PIbig_No, PIbig_File,
                        Agreement, Emp_Sign);
                        
                        Employee_info.style.display = 'none';
                        Account_info.style.display = 'block';
                    }
                },
                error: function (){
                    console.log('AJAX error');
                    alert('Error connecting to ClientVerifier')
                }
            });
        }
});
    
    back2.addEventListener('click', function(){
        event.preventDefault();
        Account_info.style.display = 'none';
        Employee_info.style.display = 'block';
    });
    
    sub2.addEventListener('click', function(){
        event.preventDefault();
        let valid2 = false;
        
        if(Employee_usernm.value === '' || Employee_userps.value === '' || Employee_secps.value === '' ||
           (Employee_userps.value !== Employee_secps.value)){
        
            alert('Please complete the required fields.');
           
            if(Employee_usernm.value === ''){
                Employee_usernm.classList.add('invalid-input');
            }else{
                Employee_usernm.classList.remove('invalid-input');
            }
            
            if(Employee_userps.value === ''){
                Employee_userps.classList.add('invalid-input');
            }else{
                Employee_userps.classList.remove('invalid-input');
            }
            
            if(Employee_secps.value === '' || (Employee_userps.value !== Employee_secps.value)){
                Employee_secps.classList.add('invalid-input');
                if(Employee_userps.value !== Employee_secps.value){
                    Employee_secps.classList.add('invalid-input');
                }
            }else{
                Employee_secps.classList.remove('invalid-input');
            }
        }else{
            valid2 = true;
        }
        
        if(valid2){
            resetOutlineColor(Employee_usernm, Employee_userps, Employee_secps);
            const confirmation = confirm("Send Request?");
            event.preventDefault();

            if(confirmation){
                const employeeData = new FormData(E_form);

                $.ajax({
                    type: 'POST',
                    url: 'Employee_Request.php',
                    data: employeeData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log('AJAX success. Response:', response);
                        if (response.status === 'success') {
                            alert(response.message);
                            E_form.reset();
                            window.location.href = 'elogin.php';
                            const empID = response.EmpID;
                            console.log('EmpID:', empID);
                        } else {
                            alert(response.message);
                            console.error('Server returned error status:', response.status);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX error. Status:', textStatus, 'Error:', errorThrown);
                        alert('An error occurred while processing your request.');
                    }
                });
                
            }
            
        }else if(!valid2){
            alert('Please complete the required fields with correct credentials.');
        }else{
            E_form.reset();
        }
        
        
        
        
    });

    
    
    
    
    
    
    
    
    
});