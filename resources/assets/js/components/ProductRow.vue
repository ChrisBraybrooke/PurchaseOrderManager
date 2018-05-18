<template lang="html">

<tr>
    <td>
        <input v-if="edit" type="text" v-model="product.code" :name="'products[' + id + '][code]'" class="form-control form-control-sm" id="code" required>
        <span v-else>{{ product.code }}</span>
    </td>
    <td>
        <input v-if="edit" type="text" v-model="product.description" :name="'products[' + id + '][description]'" class="form-control form-control-sm" id="description" required>
        <span v-else>{{ product.description }}</span>
    </td>
    <td>
        <select v-if="edit" v-model="product.quantity" :name="'products[' + id + '][quantity]'" id="quantity" class="custom-select custom-select-sm" required>
            <option v-for="(range, key) in ranges" :value="range + 1" :key="range">{{ range + 1 }}</option>
        </select>
        <span v-else>{{ product.quantity }}</span>
    </td>
    <td>
        <div v-if="edit" class="input-group input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">{{ siteCurrency }}</span>
            </div>
            <input type="number" v-model="product.unit_price" @change="unitPriceChange" :name="'products[' + id + '][unit_price]'" class="form-control form-control-sm" id="unit_price" required>
        </div>
        <span v-else>{{ siteCurrency }}{{ product.unit_price }}</span>
    </td>
    <td>
        <div v-if="edit" class="input-group input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">{{ siteCurrency }}</span>
            </div>
            <input type="number" :value="formatPrice(product.total)" class="form-control form-control-sm" disabled required>
            <input type="number" v-model="product.total" :name="'products[' + id + '][total]'" class="form-control form-control-sm" id="total" hidden required>
        </div>
        <span v-else>{{ siteCurrency }}{{ formatPrice(product.total) }}</span>
    </td>
    <td>
        <button v-if="edit" type="button" name="delete" class="btn btn-sm btn-outline-danger" @click="removeRow"> <i class="far fa-trash-alt" aria-hidden></i> </button>
    </td>

</tr>

</template>

<script>
export default {

      name: 'ProductRow',

      components: {

      },

      props: {
          product: {
              required: true,
              type: Object
          },
          products: {
              required: true,
              type: Array
          },
          id: {
              required: true,
          },
          edit: {
              required: false,
              type: Boolean,
              default () {
                  return true
              }
          }
      },

      data () {
          return {

          }
      },

      computed: {
          ranges()
          {
              return [...Array(40).keys()];
          }
      },

      watch: {
          'product.unit_price': function (value) {
              this.product.total = value * this.product.quantity;
          },
          'product.quantity': function (value) {
              this.product.total = value * this.product.unit_price;
          },
      },

      mounted () {
          console.log('ProductRow mounted');
          if (this.product.unit_price && this.product.quantity) {
              this.product.total = this.product.unit_price * this.product.quantity;
          }
      },

      methods: {
          removeRow()
          {
              this.products.splice(this.products.indexOf(this.product), 1);
          },
          unitPriceChange(val)
          {
              this.product.unit_price = this.formatPrice(this.product.unit_price);
          }
      },

}
</script>

<style lang="css">
</style>
