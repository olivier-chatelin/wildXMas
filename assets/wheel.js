import {Modal} from 'bootstrap'
const canvas = document.getElementById("can");
const nameModal = document.getElementById('nameModal');console.log(nameModal)
const spinButton = document.getElementById('spinTrigger');
const winner = document.getElementById('winner');
const studentsDiv = document.getElementsByClassName('student');
const modalBody = document.getElementById('modal-body');
let myModal = new Modal(nameModal)
let color = "";
let labels = [];

for (const studentDiv of studentsDiv) {
    labels.push(studentDiv.dataset.name);
}
let ctx = canvas.getContext("2d");
let sumAngles = 0;
let rand = Math.floor(Math.random()*100 + 20 );
let randAngle = rand % (2 * Math.PI);
canvas.width = window.innerWidth/2.5;
canvas.height = window.innerWidth/2.5;
let sectionAngle = 2*Math.PI/labels.length;
let w = canvas.width / 2
for (let i = 0; i < labels.length; i++) {
    switch (i % 4) {
        case 0:
            color = '#04A334';
            break;
        case 1:
            color = '#037523';
            break;
        case 2:
            color = '#A60932';
            break;
        case 3:
            color = '#E0AA3E';
            break;
    }
    ctx.fillStyle = color;
    ctx.beginPath();
    ctx.moveTo(w,w);
    ctx.arc(w , w, w, sumAngles,sumAngles + sectionAngle,false);
    ctx.fill();
    ctx.fillStyle ='black';
    ctx.font = "25px Arial";
    ctx.textAlign = "left";
    ctx.textBaseline = "middle";
    let mid = sumAngles + sectionAngle / 2;
    ctx.translate(w + Math.cos(mid) * (w*0.5),w + Math.sin(mid) * (w*0.5));
    ctx.rotate(sumAngles + sectionAngle / 2);
    ctx.fillText(labels[i],0 , 0);
    ctx.rotate(-sumAngles - sectionAngle / 2);
    ctx.translate(-w - Math.cos(mid) * (w*0.5),-w - Math.sin(mid) * (w*0.5));
    sumAngles += sectionAngle;
}

let index = Math.floor(randAngle  / sectionAngle)
labels.reverse();
spinButton.addEventListener('click',()=>{
    canvas.style.transform = `rotate(${rand}rad)`;
    canvas.style.transition ="transform 6s";
    canvas.style.animationTimingFunction = "ease-in-out";
    setTimeout(()=>{
        let firstname = labels[index].split('.')[0];
        modalBody.innerHTML=`Congrats ${firstname}, let's see what you earn today `;
        myModal.show();
        setTimeout(()=>{
            myModal.hide();
        },3000)
    },6000)
})


