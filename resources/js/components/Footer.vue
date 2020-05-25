
<template>
    <footer class="w-full py-5">
        <div class="container mx-auto">
            <ul class="flex justify-between align-middle">
                <li class="rounded-lg text-white hover:bg-blue-100 transition ease-in-out duration-200"><a class="py-1 px-2 text-6xl font-bold text-blue-400 flex flex-no-wrap" href="/"><i class="my-auto" style="width: 60px; height: 60px; stroke-width: 1" data-feather="twitter"></i></a></li>
            </ul>
        </div>
    </footer>
</template>

<script>
    export default {
        mounted() {
            feather.replace()
        }
    }
</script>
