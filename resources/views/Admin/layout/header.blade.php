<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" href="{{url('/')}}/uploads/admin/setting/{{$setting->icon}}">
  <title>
         {{$setting->title}}
  </title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{url('/')}}/adminlte/plugins/fontawesome-free/css/all.min.css">
   <!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{url('/')}}/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<!-- Ionicons -->
<link rel="stylesheet" href="{{url('/')}}/adminlte/css/ionicons.min.css">
<!-- Chart Css -->
<link rel="stylesheet" href="{{url('/')}}/adminlte/plugins/chart.js/Chart.css">

  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{url('/')}}/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('/')}}/adminlte/css/adminlte.css">
  <!-- Google Font: Source Sans Pro -->
  <!--
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
-->
<link rel="stylesheet" type="text/css" href="{{url('/')}}/adminlte/css/datatables.min.css"/>
 <!-- DataTables -->
 <link rel="stylesheet" type="text/css" href="{{url('/')}}/adminlte/css/daterangepicker.css" />

<link rel="stylesheet" href="{{url('/')}}/adminlte/css/style.css">
<link rel="stylesheet" href="{{url('/')}}/adminlte/css/jquery.datetimepicker.min.css">

@stack('css')

<style>

.login-page{margin-top:50px}
.cke_textarea_inline {
  border: 1px solid #ccc;
  padding: 10px;
  min-height: 200px;
  background: #fff;
  color: #000;
}
 </style>
<link rel="stylesheet" type="text/css" href="{{url('/')}}/adminlte/css/style-edit.css">
<link rel="stylesheet" type="text/css" href="{{url('/')}}/adminlte/css/bootstrap-theme.css">

<link rel="stylesheet" href="https://uicdn.toast.com/tui-image-editor/latest/tui-image-editor.css">

<!-- @@@@@@@@@@@@@ -->
<script type="text/javascript" src="{{url('/')}}/adminlte/js/jquery-1.12.1.js"></script>
<script type="text/javascript" src="{{url('/')}}/adminlte/js/bootstrap.js"></script>
<script type="text/javascript" src="{{url('/')}}/adminlte/js/functions.js"></script>
<script src="{{url('/')}}/adminlte/js/sweetalert.min.js"></script>
  <script src="https://cdn.ckeditor.com/4.14.1/standard-all/ckeditor.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
@include('sweet::alert')
<div class="wrapper">
