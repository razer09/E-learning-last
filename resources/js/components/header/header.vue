<template>
    <div>
        <!-- Side board -->

        <side-bar></side-bar>

        <!-- Mainboard -->
        <main class="">

            <top-bar></top-bar>

            <div class="mainboard">


            </div>

        </main>
        <!-- End Mainboard  -->
    </div>

</template>

<script>
    import topBar from './topbar.vue';
    import sideBar from './sidebar.vue';

export default {
    components: {
        topBar,
        sideBar
    }
};
</script>

<style lang="css" scoped>
</style>
