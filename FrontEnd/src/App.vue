<script setup>
import Header from './components/Header.vue';
import ProductDetails from './components/ProductDetails.vue'
</script>

<template>
  <Header :carts="carts" @remove-cart-item="removeCartItem" />
  <main>
    <ProductDetails @add-to-cart="addToCart" :product="product" />
  </main>
</template>

<script>

import axios from 'axios';

export default {
  data: () => ({
    apiBaseURL: 'http://127.0.0.1:8000/api',
    user_id: 1,
    product: {},
    carts: []
  }),

  methods: {
    addToCart(selectedSize) {

      if(!selectedSize) {
        alert('Product size is required!');
        return;
      }

      let data = {
        user_id: 1,
        title: this.product.title,
        description: this.product.description,
        image: this.product.imageURL,
        price: this.product.price,
        size: selectedSize,
      };

      axios({
        method: 'POST',
        url: this.apiBaseURL + '/add-to-cart',
        data: data,
      })
      .then(res => {
        console.log(res.data);
        alert('added');
        this.fetchCarts()
      })
      .catch(err => {
        console.log(err)
        alert('something went wrong');
      })
    },

    fetchCarts() {
      axios({
        method: 'GET',
        url: this.apiBaseURL + '/get-cart-items/' + this.user_id,
      })
      .then(res => {
        this.carts = res.data.data
      })
      .catch(err => {
        console.log(err)
      })
    },

    fetchProduct() {
      axios({
        method: 'GET',
        url: 'https://3sb655pz3a.execute-api.ap-southeast-2.amazonaws.com/live/product',
      })
      .then(res => {
        this.product = res.data;
      })
      .catch(err => {
        console.log(err)
      })
    },

    removeCartItem(id) {
      axios({
        method: 'DELETE',
        url: this.apiBaseURL + '/delete-cart-item/' + id
      })
      .then(res => {
        alert('Deleted');
        this.fetchCarts()
      })
      .catch(err => {
        alert('Something went wrong')
      })
    }
  },

  mounted() {
    this.fetchProduct()
    this.fetchCarts()
  }
}
</script>