const API_URL = "http://www.dockereats.com/api/";

async function getProducts() {
    try {
        let response = await fetch(API_URL + 'getProducts');
        const products = await response.json();

        response = await fetch(API_URL + 'getCategories');
        const categories = await response.json();

        response = await fetch(API_URL + 'getCategoriesProducts');
        const categoriesProducts = await response.json();

        const target = document.getElementById('target');
        target.innerHTML = ''; // Clear existing content

        // Create the product-list container dynamically
        const productList = document.createElement('div');
        productList.className = 'product-list d-flex gap-4 flex-wrap';
        target.appendChild(productList);

        products.forEach((product, index) => {
            const productForm = document.createElement('form');
            productForm.className = 'product-card d-flex position-relative';

            const belongedCats = categoriesProducts.filter(catpro => catpro.id_product === product.id_product).map(catpro => catpro.id_category);

            // Generate category options
            let categoryOptions = categories.map(category => {
                const isSelected = belongedCats && belongedCats.includes(category.id_category) ? 'selected' : '';
                return `<option value="${category.id_category}" ${isSelected}>${category.name}</option>`;
            }).join('');

            productForm.innerHTML = `
                <div id="preview-image-container${product.id_product}" class="preview-image-container position-relative">
                    <img id="preview-image${product.id_product}" class="preview-image" src="${'/img/products/product'+product.id_product+'.webp' || '/img/products/product0.webp'}" alt="${product.name}">
                    <label id="preview-image-label${product.id_product}" class="preview-image-label position-absolute" for="image${product.id_product}">
                        <span class="label-bg"></span>
                        <svg viewBox="0 0 24.00 24.00" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.2639 15.9376L12.5958 14.2835C11.7909 13.4852 11.3884 13.0861 10.9266 12.9402C10.5204 12.8119 10.0838 12.8166 9.68048 12.9537C9.22188 13.1096 8.82814 13.5173 8.04068 14.3327L4.04409 18.2802M14.2639 15.9376L14.6053 15.5991C15.4112 14.7999 15.8141 14.4003 16.2765 14.2544C16.6831 14.1262 17.12 14.1312 17.5236 14.2688C17.9824 14.4252 18.3761 14.834 19.1634 15.6515L20 16.4936M14.2639 15.9376L18.275 19.9566M18.275 19.9566C17.9176 20.0001 17.4543 20.0001 16.8 20.0001H7.2C6.07989 20.0001 5.51984 20.0001 5.09202 19.7821C4.71569 19.5904 4.40973 19.2844 4.21799 18.9081C4.12796 18.7314 4.07512 18.5322 4.04409 18.2802M18.275 19.9566C18.5293 19.9257 18.7301 19.8728 18.908 19.7821C19.2843 19.5904 19.5903 19.2844 19.782 18.9081C20 18.4803 20 17.9202 20 16.8001V16.4936M12.5 4L7.2 4.00011C6.07989 4.00011 5.51984 4.00011 5.09202 4.21809C4.71569 4.40984 4.40973 4.7158 4.21799 5.09213C4 5.51995 4 6.08 4 7.20011V16.8001C4 17.4576 4 17.9222 4.04409 18.2802M20 11.5V16.4936M14 10.0002L16.0249 9.59516C16.2015 9.55984 16.2898 9.54219 16.3721 9.5099C16.4452 9.48124 16.5146 9.44407 16.579 9.39917C16.6515 9.34859 16.7152 9.28492 16.8425 9.1576L21 5.00015C21.5522 4.44787 21.5522 3.55244 21 3.00015C20.4477 2.44787 19.5522 2.44787 19 3.00015L14.8425 7.1576C14.7152 7.28492 14.6515 7.34859 14.6009 7.42112C14.556 7.4855 14.5189 7.55494 14.4902 7.62801C14.4579 7.71033 14.4403 7.79862 14.4049 7.97518L14 10.0002Z" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </label>
                    <input type="file" name="image${product.id_product}" id="image${product.id_product}" accept="image/*" onchange="previewImage()">
                </div>
                <div class="data d-flex flex-column p-3 gap-2">
                    <span class="id position-absolute bottom-0 end-0">${product.id_product}</span>
                    <input type="text" name="name${product.id_product}" id="name${product.id_product}" value="${product.name}">
                    <div class="d-flex gap-2 align-items-center">
                        <input type="number" name="price${product.id_product}" id="price${product.id_product}" value="${product.price}" step="0.01">
                        <span id="currency${product.id_product}" class="currency">€</span>
                    </div>
                    <select name="type${product.id_product}" id="type${product.id_product}">
                        <option value="1" ${product.id_type == 1 ? "selected" : ""}>Main</option>
                        <option value="2" ${product.id_type == 2 ? "selected" : ""}>Branch</option>
                        <option value="3" ${product.id_type == 3 ? "selected" : ""}>Drink</option>
                        <option value="4" ${product.id_type == 4 ? "selected" : ""}>Dessert</option>
                    </select>
                    <select data-placeholder="Add some categories..." name="categories${product.id_product}" id="categories${product.id_product}" multiple class="chosen-select">
                        ${categoryOptions}
                    </select>
                </div>
            `;

            productList.appendChild(productForm);

            $(".chosen-select").chosen()
        });
    } catch (error) {
        console.error('Error fetching products:', error);
    }
}

document.getElementById('listproducts').addEventListener('click', getProducts);