<style>
    .product-form .switch {
        position: relative;
        display: inline-block;
        width: 200px;
        height: 34px;
    }

    .product-form .switch input {
        display: none;
    }

    .product-form .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #3C3C3C;
        -webkit-transition: .4s;
        transition: .4s;
        border-radius: 34px;
    }

    .product-form .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: oklch(var(--n));
        -webkit-transition: .4s;
        transition: .4s;
        border-radius: 50%;
    }

    .product-form input:checked+.slider {
        background-color: oklch(var(--p));
    }

    .product-form input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    .product-form input:checked+.slider:before {
        -webkit-transform: translateX(165px);
        -ms-transform: translateX(165px);
        /* transform: translateX(165px); */
        background-color: white;
    }

    /*------ ADDED CSS ---------*/
    .product-form .slider:after {
        content: 'TANPA VARIAN';
        color: oklch(var(--p));
        display: block;
        position: absolute;
        transform: translate(-50%, -50%);
        top: 50%;
        left: 50%;
        font-size: 10px;
        font-family: Verdana, sans-serif;
    }

    .product-form input:checked+.slider:after {
        color: oklch(var(--pc));
        content: 'DENGAN VARIAN';
    }

    /*--------- END --------*/
</style>
<label class="switch hover:scale-105 duration-200">
    <input type="checkbox" x-model="variantMode">
    <span class="slider"></span>
</label>
