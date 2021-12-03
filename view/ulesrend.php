
		<table>
			<tr>
				<th colspan="3">
					<h2>Ülésrend</h2>
				</th>
				<th colspan="3">
				<?php
				
				if(!empty($_SESSION["id"])) {

					if(in_array($_SESSION["id"], $adminok)) {
						?>
						<form action="index.php?page=ulesrend" method="post">
						Hiányzó: 	<select name="hianyzo_id">
									<?php

									if ($tanuloIdk) {
										foreach($tanuloIdk as $row) {
											$tanulo->set_user($row, $conn);
											if($tanulo->get_nev() and !in_array($row, $hianyzok)) echo '<option value="'.$row.'">'.$tanulo->get_nev().'</option>';

											?>
											
											<?php
										}
									}
									?>
										
									</select>
							<br>
						<input type="submit">
						</form>						
						<?php
					}
				}
				?>
				</th>
			</tr>
			<?php
		$i=0;
		$target_file="";
		$errors=array();
		 if (isset($_FILES["fileToUpload"]) ) {
			$target_dir = "kepek/";
			$allowed_filetypes=array('image/png','image/jpg','image/jpeg');
			
			foreach($_FILES["fileToUpload"]["name"]as $key=>$name ){
				$target_file = $target_dir . basename($name);
				if ($_FILES["fileToUpload"]["size"][$key]>102400) {
					$errors[$key][]="A $name túl nagy méretű, 100KB-nál nem lehet nagyobb";
					
				}
				elseif ($_FILES["fileToUpload"]["size"][$key]<1024) {
					$errors[$key][]="A $name túl kis méretű, 1KB-nál nem lehet kisebb";
					
				}
				if (!in_array($_FILES["fileToUpload"]["type"][$key],$allowed_filetypes)) {
					$errors[$key][]="A $name a fájl nem jpg vagy png";
					
				}
				if(!isset($errors[$key])){
					if (@move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$key],$target_file)) {
						$i++;
				}else{$errors[$key][]="Hiba történt a $name file mentésekor";}
				
			}
			}
			?>
			
		
		 
		
		
<?php } ?>
		<form action="index.php?page=ulesrend" method="POST" enctype="multipart/form-data">
		Select image to upload:
		<input type="file" name="fileToUpload[]" id="fileToUpload" multiple>
		
		<input type="submit" name="Upload Image" id="submit">
	
				<?php

				if ($tanuloIdk) {
					$sor = 0;
					foreach($tanuloIdk as $row) {
						$tanulo->set_user($row, $conn);
						if($tanulo->get_sor() != $sor) {
							if($sor != 0) echo '</tr>';
							
							echo '<tr>';
							$sor = $tanulo->get_sor();
						}
						if(!$tanulo->get_nev()) echo '<td class="empty"></td>';
						else {
							$plusz = '';
							if(in_array($row, $hianyzok)) $plusz .=  ' class="missing"';
							if($row == $en)  {$plusz .=  ' id="me"' ;
								echo'<div style="background-image:"'.$name.'">';
								
							}							
							if($row == $tanar) $plusz .=  ' colspan="2"';
							echo "<td".$plusz.">" . $tanulo->get_nev();
							
							if(!empty($_SESSION["id"])) {

	
							
							
								if(in_array($_SESSION["id"], $adminok)) {
									if(in_array($row, $hianyzok)) 
									echo '<br><a href="index.php?page=ulesrend&nem_hianyzo='.$row.'">Nem hiányzó</a>';
									?><?php if (!empty($_SESSION["id"])) {
										
															?>
															
												
																			
											</form>
										<?php } ?>
									<?php
								}
							}
							
							echo "</td>";
						}
					}
				
				
				$conn->close();
				}?>
				
		</table>
	</body>
</html>