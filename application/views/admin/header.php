<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin | <?= $pageTitle ?? 'Dashboard' ?></title>

    <!-- Accessibility Meta Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="color-scheme" content="light dark">
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)">

    <!-- Primary Meta Tags -->
    <meta name="title" content="AdminLTE v4 | Dashboard">
    <meta name="author" content="ColorlibHQ">
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard">
    <meta name="keywords" content="bootstrap 5, admin dashboard, accessible admin panel">

    <!-- Fonts & Plugins -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('assets/css/adminlte.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary app-loaded">
<div class="app-wrapper">

<!-- Header -->
<nav class="app-header navbar navbar-expand bg-body" style="background-color:#80c908;">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#"><i class="text-white fs-5 bi bi-list"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item d-flex">
                <a href="<?= base_url() ?>" class="nav-link"><span class="text-white fw-bold">Go to site</span></a>
                <a href="<?= base_url('admin/logout') ?>" class="nav-link"><span class="text-white fw-bold">Log Out</span></a>
            </li>
        </ul>
    </div>
</nav>

<!-- Sidebar -->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand" style="background-color:#80c908;">
        <a href="#" class="brand-link">
            <img src="<?= base_url('uploads/user.png') ?>" class="rounded-circle shadow" alt="User Image">
            <span class="brand-text fw-bold">Admin</span>
        </a>
    </div>

    <div class="sidebar-wrapper" data-overlayscrollbars="host">
        <nav class="mt-2">
            <ul class="nav sidebar-menu" data-lte-toggle="treeview" role="navigation" data-accordion="false">
                <li class="nav-item"><a href="<?= base_url('admin/dashboard') ?>" class="nav-link"><i class="nav-icon bi bi-speedometer text-white"></i><p class="text-white">Dashboard</p></a></li>
                <li class="nav-item"><a href="<?= base_url('admin/category') ?>" class="nav-link"><i class="nav-icon bi bi-ui-checks-grid text-white"></i><p class="text-white">Category</p></a></li>
                <li class="nav-item"><a href="<?= base_url('admin/subcategory') ?>" class="nav-link"><i class="nav-icon bi bi-grid-fill text-white"></i><p class="text-white">Sub Category</p></a></li>
                <li class="nav-item"><a href="<?= base_url('admin/product') ?>" class="nav-link"><i class="nav-icon bi bi-box text-white"></i><p class="text-white">Product</p></a></li>
                <li class="nav-item"><a href="<?= base_url('admin/order') ?>" class="nav-link"><i class="nav-icon bi bi-cart3 text-white"></i><p class="text-white">Order</p></a></li>
                <li class="nav-item"><a href="<?= base_url('admin/discount') ?>" class="nav-link"><i class="nav-icon bi bi-percent text-white"></i><p class="text-white">Discount</p></a></li>
                <li class="nav-item"><a href="<?= base_url('admin/customer') ?>" class="nav-link"><i class="nav-icon bi bi-person text-white"></i><p class="text-white">Customer</p></a></li>
                <li class="nav-item"><a href="<?= base_url('admin/settings') ?>" class="nav-link"><i class="nav-icon bi bi-gear-wide text-white"></i><p class="text-white">Settings</p></a></li>
            </ul>
        </nav>
    </div>
</aside>
