<?php include_once('admin/views/header.html') ?>
<div class="mt-5 d-flex justify-content-center"><svg class="admin-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle cx="12" cy="6" r="4" stroke="#1D63ED" stroke-width="1.5"></circle> <path opacity="0.5" d="M20 17.5C20 19.9853 20 22 12 22C4 22 4 19.9853 4 17.5C4 15.0147 7.58172 13 12 13C16.4183 13 20 15.0147 20 17.5Z" stroke="#1D63ED" stroke-width="1.5"></path> </g></svg></div>
<h1 class="mt-2 mb-0">Manage users</h1>
<section id="buttons" class="d-flex justify-content-center align-items-center my-5">
    <button id="listusers" class="mx-2 btn btn-normal">Get ALL</button>
</section>
<section id="target" class="d-flex justify-content-center align-items-center flex-column gap-4">
    
</section>
<?php include_once('admin/views/footer.html') ?>
<script type="module" src="scripts/users.js"></script>