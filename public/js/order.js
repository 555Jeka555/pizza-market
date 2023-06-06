document.addEventListener('DOMContentLoaded', function() {
  const form = document.querySelector('.main-form');
  console.log(form);
  form.addEventListener('submit', puplish);
  async function puplish(event) {
    event.preventDefault();
    const pizzaId = document.querySelector('.subtitle-form').id;
    const adress = document.getElementById('adress').value;
    const number_card = document.getElementById('number_card').value;
    const number_back_card = document.getElementById('number_back_card').value;
    const date_card = document.getElementById('date_card').value;
    let order = {
        pizzaId,
        adress,
        number_card,
        number_back_card,
        date_card,
    };
    console.log(JSON.stringify(order));
    let response = await fetch('http://localhost:8000/order/make', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(order)});
    // console.log(response.url);
    // window.location.replace(response.url);
  }
  
});
