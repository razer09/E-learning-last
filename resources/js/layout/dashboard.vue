<template>
    <div>
       <side-bar></side-bar>

        <main class="">
            <top-bar></top-bar>
            <transition name="slide" mode="out-in">
                <slot />
            </transition>
        </main>
    </div>


</template>

<script>
    import topBar from '../components/header/topbar.vue';
    import sideBar from '../components/header/sidebar.vue';
    export default {
        components: {
            topBar,
            sideBar
        },
        computed: {
            user(){
                return this.$store.getters.user;
            }
        },
        mounted(){
            this.firstColor(this.user.first_color);
            this.secondColor(this.user.second_color);
            this.selectFontSize(this.user.font_size);
            this.selectFullScreen(this.user.full_screen);
        },
        methods: {
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
            selectFontSize(){
                let size = this.user.font_size;
                document.querySelector(':root').style.setProperty('--font-size', size + 'px');
            },
            selectFullScreen(screen){
                let fullScreen = screen;
                if( fullScreen == '1' ){
                    $( 'header, main' ).addClass( "hide" );
                    $( 'header span' ).fadeOut(300);
                }else{
                    $( 'header, main' ).removeClass( "hide" );
                    $( 'header span' ).fadeIn(300);
                }
                $('header').hover(function(){
                    if( $('header').hasClass('hide') ){
                        $( 'header span' ).fadeIn(300);
                    }
                  }, function(){
                    if( $('header').hasClass('hide') ){
                        $( 'header span' ).fadeOut(300);
                    }
                });
            }
        }
    }
</script>

<style>
    .slide-enter-active {
        animation: slide-in 200ms ease-out forwards;
    }

    .slide-leave-active {
        animation: slide-out 200ms ease-out forwards;
    }

    @keyframes slide-in {
        from {
            transform: translateX(50px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slide-out {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(50px);
            opacity: 0;
        }
    }
</style>
