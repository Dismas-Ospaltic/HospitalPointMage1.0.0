//display cards
function displayTodayAppointments() {
    const display = document.querySelector("#app-recent-sec .app-sec");
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "displayTodayAppointment.php", true); // Use true for asynchronous
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            display.innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.send();
}  

//display cards
function displayRecentPatients() {
    const display = document.querySelector("#app-recent-sec .recent-patients .rec-list-pat");
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "displayTopListPatient.php", true); // Use true for asynchronous
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            display.innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.send();
}  



//display cards
function displayHospitalEquipment() {
    const display = document.querySelector("#hspt-resource .resources-card .resource-list");
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "displayHospitalEquipment.php", true); // Use true for asynchronous
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            display.innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.send();
}  

function displayHospitalStaffs() {
    const display = document.querySelector("#hspt-resource .staff-list .inner-staff-list");
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "displayHospitalStaff.php", true); // Use true for asynchronous
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            display.innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.send();
}     

//display graph
function showDataweek(){
    const display = document.querySelector("#statistics #week");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "WeeklyStat.php", true);
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            display.innerHTML=xmlhttp.responseText;
        }
    };
     xmlhttp.send(null);
    
} 


function showDataMonth(){
        const display = document.querySelector("#statistics #month");
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "MonthlyStat.php", true);
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                display.innerHTML=xmlhttp.responseText;
            }
        };
         xmlhttp.send(null);
        
    } 


    function showDataYear(){
            const display = document.querySelector("#statistics #year");
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "YearlyStat.php", true);
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                    display.innerHTML=xmlhttp.responseText;
                }
            };
             xmlhttp.send(null);
            
        } 

        function displayHospitalStaffsNumcard() {
        const display = document.querySelector("#overview-cards .cards .staffNumcard h1");
        
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "displayHospitalStaffNum.php", true); // Use true for asynchronous
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                display.innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.send();
    }  

    function displayHospitalPatientNumcard() {
        const display = document.querySelector("#overview-cards .cards .patientNumcard h1");
        
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "displayHospitalPatientNum.php", true); // Use true for asynchronous
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                display.innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.send();
    }


    function displayHospitalPatientVisitNumcard() {
        const display = document.querySelector("#overview-cards .cards .todayVisit h1");
        
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "displayHospitalPatientTodayVisitNum.php", true); // Use true for asynchronous
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                display.innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.send();
    }

    function displayHospitaldepartmentNumcard() {
        const display = document.querySelector("#overview-cards .cards .departmentNum h1");
        
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "displayHospitaldepartmentNum.php", true); // Use true for asynchronous
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                display.innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.send();
    }
    

  