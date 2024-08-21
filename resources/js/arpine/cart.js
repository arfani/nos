export default {
    items: [],
    showNotifSuccess: false,
    showNotifFailed: false,
    message: '',
    notifTimeout: null,
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
    async getDataCart() {
        this.items = await (await fetch('/data-cart')).json();
    },
    async addToCart(productId, variantId, qty) {
        if (qty < 1) {
            this.showNotificationFailed('Kuantitas tidak boleh kurang dari 1');
            return;
        }

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
            this.showNotification('Berhasil ditambah ke keranjang Anda !');
        } else {
            // Handle the error case
            console.error('Gagal menambahkan barang ke keranjang Anda !');
            this.showNotificationFailed('Gagal menambahkan barang ke keranjang Anda !');
        }
    },
    async updateQty(item, qty) {
        if (qty < 1) {
            this.showNotificationFailed('Kuantitas tidak boleh kurang dari 1');
            await this.getDataCart();
            return;
        }

        const response = await fetch(`/update-qty/${item.id}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                qty
            })
        });

        const result = await response.json();

        if (result.status === 1) {
            // Successfully added to cart, now refresh the cart data
            await this.getDataCart();
            this.showNotification('Berhasil update jumlah barang di keranjangmu !');
        } else {
            // Handle the error case
            this.showNotificationFailed('Gagal udpate data !');
            console.error('Gagal udpate data');
        }
    },
    async removeItem(item) {
        const response = await fetch(`/remove-item/${item.id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });

        const result = await response.json();

        if (result.status === 1) {
            // Successfully added to cart, now refresh the cart data
            await this.getDataCart();
            this.showNotification('Berhasil dihapus !');
        } else {
            // Handle the error case
            this.showNotificationFailed('Gagal dihapus !');
            console.error('Gagal dihapus');
        }
    },
    showNotification(message) {
        this.message = message;
        this.showNotifSuccess = true;

        // Clear existing timeout if any
        if (this.notifTimeout) {
            clearTimeout(this.notifTimeout);
        }

        // Set a new timeout
        this.notifTimeout = setTimeout(() => {
            this.showNotifSuccess = false;
            this.notifTimeout = null; // Clear the timeout ID
        }, 5000);
    },
    showNotificationFailed(message) {
        this.message = message;
        this.showNotifFailed = true;

        // Clear existing timeout if any
        if (this.notifTimeout) {
            clearTimeout(this.notifTimeout);
        }

        // Set a new timeout
        this.notifTimeout = setTimeout(() => {
            this.showNotifFailed = false;
            this.notifTimeout = null; // Clear the timeout ID
        }, 5000);
    }
}