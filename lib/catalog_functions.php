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

//require_once "Markdown/markdown.php";



function isGetContent(){

}

function checkLang($LANG){
    global $settings_path;

    $ACTIVE_LANGS = explode(';', getValue($settings_path."settings", "languages"));
    foreach ($ACTIVE_LANGS as $ACTIVE_LANG){
        if ($ACTIVE_LANG == $LANG){
             return $LANG;
        }
    }
    return getValue($settings_path."settings", "language_default");
}

function isSessionLang(){
    $Result = false;
    if (count($_SESSION) > 0){
        if (array_key_exists('lang', $_SESSION)){
            return $_SESSION['lang'];
        }
    }
    return $Result;
}

function isGetLang(){
    $Result = false;
    if (count($_GET) > 0){
        if (array_key_exists('lang', $_GET)){
            return $_GET['lang'];
        }
    }
    return $Result;
}

function getLocaleAgent(){
    global $LOCALE_LANG;

    $SessionLang = isSessionLang();
    if ((boolean)$SessionLang){
        $LOCALE_LANG = $SessionLang;
        return;
    }

    $GetLang = isGetLang();
    if ((boolean)$GetLang){
        $LOCALE_LANG = $GetLang;
        return;
    }

    $LOCALE = explode(",", $_SERVER["HTTP_ACCEPT_LANGUAGE"]);
    $LOCALE_LANG = substr($LOCALE[0], 0, 2);

    if(!session_id()){
        $_SESSION['lang'] = $LOCALE_LANG;
    }
    return;
}

function registerCatalog($catalog){
    global $LOCALE_CATALOG;
    global $LOCALE_LANG;
    global $LOCALE_LANG_PATH;
    global $locale_path;
    getLocaleAgent();
    $LOCALE_LANG_PATH = "./".$locale_path.$LOCALE_LANG."/";
    $LOCALE_CATALOG = $LOCALE_LANG_PATH.$catalog;

    if (!file_exists($LOCALE_CATALOG)) {
        $LOCALE_LANG = $DEFAULT_LANG;
        $LOCALE_LANG_PATH = "./".$locale_path.$LOCALE_LANG."/";
        $LOCALE_CATALOG = $LOCALE_LANG_PATH.$catalog;
    }
}

function openCatalog(){
    global $LOCALE_CATALOG;
    global $CONTENT_ARRAY;
    if (file_exists($LOCALE_CATALOG)) {
        $CONTENT = trim(file_get_contents($LOCALE_CATALOG));
        $CONTENT_ARRAY = explode("++", $CONTENT);
    } else {
       $CONTENT_ARRAY = false;
    }
}

function loadCatalog($catalog){
    registerCatalog($catalog);
    openCatalog();
}

function _T($STRING_ID){
    global $CONTENT_ARRAY;
    $Result = $STRING_ID;
    if ($CONTENT_ARRAY != false){
        $ALEN = count($CONTENT_ARRAY);
        for ($i = 0; $i < $ALEN; $i++){
            if ($STRING_ID == $CONTENT_ARRAY[$i]){
                $Index = $i + 2;
                $Result = trim($CONTENT_ARRAY[$Index]);
                print $Result;
                return $Result;
            }
        }
    }
    print $Result;
    return $Result;
}

//TODO: pippo
function _TRet($STRING_ID){
    global $CONTENT_ARRAY;
    $Result = $STRING_ID;
    if ($CONTENT_ARRAY != false){
        $ALEN = count($CONTENT_ARRAY);
        for ($i = 0; $i < $ALEN; $i++){
            if ($STRING_ID == $CONTENT_ARRAY[$i]){
                $Index = $i + 2;
                $Result = trim($CONTENT_ARRAY[$Index]);
                return $Result;
            }
        }
    }
    return $Result;
}

