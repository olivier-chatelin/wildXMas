// interact('.draggable')
//     .draggable({
//         inertia : false,
//         mdifiers: [
//             interact.modifiers.restrictRect({
//                 restriction:'parent',
//                 endOnly: true
//             })
//         ],
//         autoScroll:false,
//
//         listeners:{
//             move: (event) => {
//                 let dragged = event.target;
//                 let x = (parseFloat(dragged.dataset.x) || 0) + event.dx;
//                 let y = (parseFloat(dragged.dataset.y) || 0) + event.dy;
//                 dragged.style.transform = 'translate(' + x + 'px, '+ y + 'px)';
//                 dragged.dataset.x = x;
//                 dragged.dataset.y = y;
//                 dragged.dataset.originId = dragged.parentNode.dataset.id;
//
//
//             },
//
//         }
//     })
//
//
// interact('.dropzone').dropzone({
//     accept: '.draggable',
//     overlap: 0.75,
//     ondragenter: (event) => {
//         let draggable = event.relatedTarget;
//         let dropzone = event.target;
//         dropzone.classList.add('selected');
//         draggable.classList.add('can-drop');
//     },
//     ondragleave: (event) => {
//         event.target.classList.remove('selected');
//         event.relatedTarget.classList.remove('can-drop');
//     },
//     ondrop: (event)=> {
//         let dragged = event.relatedTarget;
//         let dropzone = event.target;
//         dropzone.classList.remove('selected');
//         dragged.dataset.x = '0';
//         dragged.dataset.y = '0';
//         dragged.style.transform = 'translate( 0px, 0px)';
//         dragged.dataset.destinationId = dropzone.dataset.id;
//
//         dropzone.appendChild(dragged);
//         dragged.classList.add('trembling');
//
//
//         //fetch
//         fetch('/meal',{
//             body: JSON.stringify({
//                 idDragged: dragged.dataset.id,
//                 idOrigin: dragged.dataset.originId,
//                 idDestination:dragged.dataset.destinationId
//             }),
//             method:"POST",
//             headers: {
//                 "Content-type": "application/json; charset=UTF-8"
//             }
//         })
//             .then((response)=>response.json())
//             .then((data)=>console.log(data));
//     }
// })