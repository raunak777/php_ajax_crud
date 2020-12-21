<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>PHP AJAX</title>
    <style type="text/css">
    	#error_msg{
    		background: #DEF1D8;
    		color: red;
    		padding: 10px;
    		margin: 10px;
    		display: none;
    		position: absolute;
    		right: 45%;
    		top: 10%;
    		border-radius: 5px;
    	}
    	#success_msg{
    		background: #DEF1D8;
    		color: green;
    		padding: 10px;
    		margin: 10px;
    		display: none;
    		border-radius: 5px;
    		position: absolute;
    		right: 20px;
    		top: 20px;
    	}
    	#modal{
    		background: rgba(0,0,0,0.7);
    		position: fixed;
    		left:0;
    		top: 0;
    		width: 100%;
    		height: 100%;
    		z-index: 99;
    		display: none;
    	}
    	#modal-form{
    		background: #fff;
    		width: 25%;
    		position: relative;
    		top: 30%;
    		left: calc(50% - 15%);
    		padding: 15px;
    		border-radius: 4px;
    	}
    	.close-btn{
    		background: red;
    		color: white;
    		width: 30px;
    		height: 30px;
    		line-height: 30px;
    		text-align: center;
    		border-radius: 50%;
    		position: absolute;
    		top: -15px;
    		left: -15px;
    		cursor: pointer;
    	}
    	.search {
  			width: 13%;
  			box-sizing: border-box;
  			border: 2px solid #ccc;
  			border-radius: 4px;
  			font-size: 16px;
  			background-color: white;
  			background-image: url('search.png');
  			background-position: -10px 0px; 
  			background-repeat: no-repeat;
  			padding: 12px 20px 12px 40px;
  			transition: width 0.4s ease-in-out;
			}

		.search:focus {
  			width: 30%;
			}
    </style>
  </head>
  <body>
    <div class="p-4 bg-secondary text-white text-center"><h1><b>AJAX PHP</b></h1>
    </div>
    <div class="p-3 bg-secondary text-white text-center"><input type="text" class="search" name="search" placeholder="Search.."></div>
    <div class="p-4 mb-2 bg-info text-white text-center">
    	<form id="formload">
    		<div class="form-group mx-sm-5 mb-2">
    	<input type="text" class="form-control" id="fname" placeholder="firstname">
  		</div>
  		<div class="form-group mx-sm-5 mb-2">
    	<input type="text" class="form-control" id="lname" placeholder="lastname">
  		</div>
  		<button type="submit" class="btn btn-primary mb-2 btn-lg ">Save</button>
    	</form>
 </div>
    
    <div id="datashow" class="container text-center pb-5"></div>
    <div id="error_msg"></div>
    <div id="success_msg"></div>
    <div id="modal">
    	<div id="modal-form">
    		<h2>Edit Form</h2>
    		<table cellpadding="10%" width="100%">
    		</table>

    		<div class="close-btn">X</div>
    	</div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script type="text/javascript">
    	$(function()
    	{
    		// Load data from database
    		function loadData(){
    			$.ajax({
    				type: "POST",
    				url: "load.php",
    				success: function(data)
    				{
    					$("#datashow").html(data);
    				}
    			});
    		}
    		loadData();
    		// insert data into database
    		$(".btn").on("click", function(e){
    			e.preventDefault();
    			var fname= $('#fname').val();
    			var lname= $('#lname').val();
    			if(fname == "" || lname == "")
    			{
    				$("#error_msg").text("All fields are required!").slideDown();
    				$("#success_msg").slideUp();
    			}
    			else{
    			$.ajax({
    				type: "POST",
    				url: "insert.php",
    				data: {first_name : fname, last_name: lname},
    				success: function(data)
    				{
    					if(data == 1)
    					{
    						loadData();
    						$("#formload").trigger("reset");
    						$("#success_msg").text("Data inserted successful").slideDown();
    						$("#error_msg").slideUp();
    					}
    					else{
    						$("#error_msg").text("Data can't inserted!").slideDown();
    						$("#success_msg").slideUp();
    					}
    				}
    			})
    		}
    		});
    		// deleted data from database
    		$(document).on("click", ".del-btn", function(){
    			if(confirm("Do you really want to delete this data?")){
    			var userId= $(this).data("id");
    			var element= this;
    			$.ajax({
    				type: 'POST',
    				url: 'delete.php',
    				data: {id: userId},
    				success: function(data){
    					if (data == 1) {
    						$(element).closest("tr").fadeOut();
    						$("#success_msg").text("Data deleted").slideDown();
    						$("#error_msg").slideUp();
    					}
    					else{
    						$("#error_msg").text("Can't delete records!").slideDown();
    						$("#success_msg").slideUp();
    					}
    				}
    			});
    		}
    		});
    		
    		//show modal
    		$(document).on("click", ".edit-btn", function(){
    			$("#modal").show();
    			var users= $(this).data('eid');
    			// alert(users);
    			$.ajax({
    				type: "POST",
    				url: "show-update.php",
    				data: {id: users},
    				success: function(data)
    				{
    					$("#modal-form table").html(data);
    				}
    			});
    		});

    		//close modal
    		$(".close-btn").on("click", function(){
    			$("#modal").hide();
    		});

    		//save update form
    		$(document).on("click", "#edit-submit", function(){
    			var id= $("#edit-id").val();
    			var fname= $("#edit-fname").val();
    			var lname= $("#edit-lname").val();
    			if(fname =='' || lname==''){
    				alert("All fields required")
    			}
    			else{
    			$.ajax({
    				type: "POST",
    				url: "update-data.php",
    				data: {id : id, fname : fname, lname : lname},
    				success: function(data){
    					if(data == 1)
    					{
    						$("#modal").hide();
    						loadData();
    					}
    				}
    			});
    		}
    		});

    		//live search
    		$(".search").on("keyup", function(){
    			var search=$(this).val();

    			$.ajax({
    				type: "POST",
    				url: "live-serach.php",
    				data: {livesearch: search},
    				success: function(data){
    					$("#datashow").html(data);
    				}
    			});
    		});
    	});

    </script>
  </body>
</html>