const form = document.querySelector('main-form');
form.addEventListener('submit', () => {
    const pizzaId = document.querySelector('subtitle-form').id;
    const adress = document.getElementsByName('adress').textContent;
    const number_card = document.getElementsByName('number_card').textContent;
    const number_back_card = document.getElementsByName('number_back_card').textContent;
    const date_card = document.getElementsByName('date_card').textContent;
    let order = {
        userId,
        pizzaId,
        adress,
        number_card,
        number_back_card,
        date_card,
    }
    fetch('http://localhost:8000/order/make', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(order)
      })
      .then(response => response.json())
      .then(result => {
        console.log(result);
      })
      .catch(error => {
        console.error('Error:', error);
      });
});