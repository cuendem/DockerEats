import { Discount } from '/admin/classes/Discount.js';

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