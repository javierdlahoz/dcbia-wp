<?php
use Director\Service\DirectorService;
use Staff\Service\StaffService;
use Client\Service\ClientTypeService;

$clientTypes = ClientTypeService::getSingleton()->getTerms();
?>
<div class="container-fluid orangish">
	<div class="container">
		<div class="row">
			<ul class="nav nav-justified secondary-nav menu dropit" role="">
				<li id="company" role="presentation"
					class="col-xs dropit-trigger dropit-open"><a href="/about">Our Organization</a>
                    <ul class="dropit-submenu" style="">
                        <li><a href="/about#what-we-do">What We Do</a></li>
                        <li><a href="/about#how-we-work">How We Work</a></li>
                        <li><a href="/about#what-we-know">What We Know</a></li>
                    </ul>
				</li>

				<li id="clients" class="col-xs" role=""><a href="/about/connections">Our Connections</a>
					<ul class="dropit-submenu" style="">
                    <?php foreach($clientTypes as $clientType): ?>
                    <li><a
							href="<?php echo $clientType->getPermalink(); ?>"><?php echo $clientType->getName(); ?></a></li>
                    <?php endforeach; ?>
                </ul></li>
				<li id="directors" class="col-xs" role=""><a href="/about/directors">Our Board of
						Directors</a>
					<ul class="dropit-submenu" style="">
                    <?php foreach(DirectorService::getSingleton()->getPosts() as $director): ?>
                    <li><a
							href="<?php echo $director->getPermalink(); ?>"><?php echo $director->getTitle(); ?></a></li>
                    <?php endforeach; ?>
                </ul></li>
				<li id="consultants" class="col-xs" role=""><a href="/about/staff">Our Staff &amp; Collaborators</a>
					<ul class="dropit-submenu" style="">
                    <?php foreach(StaffService::getSingleton()->getPosts() as $service): ?>
                    <li><a
							href="<?php echo $service->getPermalink(); ?>"><?php echo $service->getTitle(); ?></a></li>
                    <?php endforeach; ?>
                </ul></li>
			</ul>
		</div>
	</div>
</div>