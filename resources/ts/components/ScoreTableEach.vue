<template>
    <div>
        <b-collapse id="score-table-each" accordion="main-content">
            <b-card header-tag="header" footer-tag="footer">
                <template #header>
                    <h4 class="mb-0">マイページ</h4>
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

                </b-input-group>


                <b-button v-b-modal.add-modal class="float-right">
                    <b-icon icon="plus" aria-label="Help"></b-icon>
                    新規追加
                </b-button>

                <b-table small hover outlined :fields="fields" :items="scores.data" class="mt-3">
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
                        <p class="text-muted m-0"><small>更新:{{ data.item.score_updated_at }}</small></p>
                    </template>
                    <template #cell(url)="data">
                        <a v-if="data.value" :href="data.value" target="_blank" class="pa-2">
                            <b-icon-headphones></b-icon-headphones>
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

            <ScoreAddModal @getScores="getScores"/>

        </b-collapse>
    </div>
</template>

<script lang="ts">
import CustomHeader from "./CustomHeader.vue";

type Scores = {
    data: {
        id: number,
    }[],
    current_page: number,
    total: number,
    per_page: number
}

import {Component, Vue} from 'vue-property-decorator';
import ScoreAddModal from "../organisms/ScoreAddModal.vue";

@Component({
    components: {
        ScoreAddModal
    },
})

export default class ScoreTableEach extends Vue {
    isColor: boolean = true;
    searchSelected: string = 'title';
    search: string = '';
    searchOptions: Object[] = [
        {value: 'title', text: '曲名'},
        {value: 'artist', text: 'アーティスト'},
        {value: 'genre', text: 'ジャンル'},
        {value: 'score_created_at', text: '作成日'},
    ];
    fields: Object[] = [
        {key: 'title', label: '曲名', class: 'align-middle'},
        {key: 'artist', label: 'アーティスト', class: 'align-middle'},
        {key: 'genre', label: 'ジャンル', class: 'align-middle'},
        {key: 'score_date', label: '作成日/更新日'},
        {key: 'url', label: '試聴', class: 'text-center align-middle'},
    ];
    scores: Scores = {
        data: [],
        current_page: 1,
        total: 0,
        per_page: 10
    }

    created() {
        this.getScores()
    };

    mounted() {
    };

    execSearch() {
        this.getScores(1)
    };

    getScores(page: number = 1, search?: String) {
        this.axios.get('/api/v1/scores', {
            params: {
                searchSelected: this.searchSelected,
                search: this.search,
                page: page,
            }
        })
            .then((response) => {
                this.scores = response.data
            })
            .catch((e) => {
                alert(e);
            });
    };

    pageChange(page: number) {
        this.getScores(page)
    };

    reloadPage() {
        this.getScores(this.scores.current_page)
    }
}
</script>

<style>
#score-table-each {
    animation: none;
    transition: none;
}
</style>
