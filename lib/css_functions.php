<?php

/*
(c) 2003-2005 by LINee multimediaagency -
 www.linee.it - info@linee.it
 All rights reserved.

 (c) 2003-2005 by mammuth LAb -
 www.mammuth.it - nissl@mammuth.it
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
 =======

 this code is an the intellectual property of LINee multimediaagency (c)2003-2005
 All rights reserved.

 this code is an the intellectual property of mammuth LAb (c)2003-2005
 All rights reserved.


*/

require_once "global_vars.php";
require_once "catalog_functions.php";

function css_links(){

	global $settings_path;

	$CATALOG = $settings_path."css_settings";
	$CATALOG_2 = $settings_path."settings";

	$VARS["MenuMain_link"] = getValue($CATALOG, "MenuMain_link");
	$VARS["MenuMain_visited"] = getValue($CATALOG, "MenuMain_visited");
	$VARS["MenuMain_hover"] = getValue($CATALOG, "MenuMain_hover");
	$VARS["MenuMain_active"] = getValue($CATALOG, "MenuMain_active");
	$VARS["MenuMain_active_decoration"] = getValue($CATALOG, "MenuMain_active_decoration");
	$VARS["MenuMain_hover_decoration"] = getValue($CATALOG, "MenuMain_hover_decoration");

	$VARS["MenuLang_link"] = getValue($CATALOG, "MenuLang_link");
	$VARS["MenuLang_visited"] = getValue($CATALOG, "MenuLang_visited");
	$VARS["MenuLang_hover"] = getValue($CATALOG, "MenuLang_hover");
	$VARS["MenuLang_active"] = getValue($CATALOG, "MenuLang_active");
	$VARS["MenuLang_hover_decoration"] = getValue($CATALOG, "MenuLang_hover_decoration");
	$VARS["MenuLang_hover_background_color"] = getValue($CATALOG, "MenuLang_hover_background_color");

	$VARS["InfoCorporateEmail_link"] = getValue($CATALOG, "InfoCorporateEmail_link");
	$VARS["InfoCorporateEmail_visited"] = getValue($CATALOG, "InfoCorporateEmail_visited");
	$VARS["InfoCorporateEmail_hover"] = getValue($CATALOG, "InfoCorporateEmail_hover");
	$VARS["InfoCorporateEmail_active"] = getValue($CATALOG, "InfoCorporateEmail_active");
	$VARS["InfoCorporateEmail_hover_decoration"] = getValue($CATALOG, "InfoCorporateEmail_hover_decoration");

	$VARS["creator_link"] = getValue($CATALOG, "creator_link");
	$VARS["creator_visited"] = getValue($CATALOG, "creator_visited");
	$VARS["creator_hover"] = getValue($CATALOG, "creator_hover");
	$VARS["creator_active"] = getValue($CATALOG, "creator_active");
	$VARS["creator_hover_decoration"] = getValue($CATALOG, "creator_hover_decoration");

	$VARS["link_link"] = getValue($CATALOG, "link_link");
	$VARS["link_visited"] = getValue($CATALOG, "link_visited");
	$VARS["link_hover"] = getValue($CATALOG, "link_hover");
	$VARS["link_active"] = getValue($CATALOG, "link_active");
	$VARS["link_hover_decoration"] = getValue($CATALOG, "link_hover_decoration");
	$VARS["link_link_decoration"] = getValue($CATALOG, "link_link_decoration");

	$VARS["rss_link_color"] = getValue($CATALOG_2, "rss_link_color");
	$VARS["rss_link_hover_color"] = getValue($CATALOG_2, "rss_link_hover_color");
	$VARS["rss_link_link_decoration"] = getValue($CATALOG_2, "rss_link_decoration");
	$VARS["rss_link_hover_decoration"] = getValue($CATALOG_2, "rss_link_hover_decoration");

	get_template_css_vars("links", $VARS);
}

