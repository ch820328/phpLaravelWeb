<template>
    <el-menu
        :uniqueOpened="true"
        default-active="1-4-1"
        class="el-menu-demo"
        mode="horizontal"
        @open="handleOpen"
        @close="handleClose"
        background-color="#545c64"
        text-color="#fff"
        active-text-color="#ffd04b">
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
        <el-menu-item index="2"><i class="el-icon-menu"></i>List 2</el-menu-item>
        <el-menu-item index="3"><i class="el-icon-document"></i>List 3</el-menu-item>
        <el-menu-item index="4"><i class="el-icon-setting"></i>List 4</el-menu-item>
    </el-menu>
</template>
<script>
export default {
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
    }
};
</script>
