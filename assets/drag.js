
let dragged;
const dropZones = document.getElementsByClassName('dropzone');
const draggables = document.getElementsByClassName('draggable');
const dragStart = (event) => {
    dragged = event.target;

}

const dragEnter = (event) => {
    if (event.target.classList.contains("dropzone")){
        event.target.classList.add("selected");
    }
}
const dragLeave = (event) => {
    if(event.target.classList.contains("dropzone")) {
        event.target.classList.remove("selected");
    }
}
const dragOver = (event) => {
    event.preventDefault();
    // Empêche default d'autoriser le drop
}

const drop = (event) => {
    event.preventDefault();
    if (event.target.classList.contains("dropzone")){
        dragged.parentNode.removeChild(dragged);
        event.target.appendChild(dragged);
        event.target.classList.remove('selected');
        dragged.classList.add('trembling');
        dragged.dataset.date = event.target.dataset.date;
        //le fetch
        fetch('/reward/updateDate',{
            body: JSON.stringify({
                rewardId: dragged.dataset.id,
                date: dragged.dataset.date,
            }),
            method:"POST",
            headers: {
                "Content-type": "application/json; charset=UTF-8"
            }
        })
            .then((response)=>response.json())
            .then((data)=>console.log(data));


    }

}

for (const dropZone of dropZones) {
    dropZone.addEventListener('dragenter', dragEnter);
    dropZone.addEventListener('dragleave', dragLeave);
    dropZone.addEventListener('dragover',dragOver);
}

document.addEventListener('dragstart', dragStart);
document.addEventListener('drop', drop);





