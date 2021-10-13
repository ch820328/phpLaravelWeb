<template>
    <el-menu
        :uniqueOpened="true"
        default-active="$route.path"
        router
        class="el-menu-vertical-demo"
        @open="handleOpen"
        @close="handleClose"
        background-color="#545c64"
        text-color="#ffffff"
        active-text-color="#ffd04b"
        style="border-right-width: 0;">
        <el-menu-item index="/home">
            <a href="http://localhost/home/">
                <div style="text-align:center; font-weight: bold; font-size: 24px; color: #ffffff">Sepan</div>
            </a>
        </el-menu-item>
        <el-sub-menu index="/home/administrator">
            <template #title>
                <i class="el-icon-location"></i>
                <span>Administrator</span>
            </template>
            <el-menu-item index="/home/administrator/1">Option 1</el-menu-item>
            <el-sub-menu index="/home/administrator/2">
                <template #title>Group 2</template>
                <el-menu-item index="/home/administrator/2-1">Option 2-1</el-menu-item>
            </el-sub-menu>
        </el-sub-menu>
        <el-sub-menu index="/home/message">
            <template #title>
                <i class="el-icon-message"></i>
                <span>Message</span>
            </template>
            <el-menu-item index="/home/message/1">Option 1</el-menu-item>
            <el-menu-item index="/home/message/2">Option 2</el-menu-item>
        </el-sub-menu>
    </el-menu>

</template>
<script>
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
};
</script>