function css_blocks(){

	global $CONTENT_BLOCK_SIZE;

	global $settings_path;

	$CATALOG = $settings_path."css_settings";
	$CATALOG_2 = $settings_path."settings";

	$main_area_size = getValue($CATALOG_2, "main_area_size");
	$VARS["main_area_size"] = $main_area_size;
	$VARS["main_area_size_middle"] = $main_area_size / 2;

	$VARS["topBlock_background_color"] = getValue($CATALOG, "topBlock_background_color");

	$VARS["topBlock_background_image"] = "";
	if(getValue($CATALOG, "topBlock_background_image") == "on"){
		$VARS["topBlock_background_image"] = "background-image: url(./../../images/logo_image.png); background-repeat: no-repeat;";
	}

	$corporate_name_position = getValue($CATALOG_2, "corporate_name_position");
	if($corporate_name_position < 0){
		$corporate_name_position = 0;
	}
	if($corporate_name_position > $main_area_size){
		$corporate_name_position = $main_area_size;
	}
	$VARS["corporate_name_position"] = $corporate_name_position;

	$VARS["topLogoBlock_border_right_size"] = getValue($CATALOG, "topLogoBlock_border_right_size");
	$VARS["topLogoBlock_border_right_type"] = getValue($CATALOG, "topLogoBlock_border_right_type");
	$VARS["topLogoBlock_border_right_color"] = getValue($CATALOG, "topLogoBlock_border_right_color");
	$VARS["topLogoBlock_background_color"] = getValue($CATALOG, "topLogoBlock_background_color");
	$VARS["topLogoBlock_paragraph_fonts"] = getValue($CATALOG, "topLogoBlock_paragraph_fonts");
	$VARS["topLogoBlock_paragraph_fonts_color"] = getValue($CATALOG, "topLogoBlock_paragraph_fonts_color");

	$VARS["topLogoBlock_background_image"] = "";
	if(getValue($CATALOG, "topLogoBlock_background_image") == "on"){
		$VARS["topLogoBlock_background_image"] = "background-image: url(./../../images/logo_image_left.png); background-repeat: no-repeat;";
	}

	$VARS["topNameBig_fonts_color"] = getValue($CATALOG, "topNameBig_fonts_color");

	$VARS["topNameSentence_paragraph_fonts"] = getValue($CATALOG, "topNameSentence_paragraph_fonts");
	$VARS["topNameSentence_fonts_color"] = getValue($CATALOG, "topNameSentence_fonts_color");

	$VARS["ContentBlock_size"] = $CONTENT_BLOCK_SIZE;

	$VARS["ContentBlock_border_size"] = getValue($CATALOG, "ContentBlock_border_size");
	$VARS["ContentBlock_border_type"] = getValue($CATALOG, "ContentBlock_border_type");
	$VARS["ContentBlock_border_color"] = getValue($CATALOG, "ContentBlock_border_color");
	$VARS["ContentBlock_background_color"] = getValue($CATALOG, "ContentBlock_background_color");

	$VARS["TitleBand_background_color"] = getValue($CATALOG, "TitleBand_background_color");
	$VARS["TitleBand_fonts_color"] = getValue($CATALOG, "TitleBand_fonts_color");

	$VARS["infoBlock_border_size"] = getValue($CATALOG, "infoBlock_border_size");
	$VARS["infoBlock_border_type"] = getValue($CATALOG, "infoBlock_border_type");
	$VARS["infoBlock_border_color"] = getValue($CATALOG, "infoBlock_border_color");

	$VARS["langBlock_border_size"] = getValue($CATALOG, "langBlock_border_size");
	$VARS["langBlock_border_type"] = getValue($CATALOG, "langBlock_border_type");
	$VARS["langBlock_border_color"] = getValue($CATALOG, "langBlock_border_color");

	$VARS["Info_fonts_color"] = getValue($CATALOG, "Info_fonts_color");

	$VARS["InfoBand_background_color"] = getValue($CATALOG, "InfoBand_background_color");
	$VARS["InfoBand_fonts_color"] = getValue($CATALOG, "InfoBand_fonts_color");

	$VARS["MenuLang_items_fonts_color"] = getValue($CATALOG, "MenuLang_items_fonts_color");

	$VARS["footer_background_color"] = getValue($CATALOG, "footer_background_color");
	$VARS["footer_fonts_color"] = getValue($CATALOG, "footer_fonts_color");

	$VARS["websiteVersionInfo_fonts_color"] = getValue($CATALOG, "websiteVersionInfo_fonts_color");
	$VARS["websiteVersionInfo_background_color"] = getValue($CATALOG, "websiteVersionInfo_background_color");

	$VARS["creator_fonts_color"] = getValue($CATALOG, "creator_fonts_color");
	$VARS["creator_background_color"] = getValue($CATALOG, "creator_background_color");

	$VARS["rss_link_fonts_size"] = getValue($CATALOG_2, "rss_link_fonts_size");
	$VARS["rss_link_background_color"] = getValue($CATALOG_2, "rss_link_background_color");
	$VARS["rss_link_color"] = getValue($CATALOG_2, "rss_link_color");
	$VARS["rss_link_fonts"] = getValue($CATALOG_2, "rss_link_fonts");

	$RSS_POSITION = explode(",", getValue($CATALOG_2, "rss_link_position"));
	$VARS["rss_link_top_position"] = $RSS_POSITION[0];
	$VARS["rss_link_left_position"] = $RSS_POSITION[1];

	get_template_css_vars("blocks", $VARS);
}

function css_menus(){

	global $settings_path;

	$CATALOG = $settings_path."css_settings";

	$VARS["BlockMenuMain_height"] = getValue($CATALOG, "BlockMenuMain_height");
	$VARS["MenuMain_items_fonts"] = getValue($CATALOG, "MenuMain_items_fonts");
	$VARS["BlockMenuMain_background_color"] = getValue($CATALOG, "BlockMenuMain_background_color");
	$VARS["MenuMain_items_color"] = getValue($CATALOG, "MenuMain_items_color");

	get_template_css_vars("menus", $VARS);
}

function css_redefs(){

	global $settings_path;

	$CATALOG = $settings_path."css_settings";

	$VARS["body_paragraph_fonts"] = getValue($CATALOG, "body_paragraph_fonts");
	$VARS["body_fonts_color"] = getValue($CATALOG, "body_fonts_color");
	$VARS["body_background_color"] = getValue($CATALOG, "body_background_color");

	$VARS["hr_size"] = getValue($CATALOG, "hr_size");
	$VARS["hr_type"] = getValue($CATALOG, "hr_type");
	$VARS["hr_color"] = getValue($CATALOG, "hr_color");

	get_template_css_vars("redefs", $VARS);
}


?>
