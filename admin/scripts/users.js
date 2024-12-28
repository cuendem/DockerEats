import { User } from '/admin/classes/User.js';

function createSpinner() {
    // Get target container to add the elements inside
    const target = document.getElementById('target');
    target.innerHTML = ''; // Clear existing content

    const spinner = document.createElement('div');
    spinner.className = 'spinner-border text-primary';
    spinner.role = 'status';
    spinner.innerHTML = `<span class="visually-hidden">Loading...</span>`;
    target.appendChild(spinner);
}

async function getAll() {
    createSpinner();
    // Get the users
    console.log("Getting all users");
    createToast("Getting all users...");

    let response = await fetch('http://www.dockereats.com/api/getUsers');

    if (response.ok) {
        const users = await response.json();
        await listUsers(users);
    } else {
        const target = document.getElementById('target');
        target.innerHTML = 'No users found';
    }
}

// Function to preview images when changing them
function previewImage(event) {
    // Get the file input element
    var fileInput = event.target;

    // Get the selected file
    var file = fileInput.files[0];

    // Find the corresponding preview image element
    var imgElement = document.getElementById(fileInput.dataset.previewTarget);

    if (file && imgElement) {
        // Create a FileReader
        var reader = new FileReader();

        // Set up the FileReader to update the image source when the file is read
        reader.onload = function (e) {
            imgElement.src = e.target.result;
        };

        // Read the selected file as a data URL
        reader.readAsDataURL(file);
    }
}

