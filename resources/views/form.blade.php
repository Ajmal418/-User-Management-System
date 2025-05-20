@extends('layouts.app')
@section('title')
<title>User Registration</title>
@endsection
@section('content')
<div class="bg-gray-100 flex flex-col items-center justify-center h-screen">
    <div id="success_error" class="hidden">
        <div id="success_message"
            class="flex items-center p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg border border-green-300"
            role="alert">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M2 10a8 8 0 1116 0A8 8 0 012 10zm8-5a1 1 0 00-1 1v4H7a1 1 0 000 2h4v4a1 1 0 002 0v-4h4a1 1 0 000-2h-4V6a1 1 0 00-1-1h-2z"
                    clip-rule="evenodd" />
            </svg>
            <span class="font-medium">Success alert!</span>
        </div>
    </div>
    <div id="error" class="hidden">
        <div id="error_message"
            class="flex items-center p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg border border-red-300"
            role="alert">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-1 1v3a1 1 0 102 0V8a1 1 0 00-1-1zm-1 7a1 1 0 112 0 1 1 0 01-2 0z"
                    clip-rule="evenodd" />
            </svg>
            <span class="font-medium">Error alert!</span>
        </div>
    </div>
    <div class="bg-white shadow-md rounded-2xl p-8 w-full max-w-md">
        @if (!Request::route('id'))
        <h2 class="text-2xl font-bold mb-6 text-center">User Registration</h2>

        <form action="" method="POST" class="space-y-4">
            <!-- @csrf -->

            <div>
                <label class="block text-sm font-medium mb-1">Name</label>
                <input type="text" name="username" id="username" value="" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-400">
                <span class="text-red-600 hidden" id="username_err"></span>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="useremail" id="useremail" value="" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-400">
                <span class="text-red-600 hidden" id="useremail_err"></span>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-400">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-400">
                <span class="text-red-600 hidden" id="password_err"></span>
                <!-- <span class="text-red-600 hidden" id="password_confirmation_err"></span> -->
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="insertUser()"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                    Register
                </button>
                <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                    <a href="{{ route('userlist') }}"
                        class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">User
                        List</a>
                </button>
            </div>
        </form>
        @else
        <h2 class="text-2xl font-bold mb-6 text-center">User Update Form</h2>
        <form action="" method="POST" class="space-y-4">
            <!-- @csrf -->

            <div>
                <label class="block text-sm font-medium mb-1">Name</label>
                <input type="text" name="username" id="username" value="" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-400">
                <span class="text-red-600 hidden" id="username_err"></span>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="useremail" id="useremail" value="" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-400">
                <span class="text-red-600 hidden" id="useremail_err"></span>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-400">
                <span class="text-red-600 hidden" id="password_err"></span>
                <p class="text-xs text-gray-500">Leave blank if you don't want to change the password.</p>
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="updateUser()" data-id="" id="update"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                    Register
                </button>
                <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                    <a href="{{ route('userlist') }}"
                        class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">User List</a>
                </button>
            </div>
        </form>
        @endif
    </div>
</div>
@endsection
@section('script')
<script>
    url = window.location.href;
    let arr = url.split('/');
    var [id] = arr.splice(-1, 1)

    // var email = document.getElementById('useremail')
    // var password = document.getElementById('password')
    // var password_confirmation = document.getElementById('password_confirmation')
    // var update = document.getElementById('update')
    // var username = document.getElementById('username')
    // if(password_confirmation || email && password && username){
    //     username.addEventListener('keyup', () => {
    //         const err = document.getElementById('username_err');
    //         err.classList.add('hidden');
    //     })
    //     email.addEventListener('keyup', () => {
    //         const err = document.getElementById('useremail_err');
    //         err.classList.add('hidden');
    //     })
    //     password.addEventListener('keyup', () => {
    //         const err = document.getElementById('password_err');
    //         err.classList.add('hidden');
    //     })

    //     password_confirmation.addEventListener('keyup', () => {
    //         const err = document.getElementById('password_err');
    //         err.classList.add('hidden');
    //     })
    // }

    // const insertUser = async () => {
    //     var password_confirmation = document.getElementById('password_confirmation')
    //     const response = await fetch('http://127.0.0.1:8000/api/registration', {
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json',
    //             'Accept': 'application/json'
    //         },
    //         body: JSON.stringify({
    //             username: username.value,
    //             useremail: email.value,
    //             password: password.value,
    //             password_confirmation: password_confirmation.value
    //         })
    //     });
    //     const json = await response.json();

    //     if (json.success == false && json.hasOwnProperty('data')) {
    //         const errors = json.data;

    //         Object.entries(errors).forEach(([key, value]) => {

    //             // value.forEach(element => {
    //             let err = document.getElementById(`${key}_err`);
    //             err.innerHTML = value[0];
    //             err.classList.remove('hidden');
    //             // });
    //         })
    //     } else if (json.success !== false) {

    //         let success_error = document.getElementById("success_error");
    //         success_error.classList.remove("hidden");
    //         document.getElementById("success_message").innerHTML = json.message;
    //         setTimeout(() => {
    //             success_error.classList.add("hidden");
    //             location.reload();
    //         }, 3000);
    //     } else {
    //         let error = document.getElementById("error");
    //         error.classList.remove("hidden");
    //         document.getElementById("error_message").innerHTML = json.message;
    //         setTimeout(() => {
    //             error.classList.add("hidden");
    //         }, 3000);

    //     }

    // }

    // const getUser = async function(id) {

    //     // const [id] = arr.splice(-1, 1);
    //     //const [id] = id;
    //     console.log(id);
    //     const response = await fetch(`http://127.0.0.1:8000/api/userdetails/${id}`);
    //     const json = await response.json();

    //     const data = json.data;

    //     update.setAttribute('data-id', data.id);
    //     username.value = data.name;
    //     email.value = data.email;

    // }

    // const updateUser = async () => {

    //     const id = update.getAttribute('data-id')


    //     const response = await fetch(`http://127.0.0.1:8000/api/userupdate/${id}`, {
    //         method: 'PUT',
    //         headers: {
    //             'Content-Type': 'application/json',
    //             'Accept': 'application/json'
    //         },
    //         body: JSON.stringify({
    //             username: username.value,
    //             useremail: email.value,
    //             password: password.value
    //         })
    //     });
    //     const json = await response.json();
    //     console.log(json)
    //     if (json.success == false && json.hasOwnProperty('data')) {
    //         const errors = json.data;
    //         console.log('form request')
    //         Object.entries(errors).forEach(([key, value]) => {

    //             // value.forEach(element => {
    //             let err = document.getElementById(`${key}_err`);
    //             err.innerHTML = value[0];
    //             err.classList.remove('hidden');
    //             // });
    //         })
    //     } else if (json.success !== false) {

    //         console.log('success request')
    //         let success_error = document.getElementById("success_error");
    //         success_error.classList.remove("hidden");
    //         document.getElementById("success_message").innerHTML = json.message;
    //         setTimeout(() => {
    //             success_error.classList.add("hidden");
    //             location.reload()
    //         }, 3000);
    //     } else {
    //         console.log('form error')
    //         let error = document.getElementById("error");
    //         error.classList.remove("hidden");
    //         document.getElementById("error_message").innerHTML = json.message;
    //         setTimeout(() => {
    //             error.classList.add("hidden");
    //         }, 3000);
    //     }

    // }



    document.addEventListener('DOMContentLoaded', () => {

        if ([id] != "") {

            getUser(id);
        } 


    })
</script>
@endsection