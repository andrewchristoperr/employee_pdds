<!-- bootstrap -->
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'>  
<style>
    body { 
        display: flex;
        background: #f0f0f0;
    }
    .sidebar-wrap {
        width: 60px;
        height: 100vh;
        background-color: #fff;
        color: #000;
        padding: 10px;
        transition: 0.8s;
    }
    .sidebar-wrap:hover {
        width: 280px;
    }
    .sidebar-wrap:hover .nav li .nav-link span {
        display: flex;
    }
    .sidebar-wrap .nav {
        height: 100%;
        overflow-x: hidden;
        overflow-y: auto;
        flex-wrap: nowrap;
    }
    .sidebar-wrap .nav li {
        margin-top: 5px;
    }
    .sidebar-wrap .nav li .nav-link {
        color: #000;
        padding: 0;
        font-size: 20px;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .sidebar-wrap .nav li .nav-link .icon-wrap {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 40px;
        min-width: 40px;
        font-family: default
    }
    .sidebar-wrap .nav li .nav-link span {
        font-size: 16px;
    }
    .sidebar-wrap .nav li .nav-link.active {
        background-color: #f0f0f0;
    }
    .sidebar-wrap .nav li .nav-link:hover {
        background-color: #f0f0f0;
    }
</style>
