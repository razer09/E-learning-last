<template>
    <b-tab title="Settings">
        <div class="row p-4">
            <div class="col-6">
                <h3 class="mt-3 mb-3 text-center"> Genetic operation </h3>
                <hr />
                <h5 class="mt-4 mb-4">
                    Number of population :
                    <b-form-input class="mt-3"v-model="settings.nbr_pop"></b-form-input>
                </h5>
                <h5 class="mt-2 mb-4">
                    Number of generation :
                    <b-form-input class="mt-3"v-model="settings.nbr_generation"></b-form-input>
                </h5>
                <hr>
                <h5 class="mt-2 mb-4">
                    Percentage of mutation :
                    <b-form-input
                        id="range-1"
                        class="mt-2"
                        v-model="settings.mutation"
                        type="range"
                        min="0"
                        max="1"
                        step="0.05"
                    ></b-form-input>
                    <p class="text-right text-dark font-weight-bold">
                        {{ settings.mutation }} %
                    </p>
                </h5>
                <hr>
                <h5 class="mt-2 mb-4">
                    Percentage of crossover :
                    <b-form-input
                        id="range-1"
                        class="mt-2"
                        v-model="settings.crossover"
                        type="range"
                        min="0"
                        max="1"
                        step="0.05"
                    ></b-form-input>
                    <p class="text-right text-dark font-weight-bold">
                        {{ settings.crossover }} %
                    </p>
                </h5>
            </div>
            <div class="col-6 border-left">
                <h4 class="text-center mt-3 mb-3">Criteria</h4>
                <hr />
                <h5 class="mt-4 mb-4">Respnse time weight</h5>
                <b-form-input
                    id="range-1"
                    v-model="settings.W_RT"
                    type="range"
                    min="0"
                    max="1"
                    step="0.05"
                ></b-form-input>
                <p class="text-right text-dark font-weight-bold"> {{ settings.W_RT }} % </p>
                <hr />
                <h5 class="mt-4 mb-4"> consumption of data weight </h5>
                <b-form-input
                    id="range-1"
                    v-model="settings.W_C"
                    type="range"
                    min="0"
                    max="1"
                    step="0.05"
                ></b-form-input>
                <p class="text-right text-dark font-weight-bold"> {{ settings.W_C }} % </p>
                <hr />
                <h5 class="mt-4 mb-4">Utility weight</h5>
                <b-form-input
                    id="range-1"
                    v-model="settings.W_U"
                    type="range"
                    min="0"
                    max="1"
                    step="0.05"
                ></b-form-input>
                <p class="text-right text-dark font-weight-bold"> {{ settings.W_U }} % </p>
            </div>
        </div>
    </b-tab>
</template>

<script>
export default {
    props: ['settings'],
    data() {
        return {

        };
    },
    watch: {
        settings() {
            this.$emit('input', parseInt(this.value, 10));
        }
    }
};
</script>

<style lang="css" scoped>
</style>
