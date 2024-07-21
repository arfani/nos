<style>
    .button {
        --main-focus: #2d8cf0;
        --font-color: #323232;
        --bg-color-sub: oklch(var(--p));
        --bg-color: #eee;
        --main-color: #323232;
        position: relative;
        width: 200px;
        height: 40px;
        cursor: pointer;
        display: flex;
        align-items: center;
        border: 2px solid var(--main-color);
        box-shadow: 4px 4px var(--main-color);
        background-color: var(--bg-color);
        border-radius: 10px;
        overflow: hidden;
    }

    .button,
    .button__icon,
    .button__text {
        transition: all 0.3s;
    }

    .button .button__text {
        transform: translateX(22px);
        color: var(--font-color);
        font-weight: 600;
    }

    .button .button__icon {
        position: absolute;
        transform: translateX(159px);
        height: 100%;
        width: 39px;
        color: oklch(var(--pc));
        background-color: var(--bg-color-sub);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .button .svg {
        width: 20px;
        fill: var(--main-color);
    }

    .button:hover {
        background: var(--bg-color);
    }

    .button:hover .button__text {
        color: transparent;
    }

    .button:hover .button__icon {
        width: 198px;
        transform: translateX(0);
    }

    .button:active {
        transform: translate(3px, 3px);
        box-shadow: 0px 0px var(--main-color);
    }
</style>

<button class="button" type="button" x-on:click="addVariant">
    <span class="button__text">Tambah varian</span>
    <span class="button__icon"><svg class="svg" fill="none" height="24" stroke="currentColor" stroke-linecap="round"
            stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24"
            xmlns="http://www.w3.org/2000/svg">
            <line x1="12" x2="12" y1="5" y2="19"></line>
            <line x1="5" x2="19" y1="12" y2="12"></line>
        </svg></span>
</button>
