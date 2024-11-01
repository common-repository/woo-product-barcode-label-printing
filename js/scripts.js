/**
 * @package 	WooCommerce Product Barcode Label Printing
 * @version 	1.5.1
 * 
 * Main JS Scripts
 * 
**/


// Settings
jQuery(document).ready(function(e){e(".wpblp_select_products_box .product_checkbox").length&&e(".wpblp_select_products_box .product_checkbox").on("change",function(){e(".wpblp_select_products_box .product_checkbox:checked").length>3&&(this.checked=!1)});e(".wpblp_select_products_box input[type=number]").length&&e(".wpblp_select_products_box input[type=number]").change(function(){e(this).val()>5&&e(this).val(5)});if(e("#wpblp_settings_sku_input").is(":checked"))var t=1;else t=0;if(e("#wpblp_settings_title_input").is(":checked"))var _=1;else _=0;if(e("#wpblp_settings_price_input").is(":checked"))var p=1;else p=0;var i=e("#wpblp_settings_barcode_radio_types").find(":selected").val(),s=e("#wpblp_settings_dpi_input").val(),l=e("#wpblp_settings_width_input").val(),n=e("#wpblp_settings_height_input").val(),b=e("#wpblp_settings_bar_width_input").val(),w=e("#wpblp_settings_bar_height_input").val(),a=e("#wpblp_settings_offsetx_input").val(),g=e("#wpblp_settings_offsety_input").val(),r=e("#wpblp_settings_preview_sku_input").val(),d=e("#wpblp_settings_title_font_size_input").val(),o=e("#wpblp_settings_code_font_size_input").val(),c=e("#wpblp_settings_price_font_size_input").val(),u=parseInt(l*s/25.4+.5),v=parseInt(n*s/25.4+.5),f=e("#wpblp_settings_preset").val(),h=e("#wpblp_settings_preset_name").val(),x={wpblp_settings_checkbox_sku:t,wpblp_settings_checkbox_title:_,wpblp_settings_checkbox_price:p,wpblp_settings_input_field_dpi:s,wpblp_settings_input_field_width:l,wpblp_settings_input_field_height:n,wpblp_settings_input_field_bar_width:b,wpblp_settings_input_field_bar_height:w,wpblp_settings_input_field_offsetx:a,wpblp_settings_input_field_offsety:g,wpblp_settings_input_field_preview_sku:r,wpblp_settings_input_field_title_font_size:d,wpblp_settings_input_field_code_font_size:o,wpblp_settings_input_field_price_font_size:c,wpblp_settings_radio_type:i};function k(){t=e("#wpblp_settings_sku_input").is(":checked")?1:0,_=e("#wpblp_settings_title_input").is(":checked")?1:0,p=e("#wpblp_settings_price_input").is(":checked")?1:0,i=e("#wpblp_settings_barcode_radio_types").find(":selected").val(),s=e("#wpblp_settings_dpi_input").val(),l=e("#wpblp_settings_width_input").val(),n=e("#wpblp_settings_height_input").val(),b=e("#wpblp_settings_bar_width_input").val(),w=e("#wpblp_settings_bar_height_input").val(),a=e("#wpblp_settings_offsetx_input").val(),g=e("#wpblp_settings_offsety_input").val(),r=e("#wpblp_settings_preview_sku_input").val(),d=e("#wpblp_settings_title_font_size_input").val(),o=e("#wpblp_settings_code_font_size_input").val(),c=e("#wpblp_settings_price_font_size_input").val(),u=parseInt(l*s/25.4+.5),v=parseInt(n*s/25.4+.5),f=e("#wpblp_settings_preset").val(),h=e("#wpblp_settings_preset_name").val(),x={wpblp_settings_checkbox_sku:t,wpblp_settings_checkbox_title:_,wpblp_settings_checkbox_price:p,wpblp_settings_input_field_dpi:s,wpblp_settings_input_field_width:l,wpblp_settings_input_field_height:n,wpblp_settings_input_field_bar_width:b,wpblp_settings_input_field_bar_height:w,wpblp_settings_input_field_offsetx:a,wpblp_settings_input_field_offsety:g,wpblp_settings_input_field_preview_sku:r,wpblp_settings_input_field_title_font_size:d,wpblp_settings_input_field_code_font_size:o,wpblp_settings_input_field_price_font_size:c,wpblp_settings_radio_type:i}}function z(){1==t?e(".wpblp_live_preview .label .label_lines + div").show():e(".wpblp_live_preview .label .label_lines + div").hide(),1==_?e(".wpblp_live_preview .label .name").show():e(".wpblp_live_preview .label .name").hide(),1==p?e(".wpblp_live_preview .label .price").show():e(".wpblp_live_preview .label .price").hide()}k(),e("#wpblp_settings_width_description span").text(u),e("#wpblp_settings_height_description span").text(v),e(".wpblp_live_preview .label").css({width:u+"px",height:v+"px"}),e(".wpblp_live_preview .label .name").css({"font-size":d+"px"}),e(".wpblp_live_preview .label_img").barcode(r,i,{barWidth:b,barHeight:w,fontSize:o,showCode:1}),""!=a&&e(".wpblp_live_preview .label .inner").css({paddingLeft:a+"px"}),""!=g&&e(".wpblp_live_preview .label .inner").css({paddingTop:g+"px"}),z(),e("#wpblp_settings_form").on("change click",function(){k(),e("#wpblp_settings_width_description span").text(u),e("#wpblp_settings_height_description span").text(v),e(".wpblp_live_preview .label").css({width:u+"px",height:v+"px"}),e(".wpblp_live_preview .label .name").css({"font-size":d+"px"}),e(".wpblp_live_preview .label_img").barcode(r,i,{barWidth:b,barHeight:w,fontSize:o,showCode:1}),""!=a&&e(".wpblp_live_preview .label .inner").css({paddingLeft:a+"px"}),""!=g&&e(".wpblp_live_preview .label .inner").css({paddingTop:g+"px"}),z()}),e("#wpblp_submit_button_save_preset").click(function(){k(),jQuery.post(ajaxurl,{nonce:wpblp.nonce,action:"presets_action",preset_select:f,preset_name:h,wpblp_preset_value:"save",wpblp_new_settings:x},function(e){location.reload()})}),e("#wpblp_submit_button_load_preset").click(function(){k(),jQuery.post(ajaxurl,{nonce:wpblp.nonce,action:"presets_action",preset_select:f,preset_name:h,wpblp_preset_value:"load",wpblp_new_settings:x},function(e){location.reload()})})});