if(file_exists("lib/Markdown/markdown.php")
    & ($DISABLE_MARKDOWN == false)
    ){

    require_once "Markdown/markdown.php";

    function _TContent($STRING_ID){

        global $CONTENT_NUM;
        global $CONTENT_ARRAY;
        global $ERROR_MESSAGE_FILE_NOT_ON_SERVER;

        global $TOKENS_TEMPLATE;
        global $TOKENS_SUBSTITUTE;
        global $TOKENS_TEMPLATE_LOCAL;
        global $TOKENS_SUBSTITUTE_LOCAL;

        global $USE_MARKDOWN;

        /*
        if($CONTENT_NUM == "rss"){
            $Result = "rss";
            print $Result;
            return $Result;
        }
        */
        initLocalSubstTokens();

        if(!is_numeric($CONTENT_NUM)){
            if(file_exists($CONTENT_NUM)){
                $content_text = trim(file_get_contents($CONTENT_NUM));
                $substed_text = str_replace($TOKENS_TEMPLATE, $TOKENS_SUBSTITUTE, $content_text);
                $substed_text = str_replace($TOKENS_TEMPLATE_LOCAL, $TOKENS_SUBSTITUTE_LOCAL, $substed_text);
                if($USE_MARKDOWN){
                    $Result = Markdown($substed_text);
                } else {
                    $Result = ($substed_text);
                }
                print $Result;
            } else {
                $Result = $ERROR_MESSAGE_FILE_NOT_ON_SERVER;
                print $Result;
            }
            return $Result;
        }

        $Result = $STRING_ID;
        if ($CONTENT_ARRAY != false){
            $ALEN = count($CONTENT_ARRAY);
            for ($i = 0; $i < $ALEN; $i++){
                if ($STRING_ID == $CONTENT_ARRAY[$i]){
                    $Index = $i + 2;
                    $content_text = trim($CONTENT_ARRAY[$Index]);
                    $substed_text = str_replace($TOKENS_TEMPLATE, $TOKENS_SUBSTITUTE, $content_text);
                    $substed_text = str_replace($TOKENS_TEMPLATE_LOCAL, $TOKENS_SUBSTITUTE_LOCAL, $substed_text);
                    if($USE_MARKDOWN){
                        $Result = Markdown($substed_text);
                    } else {
                        $Result = ($substed_text);
                        $Result = "<p>".$Result."</p>";
                    }
                    print $Result;
                    return $Result;
                }
            }
        }
        print $Result;
        return $Result;
    }

} else {

    function _TContent($STRING_ID){

        global $CONTENT_NUM;
        global $CONTENT_ARRAY;
        global $ERROR_MESSAGE_FILE_NOT_ON_SERVER;

        global $TOKENS_TEMPLATE;
        global $TOKENS_SUBSTITUTE;
        global $TOKENS_TEMPLATE_LOCAL;
        global $TOKENS_SUBSTITUTE_LOCAL;

        /*
        if($CONTENT_NUM == "rss"){
            $Result = "rss";
            print $Result;
            return $Result;
        }
        */
        initLocalSubstTokens();

        if(!is_numeric($CONTENT_NUM)){
            if(file_exists($CONTENT_NUM)){
                $content_text = trim(file_get_contents($CONTENT_NUM));
                $substed_text = str_replace($TOKENS_TEMPLATE, $TOKENS_SUBSTITUTE, $content_text);
                $substed_text = str_replace($TOKENS_TEMPLATE_LOCAL, $TOKENS_SUBSTITUTE_LOCAL, $substed_text);
                $Result = $substed_text;
                print $Result;
            } else {
                $Result = $ERROR_MESSAGE_FILE_NOT_ON_SERVER;
                print $Result;
            }
            return $Result;
        }

        $Result = $STRING_ID;
        if ($CONTENT_ARRAY != false){
            $ALEN = count($CONTENT_ARRAY);
            for ($i = 0; $i < $ALEN; $i++){
                if ($STRING_ID == $CONTENT_ARRAY[$i]){
                    $Index = $i + 2;
                    $content_text = trim($CONTENT_ARRAY[$Index]);
                    $substed_text = str_replace($TOKENS_TEMPLATE, $TOKENS_SUBSTITUTE, $content_text);
                    $substed_text = str_replace($TOKENS_TEMPLATE_LOCAL, $TOKENS_SUBSTITUTE_LOCAL, $substed_text);
                    $Result = $substed_text;
                    print "<p>".$Result."</p>";
                    return $Result;
                }
            }
        }
        print $Result;
        return $Result;
    }

    $USE_MARKDOWN = false;
}


function getValue($Catalog, $Key){
    $Result = $Key;
    if (!file_exists($Catalog)){

        echo "$Catalog  - non esiste\n";
        return $Result;
    }
    $Cat = file_get_contents($Catalog);
    $Cat_Array = explode("++", $Cat);
    if ($Cat_Array != false){
        $Len = count($Cat_Array);
        for ($i = 0; $i < $Len; $i++){
            if ($Key == $Cat_Array[$i]){
                $Index = $i + 2;
                $Result = trim($Cat_Array[$Index]);
                return $Result;
            }
        }
    }
    return $Result;
}

function useMarkDownForFile() {

    global $LOCALE_CATALOG;
    global $USE_MARKDOWN;
    $setting = getValue($LOCALE_CATALOG, "markdown");
    if($setting == "on"){
        $USE_MARKDOWN = true;
    } else {
        $USE_MARKDOWN = false;
    }
}

/*
function BuildLangsBlock(){
    global $LOCALE_CATALOG;
    $LANGS_BLOCK = "";
    loadCatalog("languages.txt");
    $LANGS = explode(';', getValue($LOCALE_CATALOG, "languages"));
    foreach ($LANGS as $LANG){
        $LANGS_BLOCK .= "<li><a href=\"$MAIN_PROCESSOR_FILE?lang=$LANG\">$LANG</a></li>\n" ;
    }
    print $LANGS_BLOCK;
}
*/

function BuildLangsBlock(){

    global $IMAGE_LANGS_BLOCK;
    global $MAIN_PROCESSOR_FILE;
    global $settings_path;

    $LANGS_BLOCK = "";
    $LANGS = explode(';', getValue($settings_path."settings", "languages"));
    foreach ($LANGS as $LANG){
        if (trim(getValue($settings_path."settings", "lang_text") == "on")){
            $LANGS_BLOCK .= "<li>$IMAGE_LANGS_BLOCK<a href=\"$MAIN_PROCESSOR_FILE?lang=$LANG\">$LANG</a></li>\n";
        } elseif ($IMAGE_LANGS_BLOCK != "") {
            $LANGS_BLOCK .= "<li><a href=\"$MAIN_PROCESSOR_FILE?lang=$LANG\">$IMAGE_LANGS_BLOCK</a></li>\n" ;
        } else {
            $LANGS_BLOCK = ""; //blocco inutile
        }
    }
    return $LANGS_BLOCK;
}
?>
