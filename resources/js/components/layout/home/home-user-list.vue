<template>
    <el-table :data="user_list">
        <el-table-column prop="color" label="顏色" width="80" align="center">
            <template #default="scope">
                <div v-if="scope.row.color === 'red'">
                    <div class="circle" style="background-color: red; position: relative; right: -42%;"></div>
                </div>
                <div v-else-if="scope.row.color === 'blue'">
                    <div class="circle" style="background-color: cornflowerblue; position: relative; right: -42%;"></div>
                </div>
                <div v-else-if="scope.row.color === 'purple'">
                    <div class="circle" style="background-color: darkorchid; position: relative; right: -42%;"></div>
                </div>
                <div v-else-if="scope.row.color === 'green'">
                    <div class="circle" style="background-color: green; position: relative; right: -42%;"></div>
                </div>
                <div v-else>
                    <div class="circle" style="background-color: gray; position: relative; right: -42%;"></div>
                </div>
            </template>
        </el-table-column>
        <el-table-column prop="name" label="使用者" align="center"></el-table-column>
    </el-table>
</template>

<script>
export default {
    data() {
        return {
            user_list: [],
        };
    },
    created() {
        this.getUserList();
    },
    mounted() {
        this.timer = setInterval(() => {
            this.getUserList();
        }, 1000 * 300)
    },
    destroyed() {
    },
    methods: {
        async getUserList() {
            let axios_response;
            await axios.get('/home/user-list/get', {}).then(function (response) {
                axios_response = response
                console.log(response);
            }).catch(function (error) {
                console.log(error);
            });
            this.user_list = [];
            for (let i = 0; i < axios_response.data.length; i++) {
                this.user_list.push({
                    name: axios_response.data[i]['name'],
                    color: axios_response.data[i]['color'],
                })
            }
            console.log(this.user_list);
        },
    },
};
</script>

<style>
.cell {
    font-size: 16px;
}

.circle {
    width: 15px;
    height: 15px;
    border-radius: 50%;
}
</style>
