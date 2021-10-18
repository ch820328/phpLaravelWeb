<template>
    <div style="font-size: 20px; font-weight: bold;">Calendar</div>
    <el-container style="height: 100%;">
        <div class="text-center section" style="width: 50%">
            <v-calendar class="custom-calendar max-w-full"
                        :masks="masks"
                        :attributes="attributes"
                        title-position="left"
                        :first-day-of-week="2"
                        is-expanded
                        show-weeknumbers
                        style="width: 100%">
                <div slot="day-popover-header"
                     slot-scope="{ day, dayTitle, attributes }">
                </div>
            </v-calendar>
        </div>
        <div class="text-center section" style="width: 50%">
            <v-calendar class="custom-calendar max-w-full"
                        :masks="masks"
                        :attributes="attributes"
                        title-position="left"
                        :first-day-of-week="2"
                        is-expanded
                        show-weeknumbers
                        style="width: 100%">
                <div slot="day-popover-header"
                     slot-scope="{ day, dayTitle, attributes }">
                </div>
            </v-calendar>
        </div>
    </el-container>
</template>

<script>
export default {
    data() {
        const month = new Date().getMonth();
        const year = new Date().getFullYear();
        return {
            masks: {
                weekdays: 'WWW',
                date: 'YYYY-MM-DD',
            },
            attributes: [
                {
                    key: 'today',
                    highlight: {
                        fillMode: 'light',
                        color: 'orange',
                    },
                    dates: new Date(),
                },
                {
                    key: 1,
                    popover: {
                        label: 'test',
                    },
                    dot: true,
                    dates: new Date(year, month, 5),
                },
                {
                    key: 2,
                    popover: {
                        label: 'test3',
                    },
                    dot: true,
                    dates: {
                        start: new Date(year, month, 20),
                        end: new Date(year, month, 24)
                    },
                },
                {
                    key: 3,
                    popover: {
                        label: 'test4',
                    },
                    dot: true,
                    dates: new Date(year, month, 8),
                },
            ],
        };
    },
    created() {
        this.getTest2();
    },
    methods: {
        async getTest2() {
            let axios_response;
            let attributes = this.attributes;
            await axios.get('/test-data2', {
                params: {
                    ID: 12345
                }
            }).then(function (response) {
                axios_response = response
                console.log(response);
            }).catch(function (error) {
                console.log(error);
            });
            console.log(axios_response.data);
            console.log(this.attributes);
            for (let i = 0; i < axios_response.data.length; i++) {
                console.log(axios_response.data);
                this.attributes.push({
                    key: parseInt(axios_response.data[i]['key']),
                    popover: JSON.parse(axios_response.data[i]['popover']),
                    dot: axios_response.data[i]['dot'],
                    dates: new Date(Date.parse(axios_response.data[i]['dates'])),
                })
            }
            console.log(this.attributes);
        },
    },
};
</script>

<style scoped>
</style>
