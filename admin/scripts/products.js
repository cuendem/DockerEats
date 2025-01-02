import { Product } from '/admin/classes/Product.js';

function createSpinner() {
    // Get target container to add the elements inside
    const target = document.getElementById('target');
    target.innerHTML = ''; // Clear existing content

    const spinner = document.createElement('div');
    spinner.className = 'spinner-border text-primary';
    spinner.role = 'status';
    spinner.innerHTML = `<span class="visually-hidden">Loading...</span>`;
    target.appendChild(spinner);
}

window.onload = async () => {
    try {
        await get();
    } catch (error) {
        console.error('Error on page load:', error);
    }
};

async function get(type = null, order = null) {
    createSpinner();
    // Get the products by type
    if (type) {
        console.log("Getting all products of type "+type);
        createToast(`Getting all products of type ${type}...`);
    } else {
        console.log("Getting all products");
        createToast(`Getting all products...`);
    }

    let url = 'http://www.dockereats.com/api/getProducts';

    if (type) {
        url += '&type=' + type;
    }

    if (order) {
        url += '&order=' + order;
    }

    let response = await fetch(url);

    if (response.ok) {
        const products = await response.json();
        await listProducts(products);
    } else {
        const target = document.getElementById('target');
        target.innerHTML = 'No products found';
    }
}

async function getDeleted(order = null) {
    createSpinner();
    // Get the products by type
    console.log("Getting all deleted products");
    createToast(`Getting all deleted products...`);

    let response;

    if (order) {
        response = await fetch('http://www.dockereats.com/api/getDeletedProducts&order=' + order);
    } else {
        response = await fetch('http://www.dockereats.com/api/getDeletedProducts');
    }

    if (response.ok) {
        const products = await response.json();
        await listProducts(products);
    } else {
        const target = document.getElementById('target');
        target.innerHTML = 'No products found';
    }
}

// Function to preview images when changing them
function previewImage(event) {
    // Get the file input element
    var fileInput = event.target;

    // Get the selected file
    var file = fileInput.files[0];

    // Find the corresponding preview image element
    var imgElement = document.getElementById(fileInput.dataset.previewTarget);

    if (file && imgElement) {
        // Create a FileReader
        var reader = new FileReader();

        // Set up the FileReader to update the image source when the file is read
        reader.onload = function (e) {
            imgElement.src = e.target.result;
        };

        // Read the selected file as a data URL
        reader.readAsDataURL(file);
    }
}

