<template lang="html">
<div>
    <iframe @load="print" v-if="url" id="printLinkIframe" name="printLinkIframe" :src='printUrl' style="position:absolute;top:-9999px;left:-9999px;border:0px;overfow:none; z-index:-1"></iframe>

    <slot :print="btnClick">
        <button @click="btnClick" type="button" class="btn btn-sm btn-primary" name="button">Print</button>
    </slot>
</div>
</template>

<script>
export default {
    name: 'PrintButton',
    props: {
        printUrl: {
            required: true,
            type: String
        }
    },
    data () {
        return {
            url: null,
        }
    },
    mounted () {
        console.log('PrintButton.vue mounted')
    },
    methods: {
        print()
        {
            frames['printLinkIframe'].focus();
            frames['printLinkIframe'].print();

            this.url = null;
        },
        btnClick()
        {
            this.url = this.printUrl;
        }
    }
}
</script>

<style lang="css">
</style>
