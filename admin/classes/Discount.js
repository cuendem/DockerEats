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

    // Apply the discount to a price
    applyDiscount(n) {
        if (this.discountType === 2) { // Percentage-based discount
            return n * (1 - (this.discount / 100));
        } else { // Fixed amount discount
            return n - this.discount;
        }
    }

    // Check if the discount is still active
    isActive() {
        const now = new Date();
        const startDate = new Date(this.dateStart);
        const endDate = new Date(this.dateEnd);
        return now >= startDate && now <= endDate;
    }
}