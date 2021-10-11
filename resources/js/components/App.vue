<template>
    <el-container>
        <el-header style="width: 100%; background: #545c64;">
            <navmenu></navmenu>
        </el-header>
        <el-container>
            <el-main>
                <router-view></router-view>
            </el-main>
        </el-container>
    </el-container>
</template>
<script>
import navmenu from './navmenu'

export default {
    data() {
        return {}
    },
    components: {
        navmenu
    }
}
</script>
<style scoped>

</style>
