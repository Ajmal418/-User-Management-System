require('./bootstrap');

// let url = location.href;
// let arr = url.split('/');
// var [id] = arr.splice(-1, 1);

var email = document.getElementById('useremail')
var password = document.getElementById('password')
var password_confirmation = document.getElementById('password_confirmation')
var username = document.getElementById('username')
if(password && password_confirmation){

    username.addEventListener('keyup', () => {
        const err = document.getElementById('username_err');
        err.classList.add('hidden');
    })
    email.addEventListener('keyup', () => {
        const err = document.getElementById('useremail_err');
        err.classList.add('hidden');
    })

    password_confirmation.addEventListener('keyup', () => {
        const err = document.getElementById('password_err');
        err.classList.add('hidden');
    })
    
    password.addEventListener('keyup', () => {
        const err = document.getElementById('password_err');
        err.classList.add('hidden');
    })
}else if(password){

    username.addEventListener('keyup', () => {
        const err = document.getElementById('username_err');
        err.classList.add('hidden');
    })
    email.addEventListener('keyup', () => {
        const err = document.getElementById('useremail_err');
        err.classList.add('hidden');
    })

    password.addEventListener('keyup', () => {
        const err = document.getElementById('password_err');
        err.classList.add('hidden');
    })
    
}

 window.insertUser = async () => {
    var password_confirmation = document.getElementById('password_confirmation')
    const response = await fetch('http://127.0.0.1:8000/api/registration', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            username: username.value,
            useremail: email.value,
            password: password.value,
            password_confirmation: password_confirmation.value
        })
    });
    const json = await response.json();

    if (json.success == false && json.hasOwnProperty('data')) {
        const errors = json.data;

        Object.entries(errors).forEach(([key, value]) => {

            // value.forEach(element => {
            let err = document.getElementById(`${key}_err`);
            err.innerHTML = value[0];
            err.classList.remove('hidden');
            // });
        })
    } else if (json.success !== false) {

        let success_error = document.getElementById("success_error");
        success_error.classList.remove("hidden");
        document.getElementById("success_message").innerHTML = json.message;
        setTimeout(() => {
            success_error.classList.add("hidden");
            location.reload();
        }, 3000);
    } else {
        let error = document.getElementById("error");
        error.classList.remove("hidden");
        document.getElementById("error_message").innerHTML = json.message;
        setTimeout(() => {
            error.classList.add("hidden");
        }, 3000);

    }

}

window.getUser = async function(id) {

    var update = document.getElementById('update')
    // const [id] = arr.splice(-1, 1);
    //const [id] = id;
    console.log(id);
    const response = await fetch(`http://127.0.0.1:8000/api/userdetails/${id}`);
    const json = await response.json();

    const data = json.data;

    update.setAttribute('data-id', data.id);
    username.value = data.name;
    email.value = data.email;

}

window.updateUser = async () => {

    const id = update.getAttribute('data-id')


    const response = await fetch(`http://127.0.0.1:8000/api/userupdate/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            username: username.value,
            useremail: email.value,
            password: password.value
        })
    });
    const json = await response.json();
    console.log(json)
    if (json.success == false && json.hasOwnProperty('data')) {
        const errors = json.data;
        console.log('form request')
        Object.entries(errors).forEach(([key, value]) => {

            // value.forEach(element => {
            let err = document.getElementById(`${key}_err`);
            err.innerHTML = value[0];
            err.classList.remove('hidden');
            // });
        })
    } else if (json.success !== false) {

        console.log('success request')
        let success_error = document.getElementById("success_error");
        success_error.classList.remove("hidden");
        document.getElementById("success_message").innerHTML = json.message;
        setTimeout(() => {
            success_error.classList.add("hidden");
            location.reload()
        }, 3000);
    } else {
        console.log('form error')
        let error = document.getElementById("error");
        error.classList.remove("hidden");
        document.getElementById("error_message").innerHTML = json.message;
        setTimeout(() => {
            error.classList.add("hidden");
        }, 3000);
    }

}

 window.getProductlist = async function() {
    let userlistid=document.getElementById('uselist')
    const response = await fetch('http://127.0.0.1:8000/api/userlist');
    const json = await response.json()
    let html = ''
    if (json.data.length == 0) {
        html += ` <tr>
                <td colspan="4" class="text-center py-4">No users found.</td>
            </tr>`;
    } else {

        json.data.forEach(element => {


            html += ` <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2 border">${element.id}</td>
                    <td class="px-4 py-2 border">${element.name}</td>
                    <td class="px-4 py-2 border">${element.email}</td>
                    <td class="px-4 py-2 border space-x-2"> 
                         <button type="button" class="bg-green-800 text-white px-4 py-2 rounded hover:bg-green-600 "   ><a href="edit/${element.id}">Edit</a></button>
                        <button onclick="deleteUser(this)" class="bg-red-800 text-white px-4 py-2 rounded hover:bg-red-600 "  data-id="${element.id}">Delete</button>
                    </td>
                </tr>`;
        });
    }


    userlistid.innerHTML = html;

}
 window.deleteUser = async (e) => {

    const id = e.getAttribute('data-id')
    const response = await fetch(`http://127.0.0.1:8000/api/userdelete/${id}`, {
        method: "DELETE",
        headers: {
            Accept: "application/json",
        },
    });
    let json = await response.json();
    if (json.success !== false) {

        let success_error = document.getElementById("success_error");
        success_error.classList.remove("hidden");
        document.getElementById("success_message").innerHTML = json.message;
        setTimeout(() => {
            success_error.classList.add("hidden");
            location.reload();
        }, 3000);
    } else {
        let error = document.getElementById("error");
        error.classList.remove("hidden");
        document.getElementById("error_message").innerHTML = json.message;
        setTimeout(() => {
            error.classList.add("hidden");
        }, 3000);

    }
}



