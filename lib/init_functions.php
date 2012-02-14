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

function prepare_path(){
    global $css_path_template;
    global $css_path_screen_default;
    global $html_path_template;
    global $locale_path;
    global $settings_path;

    $settings_path = getValue("path_settings", "settings_path");
    $css_path_template = getValue("path_settings", "css_path_template");
    $css_path_screen_default = getValue("path_settings", "css_path_screen_default");
    $html_path_template = getValue("path_settings", "html_path_template");
    $locale_path = getValue("path_settings", "locale_path");
}

function prepare_global(){

    global $MENU_SEPARATOR;
    global $TITLE_SEPARATOR;
    global $TOP_LOGO_BLOCK;
    global $VERSION;
    global $MENU_ITEMS;
    global $INFO_BLOCK;
    global $MENU_ITEMS;
    global $CONTENT_NUM;
    global $MAIN_PROCESSOR_FILE;

    global $max_menu_items;
    global $settings_path;

    $MENU_SEPARATOR = getValue($settings_path."settings", "menu_separator");
    $TITLE_SEPARATOR = getValue($settings_path."settings", "title_separator");

    $TOP_LOGO_BLOCK = "";
    if(getValue($settings_path."settings", "top_logo_image") == "on"){
        $TOP_LOGO_BLOCK = '<div id="topLogoBlock"></div>';
    }

    // info block
    if(getValue($settings_path."settings", "info_visible") == "on"){
        $INFO_BLOCK = "";

        loadCatalog("contact.txt");

        $VARS["TITLE_SEPARATOR"] = $TITLE_SEPARATOR;
        $VARS["INFO_CONTACT"] = _TRet("contact");
        $VARS["CORPORATE_TEXT"] = _TRet("corporate_text");
        $VARS["CORPORATE_SEDE"] = _TRet("sede");
        $VARS["CORPORATE_SEDE_TEXT"] = _TRet("sede_text");
        $VARS["CORPORATE_PHONE"] = _TRet("phone");
        $VARS["CORPORATE_PHONE_TEXT"] = _TRet("phone_text");
        $VARS["CORPORATE_EMAIL"] = _TRet("email");
        $VARS["CORPORATE_EMAIL_TEXT"] = _TRet("email_text");
        $INFO_BLOCK = get_template_html_vars("info_block", $VARS);
        unset($VARS);
    }

    $MENU_ITEMS = "";
    loadCatalog("menu.txt");
    $MAX_ITEMS = getValue($settings_path."settings", "menu_items_num");
    if($MAX_ITEMS < 0){
        $MAX_ITEMS = 0;
    }
    if($MAX_ITEMS > $max_menu_items){
        $MAX_ITEMS = $max_menu_items;
    }
    for($Index = 0; $Index < $MAX_ITEMS; $Index++){
        $VARS["NUM_CONTENT"] = $Index;
        if(getValue($settings_path."settings", "menu_separator_is_moda") != "on"){
            if($Index == 0){
                $VARS["SEP_CONTENT"] = "";
            } else {
                $VARS["SEP_CONTENT"] = $MENU_SEPARATOR;
            }
        } else {
            $VARS["SEP_CONTENT"] = $MENU_SEPARATOR;
        }
        $VARS["TITLE_CONTENT"] = _TRet("menu_$Index");
        $VARS["MAIN_PROCESSOR_FILE"] = $MAIN_PROCESSOR_FILE;
        $MENU_ITEMS .= get_template_html_vars("menu_item", $VARS);
    }
    unset($VARS);

    $VERSION = getValue($settings_path."version", "version_number");

    // default home page
    $CONTENT_NUM = 0;
    $CONTENT_NUM = (int)getValue($settings_path."settings", "content_default_number");

    if($CONTENT_NUM < 0){
        $CONTENT_NUM = 0;
    }
    if($CONTENT_NUM > ($MAX_ITEMS - 1)){
        $CONTENT_NUM = ($MAX_ITEMS - 1);
    }
}

