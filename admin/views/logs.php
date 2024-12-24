<?php include_once('admin/views/header.html') ?>
<div class="mt-5 d-flex justify-content-center"><svg class="admin-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.5" d="M3 10C3 6.22876 3 4.34315 4.17157 3.17157C5.34315 2 7.22876 2 11 2H13C16.7712 2 18.6569 2 19.8284 3.17157C21 4.34315 21 6.22876 21 10V14C21 17.7712 21 19.6569 19.8284 20.8284C18.6569 22 16.7712 22 13 22H11C7.22876 22 5.34315 22 4.17157 20.8284C3 19.6569 3 17.7712 3 14V10Z" stroke="#1D63ED" stroke-width="1.5"></path> <path d="M8 12H16" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> <path d="M8 8H16" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> <path d="M8 16H13" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> </g></svg></div>
<h1 class="mt-2 mb-0">Logs</h1>
<section id="buttons" class="d-flex justify-content-center align-items-center my-5">
    <button id="alllogs" class="mx-2 btn btn-normal">Get ALL</button>
    <button id="butadmin" class="mx-2 btn btn-normal">Exclude Admin</button>
    <div class="filter-user-selector d-flex align-items-center">
        <button id="filter-user" type="submit" class="btn btn-normal">Get by user</button>
        <select name="user" id="user-filter" class="text-center"></select>
    </div>
</section>
<section id="target" class="d-flex justify-content-center align-items-center flex-column gap-4">
    
</section>
<?php include_once('admin/views/footer.html') ?>
<script src="scripts/logs.js"></script>