<header class="header body-pd" id="header">
    <div class="header_toggle">
        <i class="fa-solid fa-bars fa-circle-xmark" id="header-toggle"></i>
    </div>
    <div class="header_user">
        <div class="header_img">
            <i class='bx bx-user-circle'></i>
        </div>
        <h4>{{ auth()->user()->username}}</h4>
    </div>
</header>
