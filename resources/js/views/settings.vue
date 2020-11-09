<template>
    <div class="mainboard mt-5">
        <div class="container settings-page mb-4">
            <div class="settings shadow-sm">
                <b-tabs content-class="bg-white">
                    <b-tab title="Profile">
                        <form>
                            <div class="row p-4">
                                <div class="col-8 border-right">
                                    <div class="form-group">
                                        <div class="custom-file mb-3">
                                             <div class="d-flex justify-content-between align-items-center mb-4">
                                                <img :src="user.thubnail" style="width: 150px; height: 150px;"/>
                                                <input
                                                    name="thubnail"
                                                    type="file"
                                                    @change="handleFileUpload"
                                                    ref="thubnail"
                                                    enctype="multipart/form-data"
                                                />
                                            </div>
                                        </div>
                                        <label for="exampleInputPassword1">User Name</label>
                                        <input type="text" class="form-control" name="username" v-model="user.name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" name="email" v-model="user.email">
                                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Facebook</label>
                                        <input type="text" class="form-control" name="facebook" v-model="user.facebook">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Twitter</label>
                                        <input type="text" class="form-control" name="twitter" v-model="user.twitter">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">website</label>
                                        <input type="text" class="form-control" name="website" v-model="user.website">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </b-tab>

                    <b-tab title="Preferences">
                        <form>
                            <div class="row p-4">
                                <div class="col-6 border-right mt-4 mb-4 pl-4">

                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input mr-4" id="switch1" v-model="user.dark_mode" :true-value="1" :false-value="0">
                                        <label class="custom-control-label" for="switch1">
                                            Dark Mode
                                            <small id="emailHelp" class="form-text text-muted">Enable dark mode for fun.</small>
                                        </label>
                                    </div>

                                    <div class="custom-control custom-switch mt-4">
                                        <input type="checkbox" class="custom-control-input mr-4" id="switch2" v-model="user.full_screen" :true-value="1" :false-value="0" @change="selectFullScreen">

                                        <label class="custom-control-label" for="switch2">
                                            Full screen
                                            <small id="emailHelp" class="form-text text-muted">Enable Full screen.</small>
                                        </label>
                                    </div>

                                    <div class="theme-mode mt-4">
                                        <h5>Theme Color</h5>
                                        <div class="colors">
                                            <button @click.prevent="selectFirst('dark')" class="btn btn-dark ml-2"
                                            :class="{ focus : user.first_color == 'dark'}" >
                                            </button>
                                            <button @click.prevent="selectFirst('primary')" class="btn btn-primary ml-2"
                                            :class="{ focus : user.first_color == 'primary'}">
                                            </button>
                                            <button @click.prevent="selectFirst('warning')" class="btn btn-warning ml-2"
                                            :class="{ focus : user.first_color == 'warning'}"></button>
                                            <button @click.prevent="selectFirst('info')" class="btn btn-info ml-2"
                                            :class="{ focus : user.first_color == 'info'}"></button>
                                            <button @click.prevent="selectFirst('danger')" class="btn btn-danger ml-2"
                                            :class="{ focus : user.first_color == 'danger'}"></button>
                                        </div>
                                    </div>

                                    <div class="theme-mode mt-4">
                                        <h5>Second Color</h5>
                                        <div class="colors">
                                            <button @click.prevent="selectSecond('dark')" class="btn btn-dark ml-2"
                                            :class="{ focus : user.second_color == 'dark'}"></button>
                                            <button @click.prevent="selectSecond('primary')" class="btn btn-primary ml-2 btn-default" id="prim"
                                            :class="{ focus : user.second_color == 'primary'}"></button>
                                            <button @click.prevent="selectSecond('warning')" class="btn btn-warning ml-2" onload='this.focus();'
                                            :class="{ focus : user.second_color == 'warning'}"></button>
                                            <button @click.prevent="selectSecond('info')" class="btn btn-info ml-2"
                                            :class="{ focus : user.second_color == 'info'}"></button>
                                            <button @click.prevent="selectSecond('danger')" class="btn btn-danger ml-2"
                                            :class="{ focus : user.second_color == 'danger'}"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">font size (Px)</label>
                                        <input type="number" class="form-control" @change="selectFontSize" name="font_size" v-model="user.font_size">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputState">Language</label>
                                        <select id="inputState" class="form-control" v-model="user.language">
                                            <option disabled value="">Select Language</option>
                                            <option>English</option>
                                            <option>Arabic</option>
                                            <option>Espeign</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </b-tab>

                    <div class="card-footer text-right bg-white">
                        <b-overlay
                            :show="busy"
                            rounded
                            spinner-variant="primary"
                            opacity="0.6"
                            spinner-small
                            class="d-inline-block mb-3"
                        >
                            <div class="btn btn-primary px-4 mr-2" @click="onSubmit" :class="color">Save profile</div>
                        </b-overlay>
                        <div class="btn btn-light disabled border">Cancel</div>
                    </div>
                </b-tabs>

            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data(){
            return{
                thubnail_url:"storage/users/default_thubnail.png",
                editchild: true,
                checked: false,
                busy: false
            }
        },
        computed: {
            user(){
                return this.$store.getters.user;
            },
            color(){
                 return this.$store.getters.user.first_color;
            }
        },
        mounted(){
            this.thubnail_url = this.user.thubnail;
        },
        methods: {
            handleFileUpload(event) {
                console.log(event.target.files);
                this.thubnail_url = event.target.files[0];
            },
            onSubmit() {
                this.busy = true;
                let formData = new FormData();
                formData.append("name", this.user.name);
                formData.append("email", this.user.email);
                formData.append("thubnail", this.thubnail_url);
                formData.append("password", this.user.password);
                formData.append("facebook", this.user.facebook);
                formData.append("twitter", this.user.twitter);
                formData.append("website", this.user.website);
                formData.append("dark_mode", this.user.dark_mode);
                formData.append("full_screen", this.user.full_screen);
                formData.append("first_color", this.user.first_color);
                formData.append("second_color", this.user.second_color);
                formData.append("font_size", this.user.font_size);
                formData.append("language", this.user.language);

                let settings = { headers: { "Content-Type": "application/json" } };

                if (this.editchild === false) {
                    // Add
                    axios.post("/api/users", formData, settings).then(res => {
                        this.course_id = res.data.data.course.id;
                        this.$emit('update:course_id', res.data.data.course.id);
                        console.log(res.data.data);
                        this.thubnail_url = res.data.data.thubnail;
                        this.busy = false;
                });
                } else {
                    // Update
                    formData.append("_method", 'patch');
                    let settings = { headers: { "Content-Type": "application/x-www-form-urlencoded" } };
                    axios.post("/api/users/"+this.user.id, formData, settings).then(({data}) => {
                            this.thubnail_url = data.data.thubnail;
                            this.$store.dispatch('updateUser', data.data);
                            this.busy = false;
                            this.makeToast('success', 'Setting Saved', 'Setting Saved with success');
                        });
                }
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
            firstColor(color){
                let body = document.querySelector(':root').style;
                switch(color) {
                    case 'dark':
                        body.setProperty('--first-color', '#23272b');
                        break;
                    case 'warning':
                        body.setProperty('--first-color', '#ffc107');
                        break;
                    case 'info':
                        body.setProperty('--first-color', '#17a2b8');
                        break;
                    case 'danger':
                        body.setProperty('--first-color', '#dc3545');
                        break;
                    case 'primary':
                        body.setProperty('--first-color', '#0B5BF1');
                        break;
                }
            },
            secondColor(color){
                let body = document.querySelector(':root').style;
                switch(color) {
                    case 'dark':
                        body.setProperty('--second-color', '#23272b');
                        break;
                    case 'warning':
                        body.setProperty('--second-color', '#ffc107');
                        break;
                    case 'info':
                        body.setProperty('--second-color', '#17a2b8');
                        break;
                    case 'danger':
                        body.setProperty('--second-color', '#dc3545');
                        break;
                    case 'primary':
                        body.setProperty('--second-color', '#0B5BF1');
                        break;
                }
            },
            selectFirst(color){
                this.user.first_color = color;
                this.firstColor(color);
            },
            selectSecond(color){
                this.user.second_color = color;
                this.secondColor(color);
            },
            selectFontSize(){
                let size = this.user.font_size;
                document.querySelector(':root').style.setProperty('--font-size', size + 'px');
            },
            selectFullScreen(){
                let fullScreen = this.user.full_screen;
                if( fullScreen == '1' ){
                    $( 'header, main' ).addClass( "hide" );
                    $( 'header span' ).fadeOut(300);
                }else{
                    $( 'header, main' ).removeClass( "hide" );
                    $( 'header span' ).fadeIn(300);
                }
            }
        },
        components: {

        }
    }
</script>
<style lang="scss">

.dark{
    $mainColor: #23272b;
}

.warning{
    $mainColor: #ffc107;
}

.info{
    $mainColor: #17a2b8;
}

.primary{
    $mainColor: #0B5BF1;
}
</style>
