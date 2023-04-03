<template>
    <header>
        <div class="cart__container">
            <a href="javascript:void(0)" id="cart_button" @click="toggleMiniCart" class="cart__button">Cart <span id="cart_items">({{ carts.length }})</span></a>
            <div v-if="showMiniCart" id="mini_cart" class="mini_cart">
                <ul v-if="carts.length" class="item_list">
                    <li @click="$emit('remove-cart-item', cart.id)" v-for="cart in carts" :key="cart.id" class="item cart_item">
                        <img :src="cart.product_image" :alt="cart.product_title" class="cart_img" />
                        <div class="item_info">
                            <div>{{ cart.product_title }}</div>
                            <div>{{ `${cart.qty}x` }}</div>
                            <div>Size: {{ cart.size }}</div>
                        </div>
                    </li>
                </ul>

                <div v-else>Empty Cart</div>
            </div>
        </div>
    </header>
</template>

<script>

export default {
    props: {
        carts: Array,
        default: []
    },
    
    data: () => ({
        showMiniCart: false,
    }),

    methods: {
        toggleMiniCart() {
            this.showMiniCart = !this.showMiniCart
        }
    }
}
</script>