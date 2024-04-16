let start_date = document.getElementById('start_date');
start_date.setAttribute('min', new Date().toISOString().split('T')[0]);
let end_date = document.getElementById('end_date');
let total_cost = document.getElementById('total_cost');
let total_days = document.getElementById('total_days');
const rate = document.getElementById('rate').innerText;
const rate_day = document.getElementById('rate_day').innerText;

start_date.addEventListener('change', () => {
    const today = new Date();
    const selectedDate = new Date(start_date.value);
    const selectedEndDate = new Date(end_date.value);
    if (selectedDate < today || selectedEndDate < selectedDate) {
        alert('Please select a valid start date');
        start_date.value = '';
    }
    days_diff();
});
end_date.addEventListener('change', () => {
    const today = new Date();
    const selectedDate = new Date(start_date.value);
    const selectedEndDate = new Date(end_date.value);
    if (selectedDate < today || selectedEndDate < selectedDate) {
        alert('Please select a valid end date');
        start_date.value = '';
    }
    days_diff();
});

function days_diff() {
    let start = new Date(start_date.value);
    let end = new Date(end_date.value);
    let diff = end - start;
    let days = (diff / (1000 * 60 * 60 * 24));
    let hours = Math.round(diff / (1000 * 60 * 60));
    if (days < 0 || isNaN(days) || hours < 24) {
        days = 0;
        total_days.innerHTML = `Total Hours: <strong>${hours} Hours</strong>`;
        cost = Math.ceil(Math.abs(hours * rate));
    } else {
        total_days.innerHTML = `Total Days: <strong>${Math.round(days)} Days</strong>`;
        cost = Math.ceil(Math.abs(days * rate * 24));
        if (days >= 1) {
            cost = Math.ceil(Math.abs(days * rate_day));
        }
    }
    document.getElementById('total_cost_input').value = cost;
    console.log(cost, document.getElementById('total_cost_input').value);
    total_cost.innerText = `$${cost}`;
}
