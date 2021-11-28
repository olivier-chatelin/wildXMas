import {Modal} from 'bootstrap'
const canvas = document.getElementById("can");
const nameModal = document.getElementById('nameModal');
const spinButton = document.getElementById('spinTrigger');
const studentsDiv = document.getElementsByClassName('student');
const modalBody = document.getElementById('modal-body');
const curtains = document.getElementsByClassName('curtain');
const autoOpenInput = document.getElementById('auto-open');
let autoOpen = autoOpenInput.checked;
autoOpenInput.addEventListener('change',()=>{
    autoOpen = autoOpenInput.checked;
})

let myModal = new Modal(nameModal)
let color = "";
let labels = [];
let rewardFound = false;

console.log(autoOpen)

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
            color = '#991108';
            break;
        case 1:
            color = '#3b424e';
            break;
        case 2:
            color = '#f99797';
            break;
        case 3:
            color = '#F76c6c';
            break;
    }
    ctx.fillStyle = color;
    ctx.beginPath();
    ctx.moveTo(w,w);
    ctx.arc(w , w, w, sumAngles,sumAngles + sectionAngle,false);
    ctx.fill();
    ctx.fillStyle ='white';
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
        let winner = labels[index]
        modalBody.innerHTML=`Congrats ${winner}, let's see what you earn today `;
        for (const studentDiv of studentsDiv) {
            if(studentDiv.dataset.name === winner) {
                modalBody.dataset.winner = studentDiv.dataset.id;
            }
        }
        myModal.show();
        setTimeout(()=>{
            myModal.hide();
            if(autoOpen) {

                let date = new Date();
                let today = date.getFullYear() + '-' + (date.getMonth()+1) .toString().padStart(2,'0') + '-' + date.getDate().toString().padStart(2,'0');
                    console.log('today',today)
                for (let curtain of curtains) {
                console.log(curtain.dataset.date);
                    if(today === curtain.dataset.date) {
                        rewardFound = true;
                        location.href = 'rewards/show/' + curtain.dataset.id + '/students/' +  modalBody.dataset.winner;

                    }
                }
                if (!rewardFound) {
                    modalBody.innerHTML = "No reward found for today";
                    myModal.show();
                    setTimeout(()=>{
                        location.href='/';
                        myModal.hide();

                    },2000)
                }
            }
        },3000)
    },6000)
})


