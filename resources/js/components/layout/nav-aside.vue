<template>
    <el-menu
        :uniqueOpened="true"
        default-active="$route.path"
        router
        class="el-menu-vertical-demo"
        :collapse=is_collapse
        :collapse-transition="false"
        @open="handleOpen"
        @close="handleClose"
        background-color="#545c64"
        text-color="#ffffff"
        active-text-color="#ffd04b"
        style="border-right-width: 0;">
        <el-menu-item index="/home"><a href="http://localhost/home/" style="color: #ffffff;">
            <i class="el-icon-s-home" style="font-size: 125%;"></i>
            <span style="text-align:center; font-weight: bold; font-size: 24px;">
                首頁</span></a>
        </el-menu-item>
        <el-sub-menu index="/information">
            <template #title>
                <i class="el-icon-tickets"></i>
                <span>實用資訊</span>
            </template>
            <el-menu-item index="/information/family">家用</el-menu-item>
            <el-menu-item index="/information/program">程式</el-menu-item>
        </el-sub-menu>
        <el-sub-menu index="/home/message">
            <template #title>
                <i class="el-icon-message"></i>
                <span>測試</span>
            </template>
            <el-menu-item index="/home/message/1">測試 1</el-menu-item>
            <el-menu-item index="/home/message/2">測試 2</el-menu-item>
        </el-sub-menu>
    </el-menu>
</template>
<script>
export default {
    props: ["is_collapse"],
    data() {
        return {}
    },
    created() {
    },
    methods: {
        handleOpen(key, keyPath) {
            console.log(key, keyPath);
        },
        handleClose(key, keyPath) {
            console.log(key, keyPath);
        }
    },
    mounted() {
    },
    method: {
        toHomePage() {
            location.reload();
        },
    },
};
</script>
<style>
.el-sub-menu__title, .el-menu-item {
    font-size: 16px;
}
</style>
