<template>
    <div class="classes col-6 pt-3">
        <h3 class="mb-3 ml-2">My Classes</h3>
        <div class="groupe">
            <div v-for="course in courses" class="media classe mb-4">
                <img  :src="course.thubnail"
                class="rounded mr-3">
                <div class="media-body">
                    <router-link tag="a"
                        :to="{ name: 'singleCourse', params: { id: course.id }}"
                        exact>
                        <h5 class="mt-0">{{course.title}}
                            <span class="font-weight-bold">{{progress[course.id]}} %</span>
                        </h5>
                    </router-link>
                    <b-progress height="16px" :value="progress[course.id]" :max="100" show-progress>
                    </b-progress>
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
            courses: [],
            paginationEnrolled: {},
            progress: {}
        };
    },
    computed: {
        user_id() {
            return this.$store.getters.user.id;
        }
    },
    created(){
        this.enrolledCourses();
        this.setProgress();
    },
    methods: {
        setProgress(){
            axios.get('api/progressCourse/'+ this.user_id)
                .then(res => {
                    console.log(res.data);
                    this.progress = res.data;
            });

        },
        enrolledCourses(page_url = "/api/enrolledCourses/" + this.user_id) {
            this.show = true;
            let vm = this;

            axios.get(page_url).then(({ data: res }) => {
                this.courses = res.data;

                vm.makePagination(res.meta, res.links, "paginationEnrolled");
                this.show = false;
            });
        },
        makePagination(meta, link, pagName) {
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                prev_page: link.prev,
                next_page: link.next
            };

            this[pagName] = pagination;
        }
    }
}
</script>
