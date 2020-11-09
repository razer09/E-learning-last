<template>
    <div class="topboard bg-white">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <div class="input-group search mr-auto">
                      <input type="search" class="form-control" placeholder="Search" aria-label="Search">
                      <div class="input-group-append">
                         <button class="btn btn-orange-outline" type="button">
                            <i class="fa fa-search"></i>
                         </button>
                      </div>
                    </div>

                    <ul class="navbar-nav link">
                        <li id="expand_sidebar" class="nav-item">
                            <i class="fa fa-expand"></i>
                        </li>
                        <li class="nav-item active">
                            <i class="fa fa-globe"></i>
                        </li>
                        <li class="nav-item dropdown notif ">
                            <a class="nav-link dropdown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="badge badge-pill badge-danger">5</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-center" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="https://i.pravatar.cc/40"
                                class="rounded-circle">
                                Acil009
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" @click.prevent="logout">Log out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</template>

<script>
export default {
    methods: {
        logout(){
             axios.post('/logout')
             .then( res => {
                this.$store.dispatch('logout');
                this.$router.push({ name: 'login' }).catch(e => {console.log(e);});
            });
        },
    }

};
</script>

<style lang="css" scoped>
</style>
