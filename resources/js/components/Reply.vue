<template>
    <div>


        <div class="reply cursor-pointer rounded-lg hover:bg-blue-800 hover:bg-opacity-25 px-6 py-4 my-5 transition ease-in-out duration-100 animate__animated animate__fadeIn animate__faster">
            <div class="poster-info flex flex-no-wrap align-middle">
                <div class="w-16 h-16 rounded-full bg-indigo-900 mx-2 overflow-hidden flex">
                    <img class="w-full h-auto object-cover" :src="reply.user.avatar" alt="Profile image">
                </div>
                <div class="poster">
                    <a :href="'/u/' + reply.user.handle" class="text-white inline-block font-semibold"><span class="hover:underline">{{reply.user.name}}</span> <span class="text-gray-600 font-normal">{{reply.user.handle}} · </span></a>
                    <a href="#" class="inline-block text-gray-600">{{ reply.created_at | moment("from") }}</a>
                </div>
            </div>
            <div class="reply-body py-4">
                <p class="text-white md:px-6">{{reply.body}}</p>
            </div>
        </div>
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
                user: this.$parent.user
            }
        },
        props: {
            reply: Object,
        },
        methods: {

        },
    }
</script>
<style scoped>
    p {
        white-space: pre-wrap;
    }
    .reply-attachments{
        max-height: 600px;
    }
    .liked>*{
        fill: #FB8080;
        stroke: #FB8080;

    }
</style>
