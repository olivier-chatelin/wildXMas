
const container = document.getElementById('calendarContainer');
const dateInput = document.getElementById('available_dates_form_dateset');
console.log(container);
let buttons = [];
let result = [];
for (let i = 1; i <= 24; i++ ) {
    buttons[i] = document.createElement('span');
    buttons[i].className="btn btn-primary  text-gold";
    buttons[i].innerHTML = i;
    container.appendChild(buttons[i]);
    buttons[i].addEventListener('click',(e)=>{
        e.preventDefault();
        buttons[i].classList.toggle('active');
        result.push(buttons[i].innerHTML);
        dateInput.value = result;
        console.log(dateInput.value);
    })
}