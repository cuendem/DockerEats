// Parent Discount class
export class Discount {
    constructor({
        discount,
        discount_type,
        date_start,
        date_end,
    }) {
        this.discount = discount;
        this.discountType = discount_type;
        this.dateStart = date_start;
        this.dateEnd = date_end;
    }

    applyDiscount(n) {
        if (this.discountType === 2) { // Percentage-based discount
            return n * (1 - (this.discount / 100));
        } else { // Fixed amount discount
            return n - this.discount;
        }
    }

    isActive() {
        const now = new Date();
        const startDate = new Date(this.dateStart);
        const endDate = new Date(this.dateEnd);
        return now >= startDate && now <= endDate;
    }
}

// Coupon class extending Discount
export class Coupon extends Discount {
    constructor({
        id_coupon,
        code,
        discount,
        date_start,
        date_end,
        discount_type
    }) {
        super({ discount, discount_type, date_start, date_end }); // Call parent constructor
        this.idCoupon = id_coupon;
        this.code = code;
    }

    getSummary() {
        return `${this.code} (-${this.discount}${this.discountType === 1 ? '€' : '%'})`;
    }
}
