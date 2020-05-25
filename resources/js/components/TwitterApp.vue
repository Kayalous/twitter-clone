<template>
    <div class="container mx-auto">
        <form v-on:submit="newTweet" class="new-tweet w-full px-3 py-2">
            <div class="flex flex-no-wrap justify-center align-middle w-full">
                <div class="w-16 h-16 md:w-24 md:h-24 rounded-full bg-indigo-900 mx-2 overflow-hidden">
                    <img class="w-full h-auto" src="https://place-hold.it/300" alt="Profile image">
                </div>
                <textarea class="flex-grow bg-transparent border-none resize-none outline-none text-white text-xl" v-model="body" rows="2" placeholder="What's happening?"></textarea>
            </div>
            <div class="flex flex-no-wrap w-full justify-between align-middle p-4">
                <div class="utilities">
                    <button class="hover:bg-blue-900 text-white p-2 rounded-full transition ease-in-out duration-100 outline-none border-none text-blue-400" type="button">
                        <i data-feather="image" style="height: 30px; width: 30px; stroke-width: 1"></i>
                    </button>
                </div>
                <button type="submit" class="bg-blue-400 hover:bg-blue-700 text-white font-semibold py-2 px-8 rounded-full transition ease-in-out duration-100 outline-none border-none">Tweet</button>
            </div>
        </form>
        <div class="all-tweets flex justify-center align-middle w-full h-full flex-col">
                <vue-loaders name="ball-grid-pulse" color="#63B3ED" scale="1" v-if="!tweetsLoaded" style="margin-right: auto !important; margin-left: auto !important; margin-top: 6rem; margin-bottom: 6rem"></vue-loaders>
            <template v-for="tweet in tweets" v-if="tweetsLoaded">
                <tweet :tweet="tweet"></tweet>
            </template>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            feather.replace()
            this.getTweets()
        },
        methods: {
            newTweet(e) {
                e.preventDefault();
                this.axios.post('/new/tweet', {
                    body: this.body,
                    user_id: this.user.id
                })
                .then((res)=>{this.getTweets()})
                .catch((err) => console.log(err));
            },
            getTweets(){
                this.tweetsLoaded = false;
                this.axios.get('/api/get/tweets/all')
                    .then((res)=>{
                        this.tweets = res.data
                        this.tweetsLoaded = true;
                    })
                    .catch((err) => console.log(err));
            }
        },
        data() {
            return {
                body: '',
                tweets:[],
                tweetsLoaded: false
            };
        },
    props: {
        user: Object,
    }
    }
</script>
