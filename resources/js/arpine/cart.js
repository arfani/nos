export default {
    items: [],
    showNotifSuccess: false,
    showNotifFailed: false,
    message: '',
    notifTimeout: null,
    isLoading: false,
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
    get totalWeight() {
        return this.items.reduce((sum, item) => {
            let weight = item.product_variant ? item.product_variant.weight : item.product.product_variant[0].weight

            return sum + (item.quantity * weight)
        }, 0)
    },
    init() {
        this.getDataCart();

        // Cek apakah ada notifikasi sukses di localStorage
    if (localStorage.getItem('orderSuccess')) {
        this.showNotification("Terimakasih, data order berhasil kami terima !")
        localStorage.removeItem('orderSuccess'); // Hapus setelah ditampilkan
    }

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
            this.showNotification('Berhasil ditambah ke keranjang Anda !');
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
            this.showNotification('Berhasil ditambah ke keranjang Anda !');
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
    },
    // UNTUK CHECKOUT PAGE
    addressSelected: {},
    setAddress(id, name, recipient, hp, address, district, city, province, postal_code, area_id) {
        this.addressSelected.id = id;
        this.addressSelected.name = name;
        this.addressSelected.recipient = recipient;
        this.addressSelected.hp = hp;
        this.addressSelected.address = address;
        this.addressSelected.district = district;
        this.addressSelected.city = city;
        this.addressSelected.province = province;
        this.addressSelected.postal_code = postal_code;
        this.addressSelected.area_id = area_id;

    },
    courierList: [],
    async setCourierList() {
        // JIKA SUDAH ADA COURIER RATES PADA VARIABEL COURIERLIST MAKA JANGAN AMBIL KE CONTROLLER/ JANGAN FETCH CEK ONGKIR LAGI BIAR GA KENA CAS, TAPI INI TIDAK BERLAKU JIKA HALAMAN DI RELOAD
        if (this.courierList.length > 0) {
            return 0
        }
        const destination_area_id = this.addressSelected.area_id;
        //AMBIL DATA BARANG
        const items = this.items.map((item, i) => {
            // AMBIL BARANG DARI PRODUCT VARIANT SESUAI ID TAPI JIKA TIDAK ADA MAKA AMBIL VARIANT INDEX 0
            if (item.product_variant) {
                return {
                    name: item.product.name,
                    value: item.product_variant.price,
                    weight: +item.product_variant.weight,
                    quantity: item.quantity,
                    // OPTIONAL UNTUK BITESHIP
                    sku: item.product_variant.sku,
                    length: +item.product.dimention.length,
                    width: +item.product.dimention.width,
                    height: +item.product.dimention.height,
                }
            } else {
                return {
                    name: item.product.name,
                    value: item.product.product_variant[0].price,
                    weight: +item.product.product_variant[0].weight,
                    quantity: item.quantity,
                    // OPTIONAL UNTUK BITESHIP
                    sku: item.product.product_variant[0].sku,
                    length: +item.product.dimention.length,
                    width: +item.product.dimention.width,
                    height: +item.product.dimention.height,
                }
            }
        });

        // KURIR YANG INGIN DICEK ONGKIR NYA
        const couriers = 'jne,jnt,sicepat,gojek,grab,lalamove,anteraja,pos,deliveree,sap';

        const response = await fetch(`/cek-ongkir`, {
            method: 'POST',
            body: JSON.stringify({
                destination_area_id,
                couriers,
                items,
            }),
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            }
        });

        const result = await response.json();

        if (result.status === 1) {
            // Successfully ger courier rates
            this.courierList = result.courier_rates.pricing;
        } else {
            // Handle the error case
            console.error('Gagal cek ongkir');
        }
    },
    courierSelected: {
        // CONTOH RESPONSE
        "available_collection_method": ["pickup"],
        "available_for_cash_on_delivery": false,
        "available_for_proof_of_delivery": false,
        "available_for_instant_waybill_id": true,
        "available_for_insurance": true,
        "company": "jne",
        "courier_name": "JNE",
        "courier_code": "jne",
        "courier_service_name": "JNE Trucking",
        "courier_service_code": "jtr",
        "description": "Trucking with minimum weight of 10 kg",
        "duration": "7 - 9 days",
        "shipment_duration_range": "7 - 9",
        "shipment_duration_unit": "days",
        "service_type": "standard",
        "shipping_type": "freight",
        "price": 161500,
        "type": "jtr"
    },
    setCourierSelected(courier) {
        this.courierSelected = courier
    },
    paymentMethod: null,
    setPaymentMethod(method) {
        this.paymentMethod = method
    },
    async submitOrder() {
        this.isLoading = true;
        const response = await fetch('/order', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                paymentMethod: this.paymentMethod,
                total: this.subtotal + this.courierSelected.price,
                orderAddressId: this.addressSelected.id,
                shippingMethod: this.courierSelected,
            })
        });

        const result = await response.json();

        if (result.status === 1) {
            // Successfully added to cart, now refresh the cart data
            this.isLoading = false;
            window.location.href = '/profile';
            localStorage.setItem('activeTab', 4) // set tab profile ke data order
            localStorage.setItem('orderSuccess', true) // set tab profile ke data order
        } else {
            // Handle the error case
            this.isLoading = false;
            this.showNotificationFailed("Terjadi kesalahan, order gagal !");
        }
    },
    orderDetail: {
        
    },
    async getOrderDetail(order_id){
        this.orderDetail = await (await fetch(`/order/${order_id}`)).json();
    }
}