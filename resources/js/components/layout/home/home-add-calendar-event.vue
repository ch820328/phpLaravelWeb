<template>
    <el-form ref="form_add_calendar_event"
             :model="form_add_calendar_event"
             :rules="form_add_calendar_event_rules"
             label-width="80px">
        <el-form-item label="Day" prop="type">
            <el-radio-group v-model="form_add_calendar_event.type" size="small">
                <el-radio-button label="True">Single</el-radio-button>
                <el-radio-button label="False">Multi</el-radio-button>
            </el-radio-group>
        </el-form-item>
        <el-form-item label="Name" prop="Name">
            <el-col :span="22">
                <el-select v-model="form_add_calendar_event.name" placeholder="Choose one">
                    <el-col :span="24">
                        <el-option
                            v-for="item in name_list"
                            :label="item.name"
                            :value="item.name">
                        </el-option>
                    </el-col>
                </el-select>
            </el-col>
        </el-form-item>
        <el-form-item label="Start Date" prop="start_date">
            <el-col :span="12">
                <el-date-picker
                    :disabledDate="disabledDate"
                    v-model="form_add_calendar_event.start_date"
                    type="date"
                    placeholder="Start date">
                </el-date-picker>
            </el-col>
        </el-form-item>
        <el-form-item label="Time" prop="end_date" v-show="form_add_calendar_event.type === 'False'">
            <el-col :span="12">
                <el-date-picker
                    :disabledDate="disabledDate"
                    v-model="form_add_calendar_event.end_date"
                    type="date"
                    placeholder="End date">
                </el-date-picker>
            </el-col>
        </el-form-item>
        <el-form-item label="Event" prop="event">
            <el-col class="textarea_event" :span="24">
                <el-input v-model="form_add_calendar_event.event" type="textarea"
                          :autosize="{ minRows: 2, maxRows: 10 }"></el-input>
            </el-col>
        </el-form-item>
        <el-form-item>
            <el-button type="primary" @click="onSubmit('form_add_calendar_event')">Create</el-button>
            <el-button type="danger" @click="resetForm('form_add_calendar_event')">Reset</el-button>
        </el-form-item>
    </el-form>
</template>

<script>
export default {
    data() {
        const validateEvent = (rule, value, callback) => {
            if (value === '') {
                callback(new Error('Please input the event'))
            } else {
                if (this.form_add_calendar_event.event !== '') {
                    this.$refs.form_add_calendar_event.validateField('checkPass')
                }
                callback()
            }
        };
        const validateStartDate = (rule, value, callback) => {
            if (this.form_add_calendar_event.end_date === '') {
                this.form_add_calendar_event.end_date = this.form_add_calendar_event.start_date
            }
            if (this.form_add_calendar_event.start_date > this.form_add_calendar_event.end_date) {
                this.form_add_calendar_event.end_date = this.form_add_calendar_event.start_date
            } else {
                this.$refs.form_add_calendar_event.validateField('checkPass')
                callback()
            }
        };
        const validateEndDate = (rule, value, callback) => {
            if (value === '') {
                callback(new Error('Please pick the start date'))
            } else {
                if (this.form_add_calendar_event.start_date !== '') {
                    this.$refs.form_add_calendar_event.validateField('checkPass')
                }
                callback()
            }
        };
        return {
            name_list: [],
            form_add_calendar_event: {
                name: '',
                event: '',
                start_date: '',
                end_date: '',
                type: 'True',
            },
            form_add_calendar_event_rules: {
                event: [{validator: validateEvent, trigger: 'blur'}],
                start_date: [{validator: validateStartDate, trigger: 'blur'}],
                end_date: [{validator: validateEndDate, trigger: 'blur'}],
            },
        };
    },
    created() {
        this.getUserList();
    },
    mounted() {
    },
    destroyed() {
    },
    methods: {
        disabledDate(time) {
            return time.getTime() < Date.now();
        },
        onSubmit(formName) {
            console.log("onSubmit");
            const wait_swal = this.$swal({
                title: 'Wait for creating...',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                showCancelButton: false,
                showDenyButton: false,
            });
            wait_swal.fire(
                this.deleteEvent(this.$refs[formName].validate(async (valid) => {
                    if (valid) {
                        let axios_response = null;
                        console.log('API: post => /home/add-calendar-event');
                        await axios.post('/home/add-calendar-event', {
                            event: this.form_add_calendar_event.event,
                            start_date: this.form_add_calendar_event.start_date,
                            end_date: this.form_add_calendar_event.end_date,
                        })
                            .then(function (response) {
                                axios_response = response
                                console.log(axios_response);
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                        if (axios_response !== null) {
                            if (axios_response) {
                                this.$swal.fire({
                                    icon: 'success',
                                    title: 'Create Success!!',
                                    timer: 2000
                                })
                                location.reload()
                            }
                        } else {
                            this.$swal.fire({
                                icon: 'error',
                                title: 'Create Fail!!',
                                text: 'API has bad return!',
                                timer: 2000
                            })
                        }
                    } else {
                        this.$swal.fire({
                            icon: 'error',
                            title: 'Create Fail!!',
                            text: 'Something went wrong!',
                            timer: 2000
                        })
                        this.resetForm(formName)
                    }
                })));
            wait_swal.close();
        },
        async getUserList() {
            console.log("getUserList");
            let axios_response;
            await axios.get('/home/user-list', {}).then(function (response) {
                axios_response = response
                console.log(response);
            }).catch(function (error) {
                console.log(error);
            });
            for (let i = 0; i < axios_response.data.length; i++) {
                this.name_list.push({
                    name: axios_response.data[i]['name'],
                })
            }
            console.log(this.name_list);
        },
        resetForm(formName) {
            this.$refs[formName].resetFields();
        },
    },
}
</script>
<style>
.el-col {
    padding-left: 0;
}

.textarea_event {
    width: 100%;
}
</style>
