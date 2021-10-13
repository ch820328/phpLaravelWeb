export default [
    {
        path: '/home',
        name: "home",
        component: () =>
            import("./components/layout/home/home.vue"),
        children: [
            {
                path: "/home/administrator/1",
                name: "administrator1",
                component: () =>
                    import("./components/layout/home/administrator/one.vue")
            },
            {
                path: "/home/administrator/2-1",
                name: "administrator2",
                component: () =>
                    import("./components/layout/home/administrator/two.vue")
            },
            {
                path: "/home/message/1",
                name: "message1",
                component: () =>
                    import("./components/layout/home/message/one.vue")
            },
        ]
    },
    {
        path: "/home/message/2",
        name: "message2",
        component: () =>
            import("./components/layout/home/message/two.vue")
    }
]