async function listUsers(usersJson) {
    try {
        const users = usersJson.map(userData => new User(userData));

        // Get target container to add the elements inside
        const target = document.getElementById('target');
        target.innerHTML = ''; // Clear existing content

        const userList = document.createElement('div');
        userList.className = 'user-list d-flex gap-4 flex-wrap justify-content-center';
        target.appendChild(userList); // Add user-list to target

        // Iterate through each user
        users.forEach((user, index) => {
            // Initialize the user's container form
            const userForm = document.createElement('form');
            userForm.className = 'list-card user-card d-flex position-relative';
            userForm.enctype = "multipart/form-data";
            userForm.method = "POST";
            userForm.accept = "image/*";

            userForm.innerHTML = `
                <div class="d-flex align-items-center">
                    <div id="preview-image-container${user.idUser}" class="preview-image-container position-relative">
                        <img id="preview-image${user.idUser}" class="preview-image" src="${'/img/users/user'+user.idUser+'.webp' || '/img/users/user0.webp'}" alt="${user.username}">
                        <label id="preview-image-label${user.idUser}" class="preview-image-label position-absolute" for="image${user.idUser}">
                            <span class="label-bg"></span>
                            <svg viewBox="0 0 24.00 24.00" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.2639 15.9376L12.5958 14.2835C11.7909 13.4852 11.3884 13.0861 10.9266 12.9402C10.5204 12.8119 10.0838 12.8166 9.68048 12.9537C9.22188 13.1096 8.82814 13.5173 8.04068 14.3327L4.04409 18.2802M14.2639 15.9376L14.6053 15.5991C15.4112 14.7999 15.8141 14.4003 16.2765 14.2544C16.6831 14.1262 17.12 14.1312 17.5236 14.2688C17.9824 14.4252 18.3761 14.834 19.1634 15.6515L20 16.4936M14.2639 15.9376L18.275 19.9566M18.275 19.9566C17.9176 20.0001 17.4543 20.0001 16.8 20.0001H7.2C6.07989 20.0001 5.51984 20.0001 5.09202 19.7821C4.71569 19.5904 4.40973 19.2844 4.21799 18.9081C4.12796 18.7314 4.07512 18.5322 4.04409 18.2802M18.275 19.9566C18.5293 19.9257 18.7301 19.8728 18.908 19.7821C19.2843 19.5904 19.5903 19.2844 19.782 18.9081C20 18.4803 20 17.9202 20 16.8001V16.4936M12.5 4L7.2 4.00011C6.07989 4.00011 5.51984 4.00011 5.09202 4.21809C4.71569 4.40984 4.40973 4.7158 4.21799 5.09213C4 5.51995 4 6.08 4 7.20011V16.8001C4 17.4576 4 17.9222 4.04409 18.2802M20 11.5V16.4936M14 10.0002L16.0249 9.59516C16.2015 9.55984 16.2898 9.54219 16.3721 9.5099C16.4452 9.48124 16.5146 9.44407 16.579 9.39917C16.6515 9.34859 16.7152 9.28492 16.8425 9.1576L21 5.00015C21.5522 4.44787 21.5522 3.55244 21 3.00015C20.4477 2.44787 19.5522 2.44787 19 3.00015L14.8425 7.1576C14.7152 7.28492 14.6515 7.34859 14.6009 7.42112C14.556 7.4855 14.5189 7.55494 14.4902 7.62801C14.4579 7.71033 14.4403 7.79862 14.4049 7.97518L14 10.0002Z" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </label>
                        <input type="file" name="image" id="image${user.idUser}" accept="image/*" data-preview-target="preview-image${user.idUser}">
                    </div>
                    <div class="data d-flex flex-column p-3 gap-2">
                        <input type="text" name="username" id="name${user.idUser}" value="${user.username}" placeholder="${user.username}">
                        <input type="email" name="email" id="email${user.idUser}" value="${user.email}" placeholder="${user.email}">
                        <input type="password" name="password" id="password${user.idUser}" placeholder="Change password...">
                    </div>
                    <div class="d-flex flex-column align-items-center justify-content-around py-3 pe-3 h-100">
                        <input type="submit" id="update${user.idUser}" class="update" value="Update">
                        <input type="submit" id="delete${user.idUser}" class="delete" value="Delete">
                    </div>
                    <span class="id position-absolute bottom-0 end-0">ID: ${user.idUser}</span>
                    <input type="number" name="id" id="id${user.idUser}" value="${user.idUser}" hidden>
                </div>
            `;

            userForm.addEventListener('submit', async function (event) {
                event.preventDefault(); // Prevent the default form submission behavior

                // Determine which button was pressed
                const isUpdate = event.submitter && event.submitter.classList.contains('update');
                const isDelete = event.submitter && event.submitter.classList.contains('delete');

                if (isUpdate) {
                    handleUpdate(event);  // Handle update logic
                } else if (isDelete) {
                    handleDelete(event);  // Handle delete logic
                }
            });

            async function handleUpdate(event) {
                const formData = new FormData(event.target);
                createToast(`Updating ${formData.get('username')}...`);

                try {
                    const response = await fetch('http://www.dockereats.com/api/editUser', {
                        method: 'POST',
                        body: formData, // Send the form data
                    });

                    const result = await response.json();

                    if (!response.ok) {
                        createToast(`Error: ${result['error']}`, 'error');
                    } else {
                        createToast(`${formData.get('username')} updated successfully!`, 'success');
                    }
                } catch (error) {
                    console.error(error);
                }
            }

            async function handleDelete(event) {
                const formData = new FormData(event.target);
                const userId = formData.get('id');

                createToast(`Deleting ${formData.get('username')}...`);

                try {
                    const response = await fetch('http://www.dockereats.com/api/deleteUser', {
                        method: 'POST',
                        body: JSON.stringify({
                            id: userId
                        }),
                        headers: {
                            'Content-Type': 'application/json',
                        },
                    });

                    const result = await response.json();

                    if (!response.ok) {
                        createToast(`Error: ${result['error']}`, 'error');
                    } else {
                        createToast(`${formData.get('username')} deleted!`, 'success');
                        userList.removeChild(userForm);
                    }
                } catch (error) {
                    console.error(error);
                }
            }

            userList.appendChild(userForm);

            // Attach event listener to the image file input
            document.getElementById(`image${user.idUser}`).addEventListener('change', previewImage);
        });
    } catch (error) {
        console.error('Error fetching users:', error);
    }
}

document.getElementById('listusers').addEventListener('click', getAll);