<template>
    <div class="container">

        <button @click="fetchall">Add</button>

    </div>
</template>

<script>
    import {mapActions} from 'vuex';
    import {mapGetters} from 'vuex';

    export default {
        data(){
            return{
                prop: [1,2,3,4,5,4,8]
            }
        },
        computed: {

        },
        methods: {
        },
        components: {

        }
    }
</script>
