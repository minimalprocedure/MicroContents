<?php

/*
(c) 2003-2005 by LINee multimediaagency -
 www.linee.it - info@linee.it
 All rights reserved.

 License
 =======
 Permission is granted to anyone to use this software for any purpose,
 including commercial applications, and to alter it and redistribute it
 freely, subject to the following restrictions:

 The origin of this software must not be misrepresented; you must not
 claim that you wrote the original software. If you use this software in
 a product, an acknowledgment in the product documentation would be
 appreciated but is not required.

 The copyright notice must not be modified or removed from any of the
 source code.  If the source is reorganised into different files
 then the copyright notice must be included in each file that contains
 some or all of the original source.

 Redistributions of source code must retain all copyright notices in the
 source and must be accompanied by this license.

 Altered source versions must be plainly marked as such, and must not be
 misrepresented as being the original software.

 Neither the name of LINee multimediaagency nor the names of its contributors
 may be used to endorse or promote products derived from this software without
 specific prior written permission.

 THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
 IN NO EVENT SHALL THE COPYRIGHT HOLDERS OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT,
 INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
 LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE
 OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED
 OF THE POSSIBILITY OF SUCH DAMAGE. THIS DISCLAIMER OF WARRANTY CONSTITUTES AN
 ESSENTIAL PART OF THIS LICENSE. NO USE OF ANY ORIGINAL CODE IS AUTHORIZED
 HERE UNDER EXCEPT UNDER THIS DISCLAIMER.
 ========

 this code is an the intellectual property of LINee multimediaagency (c)2003-2005
 All rights reserved.


*/

    require_once "lib/global_vars.php";
	require_once "lib/template_functions.php";
	require_once "lib/catalog_functions.php";
	require_once "lib/css_functions.php";
	require_once "lib/init_functions.php";
	require_once "lib/sessions_functions.php";

	$MAIN_PROCESSOR_FILE = basename(__FILE__);

	prepare_path();
	start_session();

	prepare_session_vars(); // doppia chiamata per menu e contenuto
	prepare_global();

	prepare_session_vars();
	prepare_right();

	css_links();
	css_blocks();
	css_menus();
	css_redefs();

	initSubstTokens();
	loadCatalog("name.txt");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo $LOCALE_LANG ?>">
<head>
	<title>
        <?php

			pushSubstToken("%%CORPORATE_TITLE%%", _T("corporate_title"));

		?>
    </title>
	<meta name="Author" content="Linee Multimediaagency, info@linee.it" />
    <meta name="reply-to" content="info@linee.it" />
    <meta name="robots" content="ALL FOLLOW" />
    <meta name="revisit-after" content="15" />
    <meta name="distribution" content="Global" />
    <meta name="language" content="<?php echo $LOCALE_LANG ?>" />
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />

    <?php loadCatalog("meta.txt"); ?>

    <meta name="description" 	content="<?php _T("description"); ?>" />
    <meta name="keywords"    	content="<?php _T("keywords"); ?>" />
    <meta name="classification" content="<?php _T("classification"); ?>" />
    <meta name="rating" 		content="<?php _T("rating"); ?>" />

    <link rel="stylesheet" type="text/css" title="Default Screen" media="screen" href="./style/screen_default/styles.css" />

</head>
<body>
<div id="Block">

    <?php loadCatalog("name.txt"); ?>

    <div id="topBlock">

        <?php print $TOP_LOGO_BLOCK ?>

        <div id="topNameBlock">
            <div id="topNameBig">
               <h1>
	               <?php
					pushSubstToken("%%CORPORATE_NAME%%", _T("corporate_name"));
				   ?>
			   </h1>
            </div>
            <br />
            <div id="topNameSentence">
               <h5>
               		<?php
					pushSubstToken("%%CORPORATE_SLOGAN%%", _T("corporate_slogan"));
					?>
               </h5>
            </div>
        </div>
    </div>

    <?php print $RSS_LINK; ?>

    <div id="BlockMenuMain">
        <ul id="MenuMain">
        	<?php print $MENU_ITEMS ?>
        </ul>
    </div>

    <div id="bottomBlock">

        <?php loadCatalog("content-$CONTENT_NUM.txt"); ?>

        <div id="ContentBlock">
            <div class="TitleBand">
                <?php print $TITLE_SEPARATOR ?>
                <strong>
                	<?php
						_T("content_title");
					?>
                </strong>
            </div>
            <div id="TextBlock">
                <?php
				useMarkDownForFile();
				_TContent("content");

				?>
            </div>

        </div>
            <?php print $RIGHT_BLOCK; ?>
    </div>
        <?php loadCatalog("footer.txt"); ?>
        <div id="footer">
            <?php _T("footer_text"); ?>
        </div>
        <div id="creator">
            powered and (c) by
            <a href="http://www.linee.it">LINee multimediaagency</a>
            /
            <a href="http://www.mammuth.it">mammuth <em>LA</em>b</a>
			2005
        </div>
        <div id="websiteVersionInfo">
            <?php print " website ver. ".$VERSION; ?>
        </div>

</div>

</body>
</html>
