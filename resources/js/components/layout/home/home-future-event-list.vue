<template>
    <el-table :data="future_event_list">
        <el-table-column prop="name" label="Name" width="120" align="center"></el-table-column>
        <el-table-column prop="start_at" label="Start Date" width="120" align="center"></el-table-column>
        <el-table-column prop="end_at" label="End Date" width="120" align="center"></el-table-column>
        <el-table-column prop="event" label="Event" ></el-table-column>
        <el-table-column label="Operations" width="120" align="center">
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
            console.log("getFutureEventList");
            let axios_response;
            await axios.get('/home/future-event-list', {}).then(function (response) {
                axios_response = response
                console.log(response);
            }).catch(function (error) {
                console.log(error);
            });
            this.future_event_list = [];
            for (let i = 0; i < axios_response.data.length; i++) {
                this.future_event_list.push({
                    id: axios_response.data[i]['id'],
                    name: axios_response.data[i]['name'],
                    start_at: axios_response.data[i]['start_at'],
                    end_at: axios_response.data[i]['end_at'],
                    event: axios_response.data[i]['event'],
                })
            }
            console.log("future_event_list");
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
                    const wait_swal = this.$swal({
                        title: 'Wait for deleting...',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        showCancelButton: false,
                        showDenyButton: false,
                    });
                    wait_swal.fire(this.deleteEvent(event_id));
                    wait_swal.close();
                }
            })
        },
        async deleteEvent(event_id) {
            console.log("deleteEvent");
            await axios.delete('/home/delete-calendar-event/' + event_id, {})
                .catch(function (error) {
                    this.$swal.fire({
                        icon: 'error',
                        title: 'Delete Fail!!',
                        text: 'Error!',
                        showConfirmButton: true,
                    })
                    console.log(error);
                    return false;
                });
            this.$swal.fire({
                icon: 'success',
                title: 'Delete Success!!',
                timer: 2000
            })
            location.reload()
        },
    },
};
</script>

<style>
</style>
