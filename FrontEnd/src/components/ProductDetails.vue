<template>
    <div class="container">
        <div class="image_wrapper">
            <img id="product_image" class="product_image" :src="product.imageURL" alt="Classic Tree">
        </div>
        <div class="product_info">
            <div class="product_title">
                <h1 id="product_title" class="title">{{ product.title }}</h1>
            </div>
            <div class="product_price">
                <span id="product_price" class="price">{{ `$${product.price}` }}</span>
            </div>
            <div class="product_description">
                <span id="product_description" class="description">{{ product.description }}</span>
            </div>
            <div class="product_attributes">
                <div class="sizes">
                    <div class="label_container">
                        <label class="control_label">Sizes</label>
                        <span id="selected_size" class="selected_size">{{ selectedSize }}</span>
                    </div>
                    <div id="sizes" class="sizes_container">
                        <button v-for="size in product.sizeOptions" :key="size.id" class="size_variation" @click="() => changeSelectedSize(size.label)" :data-label="size.label">{{ size.label }}</button>
                    </div>
                </div>
            </div>
            <div class="product_action">
                <button id="add_to_cart" @click="$emit('add-to-cart', selectedSize)" class="action">Add to cart</button>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        product: Object,
    },

    data: () => ({
        selectedSize: '',
    }),

    methods: {
        changeSelectedSize(label) {
            this.selectedSize = label
        }
    }
}
</script>