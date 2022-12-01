<script>
	$(document).ready(function () {
		$('#pin').keyup(function () {
			var pincode = $('#pin').val();
			if (pincode.length >= 6) {
				$.ajax({
					url: "https://api.postalpincode.in/pincode/" + pincode,
					method: 'get',
					success: function (data) {
						if (data[0].Status == 'Success') {
							$('#loc').val(data[0].PostOffice[4].District);
							$('#pincode_error').text('');
						}
						else
						{
						    console.log(data);
						}
					}
				});
			} else {
				$('#pincode_error').text('Please enter 6 digit pincode no.');
				$('#loc').val('');
			}
		});

		$("#coupon_qty, #type").on('change keyup', function () {
			let value = $("#coupon_qty").val();
			let type = $("#type").val();
			console.log(type);
			if (type == "p-coupon") {
				<?php if($fetch_commision[0]['pc_coupon_type'] == "p-coupon"){
					echo "var single_coupon_price = ".$fetch_commision[0]['coupon_price'];
				} ?>
				// var single_coupon_price = 94;
			}
			if (type == "e-coupon") {
				<?php if($fetch_commision[1]['pc_coupon_type'] == "e-coupon"){
					echo "var single_coupon_price = ".$fetch_commision[1]['coupon_price'];
				} ?>
				// var single_coupon_price = 95;
			}
			let calc_price = value * single_coupon_price;
			$('.amount').val(calc_price);
		});
	});
</script>