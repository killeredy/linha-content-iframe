<?php


function iframe_submenu_page_callback()
{
    la_content_iframe_zip_upload();
    la_content_iframe_remove_zip();
    
    $list = get_option(LA_C_IFRAME_OPTION);
?>
    <div class="wrap">
        <h2>Upload ZIP File</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="zip_file" accept=".zip">
            <input type="submit" name="upload" class="button button-primary" value="Upload">
        </form>
    </div>

    <?php dprint($_POST) ?>



    <div class="wrap">
        <h2>Files List</h2>
        <form method="post" enctype="multipart/form-data">
        <?php if( is_array($list) && !empty($list)  ): ?>
             <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th class="manage-column column-primary">File</th>
                        <th>path</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($list  as $value ): ?>
                        <tr>
                            <td> <?php echo $value ?> </td>
                            <td> <?php echo LA_C_IFRAME_UPLOAD_PATH .  "/" . $value ?></td>
                            <td> <button type="submit" value="<?=  $value ?>" name="remove-iframe" onclick="removeDestaque('<?=  $value ?>')" >Remove</button> </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else:?>
            <h2>Sem Destaque cadastrados</h2>
        <?php endif; ?>
        </form>
    </div>

    <script>
        function removeDestaque($iframe){
              let text = "Deseja apagar este iframe?";
            if (!confirm(text)) {
                return;
            } 

        }

    </script>

<?php
}
