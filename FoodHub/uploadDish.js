function addIngredient() {
    var ingredientContainer = document.getElementById("ingredientContainer");
    var num = ingredientContainer.childElementCount - 1;

    var element = "<input class='form-control mb-2' id='dishIngredient" + num + "' placeholder='Ingredient " + num + "' name='dishIngredient " + num + "'></textarea>";

    let ingredients = [];
    for (let i = 1; i < num; i++) {
        let x = document.getElementById("dishIngredient" + i).value;
        ingredients.push(x);
    }

    ingredientContainer.innerHTML += element;

    for (let i = 0; i < ingredients.length; i++) {
        document.getElementById("dishIngredient" + (i+1)).value = ingredients[i];
    }
}

function addInstruction() {
    var ingredientContainer = document.getElementById("instructionContainer");
    var num = ingredientContainer.childElementCount - 1;

    var element = "<input class='form-control mb-2' id='dishInstruction" + num + "' placeholder='Instruction " + num + "' name='dishIngredient " + num + "'></textarea>";

    let instructions = [];
    for (let i = 1; i < num; i++) {
        let x = document.getElementById("dishInstruction" + i).value;
        instructions.push(x);
    }

    ingredientContainer.innerHTML += element;

    for (let i = 0; i < instructions.length; i++) {
        document.getElementById("dishInstruction" + (i+1)).value = instructions[i];
    }
}