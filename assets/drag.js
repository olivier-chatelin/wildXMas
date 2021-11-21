
let dragged;
const dropZones = document.getElementsByClassName('dropzone');
const draggables = document.getElementsByClassName('draggable');
console.log('dropzones',dropZones);
console.log('draggables',draggables);
const dragStart = (event) => {
    dragged = event.target;
    console.log("élément attrapé");
    dragged.dataset.originId = dragged.parentNode.dataset.id;

}

const dragEnter = (event) => {
    if (event.target.classList.contains("dropzone")){
        event.target.classList.add("selected");
        console.log('event target',event.target.classList);
    }
}
const dragLeave = (event) => {
    if(event.target.classList.contains("dropzone")) {
        event.target.classList.remove("selected");
        console.log('event target leave',event.target.classList);
    }
}
const dragOver = (event) => {
    event.preventDefault();
    // Empêche default d'autoriser le drop
}
const dragEnd = (event) => {
    console.log("élément lâché");
}
const drop = (event) => {
    event.preventDefault();
    if (event.target.classList.contains("dropzone")){
        dragged.parentNode.removeChild(dragged);
        event.target.appendChild(dragged);
        event.target.classList.remove('selected');
        dragged.classList.add('trembling');
        dragged.dataset.destinationId = event.target.dataset.id;
        console.log('id_dragged:',dragged.dataset.id);
        console.log('id_origine:', dragged.dataset.originId);
        console.log('id_destination:', dragged.dataset.destinationId);
        //le fetch
        // fetch('/meal',{
        //     body: JSON.stringify({
        //         idDragged: dragged.dataset.id,
        //         idOrigin: dragged.dataset.originId,
        //         idDestination:dragged.dataset.destinationId
        //     }),
        //     method:"POST",
        //     headers: {
        //         "Content-type": "application/json; charset=UTF-8"
        //     }
        // })
        //     .then((response)=>response.json())
        //     .then((data)=>console.log(data));


    }

}

for (const dropZone of dropZones) {
    dropZone.addEventListener('dragenter', dragEnter);
    dropZone.addEventListener('dragleave', dragLeave);
    dropZone.addEventListener('dragover',dragOver);
}

document.addEventListener('dragstart', dragStart);
document.addEventListener('dragend',dragEnd);
document.addEventListener('drop', drop);





