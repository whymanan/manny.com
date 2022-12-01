<div class="row">

	<div class="col-xl-12 order-xl-1">
		<div class="card">
			<div class="card-header">
				<div class="row align-items-center">
					<div class="col-8">
						<h3 class="mb-0">Vle Registration <div class="fetch"></div>
						</h3>
					</div>
					<div class="col-4 text-right">

					</div>
				</div>
			</div>
			<div class="card-body">
				<?php if ($check_vle_status['vle_status'] == 'inactive') {
					// echo form_open('pancard/vle-submit');
				?>
					<form method="post" id="vle_form">
						<div class="form-group">
							<label for="name">Full Name</label>
							<?php
							echo form_input(['class' => 'form-control text-uppercase', 'id' => 'name', 'placeholder' => 'Full Name*', 'name' => 'name', 'value' => set_value('name')]);

							?>
							<span class="error_name"></span>
						</div>

						<div class="form-group">
							<label for="mob">Mobile Number</label>
							<?php
							echo form_input(['class' => 'form-control', 'id' => 'mob', 'placeholder' => 'Mobile No.*', 'name' => 'mob', 'value' => set_value('mob')]);

							?>
							<span class="error_mob"></span>
						</div>

						<div class="form-group">
							<label for="email">Email Address</label>
							<?php
							echo form_input(['type' => 'email', 'class' => 'form-control text-uppercase', 'id' => 'email', 'placeholder' => 'Email Address', 'name' => 'email', 'value' => set_value('email')]);

							?>
							<span class="error_email"></span>
						</div>
						<div class="form-group">
							<label for="shop">Company Name</label>
							<?php
							echo form_input(['type' => 'text', 'class' => 'form-control text-uppercase', 'id' => 'shop', 'placeholder' => 'Company or Shop Name', 'name' => 'shop', 'value' => set_value('shop')]);

							?>
							<span class="error_shop"></span>
						</div>


						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="pin">Pincode</label>
									<?php
									echo form_input(['type' => 'text', 'class' => 'form-control', 'id' => 'pin', 'placeholder' => 'Pincode', 'name' => 'pin', 'value' => set_value('pin')]);

									?>
									<span class="error_pin"></span>
									<small id="pincode_error" class="text-danger"></small>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="loc">Address</label>
									<?php
									echo form_input(['type' => 'text', 'class' => 'form-control text-uppercase', 'id' => 'loc', 'placeholder' => 'District Name', 'name' => 'loc', 'value' => set_value('loc'), 'readonly' => 'readonly']);

									?>
									<span class="error_loc"></span>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="state">State</label>
									<?php
									// echo form_input(['type' =>'text', 'class'=>'form-control', 'id'=>'state', 'placeholder'=>'State Name' , 'name'=>'state','value'=>set_value('state'),'readonly'=>'readonly']);
									// 
									?>
									<select class="form-control select" placeholder="State" name="state" value="" onkeyup="this.value = this.value.toUpperCase();" onblur="this.value = this.value.toUpperCase();" required>
										<option value="">--Select State--</option>
										<option value="1">ANDAMAN AND NICOBAR ISLANDS</option>
										<option value="2">ANDHRA PRADESH</option>
										<option value="3">ARUNACHAL PRADESH</option>
										<option value="4">ASSAM</option>
										<option value="5">BIHAR</option>
										<option value="6">CHANDIGARH</option>
										<option value="33">CHHATTISGARH</option>
										<option value="7">DADRA AND NAGAR HAVELI</option>
										<option value="8">DAMAN AND DIU</option>
										<option value="9">DELHI</option>
										<option value="10">GOA</option>
										<option value="11">GUJARAT</option>
										<option value="12">HARYANA</option>
										<option value="13">HIMACHAL PRADESH</option>
										<option value="14">JAMMU AND KASHMIR</option>
										<option value="35">JHARKHAND</option>
										<option value="15">KARNATAKA</option>
										<option value="16">KERALA</option>
										<option value="17">LAKSHADWEEP</option>
										<option value="18">MADHYA PRADESH</option>
										<option value="19">MAHARASHTRA</option>
										<option value="20">MANIPUR</option>
										<option value="21">MEGHALAYA</option>
										<option value="22">MIZORAM</option>
										<option value="23">NAGALAND</option>
										<option value="24">ODISHA</option>
										<option value="99">OTHER</option>
										<option value="25">PONDICHERRY</option>
										<option value="26">PUNJAB</option>
										<option value="27">RAJASTHAN</option>
										<option value="28">SIKKIM</option>
										<option value="29">TAMILNADU</option>
										<option value="36">TELANGANA</option>
										<option value="30">TRIPURA</option>
										<option value="31">UTTAR PRADESH</option>
										<option value="34">UTTARAKHAND</option>
										<option value="32">WEST BENGAL</option>


									</select>
									<span class="error_state"></span>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="uid">Aadhar Card No.</label>
									<?php
									echo form_input(['type' => 'text', 'class' => 'form-control text-uppercase', 'id' => 'uid', 'placeholder' => 'Aadhar card No.', 'name' => 'uid', 'value' => set_value('uid')]);

									?>
									<span class="error_uid"></span>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="pan">PANCARD No.</label>
									<?php
									echo form_input(['type' => 'text', 'class' => 'form-control text-uppercase', 'id' => 'pan', 'placeholder' => 'PANCARD No.', 'name' => 'pan', 'value' => set_value('pan')]);

									?>
									<span class="error_pan"></span>
								</div>
							</div>
						</div>

						<div class="form-group">
							<button type="submit" name="submit" class="btn btn-success">Register</button>
						</div>
					<?php
					echo form_close();
				} else { ?>
						<h1>You are already registered yourself as a VLE Member</h1>
					<?php } ?>
			</div>
		</div>
	</div>
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	$(document).ready(function() {
		$('#vle_form').on('submit', function(e) {
			e.preventDefault();
			fd = new FormData(this);
			fd.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
			$.ajax({
				url: "<?php echo base_url('pancard/vle-submit'); ?>",
				method: 'POST',
				data: fd,
				processData: false,
				contentType: false,
				dataType: 'json',
				success: function(data) {
					console.log(data);
					if (data.status == '0') {
						$(".error_pan").html(data.pan_error);
						$(".error_email").html(data.email_error);
						$(".error_loc").html(data.location_error);
						$(".error_mob").html(data.mob_error);
						$(".error_name").html(data.name_error);
						$(".error_pin").html(data.pin_error);
						$(".error_shop").html(data.shop_error);
						$(".error_state").html(data.state_error);
						$(".error_uid").html(data.uid_error);
					}
					if (data.status == 'FAILD') {
						$('.fetch').html('<div class="container text-center">Massage:' + data.message + '</div>');
					}
					if (data.status == 200) {
					    	Swal.fire({
							title: 'success',
							text: data.message,
							icon: 'success',
							confirmButtonText: 'Ok'
						});
						window.location.reload();
					}
					if (data.status == 203) {
						// window.location.reload();
						// $('.fetch').html('<div class="container text-center">Massage:' + data.message + '</div>');
						Swal.fire({
							title: 'Warning',
							text: 'VLE already registered',
							icon: 'warning',
							confirmButtonText: 'Ok'
						});
					}
				}
			})
		});

		$('#pin').keyup(function() {
			var pincode = $('#pin').val();
			if (pincode.length >= 6) {
				$.ajax({
					url: "https://api.postalpincode.in/pincode/" + pincode,
					method: 'get',
					success: function(data) {
						if (data[0].Status == 'Success') {
							// console.log(data[0].Status);
							$('#loc').val(data[0].PostOffice[4].District);
							// $('#state').val(data[0].PostOffice[4].State);
							$('#pincode_error').text('');
						}
					}
				});
			} else {
				$('#pincode_error').text('Please enter 6 digit pincode no.');
				$('#loc').val('');
			}
		});

	});
</script>