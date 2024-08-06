import './bootstrap';
import './client/home';
import './client/countdown';

import Alpine from 'alpinejs';
import productForm from './arpine/productForm.js'
import productTable from './arpine/productTable.js'
import cart from './arpine/cart.js'
import auction from './arpine/auction.js'

Alpine.data('productForm', productForm);
Alpine.data('productTable', productTable);

Alpine.store('cart', cart);
Alpine.store('auction', auction);

window.Alpine = Alpine;

Alpine.start();