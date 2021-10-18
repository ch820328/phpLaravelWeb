<template>
    <div>
        <el-row :gutter="20">
            <el-col :xs="24" :sm="24" :md="17" :lg="17" :xl="17">
                <el-card class="box-card" :body-style="{ padding: '10px' }">
                    <home_calendar></home_calendar>
                </el-card>
            </el-col>
            <el-col :xs="24" :sm="24" :md="7" :lg="7" :xl="7">
                <el-card class="box-card" :body-style="{ padding: '10px' }">
                    <home_user_list></home_user_list>
                </el-card>
            </el-col>
        </el-row>
        <el-row :gutter="20">
            <el-col :xs="24" :sm="24" :md="17" :lg="17" :xl="17">
                <el-card class="box-card" :body-style="{ padding: '10px' }">
                    <hom_future_event_list></hom_future_event_list>
                </el-card>
            </el-col>
            <el-col :xs="24" :sm="24" :md="7" :lg="7" :xl="7">
                <el-card class="box-card" :body-style="{ padding: '10px' }">
                    <home_add_calendar_event></home_add_calendar_event>
                </el-card>
            </el-col>
        </el-row>
    </div>
</template>

<script>
import home_add_calendar_event from './home-add-calendar-event.vue'
import home_calendar from './home-calendar.vue'
import hom_future_event_list from './home-future-event-list.vue'
import home_user_list from './home-user-list.vue'

export default {
    props: ["title"],
    data() {
        return {
            header_title_update: "Calendar",
        };
    },
    created() {
        this.update_header_title();
    },
    mounted() {
    },
    destroyed() {
    },
    methods: {
        update_header_title() {
            this.$emit("update_title_event", this.header_title_update);
        }
    },
    components: {
        home_calendar,
        home_user_list,
        home_add_calendar_event,
        hom_future_event_list,
    },
};
</script>
<style>
.el-row {
    display: flex;
    flex-wrap: wrap;
    margin-bottom: 20px;
}

.el-row .el-card {
    min-width: 100%;
    height: 100%;
    margin-right: 20px;
    border-radius: 0.5em;
}
</style>
