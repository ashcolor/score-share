<template>
    <div>
        <custom-header></custom-header>
        <b-container class="my-4">
            <b-card no-body>
                <div>
                    <b-tabs card active-nav-item-class="bg-primary text-white">
                        <b-tab title="全楽曲" active>
                            <score-table-all></score-table-all>
                        </b-tab>
                        <b-tab title="自作楽曲">

                        </b-tab>
                        <b-tab title="欲しい楽曲">

                        </b-tab>
                    </b-tabs>
                </div>
            </b-card>
        </b-container>
    </div>
</template>

<script>
import axios from 'axios'
import VueAxios from 'vue-axios'
import CustomHeader from "../../components/Header";
import ScoreTableAll from "../../components/ScoreTableAll";

export default {
    components: {
        axios,
        VueAxios,
        CustomHeader,
        ScoreTableAll
    },
    data() {
        return {}
    },
    computed: {},
    created() {
    },
    mounted() {
    },

    methods: {}
}
</script>
