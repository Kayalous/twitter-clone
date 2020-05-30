
<template>
    <div class="container mx-auto">
        <tweet :tweet="this.tweet"></tweet>
        <hr>
        <form v-on:submit="newReply" class="new-tweet w-full px-3 py-2 my-5" v-if="user">
            <div class="flex flex-no-wrap justify-center align-middle w-full">
                <div class="w-16 h-16 md:w-24 md:h-24 rounded-full bg-indigo-900 mx-2 overflow-hidden flex">
                    <img class="w-full h-auto object-cover" :src="user.avatar" alt="Profile image">
                </div>
                <textarea class="flex-grow bg-transparent border-none resize-none outline-none text-white text-xl" v-model="body" rows="2" maxlength="250" placeholder="What's happening?"></textarea>
            </div>
<!--            <div class="tweet-attachments relative overflow-hidden rounded-md my-5 w-3/4 mx-auto" style="padding-bottom: 33.33%" :class="attachment ? '' : 'hidden'">-->
<!--                <img class="absolute w-full h-full object-cover" src="#" alt="Attachment preview" id="img-preview">-->
<!--                <button type="button" class="absolute top-0 right-0 mt-5 mr-5 border-0 bg-blue-900 rounded-full p-3 hover:bg-blue-700" v-on:click="removeAttachment"><i data-feather="x" class="text-gray-900" style="height: 30px; width: 30px; stroke-width: 2; "></i></button>-->
<!--            </div>-->
            <div class="flex flex-no-wrap w-full justify-between align-middle p-4">
<!--                <div class="utilities">-->
<!--                    <label class="cursor-pointer p-3 flex justify-center align-middle hover:bg-blue-900 text-white rounded-full transition ease-in-out duration-100 outline-none border-none text-blue-400">-->
<!--                        <i data-feather="image" style="height: 30px; width: 30px; stroke-width: 1"></i>-->
<!--                        <input type="file" class="hidden" id="attachment" v-on:change="onImageChange">-->
<!--                    </label>-->
<!--                </div>-->
                <button type="submit" class="bg-blue-400 hover:bg-blue-700 text-white font-semibold py-2 px-8 rounded-full transition ease-in-out duration-100 outline-none border-none ml-auto" :class="disableSubmission ? 'disabled' : '' " :disabled="disableSubmission">
                       <span v-if="!submitButtonLoading">
                           Reply
                       </span>
                    <vue-loaders name="ball-beat" color="white" scale="1" v-if="submitButtonLoading" style="margin: auto !important;"></vue-loaders>

                </button>
            </div>
        </form>
        <div class="all-replies flex justify-center align-middle w-full flex-col" id="all-tweets">
            <template v-for="reply in this.replies">
                <reply :reply="reply"></reply>
            </template>
            <infinite-loading @distance="1" @infinite="infiniteHandler" v-if="continueInfiniteLoading"></infinite-loading>
            <div v-if="endReached && replies.length ===0">
                <h1 class="text-4xl text-center text-gray-500 my-5">No replies</h1>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log(this.tweet);
        },
        data() {
            return {
                body: '',
                tweetsLoaded: false,
                page: 1,
                replies: [],
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
        methods:{
            infiniteHandler($state) {
                this.$http.get('/api/get/tweet/replies?page='+this.page+"&tweet_id="+this.tweet.id)
                    .then(response => {
                        return response.json();
                    }).then(data => {
                    if(data.data.length === 0) {
                        this.continueInfiniteLoading = false;
                        this.endReached = true;
                        return;
                    }
                    data.data.forEach(reply =>{
                        this.replies.push(reply)});
                    if($state) $state.loaded();
                });

                this.tweetsLoaded = true;
                this.page = this.page + 1;
            },
            newReply(e) {
                e.preventDefault();
                this.submitButtonLoading = true;
                this.$http.post('/new/reply', {
                    body: this.body.trim(),
                    tweet_id: this.tweet.id,
                    _token: window.Laravel.csrfToken,
                })
                    .then((res)=>{
                        this.body = "";
                        this.replies = [];
                        this.page = 1;
                        this.continueInfiniteLoading= true
                        this.endReached= false
                        this.infiniteHandler(null);
                    })
                    .catch((err) => {console.log(err)
                        }
                    ).finally(()=> {this.submitButtonLoading = false;})
            },
        },
        watch:{
            body: function () {
                if(this.body.length > 0) this.disableSubmission = false;
                else this.disableSubmission = true;
            }
        },
    }
</script>

<style scoped>
    .disabled{
        cursor: not-allowed;
        opacity: 0.5;
    }
</style>
