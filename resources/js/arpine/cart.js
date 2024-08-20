export default {
    items: [],
    showNotifAddSuccess: false,
    showNotifAddFailed: false,
    get totalItem() {
        return this.items.reduce((sum, item) => sum + item.quantity, 0)
    },
    get subtotal() {
        return this.items.reduce((sum, item) => {
            let price = item.product_variant ? item.product_variant.price : item.product.product_variant[0].price

            if (item.product.promo) {
                price = price - (price * item.product.promo.discount / 100)
            }

            return sum + (item.quantity * price)
        }, 0)
    },
    init() {
        this.getDataCart();
    },
    async getDataCart(){
        this.items = await (await fetch('/data-cart')).json();
    },
    async addToCart(productId, variantId, qty){
        const response = await fetch('/add-to-cart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                product_id: productId,
                product_variant_id: variantId,
                quantity: qty
            })
        });

        const result = await response.json();

        if (result.status === 1) {
            // Successfully added to cart, now refresh the cart data
            await this.getDataCart();
            this.showNotifAddSuccess = true;
        } else {
            // Handle the error case
            console.error('Failed to add to cart');
            this.showNotifAddFailed = true;
        }
    }
}