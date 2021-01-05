require('./bootstrap');

window.onload = function () {

    const cardBody = document.querySelector('#card__tbody');


    function addButtonRemoveEventListener() {
        const buttonsRemove = cardBody.querySelectorAll('.card__remove');
        buttonsRemove.forEach(buttonRemove => {
            buttonRemove.addEventListener('click', () => {
                const order_id = buttonRemove.dataset.order;
                const product_id = buttonRemove.dataset.product;

                const fetchBody = {
                    "product_id" :  product_id,
                    "order_id" : order_id
                };

                const stringy = JSON.stringify(fetchBody);

                fetch( '/order/delete',  {
                    method: "DELETE",
                    body: stringy,
                    headers:{
                        "content-type": "application/x-www-form-urlencoded",
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })

                    .then( (response) => {
                        if (response.status !== 200) {
                            return Promise.reject();
                        }
                        return response.text()
                    })
                    .then(i => {
                        const result = JSON.parse(i);
                        console.log(result);

                        let quantity = 0;
                        let total = 0;

                        let fullHTML = "";
                        for (let count = 0; count < result.length; count++) {

                            quantity += result[count].quantity;
                            total += +result[count].price;

                            fullHTML += renderCardTable(
                                count + 1,
                                result[count].order_id,
                                result[count].product_id,
                                result[count].title,
                                result[count].status,
                                result[count].quantity,
                                result[count].price
                            );
                        }

                        fullHTML += renderFooterCardTable(quantity, total);
                        cardBody.innerHTML = fullHTML;
                        addButtonRemoveEventListener();
                    })
                    .catch(() => console.log('ошибка'));
            })
        })
    }

    function renderCardTable(number, order_id, product_id, title, status, quantity, price) {
        return `
            <tr>
                <th scope="row">${number}</th>
                <td>${title}</td>
                <td>${status}</td>
                <td>${quantity}</td>
                <td>${price}</td>
                <td><i class="fas fa-trash-alt card__remove" data-order="${order_id}" data-product="${product_id}"></i></td>
            </tr>
        `;
    }

    function renderFooterCardTable(resultQuantity, resultTotal) {
        return `
            <tr class="table-primary">
                <th scope="row"></th>
                <td>Итого:</td>
                <td></td>
                <td id="quantity">${resultQuantity}</td>
                <td id="total">${resultTotal}</td>
                <td></td>
            </tr>
        `;
    }

    addButtonRemoveEventListener();
}