async function listProducts(productsJson) {
    try {
        // Get the categories
        let response = await fetch('http://www.dockereats.com/api/getCategories');
        const categories = await response.json();

        // Get the product / categories links
        response = await fetch('http://www.dockereats.com/api/getCategoriesProducts');
        const categoriesProducts = await response.json();

        // Get the allergens
        response = await fetch('http://www.dockereats.com/api/getAllergens');
        const allergens = await response.json();

        // Get the product / allergens links
        response = await fetch('http://www.dockereats.com/api/getAllergensProducts');
        const allergensProducts = await response.json();

        const products = productsJson.map(productJson => new Product(productJson));

        // Get target container to add the elements inside
        const target = document.getElementById('target');
        target.innerHTML = ''; // Clear existing content

        // // Add filter select to target (order by name or price)
        // const filterSelect = document.createElement('select');
        // filterSelect.className = 'filter-select';
        // filterSelect.innerHTML = `<option value="0">Order...</option><option value="1">Name</option><option value="2">Price</option>`;
        // target.appendChild(filterSelect);

        const productList = document.createElement('div');
        productList.className = 'product-list d-flex gap-4 flex-wrap justify-content-center';
        target.appendChild(productList); // Add product-list to target

        // Iterate through each product
        products.forEach((product, index) => {
            // Initialize the product's container form
            const productForm = document.createElement('form');
            productForm.className = 'list-card d-flex position-relative';
            productForm.enctype = "multipart/form-data";
            productForm.method = "POST";
            productForm.accept = "image/*";

            if (product.deleted == 1) {
                productForm.classList.add('deleted');
            }

            // Filter and map the categories to only get the ones where the product is
            const belongedCats = categoriesProducts.filter(catpro => catpro.id_product === product.idProduct).map(catpro => catpro.id_category);

            // Generate category options
            let categoryOptions = categories.map(category => {
                const isSelected = belongedCats && belongedCats.includes(category.id_category) ? 'selected' : '';
                return `<option value="${category.id_category}" ${isSelected}>${category.name}</option>`;
            }).join('');

            // Filter and map the allergens to only get the ones where the product is
            const belongedAl = allergensProducts.filter(alpro => alpro.id_product === product.idProduct).map(alpro => alpro.id_allergen);

            // Generate allergen options
            let allergenOptions = allergens.map(allergen => {
                const isSelected = belongedAl && belongedAl.includes(allergen.id_allergen) ? 'selected' : '';
                return `<option value="${allergen.id_allergen}" ${isSelected}>${allergen.name}</option>`;
            }).join('');

            productForm.innerHTML = `
                <div class="d-flex flex-column align-items-center">
                    <div id="preview-image-container${product.idProduct}" class="preview-image-container position-relative">
                        <img id="preview-image${product.idProduct}" class="preview-image" src="${'/img/products/product'+product.idProduct+'.webp' || '/img/products/product0.webp'}" alt="${product.name}">
                        <label id="preview-image-label${product.idProduct}" class="preview-image-label position-absolute" for="image${product.idProduct}">
                            <span class="label-bg"></span>
                            <svg viewBox="0 0 24.00 24.00" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.2639 15.9376L12.5958 14.2835C11.7909 13.4852 11.3884 13.0861 10.9266 12.9402C10.5204 12.8119 10.0838 12.8166 9.68048 12.9537C9.22188 13.1096 8.82814 13.5173 8.04068 14.3327L4.04409 18.2802M14.2639 15.9376L14.6053 15.5991C15.4112 14.7999 15.8141 14.4003 16.2765 14.2544C16.6831 14.1262 17.12 14.1312 17.5236 14.2688C17.9824 14.4252 18.3761 14.834 19.1634 15.6515L20 16.4936M14.2639 15.9376L18.275 19.9566M18.275 19.9566C17.9176 20.0001 17.4543 20.0001 16.8 20.0001H7.2C6.07989 20.0001 5.51984 20.0001 5.09202 19.7821C4.71569 19.5904 4.40973 19.2844 4.21799 18.9081C4.12796 18.7314 4.07512 18.5322 4.04409 18.2802M18.275 19.9566C18.5293 19.9257 18.7301 19.8728 18.908 19.7821C19.2843 19.5904 19.5903 19.2844 19.782 18.9081C20 18.4803 20 17.9202 20 16.8001V16.4936M12.5 4L7.2 4.00011C6.07989 4.00011 5.51984 4.00011 5.09202 4.21809C4.71569 4.40984 4.40973 4.7158 4.21799 5.09213C4 5.51995 4 6.08 4 7.20011V16.8001C4 17.4576 4 17.9222 4.04409 18.2802M20 11.5V16.4936M14 10.0002L16.0249 9.59516C16.2015 9.55984 16.2898 9.54219 16.3721 9.5099C16.4452 9.48124 16.5146 9.44407 16.579 9.39917C16.6515 9.34859 16.7152 9.28492 16.8425 9.1576L21 5.00015C21.5522 4.44787 21.5522 3.55244 21 3.00015C20.4477 2.44787 19.5522 2.44787 19 3.00015L14.8425 7.1576C14.7152 7.28492 14.6515 7.34859 14.6009 7.42112C14.556 7.4855 14.5189 7.55494 14.4902 7.62801C14.4579 7.71033 14.4403 7.79862 14.4049 7.97518L14 10.0002Z" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </label>
                        <input type="file" name="image" id="image${product.idProduct}" accept="image/*" data-preview-target="preview-image${product.idProduct}">
                    </div>
                    <div class="d-flex flex-column align-items-center justify-content-around py-3 h-100">
                        <input type="submit" id="update${product.idProduct}" class="update" value="Update">
                        <input type="submit" id="delete${product.idProduct}" class="delete" value="Delete">
                    </div>
                </div>
                <div class="data d-flex flex-column p-3 gap-2">
                    <span class="id position-absolute bottom-0 end-0">ID: ${product.idProduct}</span>
                    <input type="number" name="id" id="id${product.idProduct}" value="${product.idProduct}" hidden>
                    <input type="number" name="deleted" id="deleted${product.idProduct}" value="${product.deleted}" hidden>
                    <input type="text" name="name" id="name${product.idProduct}" value="${product.name}" placeholder="${product.name}">
                    <div class="d-flex gap-2 align-items-center">
                        <input type="number" name="price" id="price${product.idProduct}" value="${product.price}" placeholder="${product.price}" step="0.01">
                        <input type="number" name="europrice" id="europrice${product.idProduct}" value="${product.price}" hidden>
                        <span class="currency">€</span>
                    </div>
                    <select name="type" id="type${product.idProduct}">
                        <option value="1" ${product.idType == 1 ? "selected" : ""}>Main</option>
                        <option value="2" ${product.idType == 2 ? "selected" : ""}>Branch</option>
                        <option value="3" ${product.idType == 3 ? "selected" : ""}>Drink</option>
                        <option value="4" ${product.idType == 4 ? "selected" : ""}>Dessert</option>
                    </select>
                    <select data-placeholder="Add some categories..." name="categories" id="categories${product.idProduct}" multiple class="chosen-select">
                        ${categoryOptions}
                    </select>
                    <select data-placeholder="Add some allergens..." name="allergens" id="allergens${product.idProduct}" multiple class="chosen-select">
                        ${allergenOptions}
                    </select>
                </div>
            `;

            productForm.addEventListener('submit', async function (event) {
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
                const categoriesSelect = document.getElementById(`categories${product.idProduct}`);
                const selectedCategories = Array.from(categoriesSelect.selectedOptions).map(option => option.value);
                const categoriesString = selectedCategories.join(',');

                formData.set('categories', categoriesString);

                // Get the allergens multi-select element
                const allergensSelect = document.getElementById(`allergens${product.idProduct}`);
                const selectedAllergens = Array.from(allergensSelect.selectedOptions).map(option => option.value);
                const allergensString = selectedAllergens.join(',');

                // Append the allergens string to the FormData
                formData.set('allergens', allergensString);

                createToast(`Updating ${formData.get('name')}...`);

                try {
                    const response = await fetch('http://www.dockereats.com/api/editProduct', {
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
                const productId = formData.get('id');
                const deletedInput = document.getElementById(`deleted${product.idProduct}`);
                const deleted = (deletedInput.value == 0 ? 1 : 0);

                if (deleted == 1) {
                    createToast(`Marking ${formData.get('name')} as deleted...`);
                } else {
                    createToast(`Unmarking ${formData.get('name')} as deleted...`);
                }

                try {
                    const response = await fetch(`http://www.dockereats.com/api/deleteProduct`, {
                        method: 'POST',
                        body: JSON.stringify({
                            id: productId,
                            deleted: deleted
                        }),
                        headers: {
                            'Content-Type': 'application/json',
                        },
                    });

                    const result = await response.json();

                    if (!response.ok) {
                        createToast(`Error: ${result['error']}`, 'error');
                    } else {
                        productForm.classList.toggle('deleted');
                        if (deletedInput.value == 1) {
                            createToast(`${formData.get('name')} unmarked as deleted!`, 'success');
                            deletedInput.value = 0;
                        } else {
                            createToast(`${formData.get('name')} marked as deleted!`, 'success');
                            deletedInput.value = 1;
                        }
                    }
                } catch (error) {
                    console.error(error);
                }
            }

            productList.appendChild(productForm);

            // Attach event listener to the image file input
            document.getElementById(`image${product.idProduct}`).addEventListener('change', previewImage);

            if (document.getElementById('currency-filter').selectedIndex != 0) {
                // Price is not Euro, convert to selected currency
                const currency = document.getElementById('currency-filter');
                const selectedOption = currency.options[currency.selectedIndex];
                const selectedValue = selectedOption.value; // Gets the value attribute of the option
                const selectedText = selectedOption.text;  // Gets the visible text of the option
    
                // Call the appropriate function with both value and text
                changeCurrency(selectedValue, selectedText);
            }
        });

    $(".chosen-select").chosen();
    } catch (error) {
        console.error('Error fetching products:', error);
    }
}

async function createProduct() {
    // Get the categories
    let response = await fetch('http://www.dockereats.com/api/getCategories');
    const categories = await response.json();

    // Get the allergens
    response = await fetch('http://www.dockereats.com/api/getAllergens');
    const allergens = await response.json();

    // Get target container to add the elements inside, create the product-list container
    const target = document.getElementById('target');
    target.innerHTML = ''; // Clear existing content

    const productNew = document.createElement('div');
    productNew.className = 'product-new d-flex gap-4 justify-content-center';
    target.appendChild(productNew); // Add product-list to target

    // Initialize the product's container form
    const productForm = document.createElement('form');
    productForm.className = 'list-card d-flex position-relative';
    productForm.enctype = "multipart/form-data";
    productForm.method = "POST";
    productForm.accept = "image/*";

    // Generate category options
    let categoryOptions = categories.map(category => {
        return `<option value="${category.id_category}">${category.name}</option>`;
    }).join('');

    // Generate allergen options
    let allergenOptions = allergens.map(allergen => {
        return `<option value="${allergen.id_allergen}">${allergen.name}</option>`;
    }).join('');

    productForm.innerHTML = `
        <div class="d-flex flex-column align-items-center">
            <div id="preview-image-container" class="preview-image-container position-relative">
                <img id="preview-image" class="preview-image" src="/img/products/product0.webp" alt="New product">
                <label id="preview-image-label" class="preview-image-label position-absolute" for="image">
                    <span class="label-bg"></span>
                    <svg viewBox="0 0 24.00 24.00" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.2639 15.9376L12.5958 14.2835C11.7909 13.4852 11.3884 13.0861 10.9266 12.9402C10.5204 12.8119 10.0838 12.8166 9.68048 12.9537C9.22188 13.1096 8.82814 13.5173 8.04068 14.3327L4.04409 18.2802M14.2639 15.9376L14.6053 15.5991C15.4112 14.7999 15.8141 14.4003 16.2765 14.2544C16.6831 14.1262 17.12 14.1312 17.5236 14.2688C17.9824 14.4252 18.3761 14.834 19.1634 15.6515L20 16.4936M14.2639 15.9376L18.275 19.9566M18.275 19.9566C17.9176 20.0001 17.4543 20.0001 16.8 20.0001H7.2C6.07989 20.0001 5.51984 20.0001 5.09202 19.7821C4.71569 19.5904 4.40973 19.2844 4.21799 18.9081C4.12796 18.7314 4.07512 18.5322 4.04409 18.2802M18.275 19.9566C18.5293 19.9257 18.7301 19.8728 18.908 19.7821C19.2843 19.5904 19.5903 19.2844 19.782 18.9081C20 18.4803 20 17.9202 20 16.8001V16.4936M12.5 4L7.2 4.00011C6.07989 4.00011 5.51984 4.00011 5.09202 4.21809C4.71569 4.40984 4.40973 4.7158 4.21799 5.09213C4 5.51995 4 6.08 4 7.20011V16.8001C4 17.4576 4 17.9222 4.04409 18.2802M20 11.5V16.4936M14 10.0002L16.0249 9.59516C16.2015 9.55984 16.2898 9.54219 16.3721 9.5099C16.4452 9.48124 16.5146 9.44407 16.579 9.39917C16.6515 9.34859 16.7152 9.28492 16.8425 9.1576L21 5.00015C21.5522 4.44787 21.5522 3.55244 21 3.00015C20.4477 2.44787 19.5522 2.44787 19 3.00015L14.8425 7.1576C14.7152 7.28492 14.6515 7.34859 14.6009 7.42112C14.556 7.4855 14.5189 7.55494 14.4902 7.62801C14.4579 7.71033 14.4403 7.79862 14.4049 7.97518L14 10.0002Z" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </label>
                <input type="file" name="image" id="image" accept="image/*" data-preview-target="preview-image">
            </div>
            <div class="d-flex flex-column align-items-center justify-content-center py-3 h-100">
                <input type="submit" id="create" class="update" value="Create">
            </div>
        </div>
        <div class="data d-flex flex-column p-3 gap-2">
            <input type="text" name="name" id="name" placeholder="Name...">
            <div class="d-flex gap-2 align-items-center">
                <input type="number" name="price" id="price" step="0.01" placeholder="Price...">
                <span class="currency">€</span>
            </div>
            <select name="type" id="type">
                <option value="1">Main</option>
                <option value="2">Branch</option>
                <option value="3">Drink</option>
                <option value="4">Dessert</option>
            </select>
            <select data-placeholder="Add some categories..." name="categories" id="categories" multiple class="chosen-select">
                ${categoryOptions}
            </select>
            <select data-placeholder="Add some allergens..." name="allergens" id="allergens" multiple class="chosen-select">
                ${allergenOptions}
            </select>
        </div>
    `;

    // Attach submit event listener to the form
    productForm.addEventListener('submit', async function (event) {
        event.preventDefault(); // Prevent the default form submission behavior

        // Create a FormData object to collect the form inputs
        let formData = new FormData(this);

        // Get the categories multi-select element
        const categoriesSelect = document.getElementById(`categories`);
        const selectedCategories = Array.from(categoriesSelect.selectedOptions).map(option => option.value);
        const categoriesString = selectedCategories.join(',');

        // Append the categories string to the FormData
        formData.set('categories', categoriesString);

        // Get the allergens multi-select element
        const allergensSelect = document.getElementById(`allergens`);
        const selectedAllergens = Array.from(allergensSelect.selectedOptions).map(option => option.value);
        const allergensString = selectedAllergens.join(',');

        // Append the allergens string to the FormData
        formData.set('allergens', allergensString);

        // Notification toast
        createToast(`Creating ${formData.get('name')}...`);

        try {
            const response = await fetch('http://www.dockereats.com/api/createProduct', {
                method: 'POST',
                body: formData, // Send the form data
            });

            const result = await response.json();

            if (!response.ok) {
                createToast(`Error: ${result['error']}`, 'error');
            } else {
                // Create confirmation toast
                createToast(`Product ${formData.get('name')} created succesfully!`, 'success');
                getAll(); // Refresh the list of products
            }
        } catch (error) {
            console.error(error);
        }
    });

    productNew.appendChild(productForm);

    // Attach event listener to the image file input
    document.getElementById(`image`).addEventListener('change', previewImage);

    $(".chosen-select").chosen();
}

async function changeCurrency(currency, iconText) {
    const currencies = await fetch('https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@latest/v1/currencies/eur.json').then(response => response.json());
    const target = document.getElementById('target');
    const products = Array.from(target.getElementsByClassName('list-card'));
    const icon = iconText.split(' ')[0];

    products.forEach(product => {
        const price = product.querySelector('.data input[name="price"]');
        const europrice = product.querySelector('.data input[name="europrice"]');
        const currencySpan = product.querySelector('.data .currency');

        price.value = Math.round(europrice.value * currencies.eur[currency] * 100) / 100;
        currencySpan.textContent = icon;
    });
}

// Add event listener to the select element
document.getElementById('type-filter').addEventListener('change', (event) => {
    const selectedValue = event.target.value;
    const orderValue = document.getElementById('order-filter').value;

    // Call the appropriate function based on the selected value
    switch (selectedValue) {
        case 'all':
            get(null, orderValue);
            break;
        case '1':
            get(1, orderValue);
            break;
        case '2':
            get(2, orderValue);
            break;
        case '3':
            get(3, orderValue);
            break;
        case '4':
            get(4, orderValue);
            break;
        case 'deleted':
            getDeleted(orderValue);
            break;
        default:
            console.warn('Unknown option selected');
    }
});

// Add event listener to the select element
document.getElementById('order-filter').addEventListener('change', (event) => {
    const selectedValue = event.target.value;
    const typeValue = document.getElementById('type-filter').value;

    // Call the appropriate function based on the selected value
    switch (typeValue) {
        case 'all':
            get(null, selectedValue);
            break;
        case '1':
            get(1, selectedValue);
            break;
        case '2':
            get(2, selectedValue);
            break;
        case '3':
            get(3, selectedValue);
            break;
        case '4':
            get(4, selectedValue);
            break;
        case 'deleted':
            getDeleted(selectedValue);
            break;
        default:
            console.warn('Unknown option selected');
    }
});

// Add event listener to the select element
document.getElementById('currency-filter').addEventListener('change', (event) => {
    const selectedOption = event.target.options[event.target.selectedIndex];
    const selectedValue = selectedOption.value; // Gets the value attribute of the option
    const selectedText = selectedOption.text;  // Gets the visible text of the option

    // Call the appropriate function with both value and text
    changeCurrency(selectedValue, selectedText);
});

document.getElementById('createproduct').addEventListener('click', () => createProduct());