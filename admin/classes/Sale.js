export class Sale {
    constructor({
        id_sale,
        name,
        description,
        discount,
        date_start,
        date_end,
        discount_type,
        product_type,
        category_affected,
        scope
    }) {
        this.idSale = id_sale;
        this.name = name;
        this.description = description;
        this.discount = discount;
        this.dateStart = date_start;
        this.dateEnd = date_end;
        this.discountType = discount_type;
        this.productType = product_type;
        this.categoryAffected = category_affected;
        this.scope = scope;
    }

    applyDiscount(n) {
        if (this.discountType === 2) {
            return Math.round(n * (1 - (this.discount / 100)) * 100) / 100;
        } else {
            return n - this.discount;
        }
    }
}