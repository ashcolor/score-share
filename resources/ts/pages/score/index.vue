<template>
    <div>
        <CustomHeader></CustomHeader>
        <b-container class="my-4">
            <ScoreTableAll></ScoreTableAll>
        </b-container>
    </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import CustomHeader from "../../components/CustomHeader.vue";
import ScoreTableAll from "../../components/ScoreTableAll.vue";

@Component({
    components: {
        CustomHeader,
        ScoreTableAll
    },
})

export default class ScoreIndex extends Vue{

}
</script>
