export default [
    {
        path: '/home',
        name: "home",
        component: () =>
            import("./components/layout/home/home.vue"),
    },
    {
        path: "/information",
        name: "information",
        component: () =>
            import("./components/layout/information/information.vue"),
        children: [
            {
                path: "/information/family",
                name: "family",
                component: () =>
                    import("./components/layout/information/family.vue")
            },
            {
                path: "/information/program",
                name: "program",
                component: () =>
                    import("./components/layout/information/program.vue")
            },
        ]
    },
    {
        path: "/message/2",
        name: "message2",
        component: () =>
            import("./components/layout/message/two.vue")
    }
]
