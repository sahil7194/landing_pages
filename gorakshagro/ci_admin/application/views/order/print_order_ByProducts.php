<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Invoice</title>
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<style>
body{
    font-family: 'Roboto', sans-serif;
    font-size:14px;
}
th,td{
    padding:10px;
}
.label{
    font-weight:600;
    text-transform: uppercase;
}
a{
    color: #000;
    text-decoration: none;
    text-transform: uppercase;
}
.center{
    text-align: center;
}
.right{
    text-align: right;
}
</style>
</head>
<body>
<div style="width:100%;margin:0 auto;">
 
    <table border="1" style="border-collapse:collapse;">
        <tr>
            <th class="col-sm-1">Date</th>
            <th class="col-sm-2">Product Name</th>
            <th class="col-sm-2">Option</th>
            <th class="col-sm-2">Qty</th>
        </tr>
        <?php foreach($result as $row){ ?>
        <tr>
            <td><?php echo date('d M Y', strtotime($row->date_created)); ?></td>
            <td><?php echo $row->product_name; ?></td>
            <td><?php echo $row->product_options; ?></td>
            <td><?php echo $row->cnt; ?></td>
        </tr>                               
        <?php } ?>
    </table>

</div>  

<br><br>


<script type="text/javascript">
    window.print()
</script>

</body>

</html>
