<template>
    <div class="container">
        <welcom-lear></welcom-lear>
        <stats-lear></stats-lear>
        <div class="others row mb-5">
            <classes-lear></classes-lear>
            <suggests-lear></suggests-lear>
        </div>

    </div>
</template>

<script>

    import welcomLear from '../components/home/welcom.vue';
    import classesLear from '../components/home/classes';
    import suggestsLear from '../components/home/suggests';
    import statsLear from '../components/home/stats';

    export default {
        components: {
            welcomLear,
            classesLear,
            suggestsLear,
            statsLear
        }
    }
</script>
