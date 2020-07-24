<template>
  <h1>商品列表</h1>
  <ul>
    <li v-for="(good, index) in data">
      <span>{{ index }}  </span><span>{{ good.text}}</span> | <span>{{ good.price }}</span>
      <button @click="addCart(index)">添加购物车</button>
    </li>
  </ul>
</template>

<script>
export default {
  name: "Product",
  props: ['data']
}
</script>

<style scoped>

</style>