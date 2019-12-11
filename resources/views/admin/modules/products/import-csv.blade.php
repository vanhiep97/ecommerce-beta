@extends('admin.layouts.master')
@section('styles')
    <style>
        label.error {
            display: inline-block;
            color: #d71212;
            width: 100%;
            font-size: 13px;
            font-weight: 600;
            text-transform: capitalize;
            margin-top: 5px;
        }
        #custom_slug {
            margin-top: 10px;
        }
        #text-custom-slug {
            color: #333;
            font-weight: 600;
            font-size: 14px;
            margin-left: 10px;
        }
        .thumbnail{
            width: 163px;
            height: 163px;
            margin: 10px;
            float: left;
        }
        #clear{
            display:none;
            float: right;
            margin-bottom: 5px;
        }
        #result {
            display: none;
            width: 100%;
        }
        .upload-gallery {
            border: 4px dotted #cccccc;
            min-height: 200px;
            width: 100%;
            margin-top: 0;
        }
        .custom-tab nav {
            background-color: rgba(43, 34, 34, 0.03);
            border: 1px solid rgba(0,0,0,.125);
        }
        .nav-tabs {
            border-bottom: none !important;
        }
        .nav-tabs .nav-link {
            border: none !important;
            border-top-left-radius: 0 !important;
            border-top-right-radius: 0 !important;
        }
        .nav-tabs .nav-item {
            margin-bottom: 0 !important;
            color: #333;
            font-weight: 600;
        }
        .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
            background-color: rgb(247, 247, 247);
        }
        .image-append {
            border: 1px solid #f8f8f8;
            background-color: #272c33;
        }
        .upload-gallery {
            background-image: url(http://localhost:8000/a-images/noimg.jpg);
            background-color: #f3f3f3;
            width: 100%;
            background-size: contain;
        }
        #clear {
            display: none;
            width: 100%;
            text-align: right;
            background: transparent;
            border: transparent;
            color: #333;
            font-weight: 600;
            text-decoration: underline;
            float: none !important;
            margin-bottom: 0 !important;
            cursor: pointer;
        }
        #nav-tabContent {
            height: 570px;
            overflow-y: scroll;
            padding-right: 1rem !important;
            padding-left: 0 !important;
        }
        .custom-tab-right {
            height: 300px;
            overflow-y: scroll;
            padding-right: 0.5rem !important;
        }
        .product-module .card-header {
            padding: 8px 10px !important;
        }
        .product-module .card-body {
            padding: 10px !important;
        }
        .product-module .card-body.select-custom-height {
            height: 205px;
            overflow-y: scroll;
        }

        .tree ul {
            border-left: 1px dashed #dfdfdf;
        }

        .tree li {
            list-style: none;
            padding: 0 18px;
            cursor: pointer;
            vertical-align: middle;
            background: #fff;
        }

        .tree li:first-child {
            border-radius: 3px 3px 0 0;
        }

        .tree li:last-child {
            border-radius: 0 0 3px 3px;
        }

        .tree .active,
        .active li {
            background: #efefef;
        }

        .tree label {
            cursor: pointer;
        }

        .tree input[type=checkbox] {
            margin: -2px 6px 0 0px;
        }

        .has > label {
            color: #000;
        }

        .tree .total {
            color: #e13300;
        }

        .checkbox {
            padding: 0 20px 15px 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
        }
        .checkbox-input {
            margin-right: 10px;
        }

        .input-item {
            width: 50%;
        }
    </style>
@endsection
@section('main')
<form action="{{ route('post-import-csv') }}" method="POST" name="importform"
      enctype="multipart/form-data">
   @csrf
    <input type="file" name="file" class="form-control">
    <br>
    <a class="btn btn-info" href="{{ route('post-export-csv') }}">
        Export File</a>
    <button class="btn btn-success">Import File</button>
</form>
@endsection
