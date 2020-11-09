<template>
    <div class="container courses-page mt-5">
        <b-overlay :show="show" rounded="sm">
            <div class="row">
                <div class="col-8">
                    <router-link
                        tag="a"
                        :to="{ name: 'createCourse' }"
                        class="btn btn-warning mb-5 text-white"
                        exact
                    >
                        <h5 class="card-title">Creer new course</h5>
                    </router-link>
                </div>
            </div>
            <!-- Enrolled Courses -->
            <div class="courses my-5">
                <div class="d-flex header justify-content-between mx-2">
                    <h3>Enrolled Courses</h3>
                    <div class="dropdown">
                        <button
                            class="btn bg-white shadow-lg dropdown-toggle"
                            type="button"
                            id="dropdownMenuButton"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            Latest
                        </button>
                        <div
                            class="dropdown-menu dropdown-menu-right"
                            aria-labelledby="dropdownMenuButton"
                        >
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#"
                                >Something else here</a
                            >
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <course-learn
                        v-for="course in enrolledCoures"
                        :key="course.id"
                        :course="course"
                        @fetchCourses="enrolledCourses"
                    ></course-learn>
                </div>
                <div
                    class="row justify-content-center mt-5"
                    v-if="paginationCourse"
                >
                    <nav aria-label="Page navigation example text-center">
                        <ul class="pagination">
                            <li
                                class="page-item"
                                :class="[{ disabled: !paginationCourse.prev_page }]"
                            >
                                <a
                                    class="page-link"
                                    href="#"
                                    @click.prev="
                                        fetchCourses(paginationCourse.prev_page)
                                    "
                                >
                                    Previous
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">
                                    Page {{ paginationCourse.current_page }} of
                                    {{ paginationCourse.last_page }}
                                </a>
                            </li>
                            <li
                                class="page-item"
                                :class="[{ disabled: !paginationCourse.next_page }]"
                            >
                                <a
                                    class="page-link"
                                    href="#"
                                    @click.prev="
                                        fetchCourses(paginationCourse.next_page)
                                    "
                                >
                                    Next
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- End Enrolled Courses -->

            <!-- Created Courses -->
            <div class="courses my-5">
                <div class="d-flex header justify-content-between mx-2">
                    <h3>Created Courses</h3>
                    <div class="dropdown">
                        <button
                            class="btn bg-white shadow-lg dropdown-toggle"
                            type="button"
                            id="dropdownMenuButton"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            Latest
                        </button>
                        <div
                            class="dropdown-menu dropdown-menu-right"
                            aria-labelledby="dropdownMenuButton"
                        >
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#"
                                >Something else here</a
                            >
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <course-learn
                        v-for="course in courses"
                        :key="course.id"
                        :course="course"
                        @fetchCourses="createdCourses"
                    ></course-learn>
                </div>
                <div
                    class="row justify-content-center mt-5"
                    v-if="paginationCourse"
                >
                    <nav aria-label="Page navigation example text-center">
                        <ul class="pagination">
                            <li
                                class="page-item"
                                :class="[{ disabled: !paginationCourse.prev_page }]"
                            >
                                <a
                                    class="page-link"
                                    href="#"
                                    @click.prev="
                                        fetchCourses(paginationCourse.prev_page)
                                    "
                                >
                                    Previous
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">
                                    Page {{ paginationCourse.current_page }} of
                                    {{ paginationCourse.last_page }}
                                </a>
                            </li>
                            <li
                                class="page-item"
                                :class="[{ disabled: !paginationCourse.next_page }]"
                            >
                                <a
                                    class="page-link"
                                    href="#"
                                    @click.prev="
                                        fetchCourses(paginationCourse.next_page)
                                    "
                                >
                                    Next
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- End Created Courses -->
        </b-overlay>
    </div>
</template>

<script>
import tagsLearn from "../components/courses/tags";
import courseLearn from "../components/courses/course";

export default {
    components: {
        tagsLearn,
        courseLearn
    },
    computed: {
        user_id() {
            return this.$store.getters.user.id;
        }
    },
    data() {
        return {
            courses: [],
            paginationCourse: {},
            enrolledCoures: [],
            paginationEnrolled: {},
            show: false
        };
    },
    created() {
        this.createdCourses();
        this.enrolledCourses();
    },
    methods: {
        createdCourses(page_url = "/api/createdCourses/" + this.user_id) {
            this.show = true;
            let vm = this;

            axios.get(page_url).then(({ data: res }) => {
                this.courses = res.data;

                vm.makePagination(res.meta, res.links, "paginationCourse");
                this.show = false;
            });
        },
        enrolledCourses(page_url = "/api/enrolledCourses/" + this.user_id) {
            this.show = true;
            let vm = this;

            axios.get(page_url).then(({ data: res }) => {
                this.enrolledCoures = res.data;

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
};
</script>
