export default {
    items: [
        {product: {id:1, name: 'test1', price: 1000}, qty: 2},
        {product: {id:2, name: 'test2', price: 2000}, qty: 4},
        {product: {id:3, name: 'test3', price: 3000}, qty: 6},
    ],
    get totalItem(){
        return this.items.reduce((sum, item) => sum + item.qty, 0)
    },
    get subtotal(){
        return this.items.reduce((sum, item) => sum + (item.qty * item.product.price), 0)
    }
}