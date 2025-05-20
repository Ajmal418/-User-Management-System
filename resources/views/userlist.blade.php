@extends('layouts.app')
@section('title')
    <title>User List</title>
@endsection
@section('content')
    <div class="bg-gray-100 min-h-screen p-10">
        <div class="container mx-auto bg-white p-6 rounded-2xl shadow">
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
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Users</h1>
                <a href="{{ route('registration') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add
                    New User</a>
            </div>



            <table class="min-w-full table-auto border">
                <thead class="bg-gray-200 text-left">
                    <tr>
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Name</th>
                        <th class="px-4 py-2 border">Email</th>
                        <th class="px-4 py-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody id="uselist">


                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2 border"></td>
                        <td class="px-4 py-2 border"></td>
                        <td class="px-4 py-2 border"></td>
                        <td class="px-4 py-2 border space-x-2">


                            <button onclick="addToCart(this)"
                                class="bg-green-800 text-white px-4 py-2 rounded hover:bg-green-600 "
                                data-id="">Edit</button>
                            <button onclick="addToCart(this)"
                                class="bg-red-800 text-white px-4 py-2 rounded hover:bg-red-600 "
                                data-id="">Delete</button>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="4" class="text-center py-4">No users found.</td>
                    </tr>


                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // const getProductlist = async function() {
        //     const response = await fetch('http://127.0.0.1:8000/api/userlist');
        //     const json = await response.json()
        //     let html = ''
        //     if (json.data.length == 0) {
        //         html += ` <tr>
        //                 <td colspan="4" class="text-center py-4">No users found.</td>
        //             </tr>`;
        //     } else {

        //         json.data.forEach(element => {


        //             html += ` <tr class="border-b hover:bg-gray-50">
        //                     <td class="px-4 py-2 border">${element.id}</td>
        //                     <td class="px-4 py-2 border">${element.name}</td>
        //                     <td class="px-4 py-2 border">${element.email}</td>
        //                     <td class="px-4 py-2 border space-x-2"> 
        //                          <button type="button" class="bg-green-800 text-white px-4 py-2 rounded hover:bg-green-600 "   ><a href="{{ url('edit') }}/${element.id}">Edit</a></button>
        //                         <button onclick="deleteUser(this)" class="bg-red-800 text-white px-4 py-2 rounded hover:bg-red-600 "  data-id="${element.id}">Delete</button>
        //                     </td>
        //                 </tr>`;
        //         });
        //     }


        //     document.getElementById('uselist').innerHTML = html;

        // }
        // const deleteUser = async (e) => {

        //     const id = e.getAttribute('data-id')
        //     const response = await fetch(`http://127.0.0.1:8000/api/userdelete/${id}`, {
        //         method: "DELETE",
        //         headers: {
        //             Accept: "application/json",
        //         },
        //     });
        //     let json = await response.json();
        //     if (json.success !== false) {

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

        document.addEventListener('DOMContentLoaded', () => {
            getProductlist();
        });
    </script>
@endsection
