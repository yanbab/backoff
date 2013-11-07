<?php
//
// Color Plugin
//

class colorPlugin extends Plugin {
    
    const description = 'Color chooser';
    
    function getHtml($field,$value='') {

        global $init_color_js;

        if(!$value) {
            $value = '#ffffff';
        }

        if(!$init_color_js) {
            // Include JS code
            $html .= '
                <script type="text/javascript" src="' . url_base() . 'plugins/color/colorpicker/farbtastic.js"></script>
                <link rel="stylesheet" href="' . url_base() . 'plugins/color/colorpicker/farbtastic.css" type="text/css" />';
            $init_color_js = true;
        }

        $html .= "<div id=\"" . Plugin::prefix . "colorpicker_$field[id]\"></div>";
        $html .= parent::getHtml($field,$value);
        $html .= "
          <script type=\"text/javascript\">
            $(function() {
              $('#" . Plugin::prefix . "colorpicker_$field[id]').farbtastic('#" . Plugin::prefix . "$field[id]');
            });
          </script>
        ";
        return $html;
    }
  
    function prepForDisplay($field,$value='') {
        $hsl = colorPlugin::rgb2hsl(colorPlugin::hex2rgb($value));
        ($hsl[2]>0.5) ? $color = '#000' : $color = '#FFF';
        $html = "<div style=\"background-color:$value;border : solid black 1px; display:inline; padding : 0 4px; color: $color; font-family: monospace;\">$value</div>";
        return $html;
    }

    //
    // Helper functions
    //

    function hex2rgb($hexa) {
        $r = hexdec(substr($hexa, 1, 2));
        $g = hexdec(substr($hexa, 3, 2));
        $b = hexdec(substr($hexa, 5, 2));
        return array($r,$g,$b);
    }  
  
    function rgb2hsl($rgb){
        $clrR = ($rgb[0]);
        $clrG = ($rgb[1]);
        $clrB = ($rgb[2]);
        $clrMin = min($clrR, $clrG, $clrB);
        $clrMax = max($clrR, $clrG, $clrB);
        $deltaMax = $clrMax - $clrMin;
        $L = ($clrMax + $clrMin) / 510;
        if (0 == $deltaMax){
            $H = 0;
            $S = 0;
        }
        else{
            if (0.5 > $L){
                $S = $deltaMax / ($clrMax + $clrMin);
            }
            else{
                $S = $deltaMax / (510 - $clrMax - $clrMin);
            }
            if ($clrMax == $clrR) {
                $H = ($clrG - $clrB) / (6.0 * $deltaMax);
            }
            else if ($clrMax == $clrG) {
                $H = 1/3 + ($clrB - $clrR) / (6.0 * $deltaMax);
            }
            else {
                $H = 2 / 3 + ($clrR - $clrG) / (6.0 * $deltaMax);
            }
            if (0 > $H) $H += 1;
            if (1 < $H) $H -= 1;
        }
        return array($H, $S,$L);
    } 
 
}


