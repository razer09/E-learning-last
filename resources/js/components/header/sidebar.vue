<template>
    <header class="sidebar-learn">
        <div class="logo">
            <img src="/img/logo.png">
            <span>E-learning</span>
        </div>
        <nav>
            <ul>
                <router-link tag="li" to="/dashboard"  exact>
                    <a>
                        <i class="fa fa-tachometer"></i>
                        <span>Dashboard</span>
                    </a>
                </router-link>

                <router-link tag="li" to="/explore">
                    <a>
                        <i class="fa fa-compass"></i>
                        <span>Explore</span>
                    </a>
                </router-link>

                <router-link tag="li" to="/courses">
                    <a>
                        <i class="fa fa-graduation-cap"></i>
                        <span>My Courses</span>
                    </a>
                </router-link>

                <router-link tag="li" to="/calendar">
                    <a>
                        <i class="fa fa-calendar"></i>
                        <span>Calendar</span>
                    </a>
                </router-link>

                <router-link tag="li" to="/chats">
                    <a>
                        <i class="fa fa-commenting-o"></i>
                        <span>Chats</span>
                    </a>
                </router-link>

                <router-link v-can="$route.meta.roles" tag="li" to="/tags">
                    <a>
                        <i class="fa fa-link"></i>
                        <span>Tags</span>
                    </a>
                </router-link>

                <li>
                    <a href="#">
                        <i class="fa fa-book"></i>
                        <span>Exams</span>
                    </a>
                </li>

                <router-link tag="li" to="/certification">
                    <a>
                        <i class="fa fa fa-trophy"></i>
                        <span>certification</span>
                    </a>
                </router-link>

            </ul>

            <ul>
                <router-link tag="li" to="/settings">
                    <a>
                        <i class="fa fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </router-link>

                <router-link tag="li" to="/help">
                    <a>
                        <i class="fa fa-info-circle"></i>
                        <span>Help</span>
                    </a>
                </router-link>
            </ul>
            <ul>
                <li>
                    <a href="#">
                        <i class="fa fa-sign-out"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
             <!-- End Side board -->

        </nav>
    </header>
</template>

<script>
export default {
};
</script>

<style lang="css" scoped>
</style>
