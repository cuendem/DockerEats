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
        this.categories = fetch(`/api/getProductCategories&product=${this.idProduct}`).then(res => res.json());
        this.allergens = fetch(`/api/getProductAllergens&product=${this.idProduct}`).then(res => res.json());
        this.sales = fetch(`/api/getSalesByPart&part=${this.idPart}`).then(res => res.json()).then(salesJson => {
            this.sales = salesJson.map(saleJson => new Sale(saleJson));
            return this.sales;
        });
        this.deleted = deleted;
    }

    getPrice() {
        let finalPrice = this.price;

        if (Array.isArray(this.sales) && this.sales.length > 0) {
            // Apply percentage discounts first (discountType 2)
            this.sales.filter(sale => sale.discountType === 2).forEach(sale => {
                finalPrice = Math.round(finalPrice * (1 - (sale.discount / 100)) * 100) / 100;
            });

            // Apply fixed amount discounts (discountType 1)
            this.sales.filter(sale => sale.discountType === 1).forEach(sale => {
                finalPrice -= sale.discount;
            });
        }

        return finalPrice >= 0 ? finalPrice : 0;
    }
}