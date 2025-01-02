import { Sale } from '/admin/classes/Sale.js';

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

window.onload = async () => {
    try {
        await getAll();
    } catch (error) {
        console.error('Error on page load:', error);
    }
};

async function getAll() {
    createSpinner();
    // Get the sales
    console.log("Getting all sales");
    createToast("Getting all sales...");

    let response = await fetch('http://www.dockereats.com/api/getSales');

    if (response.ok) {
        const sales = await response.json();
        await listSales(sales);
    } else {
        const target = document.getElementById('target');
        target.innerHTML = '<div class="d-flex justify-content-center align-items-center">No sales found</div>';
    }
}

async function getCurrent() {
    createSpinner();
    // Get the sales
    console.log("Getting current sales");
    createToast("Getting current sales...");

    let response = await fetch('http://www.dockereats.com/api/getCurrentSales');

    if (response.ok) {
        const sales = await response.json();
        await listSales(sales);
    } else {
        const target = document.getElementById('target');
        target.innerHTML = '<div class="d-flex justify-content-center align-items-center">No sales found</div>';
    }
}

async function getFuture() {
    createSpinner();
    // Get the sales
    console.log("Getting future sales");
    createToast("Getting future sales...");

    let response = await fetch('http://www.dockereats.com/api/getFutureSales');

    if (response.ok) {
        const sales = await response.json();
        await listSales(sales);
    } else {
        const target = document.getElementById('target');
        target.innerHTML = '<div class="d-flex justify-content-center align-items-center">No sales found</div>';
    }
}

async function getEnded() {
    createSpinner();
    // Get the sales
    console.log("Getting ended sales");
    createToast("Getting ended sales...");

    let response = await fetch('http://www.dockereats.com/api/getEndedSales');

    if (response.ok) {
        const sales = await response.json();
        await listSales(sales);
    } else {
        const target = document.getElementById('target');
        target.innerHTML = '<div class="d-flex justify-content-center align-items-center">No sales found</div>';
    }
}

async function listSales(salesJson) {
    try {
        // Get the categories
        let response = await fetch('http://www.dockereats.com/api/getCategories');
        const categories = await response.json();

        const sales = salesJson.map(saleData => new Sale(saleData));

        // Get target container to add the elements inside
        const target = document.getElementById('target');
        target.innerHTML = ''; // Clear existing content

        for (const sale of sales) {
            const saleElement = document.createElement('div');
            saleElement.className = 'row mb-5';

            // Generate category options
            let categoryOptions = categories.map(category => {
                const isSelected = sale.categoryAffected == category.id_category ? 'selected' : '';
                return `<option value="${category.id_category}" ${isSelected}>${category.name}</option>`;
            }).join('');

            saleElement.innerHTML = `
                <form class="sale p-3 col-md-12 col-lg-10 col-xl-8 mx-auto position-relative d-flex justify-content-between">
                    <div class="d-flex flex-column justify-content-between">
                        <div class="d-flex flex-column align-items-start gap-1">
                            <input id="name${sale.idSale}" name="name" type="text" placeholder="Name" value="${sale.name}">
                            <div class="d-flex align-items-center gap-1">
                                <input id="datestart${sale.idSale}" name="datestart" type="date" value="${sale.dateStart}">
                                <span class="minus">-</span>
                                <input id="dateend${sale.idSale}" name="dateend" type="date" value="${sale.dateEnd}">
                            </div>
                            <input type="number" name="id" id="id${sale.idSale}" value="${sale.idSale}" hidden>
                        </div>
                        <textarea id="description${sale.idSale}" name="description" placeholder="Description">${sale.description}</textarea>
                    </div>
                    <div class="d-flex flex-column justify-content-between align-items-end">
                        <div class="d-flex align-items-center gap-1">
                            <select id="producttype${sale.idSale}" name="producttype">
                                <option value="0" ${sale.productType == 0 ? "selected" : ""}>Any</option>
                                <option value="1" ${sale.productType == 1 ? "selected" : ""}>Main</option>
                                <option value="2" ${sale.productType == 2 ? "selected" : ""}>Branch</option>
                                <option value="3" ${sale.productType == 3 ? "selected" : ""}>Drink</option>
                                <option value="4" ${sale.productType == 4 ? "selected" : ""}>Dessert</option>
                            </select>
                            <select id="categoryaffected${sale.idSale}" name="categoryaffected">
                                <option value="0">Any</option>
                                ${categoryOptions}
                            </select>
                            <select id="scope${sale.idSale}" name="scope">
                                <option value="1" ${sale.scope == 1 ? "selected" : ""}>Order</option>
                                <option value="2" ${sale.scope == 2 ? "selected" : ""}>Product</option>
                            </select>
                        </div>
                        <div class="d-flex align-items-center gap-1">
                            <input id="discount${sale.idSale}" name="discount" type="number" placeholder="Discount" value="${sale.discount}">
                            <select id="discounttype${sale.idSale}" name="discounttype" class="me-3">
                                <option value="1" ${sale.discountType == 1 ? "selected" : ""}>€</option>
                                <option value="2" ${sale.discountType == 2 ? "selected" : ""}>%</option>
                            </select>
                            <input type="submit" id="update${sale.idSale}" class="update" value="Update">
                            <input type="submit" id="delete${sale.idSale}" class="delete" value="Delete">
                        </div>
                        <span class="id position-absolute bottom-0 end-0">ID: ${sale.idSale}</span>
                    </div>
                </form>
            `;

            saleElement.addEventListener('submit', async function (event) {
                event.preventDefault(); // Prevent the default form submission behavior

                // Determine which button was pressed
                const isUpdate = event.submitter && event.submitter.classList.contains('update');
                const isDelete = event.submitter && event.submitter.classList.contains('delete');

                if (isUpdate) {
                    handleUpdate(event);  // Handle update logic
                } else if (isDelete) {
                    handleDelete(event);  // Handle delete logic
                }
            });

            async function handleUpdate(event) {
                const formData = new FormData(event.target);
                createToast(`Updating ${formData.get('name')}...`);

                try {
                    const response = await fetch('http://www.dockereats.com/api/editSale', {
                        method: 'POST',
                        body: formData, // Send the form data
                    });

                    const result = await response.json();

                    if (!response.ok) {
                        createToast(`Error: ${result['error']}`, 'error');
                    } else {
                        createToast(`${formData.get('name')} updated successfully!`, 'success');
                    }
                } catch (error) {
                    console.error(error);
                }
            }

            async function handleDelete(event) {
                const formData = new FormData(event.target);
                const saleId = formData.get('id');

                createToast(`Deleting ${formData.get('name')}...`);

                try {
                    const response = await fetch('http://www.dockereats.com/api/deleteSale', {
                        method: 'POST',
                        body: JSON.stringify({
                            id: saleId
                        }),
                        headers: {
                            'Content-Type': 'application/json',
                        },
                    });

                    const result = await response.json();

                    if (!response.ok) {
                        createToast(`Error: ${result['error']}`, 'error');
                    } else {
                        createToast(`${formData.get('name')} deleted!`, 'success');
                        target.removeChild(saleElement);
                    }
                } catch (error) {
                    console.error(error);
                }
            }

            target.appendChild(saleElement);
        }
    } catch (error) {
        console.error('Error fetching sales:', error);
    }
}

