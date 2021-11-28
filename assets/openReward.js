const curtains = document.getElementsByClassName('curtain');
const modalBody = document.getElementById('modal-body');
const autoOpenInput = document.getElementById('auto-open');
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