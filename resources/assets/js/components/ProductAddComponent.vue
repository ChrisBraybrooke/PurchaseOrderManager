<template lang="html">
    <div class="">

        <table class="table table-hover bg-white mb-0">
            <thead>
                <tr>
                    <th scope="col">Product Code</th>
                    <th scope="col">Description</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Total</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <product-row v-for="(product, key) in products" :key="key" :id="key" :product="product" :products="products" />
            </tbody>
        </table>

        <table class="table bg-white mt-0">
            <tbody>
              <tr>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col">Sub-Total</th>
                  <td scope="col">{{ siteCurrency }}{{ formatPrice(productsSubTotal) }}</td>
              </tr>
              <tr>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col">Shipping</th>
                  <td scope="col">
                      <div class="input-group input-group-sm">
                          <div class="input-group-prepend">
                              <span class="input-group-text">{{ siteCurrency }}</span>
                          </div>
                          <input type="number" v-model="products.shipping" name="shipping_rate" class="form-control form-control-sm" id="shipping" style="max-width:80px">
                      </div>
                  </td>
              </tr>
              <tr>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col">VAT</th>
                  <td scope="col">{{ siteCurrency }}{{ formatPrice(productsTotalVAT) }}</td>
              </tr>
              <tr>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col">Total</th>
                  <td scope="col">{{ siteCurrency }}{{ formatPrice(productsTotal) }}</td>
              </tr>
            </tbody>
        </table>

        <button type="button" class="btn btn-sm btn-outline-primary" name="add_row" @click="addRow">Add Row</button>
    </div>
</template>

<script>
var productModel = {
    code: "2",
    description: "2",
    quantity: 1,
    unit_price: 10,
    total: 0,
}
export default {

      name: 'ProductAddComponent',

      components: {
          ProductRow: () => import('./ProductRow')
      },

      props: {
          existingProducts: {
              required: false,
              type: Array,
              default () {
                  return [_.clone(productModel, true)]
              }
          }
      },

      data () {
          return {
              products: [],
          }
      },

      computed: {
          formattedShipping()
          {
              return parseFloat(this.products.shipping ? this.products.shipping : 0);
          },
          productsSubTotal: function () {
              var total = 0;
              _.forEach(this.products, function (product) {
                  total = total + product.total;
              });
              return parseFloat(total);
          },
          productsTotalVAT: function () {
              return ((parseFloat(this.productsSubTotal) + this.formattedShipping) * 0.2);
          },
          productsTotal: function () {
              return (this.productsSubTotal + this.productsTotalVAT + this.formattedShipping);
          }
      },

      watch: {

      },

      mounted () {
          console.log('ProductAddComponent mounted');
          this.products = _.clone(this.existingProducts, true);
      },

      methods: {
          addRow()
          {
              this.products.push(_.clone(productModel, true));
          }
      },

}
</script>

<style lang="css">
</style>
