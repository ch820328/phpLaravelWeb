<template>
    <el-dropdown style="position: absolute; top: 3px; right: 20px; font-size: 18px;" @command="handleCommand">
        <span class="el-dropdown-link" style="font-weight: bold;">
            <span style="position: relative; top: -2px;">Setting &nbsp;</span><i class="el-icon-setting" style="font-size: 125%"></i>
        </span>
        <template #dropdown>
            <el-dropdown-menu>
                <el-dropdown-item icon="el-icon-back" command="logout">Logout</el-dropdown-item>
            </el-dropdown-menu>
        </template>
    </el-dropdown>
</template>
<style>
.el-dropdown-link {
    cursor: pointer;
    color: #545c64;
}
</style>
<script>
export default{
    methods:{
        handleCommand(command){
            console.log('(nav-aside-setting) Execute:' + command)
            switch (command){
                case 'logout':
                    const url_logout = "/logout"
                    window.location.href = url_logout
                    break
                default:
                    return
            }
        }
    }
}
</script>
