<template>
    <form @submit.prevent="onSubmit">
        <div class="row p-4">
            <div class="col-8 border-right">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <img :src="thubnail_url"style="width: 200px; height: 120px;"/>
                    <input
                        name="thubnail"
                        type="file"
                        @change="handleFileUpload"
                        ref="thubnail"
                        enctype="multipart/form-data"
                    />
                </div>
                <div class="form-group">
                    <label>title</label>
                    <input
                        name="title"
                        type="text"
                        class="form-control"
                        v-model="title"
                    />
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" type="text" class="form-control"
                              v-model="description"
                    ></textarea>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Old price</label>
                    <input name="old_price" type="text" class="form-control"
                           v-model="old_price"
                    />
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input name="price" type="text" class="form-control"
                           v-model="price"
                    />
                </div>
            </div>
        </div>
        <div class="card-footer bg-white d-flex justify-content-end">
            <div class="btn btn-light mr-2 disabled border">
                Cancel
            </div>
            <button type="submit" class="btn btn-primary px-4">
                Save profile
            </button>
        </div>
    </form>
</template>

<script>
export default {
    props:['edits'],
    data() {
        return {
            course_id: "",
            title: "",
            description: "",
            thubnail: "",
            thubnail_url: "/storage/courses/default_image.png",
            old_price: "",
            price: "",
            editchild: this.edits
        };
    },
    created(){
        this.getCourse();

    },
    computed: {
        user_id(){
            return this.$store.getters.user.id;
        }
    },
    methods: {
        getCourse(){
            if (this.editchild == true) {
                this.course_id = this.$route.params.id;
                axios.get("/api/courses/"+ this.course_id ).then(({data}) => {
                    this.onEdit(data.data.course);
                });
            }
        },
        handleFileUpload(event) {
            console.log(event.target.files);
          this.thubnail = event.target.files[0];
        },
        onSubmit() {
            let formData = new FormData();
            formData.append("user_id", this.user_id);
            formData.append("title", this.title);
            formData.append("description", this.description);
            formData.append("thubnail", this.thubnail);
            formData.append("old_price", this.old_price);
            formData.append("price", this.price);

            let settings = { headers: { "Content-Type": "application/json" } };

            if (this.editchild === false) {
                // Add
                axios.post("/api/courses", formData, settings).then(res => {
                  this.course_id = res.data.data.course.id;
                  this.$emit('update:course_id', res.data.data.course.id);
                  this.thubnail_url = res.data.data.course.thubnail;
            });
            } else {
                // Update
                formData.append("_method", 'patch');
                let settings = { headers: { "Content-Type": "application/x-www-form-urlencoded" } };
                axios.post("/api/courses/"+this.course_id, formData, settings).then(({data}) => {
                        this.onEdit(data.data.course)
                    });
            }
        },
        onEdit(course){
            this.title          = course.title;
            this.description    = course.description;
            this.thubnail       = course.thubnail;
            this.thubnail_url   = course.thubnail;
            this.old_price      = course.old_price;
            this.price          = course.price;
        }
    }
};
</script>

<style lang="css" scoped></style>
