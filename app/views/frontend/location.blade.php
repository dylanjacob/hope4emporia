@extends('layouts.fe.default')

@section('content')
<div class="row">
	<div class="col-lg-12 pghead">
			<img src="holder.js/935x200">
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-lg-8">
			<div class="panel panel-default" style="padding: 7px">
				<div class="Flexible-container">
			    	<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3126.6564422218526!2d-96.17598400000001!3d38.403192000000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x87b94e9f1aecd2eb%3A0x205f3c0aedac65a3!2sHope+Community+Church!5e0!3m2!1sen!2sus!4v1397508282539"></iframe>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
		 	<div class="row">
		 	</div>
		 	<div class="row">
		 	</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-8">
			<div class="Flexible-container">
		    	<div class="panel panel-default">
		    	  <div class="panel-heading">
		    	    <h3 class="panel-title">Church Contact Information</h3>
		    	  </div>
		    	  <div class="panel-body">
		    	  	<p><i class="fa fa-home" style="color: #A2A641"></i> Hope Community Church</p>
		    	  	<p style="text-indent: 16px">428 Union St.</p>
		    	  	<p style="text-indent: 16px">Emporia, KS 66801</p>
		    	  	<p><i class="fa fa-phone" style="color: #A2A641"></i> (xxx)xxx-????</p>
		    	  	<p><i class="fa fa-envelope" style="color: #A2A641"></i> hope4emporia???@email.com</p>
		    	  </div>
		    	</div>
			</div>
		</div>
		<div class="col-lg-4">
		 	<div class="row">
		 	</div>
		 	<div class="row">
		 	</div>
		</div>
	</div>
</div>
<div class="container"> 
	<div class="row">
		<div class="col-lg-8">                     
	            <div class="panel panel-default" >
	                <div class="panel-heading">
	                    <div class="panel-title">Send us a message</div>
	                </div>   
	                <div style="padding-top:30px" class="panel-body" >
	                	<div>
	                		<li><a href="/pastor">Click here to send a message directly to Pastor Garcia</a></li>
	                		<li><a href="/prayer-team">Click here to send a message directly to the Prayer Team</a></li>
	                	</div> 
	                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
	                    <form id="loginform" class="form-horizontal" role="form">
	                        <div style="margin-bottom: 25px" class="input-group">
	                                    <span class="input-group-addon"><i class="fa fa-user" style="color: #A2A641"></i></span>
	                                    <input id="name" type="text" class="form-control" name="name" value="" placeholder="name">                                        
	                        </div>
	                        <div style="margin-bottom: 25px" class="input-group">
	                                    <span class="input-group-addon"><i class="fa fa-envelope" style="color: #A2A641"></i></span>
	                                    <input id="email" type="text" class="form-control" name="email" placeholder="email">
	                        </div>
	                        <div style="margin-bottom: 25px" class="input-group">
	                                    <span class="input-group-addon"><i class="fa fa-phone" style="color: #A2A641"></i></span>
	                                    <input id="phone" type="text" class="form-control" name="phone" placeholder="phone">
	                        </div>
	                        <div style="margin-bottom: 25px" class="input-group">
	                        			<textarea class="form-control" rows="3" cols="50" placeholder="message"></textarea>
	                        </div>
	                        <div style="margin-top:10px" class="form-group">
	                            <!-- Button -->
	                            <div class="col-sm-12 controls">
	                              <a id="btn-login" href="#" class="btn btn-success">Submit  </a>
	                            </div>
	                        </div> 
	                    </form>     
	            </div> 
		    </div>
	    </div>
</div>
@stop

