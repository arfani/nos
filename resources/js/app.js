import './bootstrap';
import './client/home';
import './client/countdown';

import Alpine from 'alpinejs';
import productForm from './arpine/productForm.js'
import productTable from './arpine/productTable.js'
import cart from './arpine/cart.js'

Alpine.data('productForm', productForm);
Alpine.data('productTable', productTable);

Alpine.store('cart', cart);

window.Alpine = Alpine;

Alpine.start();