<html>

<head>
<meta charset="utf-8" />

<title>Демо страница Dumper</title>


<style>
body
{
	margin: 0;
}
</style>
</head>

<body>


<?
include($_SERVER["DOCUMENT_ROOT"] . "/dumper/dumper.php");

dump($_SERVER, '$_SERVER', 200, false);



