async function addUsersToFilter() {
    let response = await fetch('/api/getUsers');
    const users = await response.json();
    const select = document.getElementById('user-filter');
    users.forEach(user => {
        const option = document.createElement('option');
        option.value = user.id_user;
        option.text = user.username;
        select.appendChild(option);
    });
}

window.onload = async () => {
    try {
        await addUsersToFilter();
        await getAll();
    } catch (error) {
        console.error('Error on page load:', error);
    }
};

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
    // Get the logs
    console.log("Getting all logs");
    createToast("Getting all logs...");

    let response = await fetch('/api/getLogs');

    if (response.ok) {
        const logs = await response.json();
        await logTable(logs);
    } else {
        const target = document.getElementById('target');
        target.innerHTML = 'No logs found';
    }
}

async function getAllButAdmin() {
    createSpinner();
    // Get the logs
    console.log("Getting all logs except admin");
    createToast("Getting all logs except admin...");

    let response = await fetch('/api/getLogsButAdmin');

    if (response.ok) {
        const logs = await response.json();
        await logTable(logs);
    } else {
        const target = document.getElementById('target');
        target.innerHTML = 'No logs found';
    }
}

async function getByUser() {
    createSpinner();
    // Get the logs
    let id = document.getElementById('user-filter').value;
    let name = document.getElementById('user-filter').options[document.getElementById('user-filter').selectedIndex].text;

    console.log(`Getting logs by ${name}`);
    createToast(`Getting logs by ${name}...`);

    let response = await fetch('/api/getLogsByUser&user=' + id);

    if (response.ok) {
        const logs = await response.json();
        await logTable(logs);
    } else {
        const target = document.getElementById('target');
        target.innerHTML = 'No logs found';
    }
}

async function logTable(logs) {
    // In target, create a table with each log's timestamp, username and action
    const target = document.getElementById('target');
    target.innerHTML = ''; // Clear existing content

    const table = document.createElement('table');
    table.className = 'table table-striped';

    const thead = document.createElement('thead');
    thead.innerHTML = `
        <tr>
            <th>Timestamp</th>
            <th>User ID</th>
            <th>Username</th>
            <th>Action</th>
        </tr>
    `;
    thead.className = 'table-primary';
    table.appendChild(thead);

    const tbody = document.createElement('tbody');
    logs.forEach(log => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${log.timestamp}</td>
            <td>${log.id_user}</td>
            <td>${log.username}</td>
            <td>${log.action}</td>
        `;
        tbody.appendChild(tr);
    });
    table.appendChild(tbody);

    target.appendChild(table);
}

document.getElementById('alllogs').addEventListener('click', getAll);
document.getElementById('butadmin').addEventListener('click', getAllButAdmin);
document.getElementById('filter-user').addEventListener('click', getByUser);