<template>
    <el-tabs type="border-card" style="font-size: 16px;">
        <el-tab-pane label="食物">
            <el-table :data="table_food" :border="true">
                <el-table-column prop="type" width="120" label="類型" align="center"></el-table-column>
                <el-table-column prop="name" width="200" label="名稱" align="center"></el-table-column>
                <el-table-column prop="district" width="160" label="位置" align="center"></el-table-column>
                <el-table-column prop="telephone" width="160" label="電話" align="center"></el-table-column>
                <el-table-column prop="price" width="120" label="價格" align="center">
                    <template #default="scope">
                        <div v-if="scope.row.price === null"></div>
                        <div v-else-if="scope.row.price < 200">$</div>
                        <div v-else-if="scope.row.price < 400">$$</div>
                        <div v-else-if="scope.row.price < 1000">$$$</div>
                        <div v-else-if="scope.row.price > 1000">$$$$</div>
                        <div v-else></div>
                    </template>
                </el-table-column>
                <el-table-column label="菜單" width="120" align="center">
                    <template #default="scope">
                        <div v-if="scope.row.url !== null">
                            <a :href="scope.row.url" target="_blank">連結</a>
                        </div>
                        <div v-else></div>
                    </template>
                </el-table-column>
                <el-table-column label="操作" width="240" align="center">
                    <template #default="scope">
                        <el-button type="primary" size="medium" @click="tableEdit('food', scope.row)">
                            編輯
                        </el-button>
                        <el-button type="danger" size="medium" @click="(deleteInformationConfirm(scope.row.id))">
                            刪除
                        </el-button>
                    </template>
                </el-table-column>
            </el-table>
            <el-button type="success" size="medium" @click="tableEdit('food')" style="margin-top: 20px;">
                新建
            </el-button>
        </el-tab-pane>

        <el-tab-pane label="工具">
            <el-table :data="table_tool" :border="true">
                <el-table-column prop="type" width="120" label="類型" align="center"></el-table-column>
                <el-table-column prop="name" width="240" label="名稱" align="center"></el-table-column>
                <el-table-column label="網址" width="120" align="center">
                    <template #default="scope">
                        <div v-if="scope.row.url !== null">
                            <a :href="scope.row.url" target="_blank">連結</a>
                        </div>
                        <div v-else></div>
                    </template>
                </el-table-column>
                <el-table-column label="操作" width="240" align="center">
                    <template #default="scope">
                        <el-button type="primary" size="medium" @click="tableEdit('tool', scope.row)">
                            編輯
                        </el-button>
                        <el-button type="danger" size="medium" @click="(deleteInformationConfirm(scope.row.id))">
                            刪除
                        </el-button>
                    </template>
                </el-table-column>
            </el-table>
            <el-button type="success" size="medium" @click="tableEdit('tool')" style="margin-top: 20px;">
                新建
            </el-button>
        </el-tab-pane>

    </el-tabs>

    <el-dialog v-model="table_food_dialog_visible">
        <el-form :model="form" ref="table_food_dialog" :rules="table_food_dialog_rules" :label-width="formLabelWidth">
            <el-form-item prop="type" label="類型">
                <el-input v-model="form.type" autocomplete="off"></el-input>
            </el-form-item>
            <el-form-item prop="name" label="名稱">
                <el-input v-model="form.name" autocomplete="off"></el-input>
            </el-form-item>
            <el-form-item prop="district" label="位置">
                <el-input v-model="form.district" autocomplete="off"></el-input>
            </el-form-item>
            <el-form-item prop="telephone" label="電話">
                <el-input v-model="form.telephone" autocomplete="off"></el-input>
            </el-form-item>
            <el-form-item prop="price" label="價格">
                <el-input v-model="form.price" autocomplete="off"></el-input>
            </el-form-item>
            <el-form-item prop="url" label="菜單網址">
                <el-input v-model="form.url" autocomplete="off"></el-input>
            </el-form-item>
        </el-form>
        <template #footer>
            <span class="dialog-footer">
                <el-button @click="table_food_dialog_visible = false">取消</el-button>
                <el-button type="primary" @click="onSubmit('table_food_dialog', 'family', 'food')">送出</el-button>
            </span>
        </template>
    </el-dialog>

    <el-dialog v-model="table_tool_dialog_visible">
        <el-form :model="form" ref="table_tool_dialog" :rules="table_tool_dialog_rules" :label-width="formLabelWidth">
            <el-form-item prop="type" label="類型">
                <el-input v-model="form.type" autocomplete="off"></el-input>
            </el-form-item>
            <el-form-item prop="name" label="名稱">
                <el-input v-model="form.name" autocomplete="off"></el-input>
            </el-form-item>
            <el-form-item prop="url" label="網址">
                <el-input v-model="form.url" autocomplete="off"></el-input>
            </el-form-item>
        </el-form>
        <template #footer>
            <span class="dialog-footer">
                <el-button @click="table_tool_dialog_visible = false">取消</el-button>
                <el-button type="primary" @click="onSubmit('table_tool_dialog', 'family', 'tool')">送出</el-button>
            </span>
        </template>
    </el-dialog>

</template>
<script>

