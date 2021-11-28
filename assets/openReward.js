import {Modal} from "bootstrap";

const curtains = document.getElementsByClassName('curtain');
const modalBody = document.getElementById('modal-body');
const autoOpenInput = document.getElementById('auto-open');
const rewards = document.getElementsByClassName('reward');
const resetOne = document.getElementById('resetOneModal');
const resetOneBody = document.getElementById('reset-one-modal-body');
const resetOneFooter = document.getElementById('reset-one-modal-footer');
let resetOneModal = new Modal(resetOne);

let autoOpen = autoOpenInput.checked;
autoOpenInput.addEventListener('change',()=>{
    autoOpen = autoOpenInput.checked;
})

for (let curtain of curtains) {
    curtain.addEventListener('click', () => {
        if( modalBody.dataset.winner && !autoOpen) {
            location.href = 'rewards/show/' + curtain.dataset.id + '/students/' +  modalBody.dataset.winner;
        }
    })
}
console.log(rewards)
for (let reward of rewards) {
    reward.addEventListener('click',()=>{
        resetOneBody.innerHTML="Are you sure to reset this reward?"
        let confirmResetOne = document.createElement('a');
        confirmResetOne.href = 'rewards/reset/' + reward.dataset.id;
        confirmResetOne.className='btn btn-xMas';
        confirmResetOne.innerText = "Yes reset it";
        resetOneFooter.appendChild(confirmResetOne);
        resetOneModal.show();

    })
}