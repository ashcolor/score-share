import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import ScoreIndex from "./pages/score/index.vue";

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/score",
            name: "index",
            component: ScoreIndex
        },
    ]
});

export default router;
