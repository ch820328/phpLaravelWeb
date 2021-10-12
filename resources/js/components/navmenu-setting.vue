<template>
    <el-dropdown style="position: absolute; top: 20px; right: 20px; font-size: 18px;">
        <span class="el-dropdown-link" style="font-weight: bold;">
            <span style="position: relative; top: -2px;">Setting &nbsp;</span><i class="el-icon-setting" style="font-size: 125%"></i>
        </span>
        <template #dropdown>
            <el-dropdown-menu>
                <el-dropdown-item icon="el-icon-plus">Action 1</el-dropdown-item>
                <el-dropdown-item icon="el-icon-circle-plus">Action 2</el-dropdown-item>
                <el-dropdown-item icon="el-icon-circle-plus-outline">Action 3</el-dropdown-item>
                <el-dropdown-item icon="el-icon-check">Action 4</el-dropdown-item>
                <el-dropdown-item icon="el-icon-circle-check">Action 5</el-dropdown-item>
            </el-dropdown-menu>
        </template>
    </el-dropdown>
</template>
<style>
.el-dropdown-link {
    cursor: pointer;
    color: #ffd04b;
}
</style>
