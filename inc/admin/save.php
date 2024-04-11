<?php


// Function to handle form submission
function la_content_iframe_zip_upload()
{
    if (isset($_POST['upload'])) {
        if (!empty($_FILES['zip_file']['name'])) {
            WP_Filesystem();
            $uploaded_file = $_FILES['zip_file'];
            $upload_dir = LA_C_IFRAME_UPLOAD_PATH;
            $name = sanitize_title($uploaded_file['name']);
            $name = str_replace("-zip", "", $name);
            $upload_file_content = $upload_dir . "/" . $name;

            if (!is_dir($upload_dir)) {
                mkdir($upload_dir);
            }

            if (!is_dir($upload_file_content)) {
                mkdir($upload_file_content);
            }

            $zip_path = $upload_dir . '/' . $uploaded_file['name'];

            if( move_uploaded_file($uploaded_file['tmp_name'], $zip_path) ){


                $unzip = unzip_file($zip_path, $upload_file_content);   

                
                if (is_wp_error($unzip)) {
                     la_content_iframe_show_msg(false,  $unzip->get_error_message());
                } else {
                    la_content_iframe_save_data($name);
                    la_content_iframe_show_msg(true, 'ZIP file uploaded and extracted successfully.');
                }
    
                unlink($zip_path);

            }else{
                la_content_iframe_show_msg(false, 'Error fazer upload');
            }

        } else {
            la_content_iframe_show_msg(false, 'Please select a ZIP file to upload.');
        }
    }
}

function la_content_iframe_remove_zip(){
    if (isset($_POST['remove-iframe'])) {
        $name =  $_POST['remove-iframe'];
        $zip_path =  LA_C_IFRAME_UPLOAD_PATH . '/' . $name;
        $success_msg =  "Destaque apagado com sucesso";
        $erro_msg =  "Erro ao apagar iframe";
        
        if (is_dir($zip_path)) {
            require_once ( ABSPATH . 'wp-admin/includes/class-wp-filesystem-base.php' );
            require_once ( ABSPATH . 'wp-admin/includes/class-wp-filesystem-direct.php' );
            $fileSystemDirect = new WP_Filesystem_Direct(false);
            $success  =  $fileSystemDirect->rmdir($zip_path, true);

            dprint([$success]);

       
            if($success){
                la_content_iframe_remove_data($name);
                la_content_iframe_show_msg(true, $success_msg);  
            }else{
                la_content_iframe_show_msg(false, $erro_msg);  
            }


        }else{
            la_content_iframe_show_msg(false, $erro_msg );

        }


        
    }
}

function la_content_iframe_save_data($name)
{
    $list = get_option(LA_C_IFRAME_OPTION);
    if (!is_array($list)) {
        $list = array();
    }

    $list[] = $name;
    update_option(LA_C_IFRAME_OPTION, $list);
}

function la_content_iframe_remove_data($name)
{
    $list = get_option(LA_C_IFRAME_OPTION);
    if (!is_array($list)) {
        $list = array();
        update_option(LA_C_IFRAME_OPTION, $list);
        return;
    }

    $new_list = array_filter($list, function($item) use ($name) {
        $zip_path =  LA_C_IFRAME_UPLOAD_PATH .  "/" .  $item;
        return $item != $name &&  is_dir($zip_path) ;
    });

}


function la_content_iframe_show_msg($success, $msg){
     if ($success) {
         echo '<div class="updated"><p>'.  $msg .'</p></div>';
    } else {
        echo '<div class="error"><p>Error: ' .$msg . '</p></div>';
    }
}