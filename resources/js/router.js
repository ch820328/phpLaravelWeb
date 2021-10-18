export default [
    {
        path: '/home',
        name: "home",
        component: () =>
            import("./components/layout/home/home.vue"),
        children: [
            {
                path: "/home/message/1",
                name: "message1",
                component: () =>
                    import("./components/layout/home/message/one.vue")
            },
        ]
    },
    {
        path: "/home/administrator",
        name: "administrator",
        component: () =>
            import("./components/layout/home/administrator/administrator.vue"),
        children: [
            {
                path: "/home/administrator/user-list",
                name: "user-list",
                component: () =>
                    import("./components/layout/home/administrator/administrator-user-list.vue")
            },
            {
                path: "/home/administrator/2-1",
                name: "administrator2",
                component: () =>
                    import("./components/layout/home/administrator/administrator-user-list.vue")
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
