<template>
    <div :id="'collapse' + section.id" class="collapse" data-parent="#accordionExample">
        <div class="card-body">

            <form @submit.prevent="addVideo(section.id)" class="p-2">
                <div class="form-group">
                    <label>Video Name</label>
                    <input
                        name="name"
                        type="text"
                        class="form-control mr-4"
                        v-model="video_name"
                    />
                </div>
                <div class="form-group">
                    <label>Video Url</label>
                    <input
                        name="url"
                        type="file"
                        @change="handleVideoUpload"
                        :ref="video_url"
                    />
                </div>
                <button type="submit" class="btn btn-info m-2">
                    Add
                </button>
            </form>
            <b-overlay :show="show" rounded="sm">
                <div v-for="video in section.videos">
                    <div
                        class="p-2 pl-4 border rounded d-flex justify-content-between mb-2"
                    >
                        <p v-b-modal="'show-video-'+video.id">{{ video.name }}</p>
                        <!-- Edit and Delete -->
                        <div>
                            <span
                                class="badge badge-success p-2 mr-2"
                                v-b-modal="'edit-model'+video.id"
                            >
                                <i class="fa fa-pencil"></i>
                            </span>
                            <span
                                class="badge badge-danger p-2"
                                @click="deleteVideo(video.id)"
                            >
                                <i class="fa fa-trash"></i>
                            </span>
                        </div>
                    </div>
                    <b-modal :id="'show-video-'+video.id" size="xl" hide-header hide-footer>
                        <vue-plyr ref="plyr" @ended="hellow">
                            <video poster="poster.png" src="video.mp4">
                                <source :src="video.url" type="video/mp4" size="720">
                                <source :src="video.url" type="video/mp4" size="1080">
                            </video>
                        </vue-plyr>
                    </b-modal>
                    <!-- Edit Modal -->
                    <b-modal :id="'edit-model'+video.id" title="Edit Video" centered>
                        <div class="form-group">
                            <label>Video Name</label>
                            <input
                                name="name"
                                type="text"
                                class="form-control mr-4"
                                v-model="video_name"
                            />
                        </div>
                        <div class="form-group">
                            <label>Video Url</label>
                            <input
                                name="url"
                                type="file"
                                @change="handleVideoUpload"
                                :ref="video_url"
                            />
                        </div>
                        <template v-slot:modal-footer>
                            <button
                                type="button"
                                class="btn btn-primary"
                                @click="
                                    editVideo(video.id, section.id)
                                "
                            >
                                Save changes
                            </button>
                        </template>
                    </b-modal>

                </div>
            </b-overlay>
        </div>

    </div>

</template>

<script>

export default {
    props: ['section'],
    data() {
        return {
            video_name: "",
            video_url: "",
            selectedFile: null,
            show: false
        };
    },
    computed: {
        player () {
          return this.$refs.plyr.player;
        }
      },
    mounted(){

    },
    methods: {
        hellow(){
            alert('hellown in end');
        },

        handleVideoUpload(event) {
            this.video_url = event.target.files[0];
        },
        addVideo(id) {
            let formData = new FormData();
            formData.append("section_id", id);
            formData.append("name", this.video_name);
            formData.append("url", this.video_url);

            let settings = {
                headers: { "content-type": "multipart/form-data" },
            };

            axios
                .post("/api/sections/" + id + "/videos", formData, settings)
                .then((res) => {
                    this.$emit('fetchAllSection')
                });
        },
        editVideo(id, section) {
            let formData = new FormData();
            formData.append("section_id", section);
            formData.append("name", this.video_name);
            formData.append("url", this.video_url);
            formData.append("_method", 'patch');

            let settings = { headers: { "Content-Type": "application/x-www-form-urlencoded" } };
            axios.post("/api/videos/" + id, formData, settings)
                .then((res) => {
                    this.$emit('fetchAllSection')
                });
        },
        deleteVideo(id) {
            axios
                .delete("/api/videos/" + id)
                .then((res) => this.$emit('fetchAllSection'));
        },
    },
};
</script>
