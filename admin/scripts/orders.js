import { Order } from '/admin/classes/Order.js';

async function addUsersToFilter() {
    let response = await fetch('/api/getUsers');
    const users = await response.json();
    const select = document.getElementById('user-filter');
    users.forEach(user => {
        const option = document.createElement('option');
        option.value = user.id_user;
        option.text = user.username;
        select.appendChild(option);
    });
}

window.onload = async () => {
    try {
        if (localStorage.getItem('currency')) {
            document.getElementById('currency-filter').selectedIndex = localStorage.getItem('currency');
        }
        await addUsersToFilter();
        await get();
    } catch (error) {
        console.error('Error on page load:', error);
    }
};

function createSpinner() {
    // Get target container to add the elements inside
    const target = document.getElementById('target');
    target.innerHTML = ''; // Clear existing content

    const spinnerContainer = document.createElement('div');
    spinnerContainer.className = 'd-flex justify-content-center';

    const spinner = document.createElement('div');
    spinner.className = 'spinner-border text-primary';
    spinner.role = 'status';
    spinner.innerHTML = `<span class="visually-hidden">Loading...</span>`;

    spinnerContainer.appendChild(spinner);
    target.appendChild(spinnerContainer);
}

async function get(order = null) {
    createSpinner();
    // Get the orders
    console.log("Getting all orders");
    createToast("Getting all orders...");

    let url = '/api/getOrders';

    if (order) {
        url += '&order=' + order;
    }

    let response = await fetch(url);

    if (response.ok) {
        const orders = await response.json();
        await listOrders(orders);
    } else {
        const target = document.getElementById('target');
        target.innerHTML = '<div class="d-flex justify-content-center align-items-center">No orders found</div>';
    }
}

async function getByUser() {
    createSpinner();
    let id = document.getElementById('user-filter').value;
    let name = document.getElementById('user-filter').options[document.getElementById('user-filter').selectedIndex].text;

    console.log(`Getting all orders by ${name}`);
    createToast(`Getting all orders by ${name}...`);

    let response = await fetch('http://www.dockereats.com/api/getOrdersByUser&user=' + id);

    if (response.ok) {
        const orders = await response.json();
        await listOrders(orders);
    } else {
        const target = document.getElementById('target');
        target.innerHTML = '<div class="d-flex justify-content-center align-items-center">No orders found</div>';
    }
}

