<?php 

sleep(1);

include("config.php");
if(isset($_POST['request'])){

    $request = $_POST['request'];
    $query = "SELECT * FROM ".$request;
    $result = mysqli_query($con,$query);
    $count = mysqli_num_rows($result);

?>

<table class="table">
    <?php
    if($count){

    ?>
    <thead>
	    <tr>
			<th>matricula</th>
			<th>nombre</th>
			<th>parcial 1</th>
			<th>parcial 2</th>
			<th>parcial 3</th>
		</tr>

        <?php
    }else{
        echo "no hay nada";
    }
         ?>
    </thead>
    <tbody>
        <?php 
        while($row = mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td><?php echo $row['p_mat']?></td>
            <td><?php echo $row['p_nombre']?></td>
            <td><?php echo $row['p_p1']?></td>
            <td><?php echo $row['p_p2']?></td>
            <td><?php echo $row['p_p3']?></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<?php
}
?>