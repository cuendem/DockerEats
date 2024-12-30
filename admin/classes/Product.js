import { Sale } from '/admin/classes/Sale.js';

export class Product {
    constructor({
        id_part,
        id_product,
        name,
        price,
        id_type,
        deleted
    }) {
        this.idPart = id_part;
        this.idProduct = id_product;
        this.name = name;
        this.price = parseFloat(price);
        this.idType = id_type;
        this.categories = fetch(`http://www.dockereats.com/api/getProductCategories&product=${this.idProduct}`).then(res => res.json());
        this.allergens = fetch(`http://www.dockereats.com/api/getProductAllergens&product=${this.idProduct}`).then(res => res.json());
        this.sales = fetch(`http://www.dockereats.com/api/getSalesByPart&part=${this.idPart}`).then(res => res.json()).then(salesJson => {
            this.sales = salesJson.map(saleJson => new Sale(saleJson));
            return this.sales;
        });
        this.deleted = deleted;
    }

    getDiscountedPrice(sale) {
        if (sale.discountType === 1) {
            return this.price - sale.discount;
        } else {
            return Math.round(this.price * (1 - (sale.discount / 100)) * 100) / 100;
        }
    }

    getPrice() {
        if (Array.isArray(this.sales) && this.sales.length > 0) {
            return this.getDiscountedPrice(this.sales[0]);
        } else {
            return this.price;
        }
    }
}