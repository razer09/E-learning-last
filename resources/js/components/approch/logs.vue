<template>
     <b-tab title="All Generations">
        <div class="row p-4">
            <div class="col-12">
                <h5 class="mt-3 mb-3">All Generations</h5>
                <b-table
                    sticky-header
                    hover
                    :items="logs.items"
                    :fields="logs.fields"
                    :sort-by.sync="sortBy"
                    :sort-desc.sync="sortDesc"
                    dark
                ></b-table>
            </div>
        </div>
    </b-tab>
</template>

<script>
export default {
    props: ['logs'],
    data() {
        return {
            sortBy: "Iteration",
            sortDesc: false,
        };
    },
};
</script>

<style lang="css" scoped>
</style>
