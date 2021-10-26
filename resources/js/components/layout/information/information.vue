<template>
    <div>
        <router-view></router-view>
    </div>
</template>
<script>
export default {
    props: ["title"],
    data() {
        return {
            header_title_update: "實用資訊",
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
    },
};
</script>
<style>
</style>
