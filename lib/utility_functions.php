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

function extTrimMask($str, $aMask){

    $result = trim($str);
    $tstr = "";
    $inMask = false;

    for ($index = 0; $index <= strlen($result) - 1; $index++){
        if (!in_array($result[$index], $aMask)){
            $inMask = false;
        }
        if (in_array($result[$index], $aMask)){
            $inMask = true;
        } else {
            $inMask = false;
        }
        if ($inMask <> true){
            $tstr = $tstr.$result{$index};
        }
    }
    return $result = $tstr;
}
?>