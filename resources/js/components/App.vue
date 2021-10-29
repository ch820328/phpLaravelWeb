<template>
    <el-container style="height: 100%;">
        <el-aside :width=aside_width style="background: #545c64;">
            <nav_aside :is_collapse="is_collapse"></nav_aside>
        </el-aside>
        <el-container>
            <el-header height="30px">
                <div style="font-size: 18px; font-weight: bold;">
                    {{ header_title }}
                </div>
            </el-header>
            <el-main style="background: #e8e8e8;">
                <router-view @update_title_event="update_parent_title_event" :title="header_title"></router-view>
            </el-main>
            <el-footer height="30px">
                <div id="link_web" style="text-align: center; font-size: 20px;"></div>
            </el-footer>
        </el-container>
        <nav_aside_setting></nav_aside_setting>
    </el-container>
</template>
<script>
import nav_aside from './layout/nav-aside'
import nav_aside_setting from './layout/nav-aside-setting'
import test from './Test'

export default {
    data() {
        return {
            is_collapse: false,
            aside_width: "200px",
            screen_width: window.innerWidth,
            screen_height: window.innerHeight,
            header_title: {
                title: "Test"
            }
        }
    },
    created() {
        this.checkWebAuth();
        this.initial_nav_aside_collapse();
    },
    mounted() {
        const that = this;
        window.onresize = () => {
            this.screen_width = window.innerWidth;
            that.screen_width = this.screen_width;
            this.screen_height = window.innerHeight;
            that.screen_height = this.screen_height;
        };
        console.log(this.$route);
        console.log('Window width: ', this.screen_width, 'Window height: ', this.screen_height);
        this.timer = setInterval(() => {
            this.checkWebAuth();
        }, 1000 * 300)
    },
    methods: {
        update_parent_title_event(value) {
            this.header_title = value;
        },
        initial_nav_aside_collapse() {
            if (window.innerWidth < 1280) {
                this.is_collapse = true;
                this.aside_width = "64px";
            }
        },
        async checkWebAuth() {
            let axios_response;
            console.log('API: get => /check-web-auth/get');
            await axios.get('/check-web-auth/get', {}).then(function (response) {
                console.log(response);
                axios_response = response
            }).catch(function (error) {
                console.log(error);
                location.reload();
            });
        },
    },
    watch: {
        screen_width(value) {
            if (!this.timer) {
                this.screen_width = value
                this.is_collapse = value < 1280;
                if (this.is_collapse) {
                    this.aside_width = "64px";
                } else {
                    this.aside_width = "200px";
                }
                console.log('Nav-aside is_collapse: ', this.is_collapse)
                this.timer = true
                let that = this
                setTimeout(function () {
                    console.log('Window width: ', that.screen_width)
                    that.timer = false
                }, 100)
            }
        },
        screen_height(value) {
            if (!this.timer) {
                this.screen_height = value
                this.timer = true
                let that = this
                setTimeout(function () {
                    console.log('Window height: ', that.screen_height)
                    that.timer = false
                }, 100)
            }
        },
    },
    components: {
        nav_aside,
        nav_aside_setting,
        test
    }
}
</script>
<style>
</style>

