<template>
    <div>
        <custom-header></custom-header>
        <b-container class="my-4">
            <score-table-all></score-table-all>
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
