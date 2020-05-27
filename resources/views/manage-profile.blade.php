@extends("layout")
@section("customStyles")

@endsection
@section("content")
    <div class="container mx-auto py-5">

        <h1 class="text-center text-white text-4xl mb-5">Edit Profile</h1>
            <div class="px-5 flex justify-center align-middle w-full">
                <form class="bg-gray-900 bg-opacity-75 shadow-md rounded px-8 pt-6 pb-8 mb-4 flex-grow" method="POST" enctype='multipart/form-data' style="max-width: 500px">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-200 text-sm font-bold mb-2 rounded-full" for="avatar">
                            <div class="flex h-32 w-32 md:h-48 md:w-48 lg:h-64 lg:w-64 mx-auto my-5 rounded-full bg-indigo-900 overflow-hidden border-2 border-white border-opacity-50 relative">
                                <img class="w-full h-auto object-cover" src="{{Auth::user()->avatar}}" alt="Profile image" id="img-preview">
                                <div class="absolute w-full h-full bg-black bg-opacity-50 opacity-0 hover:opacity-100 top-0 left-0 rounded-full flex justify-center align-middle transition duration-100 cursor-pointer">
                                    <span class="my-auto">Edit Avatar</span>
                                </div>
                            </div>
                        </label>
                        <input type="file" class="hidden" id="avatar" name="avatar" accept="image/*" onchange="onImageChangeNonVue(event)">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-200 text-sm font-bold mb-2" for="name">
                            Name
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" placeholder="{{Auth::user()->name}}">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-200 text-sm font-bold mb-2" for="handle">
                            Handle
                        </label>
                        <div class="flex flex-wrap items-stretch w-full mb-4 relative">
                            <div class="flex -mr-px bg-gray-800 z-10">
                                <span class="flex items-center leading-normal rounded rounded-r-none border border-r-0 border-grey-light px-3 whitespace-no-wrap text-gray-200 text-sm">@</span>
                            </div>
                            <input type="text" class="flex-shrink flex-grow flex-auto leading-normal w-px flex-1 border h-10 border-grey-light rounded rounded-l-none px-3 relative focus:outline-none focus:shadow-outline" name="handle" id="handle" placeholder="{{explode("@",Auth::user()->handle)[1]}}">
                        </div>
                    </div>
                <div class="mb-4">
                    <label class="block text-gray-200 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" name="password" type="password" placeholder="******************">
                </div>
                    <div class="w-full flex justify-center align-middle">
                        <button type="submit" class="bg-blue-400 hover:bg-blue-700 text-white font-semibold py-2 px-8 rounded-full transition ease-in-out duration-100 outline-none border-none mx-auto">
                       <span>
                           Submit
                       </span>
                        </button>
                    </div>

            </form>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script>
        function onImageChangeNonVue(e){
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;

            if(files[0].size > 5000000){
                Swal.fire({
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
            let reader = new FileReader();
            let vm = this;
            reader.onload = (e) => {
                document.querySelector("#img-preview").src = e.target.result
            };
            reader.readAsDataURL(files[0]);
        }
    </script>
@endsection
