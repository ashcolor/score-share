<template>
    <div>
        <custom-header></custom-header>
        <div class="container">
            <b-table striped hover :items="items"></b-table>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import VueAxios from 'vue-axios'
import CustomHeader from "../../components/Header";

export default {
    components: {
        axios,
        VueAxios,
        CustomHeader},
    data() {
        return {
            items: [
                { age: 40, first_name: 'Dickerson', last_name: 'Macdonald' },
                { age: 21, first_name: 'Larsen', last_name: 'Shaw' },
                { age: 89, first_name: 'Geneva', last_name: 'Wilson' },
                { age: 38, first_name: 'Jami', last_name: 'Carney' }
            ]
        }
    },
    created() {
        this.getScores()
    },
    mounted() {
    },

    methods: {
        getScores() {
            axios.get('/api/v1/scores')
                .then((response) => {
                    this.items = response.data.data
                })
                .catch((e) => {
                    alert(e);
                });
        }
    }
}
</script>
