require('./bootstrap');

window.onload = function () {
    /**
     Pagination product active
     **/
    const pagination = document.querySelector('.carousel-inner');
    const paginationProducts = pagination.querySelectorAll('.pagination-product')
    const orderWrapper = document.querySelector('.order-wrapper');
    const orderItem = orderWrapper.querySelector('.order__item');

    const clickToOrderWrapper = event => {
        orderWrapper.classList.toggle('hidden');
    };

    paginationProducts.forEach(paginationProduct => {
        paginationProduct.addEventListener('click', async () => {
            orderWrapper.classList.remove('hidden');
            const fetchBody = {
                "product_id" :  paginationProduct.dataset.id
            };

            const stringy = JSON.stringify(fetchBody);
            await fetch( '/product',  {
                method: "POST",
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
                    console.log(result.title);
                    const orderTitle = orderItem.querySelector('.order__h2');
                    const orderImage = orderItem.querySelector('.order__image');
                    const orderContent = orderItem.querySelector('.order__content');
                    const orderPrice = orderItem.querySelector('.order__price');
                    const orderButton = orderItem.querySelector('.btn-primary');

                    orderTitle.textContent = result.title;
                    orderImage.src = result.src;
                    orderContent.textContent = result.description;
                    orderPrice.textContent = result.price;
                    orderButton.setAttribute('value', paginationProduct.dataset.id);
                })
                .catch(() => console.log('ошибка'));

        });
    });


    orderItem.addEventListener('click', event => {
        event.stopPropagation();
    });
    orderWrapper.addEventListener('click', clickToOrderWrapper);

    const paginationItems = pagination.querySelectorAll('.carousel-item');
    const prevButton = document.querySelector('.carousel-control-prev');
    const nextButton = document.querySelector('.carousel-control-next');

    prevButton.addEventListener('click', () => {
        for (let count = 0; count < paginationItems.length; count++) {
            if (paginationItems[count].classList.contains('active')) {
                paginationItems[count].classList.remove('active');
                if (count > 0) {
                    paginationItems[count - 1].classList.toggle('active');
                } else {
                    paginationItems[paginationItems.length - 1].classList.toggle('active');
                }
                break;
            }
        }
    });

    nextButton.addEventListener('click', () => {
        for (let count = 0; count < paginationItems.length; count++) {
            if (paginationItems[count].classList.contains('active')) {
                paginationItems[count].classList.remove('active');
                if (count < paginationItems.length - 1) {
                    paginationItems[count + 1].classList.toggle('active');
                } else {
                    paginationItems[0].classList.toggle('active');
                }
                break;
            }
        }
    });
}
