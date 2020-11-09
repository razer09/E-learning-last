import VueRouter from 'vue-router';

import store from './store/index.js';

//Layouts
    import dashboard from './layout/dashboard.vue'
    import guest from './layout/guest.vue'

//Component
    import Home from './views/home.vue';
    import login from './views/login.vue';
    import About from './views/about.vue';
    import certification from './views/certification.vue';
    import tags from './views/tags.vue';
    import explore from './views/explore.vue';
    import courses from './views/courses.vue';
    import settings from './views/settings.vue';
    import help from './views/help.vue';
    import chats from './views/chats.vue';
    import calendar from './views/calendar.vue';
    import singleCourse from './views/singleCourse.vue';
    import createCourse from './views/course/create.vue';
    import editCourse from './views/course/edit.vue';


let router =new VueRouter({
    mode: "history",
    linkActiveClass: "active",
    routes :
    [
        { path: '/', redirect: '/dashboard' },
        { path: '/dashboard', name: 'dashboard',  component: Home,
            meta: { layout: dashboard, requiresAuth: true, roles: true }
        },

        { path: '/admin', name: 'login', component: login,
            meta: { layout: guest, requiresVisitor: true, requiresAuth: false,  roles: true  }
        },

        { path: '/about', component: About,
            meta: { layout: dashboard, requiresAuth: true }
        },

        { path: '/explore', component: explore,
            meta: { layout: dashboard, requiresAuth: true,  roles: true }
        },

        { path: '/certification', component: certification,
            meta: { layout: dashboard, requiresAuth: true,  roles: true }
        },

        { path: '/tags', component: tags,
            meta: { layout: dashboard, requiresAuth: true, roles: 'edit_stock' }
        },

        { path: '/courses', component: courses,
            meta: { layout: dashboard, requiresAuth: true,  roles: true }
        },
        { name: 'singleCourse', path: '/course/:id', component: singleCourse,
            meta: { layout: dashboard, requiresAuth: true,  roles: true }
        },

        { name: 'createCourse', path: '/courses/create', component: createCourse,
            meta: { layout: dashboard, requiresAuth: true,  roles: true }
        },
        { name: 'editCourse', path: '/course/edit/:id', component: editCourse,
            meta: { layout: dashboard, requiresAuth: true, roles: true }
        },

        { path: '/settings', component: settings,
            meta: { layout: dashboard, requiresAuth: true,  roles: true }
        },

        { path: '/help', component: help,
            meta: { layout: dashboard, requiresAuth: true,  roles: true }
        },

        { path: '/chats', component: chats,
            meta: { layout: dashboard, requiresAuth: true,  roles: true }
        },

        { path: '/calendar', component: calendar,
            meta: { layout: dashboard, requiresAuth: true, roles: 'edit_stock' }
        },

    ]

});

// Guarde
function isLoggedIn() {
    return store.getters.login;
}

function roles() {
    return store.getters.roles;
}


router.beforeEach((to, from, next) => {

    if (to.matched.some((record) => record.meta.requiresAuth)) {

        if (!isLoggedIn()) {
            next({name: "login"});
        } else {
            //Loged in
            let meta_roles = to.meta.roles;
            let hasGeneral = meta_roles == true ? true : false;
            let roles = store.getters.roles;
            let exist = roles.indexOf(meta_roles);
            if(exist != -1 || hasGeneral){
                next();
            }else{
                next(false);
            }
        }
    } else if (to.matched.some((record) => record.meta.requiresVisitor)) {
        if (isLoggedIn()) {
            next({
                name: "dashboard",
            });
        } else {
            next();
        }
    } else {
        next();
    }
});


export default router;
