<template>
    <el-menu
        :uniqueOpened="true"
        default-active="1-1"
        class="el-menu-demo"
        mode="horizontal"
        @open="handleOpen"
        @close="handleClose"
        background-color="#545c64"
        text-color="#fff"
        active-text-color="#ffd04b">
        <el-menu-item index="0">
            <a href="http://localhost/home/">
                <span style="font-weight: bold; font-size: 18px;">Sepan</span>
            </a>
        </el-menu-item>
        <el-sub-menu index="1">
            <template #title>
                <i class="el-icon-location"></i>
                <span>List 1</span>
            </template>
            <el-menu-item index="1-1">Option 1</el-menu-item>
            <el-menu-item index="1-2">Option 2</el-menu-item>
            <el-menu-item index="1-3">Option 3</el-menu-item>
            <el-sub-menu index="1-4">
                <template #title>Group 1</template>
                <el-menu-item index="1-4-1">Option 1</el-menu-item>
            </el-sub-menu>
        </el-sub-menu>
        <el-sub-menu index="2">
            <template #title>
                <i class="el-icon-setting"></i>
                <span>List 2</span>
            </template>
            <el-menu-item index="2-1">Option 1</el-menu-item>
            <el-menu-item index="2-2">Option 2</el-menu-item>
        </el-sub-menu>
        <el-sub-menu index="3">
            <template #title>
                <i class="el-icon-menu"></i>
                <span>List 3</span>
            </template>
            <el-menu-item index="3-1">Option 1</el-menu-item>
            <el-menu-item index="3-2">Option 2</el-menu-item>
        </el-sub-menu>
        <navmenu_setting></navmenu_setting>
    </el-menu>
</template>
<script>
import navmenu_setting from './navmenu-setting'
export default {
    data() {
        return {}
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
        console.log(this.$route);
    },
    components: {
        navmenu_setting
    }
};
</script>
