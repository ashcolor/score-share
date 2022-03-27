<template>
    <div>
        <b-navbar toggleable="lg" type="dark" variant="info">
            <b-navbar-brand href="#">楽譜交換支援システム</b-navbar-brand>

            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

            <b-collapse id="nav-collapse" is-nav>
                <b-navbar-nav>
                    <b-nav-item v-b-toggle.score-table-all>楽譜検索</b-nav-item>
                    <b-nav-item v-b-toggle.score-table-each>マイ楽譜</b-nav-item>
                </b-navbar-nav>

                <b-navbar-nav class="ml-auto" v-if="user">
                    <b-dropdown variant="link" toggle-class="text-decoration-none" no-caret right>
                        <template #button-content>
                            <b-avatar class="mr-3" :src="user.twitter_profile_image_url_https"></b-avatar>
                        </template>

                        <b-dropdown-item href="#">設定</b-dropdown-item>
                        <div class="dropdown-divider"></div>
                        <b-dropdown-item href="#" @click="onClickLogout">ログアウト</b-dropdown-item>
                    </b-dropdown>
                </b-navbar-nav>
                <b-navbar-nav class="ml-auto" v-else>
                    <b-navbar-brand href="#" v-b-modal.login-modal>ログイン</b-navbar-brand>
                    <LoginModal></LoginModal>
                </b-navbar-nav>

            </b-collapse>
        </b-navbar>
    </div>
</template>

<script lang="ts">
import {Component, Vue} from 'vue-property-decorator';
import LoginModal from '../organisms/LoginModal.vue'
import axios from "axios";

@Component({
    components: {LoginModal},
})
export default class CustomHeader extends Vue {
    user = null
    mounted(){
        this.axios.get('/api/v1/user/self')
            .then((response) => {
                this.user = response.data
            })
            .catch((e) => {
                alert(e);
            });
    }

    onClickLogout() {
        this.axios.get('/api/v1/logout')
            .then((response) => {
                this.user = null
            })
            .catch((e) => {
                alert(e);
            });
    }
}
</script>

<style scoped>
.not-collapsed {

    pointer-events: none;
}
.not-collapsed .nav-link {
    color: #ffffff !important;
}
.collapsed {

}
</style>
