<template>
    <div class="col-3 mb-2 mt-4">
        <div class="card shadow" style="width: 16rem;">
            <div class="image position-relative">
                <div class="rating position-absolute bg-warning rounded-pill px-2 py-0 pr-3 text-white">
                    <i class="fa fa-star-o"></i>
                    4.5
                </div>
                <div v-if="isTeacher">
                    <router-link class="edit position-absolute bg-success rounded px-2 py-0 text-white" :to="{ name: 'editCourse', params: { id: course.id }}">
                        <i class="fa fa-edit"></i>
                    </router-link>

                    <div class="delete position-absolute bg-danger rounded px-2 py-0 text-white" @click="deleteCourse(course.id)">
                        <i class="fa fa-trash"></i>
                    </div>
                </div>
                <div class="hours position-absolute bg-dark rounded-pill px-2
                    py-0 pr-3 text-white">
                    {{course.nbr_hours}}
                </div>
                <img :src="course.thubnail" class="card-img-top" alt="...">
            </div>

            <div class="card-header d-flex justify-content-between">
                <div class="">
                    <i class="fa fa-laptop fa-lg"></i>
                    <span>{{course.nbr_lessons}} Lesson</span>
                </div>
                <span>4 Day ago</span>
            </div>
            <div class="card-body">
                <router-link tag="a"
                    :to="{ name: 'singleCourse', params: { id: course.id }}"
                    exact>
                   <h5 class="card-title">{{course.title}}</h5>
                </router-link>
                <p class="card-text">
                    {{course.description}}
                </p>
            </div>
            <div class="card-footer text-nowrap d-flex justify-content-between bg-white">
                <div class="author">
                    <strong class="text-primary">By</strong>
                    {{course.teacher.name}}
                </div>
                <span class="">{{course.price + '$'}}</span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['course'],
        data() {
            return {
            };
        },
        computed: {
            user_id(){
                return this.$store.getters.user.id;
            },
            isTeacher(){
                if(this.user_id == this.course.teacher.id){
                    return true;
                }else {
                    return false;
                }
            }
        },
        methods:{
            deleteCourse(id){
                axios.delete('/api/courses/'+id)
                .then(res => this.$emit('fetchCourses'))
            }
        }
    }
</script>