export default {
    data() {
        return {
            form: {},
            formLabelWidth: '120px',
            table_food: [],
            table_tool: [],
            table_food_dialog_visible: false,
            table_tool_dialog_visible: false,
            table_food_dialog_rules: {
                type: [{required: true, message: 'This field is not filled.'}],
                name: [{required: true, message: 'This field is not filled.'}],
                district: [{required: true, message: 'This field is not filled.'}],
                telephone: [{required: true, message: 'This field is not filled.'}],
                price: [{required: true, message: 'This field is not filled.'}],
                url: [{required: true, message: 'This field is not filled.'}],
            },
            table_tool_dialog_rules: {
                type: [{required: true, message: 'This field is not filled.'}],
                name: [{required: true, message: 'This field is not filled.'}],
                url: [{required: true, message: 'This field is not filled.'}],
            },
        };
    },
    created() {
        this.getFamilyList();
    },
    mounted() {
        this.timer = setInterval(() => {
            this.getFamilyList();
        }, 1000 * 300)
    },
    destroyed() {
    },
    methods: {
        cleanTable() {
            this.table_food = [];
            this.table_tool = [];
        },
        closeDialog() {
            this.table_food_dialog_visible = false;
            this.table_tool_dialog_visible = false;
        },
        async getFamilyList() {
            let axios_response;
            console.log('API: get => /information/family/get');
            await axios.get('/information/family/get', {}).then(function (response) {
                axios_response = response
                console.log(response);
            }).catch(function (error) {
                console.log(error);
            });
            this.cleanTable();
            for (let i = 0; i < axios_response.data.length; i++) {
                let note = JSON.parse(axios_response.data[i]['note']);
                try {
                    switch (axios_response.data[i]['tab']) {
                        case 'food':
                            this.table_food.push({
                                id: axios_response.data[i]['id'],
                                type: axios_response.data[i]['type'],
                                name: axios_response.data[i]['name'],
                                district: note['district'],
                                telephone: note['telephone'],
                                price: note['price'],
                                url: axios_response.data[i]['url'],
                            })
                            break;
                        case 'tool':
                            this.table_tool.push({
                                id: axios_response.data[i]['id'],
                                type: axios_response.data[i]['type'],
                                name: axios_response.data[i]['name'],
                                url: axios_response.data[i]['url'],
                            })
                            break;
                        default:
                            console.log(axios_response.data[i]['tab'] + ' Not Found.');
                    }
                } catch (e) {
                    console.log(e);
                }
            }
        },
        tableEdit(tab, data) {
            this.form = {};
            if (data) {
                this.form = data;
            }
            switch (tab) {
                case 'food':
                    this.table_food_dialog_visible = true;
                    this.$nextTick(() => {
                        this.$refs['table_food_dialog'].clearValidate();
                    });
                    break;
                case 'tool':
                    this.table_tool_dialog_visible = true;
                    this.$nextTick(() => {
                        this.$refs['table_tool_dialog'].clearValidate();
                    });

                    break;
                default:
            }
        },
        deleteInformationConfirm(information_id) {
            this.$swal.fire({
                title: 'Do you want to remove this event?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Remove',
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$swal({
                        title: 'Wait for deleting...',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        showCancelButton: false,
                        showDenyButton: false,
                        didOpen: () => {
                            this.deleteInformation(information_id)
                        },
                    });
                }
            })
        },
        async deleteInformation(information_id) {
            let axios_response;
            console.log('API: delete => /information/delete-information-list/delete/' + information_id);
            await axios.delete('/information/delete-information-list/delete/' + information_id, {})
                .then(function (response) {
                    axios_response = response
                    console.log(response);
                }).catch(function (error) {
                    console.log(error);
                });
            if (axios_response !== null) {
                if (axios_response.status === 204) {
                    this.$swal.fire({
                        icon: 'success',
                        title: 'Delete Success!!',
                        timer: 2000
                    })
                    location.reload();
                }
            } else {
                this.$swal.fire({
                    icon: 'error',
                    title: 'Delete Fail!!',
                    text: 'API has bad return!',
                    timer: 2000
                })
            }
        },
        onSubmit(formName, page, tab) {
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    this.closeDialog();
                    this.$swal.fire({
                        title: 'Wait for updating...',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        showCancelButton: false,
                        showDenyButton: false,
                        didOpen: async () => {
                            let axios_response = null;
                            console.log('API: post => /information/update-information-list/post');
                            await axios.post('/information/update-information-list/post', {
                                id: this.form.id,
                                page: page,
                                tab: tab,
                                name: this.form.name,
                                type: this.form.type,
                                district: this.form.district,
                                description: this.form.description,
                                telephone: this.form.telephone,
                                price: this.form.price,
                                url: this.form.url,
                            })
                                .then(function (response) {
                                    console.log(response);
                                    axios_response = response
                                })
                                .catch(function (error) {
                                    console.log(error);
                                });
                            if (axios_response !== null) {
                                if (axios_response.status === 201) {
                                    this.$swal.fire({
                                        icon: 'success',
                                        title: 'Update Success!!',
                                        timer: 2000
                                    })
                                    location.reload();
                                }
                            } else {
                                this.$swal.fire({
                                    icon: 'error',
                                    title: 'Update Fail!!',
                                    text: 'API has bad return!',
                                    timer: 2000
                                })
                            }
                        },
                    })
                }
            });
        }
    },
    components: {},
};
</script>
<style>
.el-table__cell,.el-tabs__item,.el-button {
    font-size: 16px;
}
</style>
