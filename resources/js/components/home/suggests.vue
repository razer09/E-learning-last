<template>
    <div class="suggests col-6 pt-3">
        <h3 class="mb-3 ml-2">Suggestion</h3>
        <div class="suggest media mb-3" v-for="course in courses">
            <img :src="course.thubnail"
            class="align-self-center rounded mr-3">
            <div class="media-body">
                <router-link tag="a"
                    :to="{ name: 'singleCourse', params: { id: course.id }}"
                    exact>
                    <h4 class="mt-0 mb-0">{{course.title}}</h4>
                </router-link>
                <p class="mb-2">
                    {{course.description}}
                </p>
                <div class="info">
                    <div class="lessons">
                        <i class="fa fa-laptop fa-lg"></i>
                        <span>{{course.nbr_lessons}} Lesson</span>
                    </div>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            courses: []
        };
    },
    computed: {
        user_id(){
            return this.$store.getters.user.id;
        },
        tags(){
             return this.$store.getters.tags;
        }
    },
    created(){
        this.recomend();
    },
    methods: {
        recomend(){
            axios.post('/api/recomended',{
                user_id: this.user_id,
                tags: this.tags
            })
            .then(({data}) => {
                console.log(data.data);
                this.courses = data.data;

            });
        }
    }
}
</script>
