<template>
    <el-tabs type="border-card" style="font-size: 16px;">
        <el-tab-pane v-for="(item) in table_tab_list" :label="item.label">
            <el-table :data="item.data" :border="true">
                <el-table-column prop="name" width="160" label="名稱" align="center"></el-table-column>
                <el-table-column prop="type" width="160" label="類型" align="center"></el-table-column>
                <el-table-column prop="description" width="480" label="描述" align="center"></el-table-column>
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
                        <el-button type="primary" size="medium" @click="tableEdit(item.label, scope.row)">
                            編輯
                        </el-button>
                        <el-button type="danger" size="medium" @click="(deleteInformationConfirm(scope.row.id))">
                            刪除
                        </el-button>
                    </template>
                </el-table-column>
            </el-table>
            <el-button type="success" size="medium" @click="tableEdit(item.label)" style="margin-top: 20px;">
                新建
            </el-button>
        </el-tab-pane>
    </el-tabs>
    <el-dialog  v-for="(item) in table_tab_list" v-model="item.dialog">
        <div>更新資訊</div>
        <el-form :model="form" :ref="item.form_name" :rules="table_dialog_rules" :label-width="formLabelWidth">
            <el-form-item prop="name" label="名稱">
                <el-input v-model="form.name" autocomplete="off"></el-input>
            </el-form-item>
            <el-form-item prop="type" label="類型">
                <el-input v-model="form.type" autocomplete="off"></el-input>
            </el-form-item>
            <el-form-item prop="description" label="描述">
                <el-input v-model="form.description" autocomplete="off"></el-input>
            </el-form-item>
            <el-form-item prop="url" label="網址">
                <el-input v-model="form.url" autocomplete="off"></el-input>
            </el-form-item>
        </el-form>
        <template #footer>
            <span class="dialog-footer">
                <el-button @click="item.dialog = false">取消</el-button>
                <el-button type="primary" @click="onSubmit(item.form_name, 'program', item.label)">送出</el-button>
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
            table_tab_list: [
                {label: 'Common', data: this.table_common = [], form_name: 'table_common_dialog', dialog: this.table_common_dialog_visible = false},
                {label: 'PHP', data: this.table_php = [], form_name: 'table_php_dialog', dialog: this.table_php_dialog_visible = false},
                {label: 'Python', data: this.table_python = [], form_name: 'table_python_dialog', dialog: this.table_python_dialog_visible = false},
                {label: 'Web', data: this.table_web = [], form_name: 'table_web_dialog', dialog: this.table_web_dialog_visible = false},
                {label: 'Database', data: this.table_database = [], form_name: 'table_database_dialog', dialog: this.table_database_dialog_visible = false},
            ],
            table_dialog_rules: {
                name: [{required: true, message: 'This field is not filled.'}],
                type: [{required: true, message: 'This field is not filled.'}],
                description: [{required: true, message: 'This field is not filled.'}],
                url: [{required: true, message: 'This field is not filled.'}],
            },
        };
    },
    created() {
        this.getProgramList();
    },
    mounted() {
        this.timer = setInterval(() => {
            this.getProgramList();
        }, 1000 * 300)
    },
    destroyed() {
    },
    methods: {
        cleanTable() {
            this.table_tab_list.forEach(function (item) {
                item.data = [];
            });
        },
        closeDialog() {
            this.table_tab_list.forEach(function (item) {
                item.dialog = false;
            });
        },
        openDialog(tab) {
            let form_name;
            this.table_tab_list.forEach(function (item) {
                if (item.label === tab) {
                    item.dialog = true;
                    form_name = item.form_name
                }
            });
            try {
                this.$refs[form_name].clearValidate();
            } catch (e) {
            }
        },
        async getProgramList() {
            let axios_response;
            console.log('API: get => /information/program/get');
            await axios.get('/information/program/get', {}).then(function (response) {
                axios_response = response
                console.log(response);
            }).catch(function (error) {
                console.log(error);
            });
            this.cleanTable();
            for (let i = 0; i < axios_response.data.length; i++) {
                let note = JSON.parse(axios_response.data[i]['note']);
                try {
                    this.table_tab_list.forEach(function (item) {
                        if (item.label === axios_response.data[i]['tab']) {
                            item.data.push({
                                id: axios_response.data[i]['id'],
                                type: axios_response.data[i]['type'],
                                name: axios_response.data[i]['name'],
                                description: note['description'],
                                url: axios_response.data[i]['url'],
                            })
                        }
                    });
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
            this.openDialog(tab);
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
.el-table__cell, .el-tabs__item, .el-button {
    font-size: 16px;
}
</style>
