window.onsubmit = main;

// Execute main
function main() {
    var invalidMessage = "";
    invalidMessage += validateComments();
    
    if( invalidMessage !== "" ) {
        alert( invalidMessage );
        return false;
    } 
}

function validateComments() {
    let comments = document.getElementById( "viewRecipeComment" ).value;
    // alert( comments );
    let message = "";
    if( comments === "" ) {
        message += "Invalid comment. You cannot submit an empty comment box.";
    }
    return message;
}

function validate() {
    let n = ingredientContainer.childElementCount - 1;
    let m = document.getElementById("instructionContainer").childElementCount - 1;
    let invalidMessages = "";


    let picture = document.getElementById("picture").value;
    if (picture === "") {
        invalidMessages += "Picture not selected.\n";
    }

    let name = document.getElementById("dishName").value;
    if (name === "") {
        invalidMessages += "Dish name not specified.\n";
    }

    /* fetch the ingredients from the text input */
    for (let i = 1; i < n; i++) {
        let ingredientI = document.getElementById("dishIngredient" + i).value;
        if (ingredientI !== "") {
            invalidMessages += validateIngredient(ingredientI, i);
        } else if (ingredientI === "") {
            invalidMessages += "Ingredient " + i + " is empty.\n";
        }
    }
    
    for (let i = 1; i < m; i++) {
        let instr = document.getElementById("dishInstruction" + i).value;
        if (instr === "") {
            invalidMessages += "Instruction " + i + " is empty.\n";
        }
    }
    
    if (invalidMessages !== "") {
        alert(invalidMessages);
        return false;
    } else {
        var valuesProvided = "Do you want to submit the form data?\n";
        
        // We could write the following as return window.confirm(valuesProvided) 
        if (window.confirm(valuesProvided)) {
            document.forms["uploadDish"].submit();
            return true;
        }
        else {   
            return false;
        }
    }
}

function validateIngredient(ingredient, i) {
    let mssg = "";
    let arr = ingredient.split(" ");
    if (isNaN(arr[0]))
        mssg += "Ingredient" + i + " is invalid.\n";

    return mssg;
}
