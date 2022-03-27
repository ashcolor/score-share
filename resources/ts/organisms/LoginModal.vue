<template>
    <b-modal id="login-modal" ref="modal" title="新規追加" button-size="sm" hide-footer centered>
        <b-form @submit="onSubmit" @reset="onReset" v-if="show">
            <b-link href="/twitter/redirect">
                <b-img :src="'/img/sign-in-with-twitter.png'"></b-img>
            </b-link>
        </b-form>
    </b-modal>
</template>

<script lang="ts">
import {Component, Vue} from 'vue-property-decorator';

@Component
export default class LoginModal extends Vue {
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
