<template>
    <div class="container single-course-page mb-4">
        <div class="header pt-4">
            <div class="row">
                <div class="col-3 text-center">
                    <img :src="course.thubnail" class="w-100 mt-2" />
                    <button
                    type="button"
                    class="price btn btn-outline-primary mt-5 btn-lg bg-white"
                    >
                        Price: {{ course.price }} $
                    </button>
                    <h5 class="author mt-5">
                        <strong>By</strong> {{ teacher.name }}
                    </h5>
                </div>
                <div class="col-9">
                    <h3 class="mb-3">{{ course.title }}</h3>
                    <div
                        class="rating bg-warning rounded-pill px-2 py-0 pr-3 text-white"
                        >
                        <i class="fa fa-star-o"></i>
                        4.5
                    </div>

                    <p class="mb-4">
                        {{ course.description }}
                    </p>
                    <div class="row infos mb-4 mt-5 flex-wrap">
                        <div class="info col-4">
                            <i class="fa fa-laptop fa-lg mr-2"></i>
                            {{ course.nbr_lessons }} Lessons
                        </div>
                        <div class="info col-4">
                            <i class="fa fa-hourglass-half fa-lg mr-2"></i>
                            {{ course.nbr_hours }}
                        </div>
                        <div class="info col-4">
                            <i class="fa fa-user-o fa-lg mr-2"></i>
                            {{ course.nbr_student }} Students
                        </div>
                        <div class="info col-4">
                            <i class="fa fa-language fa-lg mr-2"></i>
                            English
                        </div>
                        <div class="info col-4">
                            <i class="fa fa-retweet fa-lg mr-2"></i>
                            {{ course.last_update }} Last update
                        </div>
                    </div>
                    <b-overlay
                        :show="busy"
                        rounded
                        spinner-variant="warning"
                        opacity="0.6"
                        spinner-small
                        class="d-inline-block mb-3 float-right"
                    >
                        <div v-if="!enrolled && !isTeacher">
                            <a href="#" class="btn btn-orange btn-lg"
                            @click.prevent="enrolleCourse">
                            Enrolle course</a
                            >
                        </div>
                        <div v-else-if="isTeacher">
                            <router-link class="btn btn-orange btn-lg " :to="{ name: 'editCourse', params: { id: course.id }}">
                                <i class="fa fa-edit"></i> Edit course
                            </router-link>
                        </div>
                        <div v-else>
                            <a href="#" class="btn btn-orange btn-lg"
                            @click.prevent="cancelCourse">
                            Cancel course</a
                            >
                        </div>
                    </b-overlay>
                </div>
            </div>
        </div>
        <div class=" shadow-sm">
            <b-tabs align="center" class="bg-white">
                <b-tab title-item-class="text" title="Text" >
                    <div class="p-4">
                        <h4>Requirements</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing
                            elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis
                            nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat. Duis aute irure dolor in
                            reprehenderit in voluptate velit esse cillum dolore
                            eu fugiat nulla pariatur. Excepteur sint occaecat
                            cupidatat non proident, sunt in culpa qui officia
                            deserunt mollit anim id est laborum.
                        </p>
                        <h4>Description</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing
                            elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis
                            nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat. Duis aute irure dolor in
                            reprehenderit in voluptate velit esse cillum dolore
                            eu fugiat nulla pariatur. Excepteur sint occaecat
                            cupidatat non proident, sunt in culpa qui officia
                            deserunt mollit anim id est laborum.Lorem ipsum
                            dolor sit amet, consectetur adipisicing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna
                            aliqua. Ut enim ad minim veniam, quis nostrud
                            exercitation ullamco laboris nisi ut aliquip ex ea
                            commodo consequat. Duis aute irure dolor in
                            reprehenderit in voluptate velit esse cillum dolore
                            eu fugiat nulla pariatur. Excepteur sint occaecat
                            cupidatat non proident, sunt in culpa qui officia
                            deserunt mollit anim id est laborum.
                        </p>
                    </div>
                </b-tab>
                <b-tab title-item-class="image" title="Image" >
                    <div class="p-4">
                        <h4>Requirements</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing
                            elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis
                            nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat. Duis aute irure dolor in
                            reprehenderit in voluptate velit esse cillum dolore
                            eu fugiat nulla pariatur. Excepteur sint occaecat
                            cupidatat non proident, sunt in culpa qui officia
                            deserunt mollit anim id est laborum.
                        </p>
                        <h4>Description</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing
                            elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis
                            nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat. Duis aute irure dolor in
                            reprehenderit in voluptate velit esse cillum dolore
                            eu fugiat nulla pariatur. Excepteur sint occaecat
                            cupidatat non proident, sunt in culpa qui officia
                            deserunt mollit anim id est laborum.Lorem ipsum
                            dolor sit amet, consectetur adipisicing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna
                            aliqua. Ut enim ad minim veniam, quis nostrud
                            exercitation ullamco laboris nisi ut aliquip ex ea
                            commodo consequat. Duis aute irure dolor in
                            reprehenderit in voluptate velit esse cillum dolore
                            eu fugiat nulla pariatur. Excepteur sint occaecat
                            cupidatat non proident, sunt in culpa qui officia
                            deserunt mollit anim id est laborum.
                        </p>
                    </div>
                </b-tab>
                <b-tab title-item-class="video" title="Video" active>
                    <div class="accordion" id="accordionExample">
                        <div v-for="section in sections" class="card">
                            <div class="card-header d-flex justify-content-between"
                            id="headingOne">
                            <h2 class="mb-0">
                                <a
                                class="btn btn-link btn-block text-left text-dark"
                                data-toggle="collapse"
                                :data-target="'#collapse' + section.id"
                                >{{ section.name }}</a
                                >
                            </h2>
                        </div>
                        <div class="p-4">
                            <div v-for="video in section.videos">
                                <div
                                class="p-2 pl-4 border rounded d-flex justify-content-between mb-2 align-items-center"
                                >
                                <p v-b-modal="'show-video-'+video.id">{{ video.name }}</p>
                                <div v-if="isCompletedVideo(video.id)" @click="incomplete(video.id)" class="cursor-pointer">
                                    <i class="fa fa-check-circle fa-2x text-primary" aria-hidden="true"></i>
                                </div>
                                <div v-else @click="complete(video.id)" class="cursor-pointer">
                                    <i class="fa fa-check-circle-o fa-2x text-secondary" aria-hidden="true"></i>
                                </div>
                                <!-- Edit and Delete -->
                            </div>
                            <b-modal :id="'show-video-'+video.id" size="xl" hide-header hide-footer>
                                <vue-plyr ref="plyr" @ended="completed(video.id)">
                                    <video poster="poster.png" src="video.mp4">
                                        <source :src="video.url" type="video/mp4" size="720">
                                            <source :src="video.url" type="video/mp4" size="1080">
                                            </video>
                                        </vue-plyr>
                                    </b-modal>
                                </div>
                            </div>
                        </div>
                    </div>
                </b-tab>
                <learn-rating :course_id="courseId"></learn-rating>

            </b-tabs>
        </div>
    </div>
