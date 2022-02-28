<?php
 include 'db_connect.php'; 
if(!isset($_SESSION['login1_id']))
    echo "<script> window.location.assign('index.php?page=login'); </script>";
 ?>
<div class="container-fluid mt-5 py-5">
		<div class="col-lg-12">
            <div class="row">
                <div class="col">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3" >
                            <p class="text-primary m-0 font-weight-bold">Pervsious Order</p>
                        </div>
					<div class="card-body">	
						<div class="row ml-1 mr-1">		
							<table class="table table-bordered" id="laundry-list">
								<thead>
									<tr>
										<th class="text-center">Date</th>
										<th class="text-center">Customer Name</th>
										<th class="text-center">Total Amount</th>
										<th class="text-center">Status</th>
										<th class="text-center">Print</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$list = $conn->query("SELECT * FROM laundry_list WHERE customer_id='".$_SESSION['login1_id']."' order by status asc, id DESC  ");
									$i=0;
									while($row=$list->fetch_assoc()):								
									$i=1;
									
									$list1 = $conn->query("SELECT * FROM user WHERE id=".$_SESSION['login1_id']);
									
									while($row1=$list1->fetch_assoc()):	
									?>
									<tr>
										<td class=""><?php echo date("M d, Y",strtotime($row['date_created'])) ?></td>
										<td class="text-center"><?php echo $row1['first_name']." ".$row1['last_name']; ?></td>
										<td class=""><?php echo $row['total_amount'] ?></td>
										<?php if($row['status'] == 0): ?>
											<td class="text-center bg-secondary"><span class="badge badge-secondary" style="font-size:  16px;">Pending</span></td>
										<?php elseif($row['status'] == 1): ?>
											<td class="text-center bg-primary"><span class="badge badge-primary" style="font-size:  16px;">Processing</span></td>
										<?php elseif($row['status'] == 2): ?>
											<td class="text-center bg-info"><span class="badge badge-info" style="font-size:  16px;" >Ready to be Claim</span></td>
										<?php elseif($row['status'] == 3): ?>
											<td class="text-center bg-success"><span class="badge badge-success" style="font-size:  16px;">Claimed</span></td>
										<?php endif; ?>
										<form action="" method="post"><td class="text-center"><p><button type="submit" class="btn btn-primary btn-sm" name="print" value="<?php echo $row['id']; ?>" ><i class="fas fa-print"></i>Print</button></p></td></form>
									</tr>
									<?php endwhile; endwhile; if($i==0): ?>
									<tr>
										<td class="text-center" colspan="5"><h5><b>Nothing order yet...</b></h5></td>
									</tr>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
						<div class="card-footer text-center"><a href="index.php?page=profile">Back to Profile </a></div>	
					</div>
				</div>
			</div>	
		</div>
</div>
<?php 
	if(isset($_POST['print']))
	{
		$id=$_POST['print'];
		//echo "<script>alert('".$id."');</script>";
		
		$_SESSION['bill_id']=$id;
		echo "<script> window.location.assign('index.php?page=bills'); </script>";
	}
?>
<style>
	#print-data p {
				display: none;
			}
</style>
<noscript>
	<style>
			#div{
				width:100%;
			}
			table {
				border-collapse: collapse;
				width:100% !important;
			}
			tr,th,td{
				border:1px solid black;
			}
			.text-right{
				text-align: right
			}
			.text-right{
				text-align: center
			}
			p{
				margin:unset;
			}
			#div p {
				display: block;
			}
			p.text-center {
			    text-align: -webkit-center;
			}
			
			
	</style>
</noscript>	
<script>
	$('#filter').click(function(){
		location.replace('index.php?page=reports&d1='+$('#d1').val()+'&d2='+$('#d2').val())
	})
	$('#print').click(function(){
		var newWin = document.open('','_blank','height=500,width=600');
		var _html = $('#print-data').clone();
		var ns = $('noscript').clone();
		newWin.document.write(ns.html())
		newWin.document.write(_html.html())
		newWin.document.close()
		newWin.print()
		setTimeout(function(){
			newWin.close()
		},1500)
	})
	
</script>


