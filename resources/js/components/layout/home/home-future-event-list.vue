<template>
    <el-table :data="future_event_list">
        <el-table-column prop="name" label="使用者" width="120" align="center"></el-table-column>
        <el-table-column prop="start_at" label="開始" width="160" align="center"></el-table-column>
        <el-table-column prop="end_at" label="結束" width="160" align="center"></el-table-column>
        <el-table-column prop="event" label="事件"></el-table-column>
        <el-table-column label="操作" width="120" align="center">
            <template #default="scope">
                <el-button type="danger" size="small" @click="deleteEventConfirm(scope.row.id)">
                    Delete
                </el-button>
            </template>
        </el-table-column>
    </el-table>
</template>

<script>
export default {
    data() {
        return {
            future_event_list: [],
        };
    },
    created() {
        this.getFutureEventList();
    },
    mounted() {
        this.timer = setInterval(() => {
            this.getFutureEventList();
        }, 1000 * 300)
    },
    destroyed() {
    },
    methods: {
        async getFutureEventList() {
            let axios_response;
            console.log('API: get => /home/future-event-list/get');
            await axios.get('/home/future-event-list/get', {})
                .then(function (response) {
                    console.log(response);
                    axios_response = response
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
            this.future_event_list = [];
            for (let i = 0; i < axios_response.data.length; i++) {
                if(axios_response.data[i]['start_at'] === axios_response.data[i]['end_at']){
                    axios_response.data[i]['end_at'] = '';
                }
                this.future_event_list.push({
                    id: axios_response.data[i]['id'],
                    name: axios_response.data[i]['name'],
                    start_at: axios_response.data[i]['start_at'],
                    end_at: axios_response.data[i]['end_at'],
                    event: axios_response.data[i]['event'],
                })
            }
            console.log(this.future_event_list);
        },
        deleteEventConfirm(event_id) {
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
                            this.deleteEvent(event_id)
                        },
                    });
                }
            })
        },
        async deleteEvent(event_id) {
            let axios_response;
            console.log('API: delete => /home/delete-calendar-event/delete/' + event_id);
            await axios.delete('/home/delete-calendar-event/delete/' + event_id, {})
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
    },
};
</script>

<style>
</style>
