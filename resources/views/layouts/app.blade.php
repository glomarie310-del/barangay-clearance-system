<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Barangay Business Clearance System</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

body{
    background:#f4f6f9;
    font-family:'Segoe UI',sans-serif;
}

/* Sidebar */

.sidebar{
    width:260px;
    min-height:100vh;
    position:fixed;
    left:0;
    top:0;
    background:#0b2d5c;
    color:white;
}

.sidebar-header{
    padding:25px;
    text-align:center;
    border-bottom:1px solid rgba(255,255,255,.15);
}

.sidebar-header h4{
    margin:0;
    font-weight:700;
}

.sidebar a{
    display:block;
    color:#d9e4ff;
    text-decoration:none;
    padding:15px 25px;
    transition:.3s;
}

.sidebar a:hover{
    background:#17427f;
    color:white;
}

.sidebar a i{
    margin-right:10px;
}

/* Main */

.main{
    margin-left:260px;
}

/* Topbar */

.topbar{
    background:white;
    padding:18px 30px;
    box-shadow:0 2px 10px rgba(0,0,0,.08);
}

.content{
    padding:30px;
}

/* Cards */

.card{
    border:none;
    border-radius:15px;
}

.card-body h6{
    color:#6c757d;
}

.table{
    vertical-align:middle;
}

</style>

</head>

<body>

<div class="sidebar">

    <div class="sidebar-header">

        <h4>Business Clearance</h4>

        <small>Municipality of Baliangao</small>

    </div>

    <a href="{{ route('business-clearances.index') }}">
        <i class="bi bi-speedometer2"></i>
        Dashboard
    </a>

    <a href="{{ route('business-clearances.create') }}">
        <i class="bi bi-file-earmark-plus-fill"></i>
        Generate Clearance
    </a>

    <a href="{{ route('business-clearances.index') }}">
        <i class="bi bi-folder-fill"></i>
        Clearance Records
    </a>

    <a href="{{ route('barangays.index') }}">
        <i class="bi bi-bank2"></i>
        Barangay Profile
    </a>

    <hr class="text-white">

    <a href="#">
        <i class="bi bi-bar-chart-fill"></i>
        Reports
    </a>

    <a href="#">
        <i class="bi bi-gear-fill"></i>
        Settings
    </a>

</div>

<div class="main">

    <div class="topbar d-flex justify-content-between align-items-center">

        <h4 class="fw-bold mb-0">
            Barangay Business Clearance System
        </h4>

        <span class="text-muted">
            {{ now()->format('F d, Y') }}
        </span>

    </div>

    <div class="content">

        @yield('content')

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>