<template>
    <v-calendar class="custom-calendar max-w-full"
                :masks="masks"
                :attributes="attributes"
                title-position="center"
                :first-day-of-week="2"
                is-expanded
                show-weeknumbers>
        <div slot="day-popover-header"
             slot-scope="{ day, dayTitle, attributes }">
        </div>
    </v-calendar>
</template>

<script>
export default {
    data() {
        return {
            today: new Date(),
            masks: {
                weekdays: 'WWWW',
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
            ],
        };
    },
    created() {
        this.getCalendarEvent();
    },
    mounted() {
        this.timer = setInterval(() => {
            this.getCalendarEvent();
        }, 1000 * 300)
    },
    destroyed() {
        clearInterval(this.timer)
    },
    methods: {
        async getCalendarEvent() {
            let axios_response;
            console.log('API: get => /home/calendar');
            await axios.get('/home/calendar', {}).then(function (response) {
                axios_response = response
                console.log(axios_response);
            }).catch(function (error) {
                console.log(error);
            });
            this.attributes=[
                {
                    key: 'today',
                    highlight: {
                        fillMode: 'light',
                        color: 'orange',
                    },
                    dates: new Date(),
                },
            ];
            for (let i = 0; i < axios_response.data.length; i++) {
                this.attributes.push({
                    key: parseInt(axios_response.data[i]['key']),
                    popover: JSON.parse(axios_response.data[i]['popover']),
                    dot: axios_response.data[i]['dot'],
                    dates: new Date(Date.parse(axios_response.data[i]['dates'])),
                    visibility: 'click',
                })
            }

        },
    },
};
</script>

<style >
.vc-title {
    font-size: 20px
}

.vc-weekday, .vc-day-content, .vc-weeknumber-content {
    font-size: 16px
}
.vc-weeknumber-content{
    padding-bottom: 5px;
}

.vc-day {
    height: 50px;
}

.vc-day:not(.on-right) {
    padding-top: -7px;
    border-right: 1px solid #cbd5e0;
}

.vc-day:not(.on-left) {
    padding-top: -7px;
}

.vc-day:not(.on-bottom) {
    padding-top: -7px;
    border-bottom: 1px solid #cbd5e0;
}

.vc-dots {
    padding-bottom: 7px;
}

.vc-dot {
    padding: 3px
}

.vc-popover-content-wrapper, .vc-popover-content {
    font-size: 16px
}
</style>
