let title           = document.getElementById("title");
let typeFeature     = document.querySelector('#Feature');
let typeBug         = document.querySelector('#Bug');
let statusToDo      = document.querySelector('#ToDo');
let statusInProgress= document.querySelector('#InProgress');
let statusDone      = document.querySelector('#Done');
let priorityHigh    = document.querySelector('#High');
let priorityMedium  = document.querySelector('#Medium');
let priorityLow     = document.querySelector('#Low');
let date            = document.getElementById("date");
let description     = document.getElementById("description");
let taskId          = document.getElementById('task-id');



function editTask(element) {
    // Créer objet qui a les données d'une task
    let buttonInfo = {
        id          : element.getAttribute('id'),
        title       : element.querySelector("#buttonTitle").innerText,
        type        : element.querySelector("#buttonType").innerHTML,
        priority    : element.querySelector("#buttonPriority").innerText,
        status      : element.querySelector("#buttonStatus").innerText,
        date        : element.querySelector("#buttonDate").innerText,
        description : element.querySelector("#buttonDescription").innerText,
    }


    // Ouvrir Modal form
    $("#exampleModal").modal("show");
    
    // Remplacer ancienne task par nouvelle task
    title.value         = buttonInfo.title;
    taskId.value        = buttonInfo.id;
    date.value          = buttonInfo.date;
    description.value   = buttonInfo.description;

    //Choisir le type pour vérifier
    if (buttonInfo.type === 'Bug'){
        typeBug.checked = true;
    }
    
    else  {
        typeFeature.checked = true;
    }

    //Choisir la status pour vérifier
    if (buttonInfo.status === 'To Do'){
        statusToDo.selected = true ;
    }

    else if (buttonInfo.status === 'In Progress'){
        statusInProgress.selected = true ;
    }

    else {
        statusDone.selected = true ;
    }

    //Choisir la propriete pour vérifier
    if (buttonInfo.priority === 'High'){
        priorityHigh.selected = true ;
    }

    else if (buttonInfo.priority === 'Medium'){
        priorityMedium.selected = true ;
    }

    else {
        priorityLow.selected = true ;
    }


    // Update Button
    document.getElementById("buttonsModal").innerHTML = `<button class="btn btn-dark text-white col-3 col-sm-3 col-md-2" type="submit" name="update">Update</button>
    `

    // Delete Button
    document.getElementById("buttonsModal").innerHTML += `<button class="btn btn-danger col-3 col-sm-3 col-md-2" type="submit" name="delete">Delete</button>`

    

}

function resetForm(){
    document.querySelector('form').reset();
    document.getElementById("buttonsModal").innerHTML = `
    <button class="btn btn-secondary col-3 col-sm-3 col-md-2" type="button" data-bs-dismiss="modal">Cancel</button>`
    document.getElementById("buttonsModal").innerHTML += `
    <button class = "btn btn-primary  col-3 col-sm-3 col-md-2" type="submit" name="save">Save</button>`
}
