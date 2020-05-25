<template>
    <div class="tweet cursor-pointer rounded-lg hover:bg-blue-800 hover:bg-opacity-25 px-6 py-4 my-5 transition ease-in-out duration-100">
        <div class="poster-info flex flex-no-wrap align-middle">
            <div class="w-16 h-16 rounded-full bg-indigo-900 mx-2 overflow-hidden">
                <img class="w-full h-auto" src="https://place-hold.it/300" alt="Profile image">
            </div>
            <div class="poster">
                <a href="/@test" class="text-white inline-block font-semibold"><span class="hover:underline">{{tweet.user.name}}</span> <span class="text-gray-600 font-normal">{{tweet.user.handle}} · </span></a>
                <a href="/@test/status/8625634" class="inline-block text-gray-600">{{ tweet.created_at | moment("from") }}</a>
            </div>
        </div>
        <div class="tweet-body py-4">
            <p class="text-white md:px-6">
                {{tweet.body}}
            </p>
        </div>
        <div class="tweet-actions">
            <div class="flex flex-no-wrap justify-between w-full px-6">
                <div class="flex flex-no-wrap">
                    <button class="group text-white p-2 transition ease-in-out duration-100 outline-none border-none hover:text-blue-400 mx-2 flex flex-no-wrap align-middle" type="button">
                        <i class="group-hover:bg-blue-600 group-hover:bg-opacity-25 rounded-full p-2" data-feather="message-circle" style="height: 50px; width: 50px; stroke-width: 1"></i>
                        <span class="my-auto ml-2">4</span>
                    </button>
                    <button class="group  text-white p-2 transition ease-in-out duration-100 outline-none border-none hover:text-red-400 mx-2 flex flex-no-wrap align-middle" type="button">
                        <i class="group-hover:bg-red-600 group-hover:bg-opacity-25 rounded-full p-2" data-feather="heart" style="height: 50px; width: 50px; stroke-width: 1"></i>
                        <span class="my-auto ml-2">4</span>
                    </button>
                </div>

            </div>
        </div>
    </div>

</template>

<script>
    export default {
        mounted() {
            feather.replace()
        },
        props: {tweet: Object}
    }
</script>
