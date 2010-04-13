<div id="left">
    <div id="left_navigation">
        <img src="../../../../www/media/images/gtop.gif" alt="" width="191" height="8" />
        <div class="title1">Popular Tours</div>
        <ul class="contries">
            <li><a href="#" onclick="afiseazaMeniu(1); return false;">Vacante</a></li>
            <?php
            foreach ($region as $regions)
            {
            ?>
                        <ul id="1" class="ascunde">
                            <li><a href="pagina2.php"><?php echo $regions['country']; ?></a></li>
                        </ul>
            <?php } ?>
        </ul>
        <a href="#" class="more">more tours</a>
        <img src="../../../../www/media/images/gbot.gif" alt="" width="191" height="8" />
    </div>
    <a href="#" class="banner"><img src="../../../../www/media/images/banner.jpg" alt="" width="191" height="346" /></a>
</div>