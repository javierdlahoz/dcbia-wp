<?php
use INUtils\Entity\PostEntity;
/*
  Template Name: staff
*/
$pageEntity = new PostEntity(get_the_ID());
get_header();
?>
<div class="container all-pad-gone">
    <?php echo do_shortcode('[slideshow group="about"]'); ?>
    <?php echo getTopMenu(); ?>       
</div> 

<!--start main content here-->

<div class="container all-pad-gone">
    <div class="row">
        <div class="col-md-12 about">   
            <h2><?php echo $pageEntity->getTitle(); ?></h2>
            <p><?php echo $pageEntity->getContent(); ?></p>
        </div>    
        
        <p>&nbsp;</p>
    
        <div class="staff-results">
            <div class="col-sm-2 staff-pic">
                 <a href=""><img class="img-responsive" src="<?php echo get_template_directory_uri() ;?>/img/mallory_lisa.jpg" alt="staff image" /></a>
            </div>
            <div class="col-sm-10 key-info">
                <h4>Lisa Mallory</h4>
                <h5>Chief Executive Officer</h5>  
                <p>Lisa María Mallory recently joined DCBIA in the newly created position of CEO. Lisa has over thirty years of leadership experience in the private, nonprofit, and public sectors. Most recently, Lisa was the Director of the DC Department of Employment Services where she had responsibility for overhauling one of the most troubled agencies netting millions of dollars in savings by implementing innovative programs and policies which resulted in increased customer service, new business partnerships and a dramatic decrease the unemployment rate in the District. Formerly, Lisa was Senior Vice President at ICF International and prior Senior Vice President at the Fannie Mae Foundation. She served as a member of the federal Senior Executive Service at the White House, the US Department of Health and Human Services and the US Social Security Administration and has worked for the US Senate Foreign Relations Committee and several federal Independent Counsels. Lisa began her career in the hospitality industry. </p>
                <p>She obtained a BS in Business and Technology from the University of Maryland, MBA in International Business/Marketing from George Washington University and is completing her doctoral dissertation in Leadership from George Mason University and Walden University. Lisa has completed numerous business and government leadership programs at Harvard University and is a certified coach of leaders. Lisa participates as a member of Leadership Greater Washington and serves as a volunteer and board member for several nonprofit organizations. Lisa is a native Spanish speaker and is conversational in Italian, Portuguese and French.</p>

                <a class="button1" href="{{resoure.permalink}}">Contact</a>
            </div>
        </div>
    
    </div>
</div>
<?php get_footer(); 
