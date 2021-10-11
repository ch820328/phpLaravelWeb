export default [
    {
        path:'/',
        name: "Home",
        component: () =>
            import("./components/Home.vue"),
    },
    {
        path: "/Elnav",
        name: "Elnav",
        component: () =>
            import("./components/Elnav.vue"),
        children:[
            {
                path: "/Elnav/one",
                name: "one",
                component: () =>
                    import("./components/one.vue")
            },
            {
                path: "/Elnav/two",
                name: "two",
                component: () =>
                    import("./components/two.vue")
            }
        ]
    }
]
