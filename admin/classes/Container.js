import { Product } from '/admin/classes/Product.js';

export class Container {
    constructor({
        id_container,
        parts
    }) {
        this.idContainer = id_container;
        this.parts = parts;

        const mainPart = parts.find(part => part.product_type === 1);
        this.main = new Product(mainPart) || null; // Set to null if no such part exists
        const branchPart = parts.find(part => part.product_type === 2);
        this.branch = new Product(branchPart) || null; // Set to null if no such part exists
        const drinkPart = parts.find(part => part.product_type === 3);
        this.drink = new Product(drinkPart) || null; // Set to null if no such part exists
        const dessertPart = parts.find(part => part.product_type === 4);
        this.dessert = new Product(dessertPart) || null; // Set to null if no such part exists
    }

    getPrice() {
        let total = 0;

        total += this.main.getPrice();
        total += this.branch.getPrice();
        total += this.drink.getPrice();
        total += this.dessert.getPrice();

        return Math.round(total * 100) / 100;
    }
}