async function addSale() {
    try {
        // Get the categories
        let response = await fetch('http://www.dockereats.com/api/getCategories');
        const categories = await response.json();

        // Get target container to add the elements inside
        const target = document.getElementById('target');
        target.innerHTML = ''; // Clear existing content

        const saleElement = document.createElement('div');
        saleElement.className = 'row mb-5';

        // Generate category options
        let categoryOptions = categories.map(category => {
            return `<option value="${category.id_category}">${category.name}</option>`;
        }).join('');

        const saleForm = document.createElement('form');
        saleForm.id = 'created-sale';
        saleForm.className = 'sale p-3 col-md-12 col-lg-10 col-xl-8 mx-auto position-relative d-flex justify-content-between';
        saleForm.innerHTML = `
            <div class="d-flex flex-column justify-content-between">
                <div class="d-flex flex-column align-items-start gap-1">
                <input id="name" name="name" type="text" placeholder="Name...">
                <div class="d-flex align-items-center gap-1">
                    <input id="datestart" name="datestart" type="date" value="${new Date().toISOString().split('T')[0]}">
                    <span class="minus">-</span>
                    <input id="dateend" name="dateend" type="date" value="${new Date(Date.now() + 7 * 24 * 60 * 60 * 1000).toISOString().split('T')[0]}">
                </div>
                </div>
                <textarea id="description" name="description" placeholder="Description"></textarea>
            </div>
            <div class="d-flex flex-column justify-content-between align-items-end">
                <div class="d-flex align-items-center gap-1">
                <select id="producttype" name="producttype">
                    <option value="0">Any</option>
                    <option value="1">Main</option>
                    <option value="2">Branch</option>
                    <option value="3">Drink</option>
                    <option value="4">Dessert</option>
                </select>
                <select id="categoryaffected" name="categoryaffected">
                    <option value="0">Any</option>
                    ${categoryOptions}
                </select>
                <select id="scope" name="scope">
                    <option value="1">Order</option>
                    <option value="2">Product</option>
                </select>
                </div>
                <div class="d-flex align-items-center gap-1">
                <input id="discount" name="discount" type="number" placeholder="Discount...">
                <select id="discounttype" name="discounttype" class="me-3">
                    <option value="1">€</option>
                    <option value="2">%</option>
                </select>
                <input type="submit" id="create" class="update" value="Create">
                </div>
            </div>
        `;

        // Attach submit event listener to the form
        saleForm.addEventListener('submit', async function (event) {
            event.preventDefault(); // Prevent the default form submission behavior

            // Create a FormData object to collect the form inputs
            let formData = new FormData(this);

            // Notification toast
            createToast(`Creating ${formData.get('name')}...`);

            try {
                const response = await fetch('http://www.dockereats.com/api/createSale', {
                    method: 'POST',
                    body: formData, // Send the form data
                });

                const result = await response.json();

                if (!response.ok) {
                    createToast(`Error: ${result['error']}`, 'error');
                } else {
                    // Create confirmation toast
                    createToast(`Sale ${formData.get('name')} created succesfully!`, 'success');
                    getAll(); // Refresh the list of sales
                }
            } catch (error) {
                console.error(error);
            }
        });

        saleElement.appendChild(saleForm);
        target.appendChild(saleElement);
    } catch (error) {
        console.error('Error fetching sales:', error);
    }
}

document.getElementById('listsales').addEventListener('click', getAll);
document.getElementById('listcurrent').addEventListener('click', getCurrent);
document.getElementById('listfuture').addEventListener('click', getFuture);
document.getElementById('listended').addEventListener('click', getEnded);
document.getElementById('create').addEventListener('click', addSale);