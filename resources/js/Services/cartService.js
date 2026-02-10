import axios from 'axios'
import { router } from '@inertiajs/vue3'

export async function addToCart(productId, quantity = 1) {
    try {
        const res = await axios.post(route('cart.add'), {
            product_id: productId,
            quantity
        })

        // phát event để header tự reload count
        window.dispatchEvent(new Event('cart-updated'))

        return res.data
    } catch (e) {
        if (e.response?.status === 401 || e.response?.status === 302) {
            router.visit(route('login'))
            return
        }
        throw e
    }
}
