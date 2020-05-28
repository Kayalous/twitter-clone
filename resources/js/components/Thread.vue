
<template>
    <div class="container mx-auto">
        <tweet :tweet="this.tweet"></tweet>
        <hr>
        <div class="all-replies flex justify-center align-middle w-full flex-col" id="all-tweets">
            <template v-for="reply in this.tweet.replies">
                <tweet :tweet="reply"></tweet>
            </template>
<!--            <vue-loaders name="ball-grid-pulse" color="#63B3ED" scale="1" v-if="!tweetsLoaded" style="margin-right: auto !important; margin-left: auto !important; margin-top: 6rem; margin-bottom: 6rem"></vue-loaders>-->

<!--            <infinite-loading @distance="1" @infinite="infiniteHandler" v-if="continueInfiniteLoading"></infinite-loading>-->

        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log(this.tweet.replies);
        },
        data() {
            return {
                tweetsLoaded: false,
                page: 1,
                continueInfiniteLoading: true,
                endReached: false,
                percentCompleted: 0,
                attachment: '',
                disableSubmission: true,
                submitButtonLoading: false
            };
        },
        props: {
            tweet: Object,
            user: Object
        },
    }
</script>
