<template>
    <div>
        <div class="container mx-auto">
            <form v-on:submit="newTweet" class="new-tweet w-full px-3 py-2" v-if="user">
                <div class="flex flex-no-wrap justify-center align-middle w-full">
                    <div class="w-16 h-16 md:w-24 md:h-24 rounded-full bg-indigo-900 mx-2 overflow-hidden flex">
                        <img class="w-full h-auto object-cover" :src="user.avatar" alt="Profile image">
                    </div>
                    <textarea class="flex-grow bg-transparent border-none resize-none outline-none text-white text-xl" v-model="body" rows="2" maxlength="250" placeholder="What's happening?"></textarea>
                </div>
                <div class="tweet-attachments relative overflow-hidden rounded-md my-5 w-3/4 mx-auto" style="padding-bottom: 33.33%" :class="attachment ? '' : 'hidden'">
                    <img class="absolute w-full h-full object-cover" src="#" alt="Attachment preview" id="img-preview">
                    <button type="button" class="absolute top-0 right-0 mt-5 mr-5 border-0 bg-blue-900 rounded-full p-3 hover:bg-blue-700" v-on:click="removeAttachment"><i data-feather="x" class="text-gray-900" style="height: 30px; width: 30px; stroke-width: 2; "></i></button>
                </div>
                <div class="flex flex-no-wrap w-full justify-between align-middle p-4">
                    <div class="utilities">
                            <label class="cursor-pointer p-3 flex justify-center align-middle hover:bg-blue-900 text-white rounded-full transition ease-in-out duration-100 outline-none border-none text-blue-400">
                                <i data-feather="image" style="height: 30px; width: 30px; stroke-width: 1"></i>
                                <input type="file" class="hidden" id="attachment" v-on:change="onImageChange">
                            </label>
                    </div>
                    <button type="submit" class="bg-blue-400 hover:bg-blue-700 text-white font-semibold py-2 px-8 rounded-full transition ease-in-out duration-100 outline-none border-none my-auto" :class="disableSubmission ? 'disabled' : '' " :disabled="disableSubmission">
                       <span v-if="!submitButtonLoading">
                           Tweet
                       </span>
                        <vue-loaders name="ball-beat" color="white" scale="1" v-if="submitButtonLoading" style="margin: auto !important;"></vue-loaders>

                    </button>
                </div>
            </form>
            <div v-if="!user">
                <h1 class="text-gray-500 text-center text-5xl my-12">You need to be logged in to post a tweet.</h1>
            </div>
            <div class="all-tweets flex justify-center align-middle w-full flex-col" id="all-tweets">
                <template v-for="tweet in tweets" v-if="tweetsLoaded" v-model="tweets">
                    <tweet :tweet="tweet" :liked="tweet.isLiked" ></tweet>
                </template>
                <vue-loaders name="ball-grid-pulse" color="#63B3ED" scale="1" v-if="!tweetsLoaded" style="margin-right: auto !important; margin-left: auto !important; margin-top: 6rem; margin-bottom: 6rem"></vue-loaders>

                <infinite-loading @distance="1" @infinite="infiniteHandler" v-if="continueInfiniteLoading"></infinite-loading>

            </div>
        </div>
        <div class="w-full py-10 bg-blue-900 flex flex-col flex-no-wrap my-5" v-if="endReached">
            <h1 class="text-6xl text-blue-700 text-center font-bold select-none">᛫</h1>
            <h1 class="text-2xl text-blue-700 text-center font-bold select-none">It seems that you've reached the end of twitter... Wow.</h1>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            feather.replace()
            // this.getTweets()
        },
        data() {
            return {
                body: '',
                tweets:[],
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
            user: Object
        },
        methods: {
            newTweet(e) {
                e.preventDefault();
                this.submitButtonLoading = true;
                this.$http.post('/new/tweet', {
                    body: this.body.trim(),
                    _token: window.Laravel.csrfToken,
                    attachment: this.attachment
                })
                .then((res)=>{
                    this.body = "";
                    this.attachment = "";
                    this.tweets = [];
                    this.page = 1;
                    document.querySelector("#all-tweets").scrollIntoView();
                })
                .catch((err) => {console.log(err)
                }
            ).finally(()=> {this.submitButtonLoading = false;})
            },
            infiniteHandler($state) {
                this.$http.get('/api/get/tweets/all?page='+this.page+"&user_id="+this.safeGetUserId())
                    .then(response => {
                        return response.json();
                    }).then(data => {
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
            onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;

                if(files[0].size > 5000000){
                    this.$swal.fire({
                        title: 'File is too big. (Max file size is 5MB.)',
                        icon: 'error',
                        toast:true,
                        position: "top",
                        showCloseButton: true,
                        showConfirmButton: false,
                        timer: 3000
                    })
                    e.value = "";
                    return;
                };
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.attachment = e.target.result;

                    document.querySelector("#img-preview").src = e.target.result
                };
                reader.readAsDataURL(file);
            },
            removeAttachment(){
                this.attachment = "";

            },
            safeGetUserId(){
                if(this.user) return this.user.id
                return -1
            }
        },
        watch:{
            body: function () {
                if(this.body.length > 0) this.disableSubmission = false;
                else this.disableSubmission = true;
            },
            attachment: function () {
                document.querySelector("#attachment").value = '';
                document.querySelector("#img-preview").src = this.attachment;
            }
        },
        computed: {

        }
    }
</script>

<style scoped>
    .disabled{
        cursor: not-allowed;
        opacity: 0.5;
    }
</style>
