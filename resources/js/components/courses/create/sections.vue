<template>
    <div class="tab-pane fade" id="notification">
        <form @submit.prevent="addSection" class="p-4">
            <div class="form-group">
                <label>Section Name</label>
                <div class="d-flex justify-content-between">
                    <input
                        name="name"
                        type="text"
                        class="form-control mr-4"
                        v-model="sect_name"
                    />
                    <button type="submit" class="btn btn-info">Add</button>
                </div>
            </div>
        </form>
        <b-overlay :show="show" rounded="sm">
            <div class="accordion p-3 pt-0" id="accordionExample">
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
                        <div>
                            <span edit-model-sect
                                class="badge badge-success p-2 mr-2"
                                v-b-modal.edit-model-sect
                            >
                                <i class="fa fa-pencil"></i>
                            </span>
                            <!-- Edit Modal -->
                            <b-modal id="edit-model-sect" title="Edit section" centered>
                                <div class="form-group">
                                    <label>Section name</label>
                                    <input
                                        name="sect_name"
                                        type="text"
                                        class="form-control"
                                        v-model="sect_EName"
                                    />
                                </div>
                                <template v-slot:modal-footer>
                                    <button
                                        type="button"
                                        class="btn btn-primary"
                                        @click="editSection(section.id)"
                                    >
                                        Save changes
                                    </button>
                                </template>
                            </b-modal>

                            <span
                                class="badge badge-danger p-2"
                                @click="deleteSection(section.id)"
                             >
                                <i class="fa fa-trash"></i>
                            </span>
                        </div>
                    </div>

                    <videos-learn :section="section" @fetchAllSection="fetchAllSection">
                    </videos-learn>

                </div>
            </div>
        </b-overlay>
    </div>
</template>

<script>
    import videosLearn from './videos.vue';
export default {
    components:{
        videosLearn
    },
    props: ['course_id'],
    data() {
        return {
            sections: [],
            sect_name: "",
            sect_EName: "Name of sections",
            video_name: "",
            video_url: "",
            show: false
        };
    },
    created(){
        this.fetchAllSection();
    },
    methods: {
        fetchAllSection(page_url = "/api/courses/" + this.course_id + "/sections") {
                this.show = true;
            axios.get(page_url).then(({ data: res }) => {
                this.sections = res.data;
                this.show = false;
            });
        },
        addSection() {
            axios.post("/api/courses/" + this.course_id + "/sections", {
                    course_id: this.course_id,
                    name: this.sect_name,
                })
                .then((res) => {
                    this.fetchAllSection();
                });
        },
        editSection(id) {
            axios.put("/api/sections/" + id, {
                    course_id: this.course_id,
                    name: this.sect_EName,
                })
                .then((res) => {
                    this.fetchAllSection();
                });
        },
        deleteSection(id) {

            axios.delete("/api/sections/" + id)
                .then((res) => {
                    this.fetchAllSection();
                });
        }
    },
};
</script>
