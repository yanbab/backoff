<?php
class filePlugin extends Plugin {
  
    const description    = 'File Upload';
    const folder = '../documents';
    
    function preUpdateHook($field,$value) {

        global $_FILES,$errors;

        // Target folder
        $folder = filePlugin::_getFolder($field);

        // delete the file     
        if($_POST[Plugin::prefix . $field['id'] . '_upload_delete']) {
            if(file_exists($folder . $value)) {
                if(!@unlink($folder . $value)) {
                    $error = lang('Can\'t delete file');
                }
            }        
            $_POST[Plugin::prefix . $field['id']] = '';
            
        }

        $file_info = $_FILES[Plugin::prefix . $field['id'] . '_upload'];
        if(!$file_info[error]) {
          $_POST[Plugin::prefix . $field['id']] = $file_info['name']; // we save the new name

          if(@move_uploaded_file($file_info['tmp_name'], $folder . $file_info['name'])) {
              //OK
              filePlugin::_resizeImage($folder . $file_info['name'], $field['options']['resize_width'], $field['options']['resize_height']);
              return true;
          } else {
            $errors[$field[id]] = "Can't copy '<em>$file_info[name]</em>' to '<em>$folder</em>'.<br>";
            if(!file_exists($folder)) {
              $errors[$field[id]] .= "Folder '<em>$folder</em>' doesn't exists.<br>";
            } else if(!is_writable($folder)) {
              $errors[$field[id]] .= "Folder '<em>$folder</em>' is not writable.<br>";            
            }
           
            
            return false;
          }

        } else {
            if($file_info[error]!='4') {
                // No file
                return true;
            } else {
                // Error
                return false;
            }
        }
    }

    
    function getHtml($field, $value) {
        // Store the filename in an hidden field
        $field['type'] = 'hidden';
        $html = plugin::getHtml($field,$value);
        
        // File input
        $field['type'] = 'file';
        $name =  Plugin::prefix . $field['id'];
        $field['id'] .= '_upload';
        $html .= plugin::getHtml($field,$value);
        
        // Link to file & delete checkbox
        if($value) {
            
            $path = filePlugin::_getFolder($field) . $value;

            if (!file_exists($path)) {
              $display =  '<div class="error">'. lang('File not found : <em>')  .$value .  '</em></div>';
            } else {
              $href = url_base() . $path;
              $size = '(' . filePlugin::_humanSize(filesize($path));
            
              if($isize = @getimagesize($path)) {
                $size .= ", $isize[0]x$isize[1]px";
              }
              $size .= ')';
              $display = "<a class='_blank' href=\"$href\">" . filePlugin::prepForDisplay($field, $value)  . "$value</A> $size<br>";
            }
            
            $html =  $display  . $html
                . '<div style="line-height:1.7em"><label for=""><input name="'
                . $name
                . '_upload_delete" type="checkbox" > ' 
                . lang('Delete file') 
                . '</div>';
        }

        return $html;    
    }
    
    function _getHTMLbase() {
    
    }
    
    function prepForDisplay($field, $value) {
        if($value) {
            //$html = parent::prepForDisplay($field,$value);
            // Add link to file
            $path = filePlugin::_getFolder($field) . $value;
            $href = url_base() . $path;
            //$size = filePlugin::_humanSize(filesize($path));
            if (!file_exists($path)) {
              return '<div class="error">'. lang('File not found : <em>')  .$value .  '</em></div>';
            }
            if($image = @getimagesize($path)) {
              
              $html .=  "<img src=\"$href\" alt=\"$value\" style=\"max-width:80px;max-height:64px;float:left;margin-right:6px;background:#fff;border:#000 solid 1px;\" >";
            } else {
              $html .= $value;
            }
            return $html;
        }
    }
    
    function _getFolder($field) {
        if(!$field['options']['folder']) {
            $folder = filePlugin::folder;
        } else {
            $folder = $field['options']['folder'];
        }
        // Add trailing slash to folder 
        if(substr($folder,-1)!='/') $folder .= '/';

        return $folder;
    }
    
    function _humanSize($size) {
         // Adapted from: http://www.php.net/manual/en/function.filesize.php
        $mod = 1024;
        $units = explode(' ','o k  m  G  T  P ');
        for ($i = 0; $size > $mod; $i++) {
            $size /= $mod;
        }
        return round($size, 1) . '' . $units[$i];
    }
    
    function _resizeImage($image,$w,$h) {
      if(!@getimagesize($image)) {
        return false;
      }
      $image = new Image($image);
      if($w&&$h) {
        $image->resize($w,$h);
        $image->save();
        return true;
      }    
      if($w) {
        $image->resizeToWidth($w);
        $image->save();
        return true;
      }    
      if($h) {
        $image->resizeToHeight($h);
        $image->save();
        return true;
      }    
    
    }
    
}


// Image

class Image {
   
   var $image;
   var $image_type;
   var $filename;
 
   function Image($filename='') {
    if($filename) {
      $this->load($filename);
    }
   }
 
   function load($filename) {
      $this->filename = $filename;
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
         $this->image = imagecreatefrompng($filename);
      }
   }
   function save($filename=null, $image_type=IMAGETYPE_JPEG, $compression=90, $permissions=null) {
      if($filename==null) {
        $filename = $this->filename;
      }
      if($image_type==null) {
        $image_type = $this->image_type;
      }
      if($image_type==null) {
        $image_type = IMAGETYPE_JPEG;
      }
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image,$filename);         
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagealphablending($this->image, false);
          imagesavealpha($this->image, true);
         imagepng($this->image,$filename);
         
      }   
      if( $permissions != null) {
         chmod($filename,$permissions);
      }
   }
   function output($image_type=IMAGETYPE_JPEG) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image);         
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image);
      }   
   }
   function getWidth() {
      return imagesx($this->image);
   }
   function getHeight() {
      return imagesy($this->image);
   }
   function resizeToHeight($height) {
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100; 
      $this->resize($width,$height);
   }
   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
   
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;   
   }      
}





