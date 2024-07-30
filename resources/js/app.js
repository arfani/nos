import './bootstrap';
import './client/home';
import './client/countdown';

import Alpine from 'alpinejs';
import productForm from './arpine/productForm.js'
import productTable from './arpine/productTable.js'

Alpine.data('productForm', productForm);
Alpine.data('productTable', productTable);

Alpine.store('cart', {
    content: [
        {product_id: 1, qty: 2},
        {product_id: 2, qty: 4},
        {product_id: 3, qty: 6},
    ]
});

window.Alpine = Alpine;

Alpine.start();