async function listOrders(ordersJson) {
    try {
        const orders = ordersJson.map(orderData => new Order(orderData));

        // Get target container to add the elements inside
        const target = document.getElementById('target');
        target.innerHTML = ''; // Clear existing content

        for (const order of orders) {
            const orderRow = document.createElement('div');
            orderRow.className = 'row mb-5';
            target.appendChild(orderRow); // Add order-list to target

            const containers = await order.getContainers();
            const sales = await order.getSales();
            const coupons = await order.getCoupons();

            const orderDiv = document.createElement('div');
            orderDiv.className = 'order p-3 col-12 position-relative';

            const userDataDiv = document.createElement('div');
            userDataDiv.className = 'userdata d-flex position-absolute top-0 start-0';

            const userImg = document.createElement('img');
            const userImgPath = `/img/users/user${order.userId}.webp`;
            const imgResponse = await fetch(userImgPath);
            userImg.src = imgResponse.ok ? userImgPath : '/img/users/user0.webp';
            userImg.alt = order.username;

            // Set fallback image if the main one doesn't load
            userImg.onerror = () => {
                userImg.src = '/img/users/user0.webp';
            };

            const userDataText = document.createElement('div');
            userDataText.className = 'userdatatext d-flex flex-column';

            const dateSpan = document.createElement('span');
            dateSpan.className = 'date';
            dateSpan.textContent = order.dateOrder;

            const usernameOrderData = document.createElement('div');
            usernameOrderData.className = 'd-flex gap-2 align-items-center';

            const usernameSpan = document.createElement('span');
            usernameSpan.className = 'username';
            usernameSpan.textContent = order.username;

            const idSpan = document.createElement('span');
            idSpan.className = 'id';
            idSpan.textContent = `ID: ${order.idOrder}`;

            orderDiv.appendChild(idSpan);

            usernameOrderData.appendChild(usernameSpan);
            usernameOrderData.appendChild(idSpan);

            userDataText.appendChild(dateSpan);
            userDataText.appendChild(usernameOrderData);
            userDataDiv.appendChild(userImg);
            userDataDiv.appendChild(userDataText);
            orderDiv.appendChild(userDataDiv);

            const orderPillsDiv = document.createElement('div');
            orderPillsDiv.className = 'orderpills p-3 d-flex gap-3 position-absolute top-0 end-0';

            const deliveryPill = document.createElement('div');
            deliveryPill.className = 'orderpill d-flex align-items-center gap-1 px-3 py-2';
            deliveryPill.setAttribute('data-bs-toggle', 'tooltip');
            deliveryPill.setAttribute('data-bs-custom-class', 'custom-tooltip');
            deliveryPill.setAttribute('data-bs-placement', 'bottom');

            let delivery_data = order.getDeliveryData();

            deliveryPill.setAttribute('data-bs-title', delivery_data[2]);
            deliveryPill.innerHTML = `${delivery_data[1]} <span class="flex-grow-1">${delivery_data[0]}</span>`;

            let payment_data = order.getPaymentData();

            const paymentPill = document.createElement('div');
            paymentPill.className = 'orderpill d-flex align-items-center gap-1 px-3 py-2';
            paymentPill.innerHTML = `${payment_data[1]} <span class="flex-grow-1">${payment_data[0]}</span>`;

            orderPillsDiv.appendChild(deliveryPill);
            orderPillsDiv.appendChild(paymentPill);

            if (coupons.length > 0) {
                const couponPill = document.createElement('div');
                couponPill.className = 'orderpill d-flex align-items-center gap-1 px-3 py-2';
                couponPill.setAttribute('data-bs-toggle', 'tooltip');
                couponPill.setAttribute('data-bs-custom-class', 'custom-tooltip');
                couponPill.setAttribute('data-bs-placement', 'bottom');
                couponPill.setAttribute('data-bs-title', coupons.map(coupon => coupon.getSummary()).join(', '));
                couponPill.innerHTML = `<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.5" d="M4.72848 16.1369C3.18295 14.5914 2.41018 13.8186 2.12264 12.816C1.83509 11.8134 2.08083 10.7485 2.57231 8.61875L2.85574 7.39057C3.26922 5.59881 3.47597 4.70292 4.08944 4.08944C4.70292 3.47597 5.5988 3.26922 7.39057 2.85574L8.61875 2.57231C10.7485 2.08083 11.8134 1.83509 12.816 2.12264C13.8186 2.41018 14.5914 3.18295 16.1369 4.72848L17.9665 6.55812C20.6555 9.24711 22 10.5916 22 12.2623C22 13.933 20.6555 15.2775 17.9665 17.9665C15.2775 20.6555 13.933 22 12.2623 22C10.5916 22 9.24711 20.6555 6.55812 17.9665L4.72848 16.1369Z" stroke="#1D63ED" stroke-width="1.5"></path> <path d="M15.3893 15.3891C15.9751 14.8033 16.0542 13.9327 15.5661 13.4445C15.0779 12.9564 14.2073 13.0355 13.6215 13.6213C13.0358 14.2071 12.1652 14.2863 11.677 13.7981C11.1888 13.3099 11.268 12.4393 11.8538 11.8536M15.3893 15.3891L15.7429 15.7426M15.3893 15.3891C14.9883 15.7901 14.4539 15.9537 14 15.8604M11.5002 11.5L11.8538 11.8536M11.8538 11.8536C12.185 11.5223 12.6073 11.3531 13 11.3568" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> <circle cx="8.60699" cy="8.87891" r="2" transform="rotate(-45 8.60699 8.87891)" stroke="#1D63ED" stroke-width="1.5"></circle> </g></svg> <span class="flex-grow-1">${coupons.length} Coupon${coupons.length > 1 ? 's' : ''}</span>`;
                orderPillsDiv.appendChild(couponPill);
            }

            orderDiv.appendChild(orderPillsDiv);

            const orderBottomDiv = document.createElement('div');
            orderBottomDiv.className = 'orderbottom d-flex gap-3 flex-wrap';

            let totalOrderPrice = 0;
            for (const container of containers) {
                const containerDiv = document.createElement('div');
                containerDiv.className = 'ordercontainer container m-0 position-relative';
                containerDiv.setAttribute('data-bs-toggle', 'tooltip');
                containerDiv.setAttribute('data-bs-placement', 'bottom');
                containerDiv.setAttribute('data-bs-custom-class', 'custom-tooltip');

                const rowDiv = document.createElement('div');
                rowDiv.className = 'row row-cols-2';

                const dessertImg = document.createElement('img');
                dessertImg.className = 'dessert col p-0';
                dessertImg.src = `/img/products/product${container.dessert.idProduct}.webp`;
                dessertImg.alt = container.dessert.name;

                const drinkImg = document.createElement('img');
                drinkImg.className = 'drink col p-0';
                drinkImg.src = `/img/products/product${container.drink.idProduct}.webp`;
                drinkImg.alt = container.drink.name;

                const mainImg = document.createElement('img');
                mainImg.className = 'main col p-0';
                mainImg.src = `/img/products/product${container.main.idProduct}.webp`;
                mainImg.alt = container.main.name;

                const branchImg = document.createElement('img');
                branchImg.className = 'branch col p-0';
                branchImg.src = `/img/products/product${container.branch.idProduct}.webp`;
                branchImg.alt = container.branch.name;

                rowDiv.appendChild(dessertImg);
                rowDiv.appendChild(drinkImg);
                rowDiv.appendChild(mainImg);
                rowDiv.appendChild(branchImg);

                let containerPrice = container.getPrice(sales);

                containerDiv.setAttribute('data-bs-title', `Total: ${containerPrice.toFixed(2)} €`);

                const containerPriceInput = document.createElement('input');
                containerPriceInput.className = 'container-euro-price';
                containerPriceInput.type = 'hidden';
                containerPriceInput.value = containerPrice;

                containerDiv.appendChild(rowDiv);
                containerDiv.appendChild(containerPriceInput);

                const deleteButton = document.createElement('button');
                deleteButton.className = 'delete bi bi-x-circle-fill position-absolute top-0 start-100 z-2';

                deleteButton.addEventListener('click', async () => {
                    if (confirm('Are you sure you want to delete this container?')) {
                        const response = await fetch(`/api/deleteContainer`, {
                            method: 'POST',
                            body: JSON.stringify({
                                id: container.idContainer
                            }),
                            headers: {
                                'Content-Type': 'application/json',
                            },
                        });
    
                        const result = await response.json();
    
                        if (!response.ok) {
                            createToast(`Error: ${result['error']}`, 'error');
                        } else {
                            createToast(`Container ${container.idContainer} deleted!`, 'success');
                            orderBottomDiv.removeChild(containerDiv);
                        }
                    }
                });

                containerDiv.appendChild(deleteButton);

                orderBottomDiv.appendChild(containerDiv);

                totalOrderPrice += containerPrice;
            }

            orderDiv.appendChild(orderBottomDiv);

            totalOrderPrice = totalOrderPrice * (1 + parseFloat(target.dataset.tax) / 100);

            // Order sales to get discount type 2 first, then the other ones (apply percentage based discounts before flat discounts for highest savings)
            let orderedSales = sales.sort((b, a) => a.discountType - b.discountType);

            orderedSales.forEach(sale => {
                if (sale.scope === 1) {
                    // Per order
                    totalOrderPrice = sale.applyDiscount(totalOrderPrice);
                }
            });

            // Order coupons to get discount type 2 first, then the other ones (apply percentage based discounts before flat discounts for highest savings)
            let orderedCoupons = coupons.sort((b, a) => a.discountType - b.discountType);

            orderedCoupons.forEach(coupon => {
                totalOrderPrice = coupon.applyDiscount(totalOrderPrice);
            });

            if (order.deliveryAddress) {
                totalOrderPrice += parseFloat(target.dataset.deliveryTax);
            }

            // Round to 2 decimal places
            totalOrderPrice = Math.round(totalOrderPrice * 100) / 100;

            const priceSpan = document.createElement('span');
            priceSpan.className = 'price position-absolute bottom-0 end-0 py-2 px-3';
            priceSpan.textContent = `${totalOrderPrice.toFixed(2)} €`;

            const euroPriceInput = document.createElement('input');
            euroPriceInput.className = 'euro-price';
            euroPriceInput.type = 'hidden';
            euroPriceInput.value = totalOrderPrice;

            orderDiv.appendChild(priceSpan);
            orderDiv.appendChild(euroPriceInput);

            const deleteButton = document.createElement('button');
            deleteButton.className = 'delete order-delete bi bi-x-circle-fill position-absolute top-0 start-100 z-2';
            orderDiv.appendChild(deleteButton);

            orderRow.appendChild(orderDiv);

            deleteButton.addEventListener('click', async () => {
                if (confirm('Are you sure you want to delete this order?')) {
                    const response = await fetch(`/api/deleteOrder`, {
                        method: 'POST',
                        body: JSON.stringify({
                            id: order.idOrder
                        }),
                        headers: {
                            'Content-Type': 'application/json',
                        },
                    });

                    const result = await response.json();

                    if (!response.ok) {
                        createToast(`Error: ${result['error']}`, 'error');
                    } else {
                        createToast(`Order ${order.idOrder} deleted!`, 'success');
                        target.removeChild(orderRow);
                    }
                }
            });

            if (document.getElementById('currency-filter').selectedIndex != 0) {
                // Price is not Euro, convert to selected currency
                const currency = document.getElementById('currency-filter');
                const selectedOption = currency.options[currency.selectedIndex];
                const selectedValue = selectedOption.value; // Gets the value attribute of the option
                const selectedText = selectedOption.text;  // Gets the visible text of the option
    
                // Call the appropriate function with both value and text
                changeCurrency(orderDiv, selectedValue, selectedText);
            }
        }

        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    } catch (error) {
        console.error('Error fetching orders:', error);
    }
}

