export class Coupon {
    constructor({
        id_coupon,
        code,
        discount,
        date_start,
        date_end,
        discount_type
    }) {
        this.idCoupon = id_coupon;
        this.code = code;
        this.discount = discount;
        this.dateStart = date_start;
        this.dateEnd = date_end;
        this.discountType = discount_type;
    }

    getSummary() {
        return `${this.code} (-${this.discount}${this.discountType == 1 ? '€' : '%'})`;
    }

    applyDiscount(n) {
        if (this.discountType === 2) {
            return Math.round(n * (1 - (this.discount / 100)) * 100) / 100;
        } else {
            return n - this.discount;
        }
    }
}