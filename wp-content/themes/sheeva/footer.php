            <div class="clear"></div>
            <?php 
                $type = yiw_get_option( 'footer_type', 'normal' ); 
                if( strpos($type, "big") !== false )
                    get_template_part('footer','big');
            ?>
            
            <!-- START FOOTER -->
            <div id="copyright" class="group">
                <div class="inner group">
                    <?php if( $type == 'normal' || $type == 'big-normal' ) : ?>
                    <p class="left">
                        <?php yiw_convertTags( do_shortcode( stripslashes( yiw_get_option( 'copyright_text_left', 'Copyright <a href="%site_url%"><strong>%name_site%</strong></a> 2010' ) ) ) ) ?>
                    </p>
                    <p class="right">
                        <?php yiw_convertTags( do_shortcode( stripslashes( yiw_get_option( 'copyright_text_right', 'Powered by <a href="http://www.yourinspirationweb.com/en"><strong>Your Inspiration Web</strong></a>' ) ) ) ) ?>  
                    </p>
                    <?php elseif( $type == 'centered' || $type == 'big-centered' ) : ?> 
                    <p class="center">
                        <?php yiw_convertTags( do_shortcode( stripslashes( yiw_get_option( 'footer_text_centered' ) ) ) ) ?>  
                    </p>
                <?php endif ?>
                </div>
            </div>
            <!-- END FOOTER -->     
        </div>     
        <!-- END WRAPPER -->  
    <script type="text/javascript">
        //<![CDATA[
        Cufon.replace( '.slider_sheeva .slide-title h2' );
        Cufon.now();  //]]>
    </script>            
    
    <?php wp_footer() ?>   
    </body>
</html>