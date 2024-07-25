import './bootstrap';
import './client/home';
import './client/countdown';

import Alpine from 'alpinejs';
import productForm from './arpine/productForm.js'
Alpine.data('productForm', productForm);
window.Alpine = Alpine;

Alpine.start();
