<template>
    <b-modal id="add-modal" ref="modal" title="新規追加" button-size="sm" hide-footer centered>
        <b-form @submit="onSubmit" @reset="onReset" v-if="show">
            <b-form-group label="曲名">
                <b-form-input v-model="form.title" required></b-form-input>
            </b-form-group>

            <b-form-group label="アーティスト">
                <b-form-input v-model="form.artist" required></b-form-input>
            </b-form-group>

            <b-form-group label="作成日">
                <b-form-input v-model="form.score_created_at" type="date"></b-form-input>
            </b-form-group>

            <b-form-group label="更新日">
                <b-form-input v-model="form.score_updated_at" type="date"></b-form-input>
            </b-form-group>

            <b-form-group label="ジャンル">
                <b-form-input v-model="form.genre"></b-form-input>
            </b-form-group>

            <b-form-group label="試聴用URL">
                <b-form-input v-model="form.url"></b-form-input>
            </b-form-group>

            <b-button type="submit" variant="primary">登録</b-button>
            <b-button type="reset" variant="danger">クリア</b-button>
        </b-form>
    </b-modal>
</template>

<script lang="ts">
import {Component, Vue} from 'vue-property-decorator';

@Component
export default class ScoreAddModal extends Vue {
    show: boolean = true
    form = {
        title: '',
        artist: '',
        score_created_at: null,
        score_updated_at: null,
        genre: null,
        url: null
    }

    async onSubmit(event) {
        event.preventDefault()
        const response = await this.axios.post('/api/v1/scores', this.form).catch()
        this.$emit('getScores')
        this.$bvModal.hide('add-modal')
    };

    onReset(event) {
        event.preventDefault()
        this.form.title = ''
        this.form.artist = ''
        this.form.genre = null
        this.form.score_created_at = null
        this.form.score_updated_at = null
        this.form.genre = null
        this.form.url = null
    };
}
</script>
