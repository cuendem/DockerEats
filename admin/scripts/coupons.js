import { Coupon } from '/admin/classes/Coupon.js';

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
    // Get the coupons
    console.log("Getting all coupons");
    createToast("Getting all coupons...");

    let response = await fetch('/api/getCoupons');

    if (response.ok) {
        const coupons = await response.json();
        await listCoupons(coupons);
    } else {
        const target = document.getElementById('target');
        target.innerHTML = '<div class="d-flex justify-content-center align-items-center">No coupons found</div>';
    }
}

async function getCurrent() {
    createSpinner();
    // Get the coupons
    console.log("Getting current coupons");
    createToast("Getting current coupons...");

    let response = await fetch('/api/getCurrentCoupons');

    if (response.ok) {
        const coupons = await response.json();
        await listCoupons(coupons);
    } else {
        const target = document.getElementById('target');
        target.innerHTML = '<div class="d-flex justify-content-center align-items-center">No coupons found</div>';
    }
}

async function getFuture() {
    createSpinner();
    // Get the coupons
    console.log("Getting future coupons");
    createToast("Getting future coupons...");

    let response = await fetch('/api/getFutureCoupons');

    if (response.ok) {
        const coupons = await response.json();
        await listCoupons(coupons);
    } else {
        const target = document.getElementById('target');
        target.innerHTML = '<div class="d-flex justify-content-center align-items-center">No coupons found</div>';
    }
}

async function getExpired() {
    createSpinner();
    // Get the coupons
    console.log("Getting expired coupons");
    createToast("Getting expired coupons...");

    let response = await fetch('/api/getExpiredCoupons');

    if (response.ok) {
        const coupons = await response.json();
        await listCoupons(coupons);
    } else {
        const target = document.getElementById('target');
        target.innerHTML = '<div class="d-flex justify-content-center align-items-center">No coupons found</div>';
    }
}

