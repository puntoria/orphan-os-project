<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{ $orphan->id }} {{ $orphan->first_name }} {{ $orphan->last_name }}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<style type="text/css">
        body { 
            color: #59554c;
            width: 707px;
            margin: 0 auto;
        }
        
        tr { text-align: center; vertical-align: bottom; background-color:#fffaea; }
        th { background-color: #fffaea; }
        td { background-color: #ffffff; }

        tr.border th {
            border:1px solid #d5c3b4;
            text-align: right;
            font-weight: lighter;
            font-size:14px;
            background-color: #fffaea;
        }

        tr.table-heading th {
            border: 0px solid rgb(249,238,208);
            text-align: right;
            font-weight: bold;
            font-size:14px;
            background-color: rgb(249,238,208);
        }

        tr.border td {
            border:1px solid #d5ceb4;
            font-weight: bold;
            font-size: 12px;
            text-align: center;
            background-color: #fff;
        }

        h2{
            font-weight: lighter;
            text-align: center;
            font-size: 18px;
        }

        h3 { text-align: right; }

        .description {
            width:30%;
            border: 1px solid #d2cdb0;
            background-color: #fffaea;
            text-align: center;
            font-size: 14px;
            line-height: 120%;
        }

    </style>
</head>
<body>
    <div class="wrapper">