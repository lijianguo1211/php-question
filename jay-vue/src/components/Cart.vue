<template>
  <h1>购物车</h1>
  <table border="1">
    <tr>
      <td>商品</td>
      <td>单价</td>
      <td>价格</td>
      <td>总量</td>
      <td>操作</td>
    </tr>

    <tr v-for="c in data">
      <td>{{ c.text }}</td>
      <td>{{ c.price }}</td>
      <td>{{ c.price * c.count }}</td>
      <td>{{ c.count }}</td>
    </tr>

  </table>
</template>

<script>
export default {
  name: "Cart",
  props: ['data']
}
</script>

<style scoped>

</style>