<template>
<div>
    <div class="container mx-auto">
        <div class="flex flex-col flex-no-wrap justify-center align-middle w-full py-5 my-3">
            <div class="flex flex-col md:flex-row flex-no-wrap w-full">
                <div class="flex h-32 w-32 md:h-48 md:w-48 lg:h-64 lg:w-64 mx-auto my-5 md:mx-0 rounded-full bg-indigo-900 overflow-hidden border-2 border-white border-opacity-50">
                    <img class="w-full h-auto object-cover" :src="tweeter.avatar" alt="Profile image">
                </div>
                <div class="flex align-middle flex-grow my-auto px-5">
                    <div class="tweeter-info text-left">
                        <h1 class="text-white text-xl md:text-2xl xl:text-4xl font-bold">{{tweeter.name}}</h1>
                        <h2 class="text-gray-600 text-base md:text-xl xl:text-2xl font-bold">{{tweeter.handle}}</h2>
                    </div>
                    <a class="ml-auto my-auto bg-blue-400 hover:bg-blue-700 text-white font-semibold py-2 px-8 rounded-full transition ease-in-out duration-100 outline-none border-none" href="/manage/profile" v-if="checkIfUserProfile">Edit profile</a>
                </div>
            </div>
        </div>
        <div class="all-tweets flex justify-center align-middle w-full h-full flex-col">
            <template v-for="tweet in tweets" v-if="tweetsLoaded">
                <tweet :tweet="tweet" :liked="tweet.isLiked" ></tweet>
            </template>
            <vue-loaders name="ball-grid-pulse" color="#63B3ED" scale="1" v-if="!tweetsLoaded" style="margin-right: auto !important; margin-left: auto !important; margin-top: 6rem; margin-bottom: 6rem"></vue-loaders>
            <infinite-loading @distance="1" @infinite="infiniteHandler" v-if="continueInfiniteLoading"></infinite-loading>
        </div>
    </div>
    <div class="w-full py-10 bg-blue-900 flex flex-col flex-no-wrap my-5" v-if="endReached">
        <h1 class="text-6xl text-blue-700 text-center font-bold select-none">᛫</h1>
        <h1 class="text-2xl text-blue-700 text-center font-bold select-none">No more tweets.</h1>
    </div>
</div>
</template>

<script>
    export default {
        props:{
            tweeter: Object,
            user: Object,
        },
        data(){
            return {
                tweetsLoaded: false,
                tweets: [],
                page: 1,
                continueInfiniteLoading: true,
                endReached: false,
            }
        },
        methods:{
            infiniteHandler($state) {
                this.$http.get('/api/get/tweets/user?page='+this.page+"&user_id="+this.safeGetUserId()+"&tweeter_id="+this.tweeter.id)
                    .then(response => {
                        return response.json();
                    }).then(data => {
                    console.log(data.data);
                    if(data.data.length === 0) {
                        this.continueInfiniteLoading = false;
                        this.endReached = true;
                        return;
                    }
                    data.data.forEach(tweet =>{
                        this.tweets.push(tweet)});
                    $state.loaded();
                });

                this.tweetsLoaded = true;
                this.page = this.page + 1;
            },
            safeGetUserId(){
                if(this.user) return this.user.id
                return -1
            },
        },
        computed:{
            checkIfUserProfile: function(){
                if(!this.user) return false;
                if(this.user.id !== this.tweeter.id) return false;
                return true;
            }
        }
    }
</script>
<style>

</style>
