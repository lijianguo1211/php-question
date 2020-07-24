<template>
<product :data="goods"></product>
<!--<cart :data="cart"></cart>-->
</template>

<script>
import Product from './components/Product.vue'
// import Cart from './components/Cart.vue'

export default {
  name: 'App',
  components: {
    Product,
    //Cart
  },
  data() {
    return {
      goods: [
        {text: 'php', price: 100},
        {text: 'java', price: 80},
        {text: 'nginx', price: 10}
      ],
      cart: [],
    }
  },
  methods: {
    addCart(i) {
      console.log('添加购物车');
      let item = this.goods[i];
      console.log(item);
      let good = this.cart.find(v=>v.text == item.text);

      if (good) {
        good.count += 1
      } else {
        this.cart.push({...item, count:1});
      }
    }
  },
  created: function () {//实例被创建之后执行代码
    console.log('name is:' + this.name);
  }
}
</script>

<style>

</style>
