<template>
    <div style="font-size: 20px; font-weight: bold;">Calendar</div>
    <el-container style="height: 100%;">
        <div class="text-center section" style="width: 100%">
            <v-calendar class="custom-calendar max-w-full"
                        :masks="masks"
                        :attributes="attributes"
                        disable-page-swipe
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
                    highlight: {
                        start: {fillMode: 'light'},
                        base: {fillMode: 'light'},
                        end: {fillMode: 'light'},
                    },
                    popover: {
                        label: 'test1',
                    },
                    dates: {
                        start: new Date(year, month, 10),
                        end: new Date(year, month, 14)
                    },
                },
                {
                    highlight: {
                        color: 'orange',
                        fillMode: 'light',
                    },
                    dates: new Date(year, month, 15),
                },
                {
                    key: 1,
                    customData: {
                        description: 'test',
                    },
                    popover: {
                        label: 'test',
                    },
                    dot: true,
                    dates: new Date(year, month, 18),
                },
            ],
        };
    },
};
</script>
