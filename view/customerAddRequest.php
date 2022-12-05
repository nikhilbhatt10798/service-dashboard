    
	<div id="snackbar"></div>
    <div class="col-lg-12">
    	<h3>Add Request</h3>
    </div>
    <div class="card-body" id="Add-res-form">
    	<div class="chart-area">

    		<!-- <form id="Add-res-form" name="Add-res-form" method="post" action="route.php?param=c_AddRequestAction"> -->
    		<lable for="required-resource">Resource Required</lable><samp id="err_res" style="color: red;"></samp>
			<input type="text" id="r_resource" name="r-resource" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
			placeholder="Enter required resource" autocomplete="off" min="5" max="1000" pattern="[0-9]+" title="only no." required />

    		<lable for="Address">Location</lable><samp id="err_add" style="color: red;"></samp>
    		<input type="text" id="address" name="location" placeholder="Enter Address" autocomplete="off" required>

    		<lable for="Date">Date</lable><samp id="err_date" style="color: red;"></samp>
    		<input type="date" id="date"  name="date" min="<?php echo date('Y-m-d') ?>" max="2022-01-01" placeholder="Enter date" autocomplete="off" pattern="\d{4}-\d{2}-\d{2}" required>

    		<lable for="Phone">Phone</lable><samp id="err_phone" style="color: red;"></samp>
			<input type="text" id="Phone" name="phone" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
			 placeholder="Enter phone No."
			 pattern="[0-9]{10}" title="only 10 digit no." autocomplete="off" required>

    		<input type="submit" id="submit_add_rec" onclick="get()" name="Submit">

    		<!-- </form> -->


    	</div>
    </div>
    
    <script>

    	function get() {
    		var resource = document.getElementById('r_resource').value;
    		if (resource == "" || isNaN(resource) || resource <= 0 || resource > 100) {
    			document.getElementById("err_res").innerHTML = "****Enter Numeric value only and between 1 to 100****";
    			// document.getElementById("err_res").style.display.color="red";

    			return false;
    		} else {

    			var address = document.getElementById('address').value;
    			// console.log(address);
    			if (address.length <= 15 || address.length >= 60) {
    				document.getElementById("err_add").innerHTML = "****Enter address between 15 to 60****";
    				return false;
    			// } else {
    			// 	var date = new Date(document.getElementById('date').value);
    			// 	// console.log(date);
    			// 	var a = new Date();
    			// 	// console.log(a);
    			// 	if (date.getTime() <= a.getTime()) {
    			// 		document.getElementById("err_date").innerHTML = "****date should de greater than today****";
    			// 		// console.log('yes');
    			// 		return false;
    				} else {
    					var phone = document.getElementById('Phone').value
    					if (phone.length != 10 || isNaN(phone)) {
    						document.getElementById("err_phone").innerHTML = "****Enter 10 Digit Number****";
    					} else {
    						var date = document.getElementById('date').value;
    						var x = document.getElementById("snackbar");
    						console.log(resource) ;
    						console.log(address) ;
    						console.log(date) ;
    						console.log(phone) ;
    						$.ajax({
    							type: "post",
    							url: "route.php?param=c_AddRequestAction",
    							data:{
    								resource: resource,
    								address: address,
    								date: date,
    								phone: phone
    							},
    						
    							success: function(data) {
									document.getElementById("snackbar").innerHTML = data;
									document.getElementById("r_resource").value="";
									document.getElementById("address").value="";
									document.getElementById("date").value="";
									document.getElementById("Phone").value="";
									document.getElementById("err_phone").innerHTML="";
									document.getElementById("err_date").innerHTML="";
									document.getElementById("err_add").innerHTML="";
    								x.className = "show";
    								setTimeout(function() {
    									x.className = x.className.replace("show", "");
    								}, 3000);
    							}

    						});

    					}
    				}

    			}
    		}
    	
    </script>