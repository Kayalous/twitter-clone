<template>
    <div>


    <div class="tweet cursor-pointer rounded-lg hover:bg-blue-800 hover:bg-opacity-25 px-6 py-4 my-5 transition ease-in-out duration-100 animate__animated animate__fadeIn animate__faster">
        <div class="poster-info flex flex-no-wrap align-middle">
            <div class="w-16 h-16 rounded-full bg-indigo-900 mx-2 overflow-hidden flex">
                <img class="w-full h-auto object-cover" :src="tweet.user.avatar" alt="Profile image">
            </div>
            <div class="poster">
                <a :href="'/u/' + tweet.user.handle" class="text-white inline-block font-semibold"><span class="hover:underline">{{tweet.user.name}}</span> <span class="text-gray-600 font-normal">{{tweet.user.handle}} · </span></a>
                <a :href="'/thread/' + tweet.id" class="inline-block text-gray-600">{{ tweet.created_at | moment("from") }}</a>
            </div>
        </div>
        <div class="tweet-body py-4">
            <p class="text-white md:px-6">{{tweet.body}}</p>
        </div>
        <div class="px-20" v-if="tweet.attachment">
            <div class="tweet-attachments relative overflow-hidden rounded-md" style="padding-bottom: 66.66%">
                <img class="absolute w-full h-full object-cover" :src="tweet.attachment" alt="Attachment" v-on:click="toggleModal" v-show="tweet.attachment_type === 'image'">
                <video class="absolute w-full h-full object-cover" :src="tweet.attachment" width="100%" height="100%" controls autoplay muted v-show="tweet.attachment_type === 'video'">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
        <div class="tweet-actions">
            <div class="flex flex-no-wrap justify-between w-full px-6">
                <div class="flex flex-no-wrap">
                    <a :href="'/thread/' + tweet.id" class="group text-white p-2 transition ease-in-out duration-100 outline-none border-none hover:text-blue-400 mx-2 flex flex-no-wrap align-middle" type="button">
                        <i class="group-hover:bg-blue-600 group-hover:bg-opacity-25 rounded-full p-2" data-feather="message-circle" style="height: 50px; width: 50px; stroke-width: 1"></i>
                        <span class="my-auto ml-2">{{replyCount}}</span>
                    </a>
                    <button class="group text-white p-2 transition ease-in-out duration-100 outline-none border-none hover:text-red-400 mx-2 flex flex-no-wrap align-middle" type="button" v-on:click="likeTweet(tweet.id)" :class="{liked: liked}">
                        <i class="group-hover:bg-red-600 group-hover:bg-opacity-25 rounded-full p-2" data-feather="heart" style="height: 50px; width: 50px; stroke-width: 1"></i>
                        <span class="my-auto ml-2">{{likeCount}}</span>
                    </button>
                </div>

            </div>
        </div>
    </div>
    <modal :showing="showModal" @close="showModal = false">
        <div class="px-20" v-if="tweet.attachment">
            <div class="tweet-attachments relative overflow-scroll rounded-md " style="padding-bottom: 66.66%">
                <img class="absolute w-full h-auto" :src="tweet.attachment" alt="Attachment" v-on:click="toggleModal">
            </div>
        </div>
    </modal>
    </div>
</template>

<script>
    export default {
        mounted() {
            feather.replace();
        },
        data(){
            return{
                showModal: false,
                likeCount: this.tweet.liked_by.length,
                replyCount: this.tweet.replies.length,
                liked: this.tweet.isLiked,
            }
        },
        props: {
            tweet: Object,
        },
        methods: {
            likeTweet(id){
                if(this.$parent.user){
                    this.liked = !this.liked;
                    if(this.liked)
                        this.likeCount++;
                    else
                        this.likeCount--;
                    this.$http.post('/like/tweet', {
                        tweet_id: id,
                        user_id: this.$parent.user.id,
                        _token: window.Laravel.csrfToken,
                    })
                        .then((res)=>{})
                        .catch((err) => {console.log(err)}
                        );
            }
            },
            toggleModal(){
                this.showModal = !this.showModal
            }
        },
    }
</script>
<style scoped>
    p {
        white-space: pre-wrap;
    }
    .tweet-attachments{
        max-height: 600px;
    }
    .liked>*{
        fill: #FB8080;
        stroke: #FB8080;

    }
</style>