function orderByDate(order) {
    const target = document.getElementById('target');
    const orders = Array.from(target.getElementsByClassName('order'));

    // Extract the dates and sort the orders
    const sortedOrders = orders.sort((a, b) => {
        const dateA = new Date(a.querySelector('.date').textContent);
        const dateB = new Date(b.querySelector('.date').textContent);
        if (dateA.getTime() === dateB.getTime()) {
            const idA = parseInt(a.querySelector('.id').textContent.replace('ID: ', '').trim());
            const idB = parseInt(b.querySelector('.id').textContent.replace('ID: ', '').trim());
            return order === 'date_order-ASC' ? idA - idB : idB - idA;
        }
        return order === 'date_order-ASC' ? dateA - dateB : dateB - dateA;
    });

    // Clear the current target content
    target.innerHTML = '';

    // Append sorted orders back to the DOM
    sortedOrders.forEach(orderDiv => {
        const orderRow = document.createElement('div');
        orderRow.className = 'row mb-5';
        target.appendChild(orderRow);
        orderRow.appendChild(orderDiv);
    });
}

function orderByPrice(order) {
    const target = document.getElementById('target');
    const orders = Array.from(target.getElementsByClassName('order'));

    // Extract the prices and sort the orders
    const sortedOrders = orders.sort((a, b) => {
        const priceA = parseFloat(a.querySelector('.price').textContent.replace('€', '').trim());
        const priceB = parseFloat(b.querySelector('.price').textContent.replace('€', '').trim());
        return order === 'price-ASC' ? priceA - priceB : priceB - priceA;
    });

    // Clear the current target content
    target.innerHTML = '';

    // Append sorted orders back to the DOM
    sortedOrders.forEach(orderDiv => {
        const orderRow = document.createElement('div');
        orderRow.className = 'row mb-5';
        target.appendChild(orderRow);
        orderRow.appendChild(orderDiv);
    });
}

