<template>
    <div>
        <CustomHeader></CustomHeader>
        <b-container class="my-4">
            <ScoreTableAll></ScoreTableAll>
            <ScoreTableEach></ScoreTableEach>
        </b-container>
    </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import CustomHeader from "../../components/CustomHeader.vue";
import ScoreTableAll from "../../components/ScoreTableAll.vue";
import ScoreTableEach from "../../components/ScoreTableEach.vue";

@Component({
    components: {
        CustomHeader,
        ScoreTableAll,
        ScoreTableEach
    },
})

export default class ScoreIndex extends Vue{

}
</script>
