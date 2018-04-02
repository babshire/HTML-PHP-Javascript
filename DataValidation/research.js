
window.onsubmit=validateForm;

function validateForm() {
    var invalidMessages = "";

    /* Validate Phone Number */
    var phone1 = document.getElementById("phoneFirstPart").value;
    var phone2 = document.getElementById("phoneSecondPart").value;
    var phone3 = document.getElementById("phoneThirdPart").value;
    invalidMessages += validatePhone(phone1,phone2,phone3);

    /* Validate Check Boxes */
    var highBloodPressure = document.getElementById("highBloodPressure");
    var diabetes = document.getElementById("diabetes");
    var glaucoma = document.getElementById("glaucoma");
    var asthma = document.getElementById("asthma");
    var none = document.getElementById("none");
    invalidMessages += validateCheckBoxes(highBloodPressure, diabetes, glaucoma, asthma, none);

    /* Validate Radio Buttons */
    var period = document.getElementsByName("period");
    invalidMessages += validateRadioButtons(period);

    /* Validate study ID */
    var firstHalf = document.getElementById("firstFourDigits").value; 
    var secondHalf = document.getElementById("secondFourDigits").value;
    invalidMessages += validateStudyId(firstHalf, secondHalf);





    if (invalidMessages !== "") {
        alert(invalidMessages);
        return false;
    } else {
        var valuesProvided = "Do you want to submit the form data?\n";
        
        // We could write the following as return window.confirm(valuesProvided) 
        if (window.confirm(valuesProvided)) {
            return true;
        }
        else {   
            return false;
        }
    }
}


function validatePhone(phone1, phone2, phone3) {
    var invalid = "";
    if (Number.isNaN(phone1) || phone1.length !== 3 || Number.isNaN(phone2) || phone2.length !== 3
        || Number.isNaN(phone3) || phone3.length !== 4) {
        invalid += "Invalid phone number.\n";
    }
    return invalid;
}

function validateCheckBoxes(box1, box2, box3, box4, box5) {
    var invalid = "";
    if (!highBloodPressure.checked && !diabetes.checked && !glaucoma.checked && !asthma.checked && !none.checked) {
        invalid += "No conditions selected.\n";
    }
    if (none.checked && (highBloodPressure.checked || diabetes.checked || glaucoma.checked || asthma.checked)) {
        invalid += "Invalid conditions selection.\n";
    }
    return invalid;
}

function validateRadioButtons(period) {
    var invalid = "";
    var onechecked = 0;
    for (var idx = 0; idx < period.length; idx++) {
        if (period[idx].checked) {
            onechecked = 1;
        }
    }
    if (onechecked == 0) {
        invalid += "No time period selected.\n";
    }
    return invalid;
}

function validateStudyId(firstHalf, secondHalf) {
    invalid = "";
    var count = 0;
    if (firstHalf.length != 4) {
        count++;
    }
    if (firstHalf.charAt(0) != 'A')
        count++;
    if (isNaN(firstHalf.charAt(1)))
        count++;
    if (isNaN(firstHalf.charAt(2))) 
        count++;
    if (isNaN(firstHalf.charAt(3))) 
        count++;
     
    if(secondHalf.length != 4)
        count++;
    if(secondHalf.charAt(0) != 'B')
        count++;
    if (isNaN(secondHalf.charAt(1)))
        count++;
    if(isNaN(secondHalf.charAt(2)))
        count++;
    if (isNaN(secondHalf.charAt(3))) 
        count++;
    if (count > 0)
        invalid += "Invalid Study id.\n";

    return invalid;
}


 

