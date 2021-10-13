<template>
    <el-container style="height: 100%;">
        <el-aside width="200px" style="background: #545c64;">
            <nav_aside></nav_aside>
        </el-aside>
        <el-container>
            <el-header height="40px">
            </el-header>
            <el-main style="background: #e8e8e8;">
                <router-view></router-view>
            </el-main>
            <el-footer height="40px">
            </el-footer>
        </el-container>
        <nav_aside_setting></nav_aside_setting>
    </el-container>
</template>
<script>
import nav_aside from './layout/nav-aside'
import nav_aside_setting from './layout/nav-aside-setting'
export default {
    data() {
        return {}
    },
    mounted() {
        console.log(this.$route);
    },
    components: {
        nav_aside,
        nav_aside_setting
    }
}
</script>