async function changeCurrency(order, currency, iconText) {
    const currencies = await fetch('https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@latest/v1/currencies/eur.json').then(response => response.json());
    const icon = iconText.split(' ')[0];

    const containers = Array.from(order.getElementsByClassName('ordercontainer'));
    for (const container of containers) {
        const euroPriceInput = container.querySelector('.container-euro-price');
        const euroPrice = parseFloat(euroPriceInput.value);

        let newPrice = euroPrice * currencies.eur[currency];
        newPrice = Math.round(newPrice * 100) / 100;

        container.setAttribute('data-bs-title', `Total: ${newPrice.toFixed(2)} ${icon}`);
    }

    const priceSpan = order.querySelector('.price');
    const euroPriceInput = order.querySelector('.euro-price');
    const euroPrice = parseFloat(euroPriceInput.value);

    let newPrice = euroPrice * currencies.eur[currency];
    newPrice = Math.round(newPrice * 100) / 100;

    priceSpan.textContent = `${newPrice.toFixed(2)} ${icon}`;

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
}

document.getElementById('listorders').addEventListener('click', () => get());

document.getElementById('filter-user').addEventListener('click', getByUser);

// Add event listener to the select element
document.getElementById('order-filter').addEventListener('change', (event) => {
    const selectedValue = event.target.value;

    // Call the appropriate function based on the selected value
    switch (selectedValue) {
        case 'date_order-ASC':
        case 'date_order-DESC':
            orderByDate(selectedValue);
            break;
        case 'price-ASC':
        case 'price-DESC':
            orderByPrice(selectedValue);
            break;
        default:
            console.warn('Unknown option selected');
    }
});

document.getElementById('currency-filter').addEventListener('change', (event) => {
    const selectedOption = event.target.options[event.target.selectedIndex];
    const selectedValue = selectedOption.value; // Gets the value attribute of the option
    const selectedText = selectedOption.text;  // Gets the visible text of the option

    // Store desired currency in local storage
    localStorage.setItem('currency', event.target.selectedIndex);

    // Call the appropriate function with both value and text
    changeCurrency(selectedValue, selectedText);

    const target = document.getElementById('target');
    const orders = Array.from(target.getElementsByClassName('order'));
    for (const order of orders) {
        changeCurrency(order, selectedValue, selectedText);
    }
});