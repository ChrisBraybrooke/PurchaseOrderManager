<template lang="html">
    <print-button :print-url="printUrl">
        <template slot-scope="props">
            <slot :print="props.print"></slot>
        </template>
    </print-button>
</template>

<script>
export default {

      name: 'PrintOrderButton',

      components: {
          PrintButton: () => import('./PrintButton'),
      },

      props: {
          order: {
              required: true,
              type: Object
          },
          type: {
              required: true,
              type: String
          }
      },

      data () {
          return {

          }
      },

      computed: {
          printUrl()
          {
              if (this.type === 'invoice') {
                  return this.order.invoice_link;
              }
              return this.order.delivery_note_link;
          }
      },

      watch: {

      },

      mounted () {

      },

      methods: {

      },

}
</script>

<style lang="css">
</style>