function prepare_right(){

    global $RSS_LINK;
    global $TITLE_SEPARATOR;
    global $LANG_BLOCK;
    global $IMAGE_LANGS_BLOCK;
    global $LOCALE_LANG_PATH;
    global $LOCALE_LANG;
    global $INFO_BLOCK;
    global $RIGHT_BLOCK;
    global $CONTENT_BLOCK_SIZE;

    global $locale_path;
    global $settings_path;

    $main_area_size = getValue($settings_path."settings", "main_area_size");

    // lang block
    if(getValue($settings_path."settings", "lang_visible") == "on"){

        loadCatalog("languages.txt");

        $IMAGE_LANGS_BLOCK="";
        if (getValue($settings_path."settings", "lang_image") == "on"){
            if (file_exists($LOCALE_LANG_PATH."img_lang.png")){
                $IMAGE = $LOCALE_LANG_PATH."img_lang.png";
                $IMAGE_LANGS_BLOCK = "<img class=\"lang_image\"src=\"$IMAGE\" alt=\"$LOCALE_LANG\" />";
            }
        }

        $LANGS_BLOCK = BuildLangsBlock();

        $LANG_BLOCK = "";
        $VARS["TITLE_SEPARATOR"] = $TITLE_SEPARATOR;
        $VARS["LANG_TITLE"] = _TRet("lang_title");;
        $VARS["LOCALE_LANG"] = $LOCALE_LANG;
        $VARS["LANGS_BLOCK"] = $LANGS_BLOCK;
        $LANG_BLOCK = get_template_html_vars("lang_block", $VARS);
        unset($VARS);
    }

    // right blocks position
    $RIGHT_BLOCK = "";
    if(getValue($settings_path."settings", "info_first") == "on"){
        $RIGHT_BLOCK = $INFO_BLOCK.$LANG_BLOCK;
    } else {
        $RIGHT_BLOCK = $LANG_BLOCK.$INFO_BLOCK;
    }

    // right block
    if($RIGHT_BLOCK != ""){
        $VARS["RIGHT_BLOCK"] = $RIGHT_BLOCK;
        $RIGHT_BLOCK = get_template_html_vars("right_block", $VARS);
        $CONTENT_BLOCK_SIZE = $main_area_size - 172;
    } else {
        $CONTENT_BLOCK_SIZE = $main_area_size;
    }
    unset($VARS);

    $RSS_LINK = "";
    if(getValue($settings_path."settings", "rss_link_active") == "on"){
        $VARS["LOCALE_LINK"] = "../".$locale_path.$LOCALE_LANG."/news.txt";
        $VARS["RSS_CAPTION"] = getValue($settings_path."settings", "rss_link_caption");
        $RSS_LINK = get_template_html_vars("rss_link", $VARS);
    }
    unset($VARS);

}

function initSubstTokens(){
    global $MAIN_PROCESSOR_FILE;
    global $VERSION;
    global $LOCALE_LANG_PATH;
    global $LOCALE_LANG;

    global $css_path_template;
    global $css_path_screen_default;
    global $html_path_template;
    global $locale_path;
    global $settings_path;

    $today = getdate();
    pushSubstToken("%%YEAR%%", $today["year"]);
    pushSubstToken("%%MONTH%%", $today["mon"]);
    pushSubstToken("%%DAY%%", $today["mday"]);

    pushSubstToken("%%HOURS%%", $today["hours"]);
    pushSubstToken("%%MINUTES%%", $today["minutes"]);
    pushSubstToken("%%SECONDS%%", $today["seconds"]);

    pushSubstToken("%%MAIN_PROCESSOR_FILE%%", $MAIN_PROCESSOR_FILE);
    pushSubstToken("%%SITE_VERSION%%", $VERSION);
    pushSubstToken("%%LOCALE_LANG_PATH%%", $LOCALE_LANG_PATH);
    pushSubstToken("%%LOCALE_LANG%%", $LOCALE_LANG);

    pushSubstToken("%%SETTINGS_PATH%%", $settings_path);
    pushSubstToken("%%CSS_PATH_TEMPLATE%%", $css_path_template);
    pushSubstToken("%%CSS_PATH_SCREEN_DEFAULT%%", $css_path_screen_default);
    pushSubstToken("%%HTML_PATH_TEMPLATE%%", $html_path_template);
    pushSubstToken("%%LOCALE_PATH%%", $locale_path);

    $T = explode(";", getValue($settings_path."subst_tokens", "token"));
    $S = explode(";", getValue($settings_path."subst_tokens", "subst"));

    foreach($T as $key => $token){
        if ($token != "token"){
            pushSubstToken($token, $S[$key]);
        }
    }
}

function initLocalSubstTokens(){

    global $TOKENS_TEMPLATE_LOCAL;
    unset($TOKENS_TEMPLATE_LOCAL);
    global $TOKENS_SUBSTITUTE_LOCAL;
    unset($TOKENS_SUBSTITUTE_LOCAL);
    global $LOCALE_LANG_PATH;

    $TOKENS_TEMPLATE_LOCAL = Array();
    $TOKENS_SUBSTITUTE_LOCAL = Array();

    $T = explode(";", getValue($LOCALE_LANG_PATH."subst_tokens.txt", "token"));
    $S = explode(";", getValue($LOCALE_LANG_PATH."subst_tokens.txt", "subst"));

    foreach($T as $key => $token){
        if ($token != "token"){
            pushLocalSubstToken($token, $S[$key]);
        }
    }
}

function pushSubstToken($token, $subst){
    global $TOKENS_TEMPLATE;
    global $TOKENS_SUBSTITUTE;

    $key = array_search($token, $TOKENS_TEMPLATE);
    if($key){
        $TOKENS_TEMPLATE[$key] = trim($token);
        $TOKENS_SUBSTITUTE[$key] = trim($subst);
    } else {
        array_push($TOKENS_TEMPLATE, trim($token));
        array_push($TOKENS_SUBSTITUTE, trim($subst));
    }
}

function pushLocalSubstToken($token, $subst){
    global $TOKENS_TEMPLATE_LOCAL;
    global $TOKENS_SUBSTITUTE_LOCAL;

    $key = array_search($token, $TOKENS_TEMPLATE_LOCAL);
    if($key){
        $TOKENS_TEMPLATE_LOCAL[$key] = trim($token);
        $TOKENS_SUBSTITUTE_LOCAL[$key] = trim($subst);
    } else {
        array_push($TOKENS_TEMPLATE_LOCAL, trim($token));
        array_push($TOKENS_SUBSTITUTE_LOCAL, trim($subst));
    }
}

?>
