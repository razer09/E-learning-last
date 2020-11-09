import './bootstrap';

import router from './routes';

import store from './store/index.js';

import can from './directives/roles.js';


Vue.directive('can', can);

new Vue({

    el: '#app',

    router,

    store,

});

$('#expand_sidebar').click(function (e) {
    $( 'header, main' ).toggleClass( "hide" );
    $( 'header span' ).fadeToggle(300);
});

$('header').hover(function(){
    if( $('header').hasClass('hide') ){
        $( 'header span' ).fadeIn(300);
    }
  }, function(){
    if( $('header').hasClass('hide') ){
        $( 'header span' ).fadeOut(300);
    }
});
