<?php
/*
  Template Name: contact
*/
get_header(); ?>
<div class="container all-pad-gone">
    <?php echo getTopMenu(); ?>
</div>
<div class="container all-pad-gone">
    <div class="row">
        <div class="col-md-12">
            <h2>Contact</h2>
        </div>    
    </div>    
</div> 
<div class="container all-pad-gone">
        <div class="row">
            <div class="col-sm-6" id="contact-form">
                <h4>Contact DCBIA</h4>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" type="text" name="name" id="name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" name="from" id="from">
                </div>
                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea name="content" cols="30" rows="10" style="resize:none; width:100%;" id="content"></textarea>
                </div>
                <input type="hidden" name="send_email">
                <input type="hidden" name="to" id="to" value="trevor@innuevodigital.com">
                <input class="btn btn-default" type="submit" name="submit" value="Send" onclick="sendContactEmail();">
            </div>
            <div class="col-sm-6" id="contact-form-sent" style="display: none">
                <h3>Your email was sent</h3>
            </div>
            <div class="col-sm-6">
        	<h4>Info</h4>
            <p>202-537-1107<br> 
            <a href="mailto:studio@marshallmoya.com">studio@marshallmoya.com</a><br> 
            2201 Wisconsin Avenue, NW  Suite 305 Washington, D.C. 20007</p>
            <br>
        	<div class="container-fluid information">
                <div class="row-fluid">
                    <div class="col-md-4">
                        <h6>Architecture/ Masterplan/ Interiors</h6>
                        <p>Paola Moya</p>
                        <a href="mailto:paola@marshallmoya.com">paola@marshallmoya.com</a>
                    </div>
                    <div class="col-md-4">
                        <h6>Business Development</h6>
                        <p>Craig Dean</p>
                        <a href="mailto:craig@marshallmoya.com">craig@marshallmoya.com</a>
                    </div>

                    <div class="col-md-4">
                        <h6>Operations/ HR/ Proposals</h6>
                        <p>Jenny Lopez</p>
                        <a href="mailto:jenny@marshallmoya.com">jenny@marshallmoya.com</a>
                    </div>  
        	   </div>
        	</div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