</template>

<script>
    import learnRating from '../components/courses/reviews.vue';
    export default {
        data() {
            return {
                courseId: this.$route.params.id,
                course: {},
                teacher: {},
                students: [],
                sections: [],
                completedBy: [],
                tags: [],
                busy: false,
                isComplete: false,
            };
        },
        computed: {
            user_id(){
                return this.$store.getters.user.id;
            },
            enrolled(){
                return this.students.find(o => o.id === this.user_id);
            },
            isTeacher(){
                return this.user_id == this.course.user_id;
            }
        },
        created() {
            this.fetchCourse();
        },
        methods: {
            swlEndTop(icon, msg){
                const Toast = this.$swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000,
                      timerProgressBar: true,
                      onOpen: (toast) => {
                        toast.addEventListener('mouseenter', this.$swal.stopTimer)
                        toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                    }
                })

                Toast.fire({
                  icon: icon,
                  title: msg
              })
            },
            completed(video){
                axios.post('/api/completeVideo',{
                    video: video,
                    user: this.user_id,
                })
                .then(res => {
                    this.$swal.fire({
                      icon: 'success',
                      title: 'lesson Completted !!',
                      showConfirmButton: true,
                      timer: 1500
                  })
                    this.fetchCourse();
                });
            },
            complete(video){
                axios.post('/api/completeVideo',{
                    video: video,
                    user: this.user_id,
                })
                .then(res => {
                    this.swlEndTop('success', 'lesson completed');
                });
                this.fetchCourse();
            },
            incomplete(video){
                axios.post('/api/incompleteVideo',{
                    video: video,
                    user: this.user_id,
                })
                .then(res => {
                    this.swlEndTop('warning', 'lesson incompleted !!');
                });

                this.fetchCourse();
            },
            makeToast(variant = null, title, body) {
                this.$bvToast.toast(body, {
                    title: title,
                    variant: variant,
                    solid: false,
                    toaster: 'b-toaster-bottom-right',
                    toastClass: 'mb-2'
                })
            },
            fetchCourse(page_url = "/api/courses/" + this.courseId) {
                this.busy = true;
                let vm = this;
                axios.get(page_url).then(({ data: res }) => {
                    this.course = res.data.course;
                    this.teacher = res.data.teacher;
                    this.students = res.data.students;
                    this.sections = res.data.sections;
                    this.completedBy = res.data.completedBy;
                    this.tags = res.data.tags;
                    this.busy = false;
                });
            },
            enrolleCourse(courseId){
               axios.get("/api/enrollCourse/"+ this.user_id + '/' + this.courseId)
                   .then(({ data: res }) => {
                    this.fetchCourse();
                    this.makeToast('success', 'Enrolle course', 'Course enrolled with success');
                });
            },
            cancelCourse(courseId){
               axios.get("/api/cancelCourse/"+ this.user_id + '/' + this.courseId)
                   .then(({ data: res }) => {
                    this.fetchCourse();
                    this.makeToast('danger', 'course Cancelled', 'Course concelled with success');
                });
            },
            isCompletedVideo(video_id){
                let completedBy = this.completedBy.find(o => o.video_id === video_id).completedBy;
                if( completedBy.indexOf(this.user_id) == -1){
                    return false;
                }
                return true;
            }
        },
        components: {
            learnRating
        }
    };
</script>