async function listCoupons(couponsJson) {
    try {
        const coupons = couponsJson.map(couponData => new Coupon(couponData));

        // Get target container to add the elements inside
        const target = document.getElementById('target');
        target.innerHTML = ''; // Clear existing content

        for (const coupon of coupons) {
            const couponElement = document.createElement('div');
            couponElement.className = 'row mb-5';
            couponElement.innerHTML = `
                <form class="coupon p-3 col-md-12 col-lg-10 col-xl-8 mx-auto position-relative d-flex justify-content-between">
                    <div class="d-flex flex-column justify-content-between">
                        <div class="d-flex flex-column align-items-start gap-1">
                            <input id="code${coupon.idCoupon}" name="code" type="text" placeholder="Code" value="${coupon.code}">
                            <div class="d-flex align-items-center gap-1">
                                <input id="datestart${coupon.idCoupon}" name="datestart" type="date" value="${coupon.dateStart}">
                                <span class="minus">-</span>
                                <input id="dateend${coupon.idCoupon}" name="dateend" type="date" value="${coupon.dateEnd}">
                            </div>
                            <input type="number" name="id" id="id${coupon.idCoupon}" value="${coupon.idCoupon}" hidden>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                        <input id="discount${coupon.idCoupon}" name="discount" type="number" placeholder="Discount" value="${coupon.discount}">
                        <select id="discounttype${coupon.idCoupon}" name="discounttype" class="me-3">
                            <option value="1" ${coupon.discountType == 1 ? "selected" : ""}>€</option>
                            <option value="2" ${coupon.discountType == 2 ? "selected" : ""}>%</option>
                        </select>
                        <input type="submit" id="update${coupon.idCoupon}" class="update" value="Update">
                        <input type="submit" id="delete${coupon.idCoupon}" class="delete" value="Delete">
                    </div>
                    <span class="id position-absolute bottom-0 end-0">ID: ${coupon.idCoupon}</span>
                </form>
            `;

            couponElement.addEventListener('submit', async function (event) {
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
                createToast(`Updating ${formData.get('code')}...`);

                try {
                    const response = await fetch('/api/editCoupon', {
                        method: 'POST',
                        body: formData, // Send the form data
                    });

                    const result = await response.json();

                    if (!response.ok) {
                        createToast(`Error: ${result['error']}`, 'error');
                    } else {
                        createToast(`${formData.get('code')} updated successfully!`, 'success');
                    }
                } catch (error) {
                    console.error(error);
                }
            }

            async function handleDelete(event) {
                const formData = new FormData(event.target);
                const couponId = formData.get('id');

                createToast(`Deleting ${formData.get('code')}...`);

                try {
                    const response = await fetch('/api/deleteCoupon', {
                        method: 'POST',
                        body: JSON.stringify({
                            id: couponId
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
                        target.removeChild(couponElement);
                    }
                } catch (error) {
                    console.error(error);
                }
            }

            target.appendChild(couponElement);
        }
    } catch (error) {
        console.error('Error fetching coupons:', error);
    }
}

async function addCoupon() {
    try {
        // Get the categories
        let response = await fetch('/api/getCategories');
        const categories = await response.json();

        // Get target container to add the elements inside
        const target = document.getElementById('target');
        target.innerHTML = ''; // Clear existing content

        const couponElement = document.createElement('div');
        couponElement.className = 'row mb-5';

        // Generate category options
        let categoryOptions = categories.map(category => {
            return `<option value="${category.id_category}">${category.name}</option>`;
        }).join('');

        const couponForm = document.createElement('form');
        couponForm.id = 'created-coupon';
        couponForm.className = 'coupon p-3 col-md-12 col-lg-10 col-xl-8 mx-auto position-relative d-flex justify-content-between';
        couponForm.innerHTML = `
            <div class="d-flex flex-column justify-content-between">
                <div class="d-flex flex-column align-items-start gap-1">
                    <input id="code" name="code" type="text" placeholder="Code...">
                    <div class="d-flex align-items-center gap-1">
                        <input id="datestart" name="datestart" type="date" value="${new Date().toISOString().split('T')[0]}">
                        <span class="minus">-</span>
                        <input id="dateend" name="dateend" type="date" value="${new Date(Date.now() + 7 * 24 * 60 * 60 * 1000).toISOString().split('T')[0]}">
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center gap-1">
                <input id="discount" name="discount" type="number" placeholder="Discount...">
                <select id="discounttype" name="discounttype" class="me-3">
                    <option value="1">€</option>
                    <option value="2">%</option>
                </select>
                <input type="submit" id="create" class="update" value="Create">
            </div>
        `;

        // Attach submit event listener to the form
        couponForm.addEventListener('submit', async function (event) {
            event.preventDefault(); // Prevent the default form submission behavior

            // Create a FormData object to collect the form inputs
            let formData = new FormData(this);

            // Notification toast
            createToast(`Creating ${formData.get('code')}...`);

            try {
                const response = await fetch('/api/createCoupon', {
                    method: 'POST',
                    body: formData, // Send the form data
                });

                const result = await response.json();

                if (!response.ok) {
                    createToast(`Error: ${result['error']}`, 'error');
                } else {
                    // Create confirmation toast
                    createToast(`Coupon ${formData.get('code')} created succesfully!`, 'success');
                    getAll(); // Refresh the list of coupons
                }
            } catch (error) {
                console.error(error);
            }
        });

        couponElement.appendChild(couponForm);
        target.appendChild(couponElement);
    } catch (error) {
        console.error('Error fetching coupons:', error);
    }
}

document.getElementById('listcoupons').addEventListener('click', getAll);
document.getElementById('listcurrent').addEventListener('click', getCurrent);
document.getElementById('listfuture').addEventListener('click', getFuture);
document.getElementById('listexpired').addEventListener('click', getExpired);
document.getElementById('create').addEventListener('click', addCoupon);