// Actions
jQuery(document).ready(function(e) {
	"use strict";

	var t_l = e('#wpblp_support_link').parent();
	if (typeof t_l != 'undefined') {
		t_l.prop('target', '_blank')
	}
});



/**
 *  BarCode Coder Library (BCC Library)
 *  BCCL Version 2.0
 *
 *  Porting : WooCommerce Product Barcode Label Printing
 *
 *
 *  Date    : 2013-01-06
 *  Author  : DEMONTE Jean-Baptiste <jbdemonte@gmail.com>
 *            HOUREZ Jonathan
 *
 *  Web site: http://barcode-coder.com/
 *  dual licence :  http://www.cecill.info/licences/Licence_CeCILL_V2-fr.html
 *                  http://www.gnu.org/licenses/gpl.html
**/

!function(t){var e={settings:{barWidth:1,barHeight:50,showCode:!0,moduleSize:5,showHRI:!0,addQuietZone:!0,marginHRI:5,bgColor:"#FFFFFF",color:"#000000",fontSize:10,output:"css",posX:0,posY:0},intval:function(t){var i=typeof t;return"string"==i?(t=t.replace(/[^0-9-.]/g,""),t=parseInt(1*t,10),isNaN(t)||!isFinite(t)?0:t):"number"==i&&isFinite(t)?Math.floor(t):0},i25:{encoding:["NNWWN","WNNNW","NWNNW","WWNNN","NNWNW","WNWNN","NWWNN","NNNWW","WNNWN","NWNWN"],compute:function(t,i,a){if(i){"int25"==a&&t.length%2==0&&(t="0"+t);for(var r,n=!0,o=0,c=t.length-1;c>-1;c--){if(r=e.intval(t.charAt(c)),isNaN(r))return"";o+=n?3*r:r,n=!n}t+=((10-o%10)%10).toString()}else t.length%2!=0&&(t="0"+t);return t},getDigit:function(t,i,e){if(""==(t=this.compute(t,i,e)))return"";var a,r;if(result="","int25"==e){var n,o;for(result+="1010",a=0;a<t.length/2;a++)for(n=t.charAt(2*a),o=t.charAt(2*a+1),r=0;r<5;r++)result+="1","W"==this.encoding[n].charAt(r)&&(result+="1"),result+="0","W"==this.encoding[o].charAt(r)&&(result+="0");result+="1101"}else if("std25"==e){var c;for(result+="11011010",a=0;a<t.length;a++)for(c=t.charAt(a),r=0;r<5;r++)result+="1","W"==this.encoding[c].charAt(r)&&(result+="11"),result+="0";result+="11010110"}return result}},ean:{encoding:[["0001101","0100111","1110010"],["0011001","0110011","1100110"],["0010011","0011011","1101100"],["0111101","0100001","1000010"],["0100011","0011101","1011100"],["0110001","0111001","1001110"],["0101111","0000101","1010000"],["0111011","0010001","1000100"],["0110111","0001001","1001000"],["0001011","0010111","1110100"]],first:["000000","001011","001101","001110","010011","011001","011100","010101","010110","011010"],getDigit:function(t,i){var a="ean8"==i?7:12;if((t=t.substring(0,a)).length!=a)return"";for(var r,n=0;n<t.length;n++)if((r=t.charAt(n))<"0"||r>"9")return"";t=this.compute(t,i);var o="101";if("ean8"==i){for(n=0;n<4;n++)o+=this.encoding[e.intval(t.charAt(n))][0];for(o+="01010",n=4;n<8;n++)o+=this.encoding[e.intval(t.charAt(n))][2]}else{var c=this.first[e.intval(t.charAt(0))];for(n=1;n<7;n++)o+=this.encoding[e.intval(t.charAt(n))][e.intval(c.charAt(n-1))];for(o+="01010",n=7;n<13;n++)o+=this.encoding[e.intval(t.charAt(n))][2]}return o+"101"},compute:function(t,a){var r="ean13"==a?12:7;t=t.substring(0,r);var n=0,o=!0;for(i=t.length-1;i>-1;i--)n+=(o?3:1)*e.intval(t.charAt(i)),o=!o;return t+((10-n%10)%10).toString()}},upc:{getDigit:function(t){return t.length<12&&(t="0"+t),e.ean.getDigit(t,"ean13")},compute:function(t){return t.length<12&&(t="0"+t),e.ean.compute(t,"ean13").substr(1)}},msi:{encoding:["100100100100","100100100110","100100110100","100100110110","100110100100","100110100110","100110110100","100110110110","110100100100","110100100110"],compute:function(t,i){return"object"==typeof i?("mod10"==i.crc1?t=this.computeMod10(t):"mod11"==i.crc1&&(t=this.computeMod11(t)),"mod10"==i.crc2?t=this.computeMod10(t):"mod11"==i.crc2&&(t=this.computeMod11(t))):"boolean"==typeof i&&i&&(t=this.computeMod10(t)),t},computeMod10:function(t){var i,a=t.length%2,r=0,n=0;for(i=0;i<t.length;i++)a?r=10*r+e.intval(t.charAt(i)):n+=e.intval(t.charAt(i)),a=!a;var o=(2*r).toString();for(i=0;i<o.length;i++)n+=e.intval(o.charAt(i));return t+((10-n%10)%10).toString()},computeMod11:function(t){for(var i=0,a=2,r=t.length-1;r>=0;r--)i+=a*e.intval(t.charAt(r)),a=7==a?2:a+1;return t+((11-i%11)%11).toString()},getDigit:function(t,e){var a=0,r="";for(t=this.compute(t,!1),r="110",i=0;i<t.length;i++){if((a="0123456789".indexOf(t.charAt(i)))<0)return"";r+=this.encoding[a]}return r+"1001"}},code11:{encoding:["101011","1101011","1001011","1100101","1011011","1101101","1001101","1010011","1101001","110101","101101"],getDigit:function(t){var i,e,a="";for(a="10110010",i=0;i<t.length;i++){if((e="0123456789-".indexOf(t.charAt(i)))<0)return"";a+=this.encoding[e]+"0"}var r=0,n=0,o=1,c=0;for(i=t.length-1;i>=0;i--)r=10==r?1:r+1,o=10==o?1:o+1,n+=r*(e="0123456789-".indexOf(t.charAt(i))),c+=o*e;var s=n%11,h=(c+=s)%11;return a+=this.encoding[s]+"0",t.length>=10&&(a+=this.encoding[h]+"0"),a+"1011001"}},code39:{encoding:["101001101101","110100101011","101100101011","110110010101","101001101011","110100110101","101100110101","101001011011","110100101101","101100101101","110101001011","101101001011","110110100101","101011001011","110101100101","101101100101","101010011011","110101001101","101101001101","101011001101","110101010011","101101010011","110110101001","101011010011","110101101001","101101101001","101010110011","110101011001","101101011001","101011011001","110010101011","100110101011","110011010101","100101101011","110010110101","100110110101","100101011011","110010101101","100110101101","100100100101","100100101001","100101001001","101001001001","100101101101"],getDigit:function(t){var i,e,a="";if(t.indexOf("*")>=0)return"";for(t=("*"+t+"*").toUpperCase(),i=0;i<t.length;i++){if((e="0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ-. $/+%*".indexOf(t.charAt(i)))<0)return"";i>0&&(a+="0"),a+=this.encoding[e]}return a}},code93:{encoding:["100010100","101001000","101000100","101000010","100101000","100100100","100100010","101010000","100010010","100001010","110101000","110100100","110100010","110010100","110010010","110001010","101101000","101100100","101100010","100110100","100011010","101011000","101001100","101000110","100101100","100010110","110110100","110110010","110101100","110100110","110010110","110011010","101101100","101100110","100110110","100111010","100101110","111010100","111010010","111001010","101101110","101110110","110101110","100100110","111011010","111010110","100110010","101011110"],getDigit:function(t,e){var a,r="0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ-. $/+%____*",n="";if(t.indexOf("*")>=0)return"";for(t=t.toUpperCase(),n+=this.encoding[47],i=0;i<t.length;i++){if(a=t.charAt(i),index=r.indexOf(a),"_"==a||index<0)return"";n+=this.encoding[index]}if(e){var o=0,c=0,s=1,h=0;for(i=t.length-1;i>=0;i--)o=20==o?1:o+1,s=15==s?1:s+1,index=r.indexOf(t.charAt(i)),c+=o*index,h+=s*index;var l=(h+=a=c%47)%47;n+=this.encoding[a],n+=this.encoding[l]}return(n+=this.encoding[47])+"1"}},code128:{encoding:["11011001100","11001101100","11001100110","10010011000","10010001100","10001001100","10011001000","10011000100","10001100100","11001001000","11001000100","11000100100","10110011100","10011011100","10011001110","10111001100","10011101100","10011100110","11001110010","11001011100","11001001110","11011100100","11001110100","11101101110","11101001100","11100101100","11100100110","11101100100","11100110100","11100110010","11011011000","11011000110","11000110110","10100011000","10001011000","10001000110","10110001000","10001101000","10001100010","11010001000","11000101000","11000100010","10110111000","10110001110","10001101110","10111011000","10111000110","10001110110","11101110110","11010001110","11000101110","11011101000","11011100010","11011101110","11101011000","11101000110","11100010110","11101101000","11101100010","11100011010","11101111010","11001000010","11110001010","10100110000","10100001100","10010110000","10010000110","10000101100","10000100110","10110010000","10110000100","10011010000","10011000010","10000110100","10000110010","11000010010","11001010000","11110111010","11000010100","10001111010","10100111100","10010111100","10010011110","10111100100","10011110100","10011110010","11110100100","11110010100","11110010010","11011011110","11011110110","11110110110","10101111000","10100011110","10001011110","10111101000","10111100010","11110101000","11110100010","10111011110","10111101110","11101011110","11110101110","11010000100","11010010000","11010011100","11000111010"],getDigit:function(t){var i=" !\"#$%&'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~",a="",r=0,n=0,o=0,c=0,s=0;for(o=0;o<t.length;o++)if(-1==i.indexOf(t.charAt(o)))return"";var h=t.length>1,l="";for(o=0;o<3&&o<t.length;o++)h&=(l=t.charAt(o))>="0"&&l<="9";for(r=h?105:104,a=this.encoding[r],o=0;o<t.length;){if(h)(o==t.length||t.charAt(o)<"0"||t.charAt(o)>"9"||t.charAt(o+1)<"0"||t.charAt(o+1)>"9")&&(h=!1,a+=this.encoding[100],r+=100*++n);else{for(c=0;o+c<t.length&&t.charAt(o+c)>="0"&&t.charAt(o+c)<="9";)c++;(h=c>5||o+c-1==t.length&&c>3)&&(a+=this.encoding[99],r+=99*++n)}h?(s=e.intval(t.charAt(o)+t.charAt(o+1)),o+=2):(s=i.indexOf(t.charAt(o)),o+=1),a+=this.encoding[s],r+=++n*s}return a+=this.encoding[r%103],(a+=this.encoding[106])+"11"}},codabar:{encoding:["101010011","101011001","101001011","110010101","101101001","110101001","100101011","100101101","100110101","110100101","101001101","101100101","1101011011","1101101011","1101101101","1011011011","1011001001","1010010011","1001001011","1010011001"],getDigit:function(t){var i,e,a="";for(a+=this.encoding[16]+"0",i=0;i<t.length;i++){if((e="0123456789-$:/.+".indexOf(t.charAt(i)))<0)return"";a+=this.encoding[e]+"0"}return a+this.encoding[16]}},datamatrix:{lengthRows:[10,12,14,16,18,20,22,24,26,32,36,40,44,48,52,64,72,80,88,96,104,120,132,144,8,8,12,12,16,16],lengthCols:[10,12,14,16,18,20,22,24,26,32,36,40,44,48,52,64,72,80,88,96,104,120,132,144,18,32,26,36,36,48],dataCWCount:[3,5,8,12,18,22,30,36,44,62,86,114,144,174,204,280,368,456,576,696,816,1050,1304,1558,5,10,16,22,32,49],solomonCWCount:[5,7,10,12,14,18,20,24,28,36,42,48,56,68,84,112,144,192,224,272,336,408,496,620,7,11,14,18,24,28],dataRegionRows:[8,10,12,14,16,18,20,22,24,14,16,18,20,22,24,14,16,18,20,22,24,18,20,22,6,6,10,10,14,14],dataRegionCols:[8,10,12,14,16,18,20,22,24,14,16,18,20,22,24,14,16,18,20,22,24,18,20,22,16,14,24,16,16,22],regionRows:[1,1,1,1,1,1,1,1,1,2,2,2,2,2,2,4,4,4,4,4,4,6,6,6,1,1,1,1,1,1],regionCols:[1,1,1,1,1,1,1,1,1,2,2,2,2,2,2,4,4,4,4,4,4,6,6,6,1,2,1,2,2,2],interleavedBlocks:[1,1,1,1,1,1,1,1,1,1,1,1,1,1,2,2,4,4,4,4,6,6,8,8,1,1,1,1,1,1],logTab:[-255,255,1,240,2,225,241,53,3,38,226,133,242,43,54,210,4,195,39,114,227,106,134,28,243,140,44,23,55,118,211,234,5,219,196,96,40,222,115,103,228,78,107,125,135,8,29,162,244,186,141,180,45,99,24,49,56,13,119,153,212,199,235,91,6,76,220,217,197,11,97,184,41,36,223,253,116,138,104,193,229,86,79,171,108,165,126,145,136,34,9,74,30,32,163,84,245,173,187,204,142,81,181,190,46,88,100,159,25,231,50,207,57,147,14,67,120,128,154,248,213,167,200,63,236,110,92,176,7,161,77,124,221,102,218,95,198,90,12,152,98,48,185,179,42,209,37,132,224,52,254,239,117,233,139,22,105,27,194,113,230,206,87,158,80,189,172,203,109,175,166,62,127,247,146,66,137,192,35,252,10,183,75,216,31,83,33,73,164,144,85,170,246,65,174,61,188,202,205,157,143,169,82,72,182,215,191,251,47,178,89,151,101,94,160,123,26,112,232,21,51,238,208,131,58,69,148,18,15,16,68,17,121,149,129,19,155,59,249,70,214,250,168,71,201,156,64,60,237,130,111,20,93,122,177,150],aLogTab:[1,2,4,8,16,32,64,128,45,90,180,69,138,57,114,228,229,231,227,235,251,219,155,27,54,108,216,157,23,46,92,184,93,186,89,178,73,146,9,18,36,72,144,13,26,52,104,208,141,55,110,220,149,7,14,28,56,112,224,237,247,195,171,123,246,193,175,115,230,225,239,243,203,187,91,182,65,130,41,82,164,101,202,185,95,190,81,162,105,210,137,63,126,252,213,135,35,70,140,53,106,212,133,39,78,156,21,42,84,168,125,250,217,159,19,38,76,152,29,58,116,232,253,215,131,43,86,172,117,234,249,223,147,11,22,44,88,176,77,154,25,50,100,200,189,87,174,113,226,233,255,211,139,59,118,236,245,199,163,107,214,129,47,94,188,85,170,121,242,201,191,83,166,97,194,169,127,254,209,143,51,102,204,181,71,142,49,98,196,165,103,206,177,79,158,17,34,68,136,61,122,244,197,167,99,198,161,111,222,145,15,30,60,120,240,205,183,67,134,33,66,132,37,74,148,5,10,20,40,80,160,109,218,153,31,62,124,248,221,151,3,6,12,24,48,96,192,173,119,238,241,207,179,75,150,1],champGaloisMult:function(t,i){return t&&i?this.aLogTab[(this.logTab[t]+this.logTab[i])%255]:0},champGaloisDoub:function(t,i){return t?i?this.aLogTab[(this.logTab[t]+i)%255]:t:0},champGaloisSum:function(t,i){return t^i},selectIndex:function(t,i){if((t<1||t>1558)&&!i)return-1;if((t<1||t>49)&&i)return-1;var e=0;for(i&&(e=24);this.dataCWCount[e]<t;)e++;return e},encodeDataCodeWordsASCII:function(t){var i,e,a=new Array,r=0;for(i=0;i<t.length;i++)(e=t.charCodeAt(i))>127?(a[r]=235,e-=127,r++):e>=48&&e<=57&&i+1<t.length&&t.charCodeAt(i+1)>=48&&t.charCodeAt(i+1)<=57?(e=10*(e-48)+(t.charCodeAt(i+1)-48),e+=130,i++):e++,a[r]=e,r++;return a},addPadCW:function(t,i,e){var a,r;if(!(i>=e))for(t[i]=129,r=i+1;r<e;r++)a=149*(r+1)%253+1,t[r]=(129+a)%254},calculSolFactorTable:function(t){var i,e,a=new Array;for(i=0;i<=t;i++)a[i]=1;for(i=1;i<=t;i++)for(e=i-1;e>=0;e--)a[e]=this.champGaloisDoub(a[e],i),e>0&&(a[e]=this.champGaloisSum(a[e],a[e-1]));return a},addReedSolomonCW:function(t,i,e,a,r){var n,o,c,s=0,h=t/r,l=new Array;for(c=0;c<r;c++){for(n=0;n<h;n++)l[n]=0;for(n=c;n<e;n+=r)for(s=this.champGaloisSum(a[n],l[h-1]),o=h-1;o>=0;o--)l[o]=s?this.champGaloisMult(s,i[o]):0,o>0&&(l[o]=this.champGaloisSum(l[o-1],l[o]));for(o=e+c,n=h-1;n>=0;n--)a[o]=l[n],o+=r}return a},getBits:function(t){for(var i=new Array,e=0;e<8;e++)i[e]=t&128>>e?1:0;return i},next:function(t,i,e,a,r,n){var o=0,c=4,s=0;do{c==i&&0==s?(this.patternShapeSpecial1(r,n,a[o],i,e),o++):t<3&&c==i-2&&0==s&&e%4!=0?(this.patternShapeSpecial2(r,n,a[o],i,e),o++):c==i-2&&0==s&&e%8==4?(this.patternShapeSpecial3(r,n,a[o],i,e),o++):c==i+4&&2==s&&e%8==0&&(this.patternShapeSpecial4(r,n,a[o],i,e),o++);do{c<i&&s>=0&&1!=n[c][s]&&(this.patternShapeStandard(r,n,a[o],c,s,i,e),o++),c-=2,s+=2}while(c>=0&&s<e);c+=1,s+=3;do{c>=0&&s<e&&1!=n[c][s]&&(this.patternShapeStandard(r,n,a[o],c,s,i,e),o++),c+=2,s-=2}while(c<i&&s>=0);c+=3,s+=1}while(c<i||s<e)},patternShapeStandard:function(t,i,e,a,r,n,o){this.placeBitInDatamatrix(t,i,e[0],a-2,r-2,n,o),this.placeBitInDatamatrix(t,i,e[1],a-2,r-1,n,o),this.placeBitInDatamatrix(t,i,e[2],a-1,r-2,n,o),this.placeBitInDatamatrix(t,i,e[3],a-1,r-1,n,o),this.placeBitInDatamatrix(t,i,e[4],a-1,r,n,o),this.placeBitInDatamatrix(t,i,e[5],a,r-2,n,o),this.placeBitInDatamatrix(t,i,e[6],a,r-1,n,o),this.placeBitInDatamatrix(t,i,e[7],a,r,n,o)},patternShapeSpecial1:function(t,i,e,a,r){this.placeBitInDatamatrix(t,i,e[0],a-1,0,a,r),this.placeBitInDatamatrix(t,i,e[1],a-1,1,a,r),this.placeBitInDatamatrix(t,i,e[2],a-1,2,a,r),this.placeBitInDatamatrix(t,i,e[3],0,r-2,a,r),this.placeBitInDatamatrix(t,i,e[4],0,r-1,a,r),this.placeBitInDatamatrix(t,i,e[5],1,r-1,a,r),this.placeBitInDatamatrix(t,i,e[6],2,r-1,a,r),this.placeBitInDatamatrix(t,i,e[7],3,r-1,a,r)},patternShapeSpecial2:function(t,i,e,a,r){this.placeBitInDatamatrix(t,i,e[0],a-3,0,a,r),this.placeBitInDatamatrix(t,i,e[1],a-2,0,a,r),this.placeBitInDatamatrix(t,i,e[2],a-1,0,a,r),this.placeBitInDatamatrix(t,i,e[3],0,r-4,a,r),this.placeBitInDatamatrix(t,i,e[4],0,r-3,a,r),this.placeBitInDatamatrix(t,i,e[5],0,r-2,a,r),this.placeBitInDatamatrix(t,i,e[6],0,r-1,a,r),this.placeBitInDatamatrix(t,i,e[7],1,r-1,a,r)},patternShapeSpecial3:function(t,i,e,a,r){this.placeBitInDatamatrix(t,i,e[0],a-3,0,a,r),this.placeBitInDatamatrix(t,i,e[1],a-2,0,a,r),this.placeBitInDatamatrix(t,i,e[2],a-1,0,a,r),this.placeBitInDatamatrix(t,i,e[3],0,r-2,a,r),this.placeBitInDatamatrix(t,i,e[4],0,r-1,a,r),this.placeBitInDatamatrix(t,i,e[5],1,r-1,a,r),this.placeBitInDatamatrix(t,i,e[6],2,r-1,a,r),this.placeBitInDatamatrix(t,i,e[7],3,r-1,a,r)},patternShapeSpecial4:function(t,i,e,a,r){this.placeBitInDatamatrix(t,i,e[0],a-1,0,a,r),this.placeBitInDatamatrix(t,i,e[1],a-1,r-1,a,r),this.placeBitInDatamatrix(t,i,e[2],0,r-3,a,r),this.placeBitInDatamatrix(t,i,e[3],0,r-2,a,r),this.placeBitInDatamatrix(t,i,e[4],0,r-1,a,r),this.placeBitInDatamatrix(t,i,e[5],1,r-3,a,r),this.placeBitInDatamatrix(t,i,e[6],1,r-2,a,r),this.placeBitInDatamatrix(t,i,e[7],1,r-1,a,r)},placeBitInDatamatrix:function(t,i,e,a,r,n,o){a<0&&(a+=n,r+=4-(n+4)%8),r<0&&(r+=o,a+=4-(o+4)%8),1!=i[a][r]&&(t[a][r]=e,i[a][r]=1)},addFinderPattern:function(t,i,e,a,r){var n=(a+2)*i,o=(r+2)*e,c=new Array;for(c[0]=new Array,h=0;h<o+2;h++)c[0][h]=0;for(var s=0;s<n;s++)for(c[s+1]=new Array,c[s+1][0]=0,c[s+1][o+1]=0,h=0;h<o;h++)s%(a+2)==0?c[s+1][h+1]=h%2==0?1:0:s%(a+2)==a+1?c[s+1][h+1]=1:h%(r+2)==r+1?c[s+1][h+1]=s%2==0?0:1:h%(r+2)==0?c[s+1][h+1]=1:(c[s+1][h+1]=0,c[s+1][h+1]=t[s-1-2*parseInt(s/(a+2))][h-1-2*parseInt(h/(r+2))]);c[n+1]=new Array;for(var h=0;h<o+2;h++)c[n+1][h]=0;return c},getDigit:function(t,i){var e=this.encodeDataCodeWordsASCII(t),a=e.length,r=this.selectIndex(a,i),n=this.dataCWCount[r],o=this.solomonCWCount[r],c=n+o,s=this.lengthRows[r],h=this.lengthCols[r],l=this.regionRows[r],g=this.regionCols[r],d=this.dataRegionRows[r],f=this.dataRegionCols[r],u=s-2*l,p=h-2*g,v=this.interleavedBlocks[r],m=o/v;this.addPadCW(e,a,n);var x=this.calculSolFactorTable(m);this.addReedSolomonCW(o,x,n,e,v);for(var b=new Array,D=0;D<c;D++)b[D]=this.getBits(e[D]);var A=new Array,I=new Array;for(D=0;D<p;D++)A[D]=new Array,I[D]=new Array;return u*p%8==4&&(A[u-2][p-2]=1,A[u-1][p-1]=1,A[u-1][p-2]=0,A[u-2][p-1]=0,I[u-2][p-2]=1,I[u-1][p-1]=1,I[u-1][p-2]=1,I[u-2][p-1]=1),this.next(0,u,p,b,A,I),this.addFinderPattern(A,l,g,d,f)}},lec:{cInt:function(t,i){for(var e="",a=0;a<i;a++)e+=String.fromCharCode(255&t),t>>=8;return e},cRgb:function(t,i,e){return String.fromCharCode(e)+String.fromCharCode(i)+String.fromCharCode(t)},cHexColor:function(t){var i=parseInt("0x"+t.substr(1)),e=255&i,a=255&(i>>=8),r=i>>8;return this.cRgb(r,a,e)}},hexToRGB:function(t){var i=parseInt("0x"+t.substr(1)),e=255&i;return{r:(i>>=8)>>8,g:255&i,b:e}},isHexColor:function(t){var i=new RegExp("#[0-91-F]","gi");return t.match(i)},base64Encode:function(t){for(var i,e,a,r,n,o,c,s="",h="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",l=0;l<t.length;)r=(i=t.charCodeAt(l++))>>2,n=(3&i)<<4|(e=t.charCodeAt(l++))>>4,o=(15&e)<<2|(a=t.charCodeAt(l++))>>6,c=63&a,isNaN(e)?o=c=64:isNaN(a)&&(c=64),s+=h.charAt(r)+h.charAt(n)+h.charAt(o)+h.charAt(c);return s},bitStringTo2DArray:function(t){var i=[];i[0]=[];for(var e=0;e<t.length;e++)i[0][e]=t.charAt(e);return i},resize:function(t,i){return t.css("padding","0px").css("overflow","auto").html(""),t},digitToBmpRenderer:function(t,i,e,a,r,n){var o=e.length,c=e[0].length,s=0,h=this.isHexColor(i.bgColor)?this.lec.cHexColor(i.bgColor):this.lec.cRgb(255,255,255),l=this.isHexColor(i.color)?this.lec.cHexColor(i.color):this.lec.cRgb(0,0,0),g="",d="";for(s=0;s<r;s++)g+=h,d+=l;var f=(4-r*c*3%4)%4,u=(r*c+f)*n*o,p="";for(s=0;s<f;s++)p+="\0";for(var v="BM"+this.lec.cInt(54+u,4)+"\0\0\0\0"+this.lec.cInt(54,4)+this.lec.cInt(40,4)+this.lec.cInt(r*c,4)+this.lec.cInt(n*o,4)+this.lec.cInt(1,2)+this.lec.cInt(24,2)+"\0\0\0\0"+this.lec.cInt(u,4)+this.lec.cInt(2835,4)+this.lec.cInt(2835,4)+this.lec.cInt(0,4)+this.lec.cInt(0,4),m=o-1;m>=0;m--){for(var x="",b=0;b<c;b++)x+="0"==e[m][b]?g:d;x+=p;for(var D=0;D<n;D++)v+=x}var A=document.createElement("object");A.setAttribute("type","image/bmp"),A.setAttribute("data","data:image/bmp;base64,"+this.base64Encode(v)),this.resize(t,r*c+f).append(A)},digitToBmp:function(t,i,a,r){var n=e.intval(i.barWidth),o=e.intval(i.barHeight);this.digitToBmpRenderer(t,i,this.bitStringTo2DArray(a),r,n,o)},digitToBmp2D:function(t,i,a,r){var n=e.intval(i.moduleSize);this.digitToBmpRenderer(t,i,a,r,n,n)},digitToCssRenderer:function(t,i,e,a,r,n){var o=e.length,c=e[0].length,s="",h='<div style="float: left; font-size: 0px; background-color: '+i.bgColor+"; height: "+n+'px; width: &Wpx"></div>',l='<div style="float: left; font-size: 0px; width:0; border-left: &Wpx solid '+i.color+"; height: "+n+'px;"></div>';s+='<div class="label_lines">';for(var g,d,f=0;f<o;f++){g=0,d=e[f][0];for(var u=0;u<c;u++)d==e[f][u]?g++:(s+=("0"==d?h:l).replace("&W",g*r),d=e[f][u],g=1);g>0&&(s+=("0"==d?h:l).replace("&W",g*r))}s+="</div>",1==i.showCode&&(s+='<div style="clear:both; width: 100%; background-color: '+i.bgColor+"; color: "+i.color+"; text-align: center; font-size: "+i.fontSize+'px;">'+a+"</div>"),this.resize(t,r*c).html(s)},digitToCss:function(t,i,a,r){var n=e.intval(i.barWidth),o=e.intval(i.barHeight);this.digitToCssRenderer(t,i,this.bitStringTo2DArray(a),r,n,o)},digitToCss2D:function(t,i,a,r){var n=e.intval(i.moduleSize);this.digitToCssRenderer(t,i,a,r,n,n)},digitToSvgRenderer:function(t,i,a,r,n,o){var c=a.length,s=a[0].length,h=n*s,l=o*c;if(i.showHRI){var g=e.intval(i.fontSize);l+=e.intval(i.marginHRI)+g}var d='<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="'+h+'" height="'+l+'">';d+='<rect width="'+h+'" height="'+l+'" x="0" y="0" fill="'+i.bgColor+'" />';for(var f,u,p='<rect width="&W" height="'+o+'" x="&X" y="&Y" fill="'+i.color+'" />',v=0;v<c;v++){f=0,u=a[v][0];for(var m=0;m<s;m++)u==a[v][m]?f++:("1"==u&&(d+=p.replace("&W",f*n).replace("&X",(m-f)*n).replace("&Y",v*o)),u=a[v][m],f=1);f>0&&"1"==u&&(d+=p.replace("&W",f*n).replace("&X",(s-f)*n).replace("&Y",v*o))}i.showHRI&&(d+='<g transform="translate('+Math.floor(h/2)+' 0)">',d+='<text y="'+(l-Math.floor(g/2))+'" text-anchor="middle" style="font-family: Arial; font-size: '+g+'px;" fill="'+i.color+'">'+r+"</text>",d+="</g>"),d+="</svg>";var x=document.createElement("object");x.setAttribute("type","image/svg+xml"),x.setAttribute("data","data:image/svg+xml,"+d),this.resize(t,h).append(x)},digitToSvg:function(t,i,a,r){var n=e.intval(i.barWidth),o=e.intval(i.barHeight);this.digitToSvgRenderer(t,i,this.bitStringTo2DArray(a),r,n,o)},digitToSvg2D:function(t,i,a,r){var n=e.intval(i.moduleSize);this.digitToSvgRenderer(t,i,a,r,n,n)},digitToCanvasRenderer:function(t,i,e,a,r,n,o,c){var s=t.get(0);if(s&&s.getContext){var h=e.length,l=e[0].length,g=s.getContext("2d");g.lineWidth=1,g.lineCap="butt",g.fillStyle=i.bgColor,g.fillRect(r,n,l*o,h*c),g.fillStyle=i.color;for(var d=0;d<h;d++){for(var f=0,u=e[d][0],p=0;p<l;p++)u==e[d][p]?f++:("1"==u&&g.fillRect(r+(p-f)*o,n+d*c,o*f,c),u=e[d][p],f=1);f>0&&"1"==u&&g.fillRect(r+(l-f)*o,n+d*c,o*f,c)}if(i.showHRI){var v=g.measureText(a);g.fillText(a,r+Math.floor((l*o-v.width)/2),n+h*c+i.fontSize+i.marginHRI)}}},digitToCanvas:function(t,i,a,r){var n=e.intval(i.barWidth),o=e.intval(i.barHeight),c=e.intval(i.posX),s=e.intval(i.posY);this.digitToCanvasRenderer(t,i,this.bitStringTo2DArray(a),r,c,s,n,o)},digitToCanvas2D:function(t,i,a,r){var n=e.intval(i.moduleSize),o=e.intval(i.posX),c=e.intval(i.posY);this.digitToCanvasRenderer(t,i,a,r,o,c,n,n)}};t.fn.extend({barcode:function(i,a,r){var n="",o="",c="",s=!0,h=!1,l=!1;if("string"==typeof i?c=i:"object"==typeof i&&(c="string"==typeof i.code?i.code:"",s=void 0===i.crc||i.crc,h=void 0!==i.rect&&i.rect),""==c)return!1;void 0===r&&(r=[]);for(var g in e.settings)void 0==r[g]&&(r[g]=e.settings[g]);switch(a){case"std25":case"int25":n=e.i25.getDigit(c,s,a),o=e.i25.compute(c,s,a);break;case"ean8":case"ean13":n=e.ean.getDigit(c,a),o=e.ean.compute(c,a);break;case"upc":n=e.upc.getDigit(c),o=e.upc.compute(c);break;case"code11":n=e.code11.getDigit(c),o=c;break;case"code39":n=e.code39.getDigit(c),o=c;break;case"code93":n=e.code93.getDigit(c,s),o=c;break;case"code128":n=e.code128.getDigit(c),o=c;break;case"codabar":n=e.codabar.getDigit(c),o=c;break;case"msi":n=e.msi.getDigit(c,s),o=e.msi.compute(c,s);break;case"datamatrix":n=e.datamatrix.getDigit(c,h),o=c,l=!0}if(0==n.length)return t(this);!l&&r.addQuietZone&&(n="0000000000"+n+"0000000000");var d=t(this),f="digitTo"+r.output.charAt(0).toUpperCase()+r.output.substr(1)+(l?"2D":"");return"function"==typeof e[f]&&e[f](d,r,n,o),d}})}(jQuery);