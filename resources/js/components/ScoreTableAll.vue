<template>
    <div>
        <b-card header-tag="header" footer-tag="footer">
            <template #header>
                <h4 class="mb-0">楽譜検索</h4>
            </template>

            <b-input-group class="w-75 mx-auto">

                <b-input-group-prepend>
                    <b-form-select v-model="searchSelected" :options="searchOptions"></b-form-select>
                </b-input-group-prepend>

                <b-form-input v-if="['title','artist','genre'].includes(searchSelected)"
                              v-model="search"></b-form-input>
                <b-form-datepicker
                    v-if="['score_created_at','score_updated_at'].includes(searchSelected)"></b-form-datepicker>

                <b-input-group-append>
                    <b-button size="sm" text="Button" variant="success" @click="execSearch">検索</b-button>
                </b-input-group-append>

                <div class="custom-control custom-switch align-middle ml-4 my-auto">
                    <input v-model="isColor" type="checkbox" class="custom-control-input" id="customSwitch1">
                    <label class="custom-control-label" for="customSwitch1">色表示</label>
                </div>

            </b-input-group>

            <b-table small hover outlined :fields="fields" :items="scores.data" :tbody-tr-class="rowClass" class="mt-3">
                <template #cell(genre)="data">
                    <span class="badge badge-light">{{ data.value }}</span>
                </template>
                <template #cell(score_created_user)="data">
                    <b-avatar size="sm" :src="data.item.score_created_user.twitter_profile_image_url_https"
                              class="m-0"></b-avatar>
                    <small>
                        {{ data.item.score_created_user.twitter_screen_name }}
                        <span class="text-muted">@{{ data.item.score_created_user.twitter_name }}</span>
                    </small>
                </template>
                <template #cell(score_date)="data">
                    <p class="text-muted m-0"><small>作成:{{ data.item.score_created_at }}</small></p>
                    <p class="text-muted m-0"><small>更新:{{ data.item.score_created_at }}</small></p>
                </template>
                <template #cell(url)="data">
                    <a v-if="data.value" :href="data.value" target="_blank" class="pa-2">
                        <b-icon-headphones></b-icon-headphones>
                    </a>
                </template>
                <template #cell(is_want)="data">
                    <a class="pa-2" @click="want(data.item.id)">
                        <b-icon-heart-fill v-if="data.value" color="red"></b-icon-heart-fill>
                        <b-icon-heart v-else color="red"></b-icon-heart>
                    </a>
                </template>
                <template #cell(is_own)="data">
                    <a class="pa-2">
                        <b-icon-bookmark-check-fill v-if="data.value" color=green></b-icon-bookmark-check-fill>
                        <b-icon-bookmark-check v-else color=green></b-icon-bookmark-check>
                    </a>
                </template>
            </b-table>


            <b-pagination
                v-model="scores.current_page"
                :total-rows="scores.total"
                :per-page="scores.per_page"
                align="center"
                @change="pageChange"
                class="mt-3"
            ></b-pagination>


        </b-card>
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
            isColor: true,
            searchSelected: 'title',
            search: '',
            searchOptions: [
                {value: 'title', text: '曲名'},
                {value: 'artist', text: 'アーティスト'},
                {value: 'genre', text: 'ジャンル'},
                {value: 'score_created_at', text: '作成日'},
            ],
            fields: [
                {key: 'title', label: '曲名', class: 'align-middle'},
                {key: 'artist', label: 'アーティスト', class: 'align-middle'},
                {key: 'genre', label: 'ジャンル', class: 'align-middle'},
                {key: 'score_created_user', label: '作成者', class: 'align-middle'},
                {key: 'score_date', label: '作成日/更新日'},
                {key: 'url', label: '試聴', class: 'text-center align-middle'},
                {key: 'is_want', label: '欲しい！', class: 'text-center align-middle'},
                {key: 'is_own', label: '所持', class: 'text-center align-middle'},
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
        want(id) {
            const index = this.scores.data.findIndex(score => score.id === id)

            this.scores.data[index].is_want = !this.scores.data[index].is_want
            axios.post(`/api/v1/want`, {
                'score_id': id
            })
                .then((response) => {
                    console.log(response.data)
                })
                .catch((e) => {
                    alert(e);
                });
        },
        pageChange(page) {
            this.getScores(page)
        },
        rowClass(item, type) {
            if (item.is_own === true) {
                return 'bg-own'
            } else if (item.is_want === true) {
                return 'bg-want'
            } else {
                return
            }
        }
    }
}
</script>

<style>
.bg-want {
    background-color: #ffffe0;
}

.bg-own {
    background-color: #c0c0c0;
}
</style>
