<template>
    <div>
        <b-row>
            <b-col class="my-1">
                <b-input-group class="mx-auto">

                    <b-input-group-prepend>
                        <b-form-select v-model="searchSelected" :options="options"></b-form-select>
                    </b-input-group-prepend>

                    <b-form-input v-if="['title','artist','genre'].includes(searchSelected)"
                                  v-model="search"></b-form-input>
                    <b-form-datepicker
                        v-if="['score_created_at','score_updated_at'].includes(searchSelected)"></b-form-datepicker>

                    <b-input-group-append>
                        <b-button size="sm" text="Button" variant="success" @click="execSearch">検索</b-button>
                    </b-input-group-append>

                </b-input-group>
            </b-col>
        </b-row>

        <b-table small hover outlined :fields="fields" :items="scores.data" class="mt-3">
            <template #cell(remarks)="data">
                {{ data.value.length <= 20 ? data.value : (data.value.substr(0, 20) + "...") }}
            </template>
            <template #cell(url)="data">
                <a v-if="data.value" :href="data.value" target="_blank">
                    <b-icon-volume-up-fill></b-icon-volume-up-fill>
                </a>
            </template>
        </b-table>

        <b-row>
            <b-col>
                <b-pagination
                    v-model="scores.current_page"
                    :total-rows="scores.total"
                    :per-page="scores.per_page"
                    align="center"
                    @change="pageChange"
                    class="mt-3"
                ></b-pagination>
            </b-col>
        </b-row>

    </div>
</template>

<script>
import axios from 'axios'
import VueAxios from 'vue-axios'

export default {
    components: {
        axios,
        VueAxios,
    },
    data() {
        return {
            searchSelected: 'title',
            search: '',
            options: [
                {value: 'title', text: '曲名'},
                {value: 'artist', text: 'アーティスト'},
                {value: 'genre', text: 'ジャンル'},
                {value: 'score_created_at', text: '作成日'},
            ],
            fields: [
                {key: 'score_created_at', label: '作成日', sortable: true},
                {key: 'score_updated_at', label: '最終更新日', sortable: true},
                {key: 'title', label: '曲名'},
                {key: 'artist', label: 'アーティスト'},
                {key: 'genre', label: 'ジャンル'},
                {key: 'remarks', label: '備考'},
                {key: 'url', label: '試聴URL'},
                {key: 'is_own', label: '所持'},
                {key: 'is_want', label: '欲しい！'},
            ],
            scores: [],
        }
    },
    computed: {},
    created() {
        this.getScores()
    },
    mounted() {
    },

    methods: {
        execSearch() {
            this.getScores(1)
        },
        getScores(page = 1, search = null) {
            axios.get('/api/v1/scores', {
                params: {
                    searchSelected: this.searchSelected,
                    search: this.search,
                    page: page
                }
            })
                .then((response) => {
                    this.scores = response.data
                    console.log(response.data)
                })
                .catch((e) => {
                    alert(e);
                });
        },
        pageChange(page) {
            this.getScores(page)
        }
    }
}
</script>
