let taskInput   = document.querySelector('.addTask');
let form        = document.querySelector('.todoForm');
let taskList    = document.querySelector('.taskList');
let deleteIcons = document.querySelectorAll('.fa-trash-alt');
let editIcons   = document.querySelectorAll('.fa-edit');

function removeRequest(taskID) {
    const url = 'index.php?page=supprimer-tache';
    let request = new XMLHttpRequest();
    request.open('POST', url);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.send('taskID=' + taskID);
}

function editRequest(taskID, label) {
    const url = 'index.php?page=modifier-tache';
    let request = new XMLHttpRequest();
    request.open('POST', url);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.send('taskID=' + taskID + '&' + 'label=' + label);
}

for(let icon of deleteIcons) {
    icon.addEventListener('click', () => {
        removeRequest(icon.parentElement.id);
        icon.parentElement.remove();
    });
}

for(let icon of editIcons) {
    icon.addEventListener('click', () => {
        let taskLabel = icon.parentElement.querySelector('.label');
        taskLabel.textContent = prompt('Saisissez le nouvel intitulé de la tâche : ');
        editRequest(icon.parentElement.id, taskLabel.textContent);
    });
}