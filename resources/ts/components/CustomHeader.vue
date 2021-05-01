<template>
    <div>
        <b-navbar toggleable="lg" type="dark" variant="info">
            <b-navbar-brand href="#">楽譜交換支援システム</b-navbar-brand>

            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

            <b-collapse id="nav-collapse" is-nav>
                <b-navbar-nav>
                    <b-nav-item href="#">楽譜検索</b-nav-item>
                    <b-nav-item href="#">マイ楽譜</b-nav-item>
                </b-navbar-nav>

                <b-navbar-nav class="ml-auto">
                    <b-dropdown variant="link" toggle-class="text-decoration-none" no-caret right>
                        <template #button-content>
                            <b-avatar class="mr-3"></b-avatar>
                        </template>
                        <b-dropdown-item href="#">ログイン</b-dropdown-item>
                        <b-dropdown-item href="#">設定</b-dropdown-item>
                        <div class="dropdown-divider"></div>
                        <b-dropdown-item href="#">ログアウト</b-dropdown-item>
                    </b-dropdown>
                </b-navbar-nav>

            </b-collapse>
        </b-navbar>
    </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';

@Component
export default class CustomHeader extends Vue {

}
</script>
