<template>
    <div class="d-flex justify-content-center align-items-center">

        <form @submit.prevent="login" class="m-5">
                <h1 class="mb-5">Login Page</h1>
                <div class="form-group">
                    <label for="exampleInputEmail1">
                        email
                    </label>
                    <input  name="name"
                            type="text"
                            class="form-control"
                            v-model="email"
                    >
                    <small class="text-danger">

                    </small>

                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">
                        password
                    </label>
                    <input  name="password"
                            type="password"
                            class="form-control"
                            v-model="password"
                    >
                    <small class="text-danger">

                    </small>
                </div>

                <button type="submit" class="btn btn-primary">
                    login
                </button>

                <a class="btn btn-success m-5 text-white" @click.prev="logout">Logout</a>

        </form>
    </div>
</template>

<script>
export default {

    data() {
        return {
            password: '',
            email: ''
        };
    },
    methods: {
        login(){
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/login',{
                    password: this.password,
                    email: this.email
                })
                .then(res2 => {
                    this.getall();

                });
            });
        },
        getall(){
            axios.get('/api/user')
             .then( ({data}) => {
                this.$store.dispatch('setUser', data);
                this.setAbilities(data.id);
                this.setTags(data.id);
                this.$router.push({ name: 'dashboard' }).catch(e => {console.log(e);});
            });
        },
        setAbilities(user_id){
            axios.get('/api/abilities/'+ user_id)
             .then( ({data}) => {
                this.$store.dispatch('setRoles', data);
            });
        },
        setTags(user_id){
            axios.get('/api/tagsUser/'+ user_id)
             .then( ({data}) => {
                this.$store.dispatch('setTags', data);
            });
        },
        logout(){
             axios.post('/logout')
             .then( res => {
                this.$store.dispatch('logout');
                console.log(res);
                this.$router.push({ name: 'login' }).catch(e => {console.log(e);});
            });
        },
    }
    };
</script>

<style lang="css" scoped>
</style>
