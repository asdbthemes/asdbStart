<tr class="form-field">
<?php $inputType = 'image'; ?>
<?php $inputName = 'tax_flag'; ?>
<?php $inputTitle = 'Флаг'; ?>
<?php $inputDescription = 'Загрузите изображение'; ?>
<?php $current_image_url = get_term_meta( $term->term_id, $inputName, true); ?>
<script type="text/javascript">

jQuery(document).ready(function() {
	var InputText = '';
	jQuery('#uploadImage_<?php echo str_replace(' ','_',$inputName); ?>').click(function() {
//		InputText = jQuery('#asdb_<?php echo str_replace(' ','_',$inputName); ?>');
		tb_show('Загрузить', 'media-upload.php?type=image&TB_iframe=true');
		return false;
	});
//	window.original_send_to_editor = window.send_to_editor;
	window.send_to_editor = function(html){
		InputText_<?php echo str_replace(' ','_',$inputName); ?> = jQuery('#asdb_<?php echo str_replace(' ','_',$inputName); ?>');
        editorContents = html || '';
        tb_remove();
        edCanvas_temp.value = html;
        var extractedImageUrl = edCanvas_temp.value.match(/img src=\"(.*?)\"/g)[0].split(/img src=\"(.*?)\"/g)[1];
        imageUrl = extractedImageUrl.replace(/-[0-9][0-9][0-9]x[0-9][0-9][0-9]\./i, '.');
		InputText_<?php echo str_replace(' ','_',$inputName); ?>.val(imageUrl);
//	    console.log(window.send_to_editor);
//		if (InputText) {
//			InputURL = jQuery('img',html).attr('src');
//			InputText.val(InputURL);
//			tb_remove();
//		} else {
//			window.original_send_to_editor(html);
//		}
	};
});
</script>

	<th scope="row" valign="top">
        <label for="<?php echo "asdb_".str_replace(' ','_',$inputName);?>" class="asdb_meta_name_label"><?php echo $inputTitle;?></label>
	</th>
	<td>
        <div id="<?php echo "asdb_".str_replace(' ','_',$inputName);?>_selected_image" class="asdb_selected_image">
            <?php if ($current_image_url != '') echo '<img src="'.$current_image_url.'" style="max-width:100%;"/>';?>
        </div>
        <input type="regular-text" name="<?php echo "asdb_".str_replace(' ','_',$inputName);?>" id="<?php echo "asdb_".str_replace(' ','_',$inputName);?>" value="<?php echo $current_image_url;?>" />
        <input type='button' class="button-primary" value="Upload Image" id="uploadImage_<?php echo str_replace(' ','_',$inputName); ?>"/>
		<br />
		<span class="description"><?php echo $inputDescription; ?></span>
   </td>
</tr>





<tr class="form-field">
<?php $inputType = 'image'; ?>
<?php $inputName = 'title_background'; ?>
<?php $inputTitle = 'Фон заголовка'; ?>
<?php $inputDescription = 'Загрузите изображение'; ?>
<?php $current_image_url = get_term_meta( $term->term_id, $inputName, true); ?>
<script type="text/javascript">

jQuery(document).ready(function() {
	var InputText = '';
	jQuery('#uploadImage_<?php echo str_replace(' ','_',$inputName); ?>').click(function() {
//		InputText = jQuery('#asdb_<?php echo str_replace(' ','_',$inputName); ?>');
		tb_show('Загрузить', 'media-upload.php?type=image&TB_iframe=true');
		return false;
	});
//	window.original_send_to_editor = window.send_to_editor;
	window.send_to_editor = function(html){
		InputText_<?php echo str_replace(' ','_',$inputName); ?> = jQuery('#asdb_<?php echo str_replace(' ','_',$inputName); ?>');
        editorContents = html || '';
        tb_remove();
        edCanvas_temp.value = html;
        var extractedImageUrl = edCanvas_temp.value.match(/img src=\"(.*?)\"/g)[0].split(/img src=\"(.*?)\"/g)[1];
        imageUrl = extractedImageUrl.replace(/-[0-9][0-9][0-9]x[0-9][0-9][0-9]\./i, '.');
		InputText_<?php echo str_replace(' ','_',$inputName); ?>.val(imageUrl);
//	    console.log(window.send_to_editor);
//		if (InputText) {
//			InputURL = jQuery('img',html).attr('src');
//			InputText.val(InputURL);
//			tb_remove();
//		} else {
//			window.original_send_to_editor(html);
//		}
	};
});
</script>

	<th scope="row" valign="top">
        <label for="<?php echo "asdb_".str_replace(' ','_',$inputName);?>" class="asdb_meta_name_label"><?php echo $inputTitle;?></label>
	</th>
	<td>
        <div id="<?php echo "asdb_".str_replace(' ','_',$inputName);?>_selected_image" class="asdb_selected_image">
            <?php if ($current_image_url != '') echo '<img src="'.$current_image_url.'" style="max-width:100%;"/>';?>
        </div>
        <input type="regular-text" name="<?php echo "asdb_".str_replace(' ','_',$inputName);?>" id="<?php echo "asdb_".str_replace(' ','_',$inputName);?>" value="<?php echo $current_image_url;?>" />
        <input type='button' class="button-primary" value="Upload Image" id="uploadImage_<?php echo str_replace(' ','_',$inputName); ?>"/>
		<br />
		<span class="description"><?php echo $inputDescription; ?></span>
   </td>
</tr>













	<th scope="row" valign="top">
        <label for="<?php echo "asdb_".str_replace(' ','_',$inputName);?>" class="asdb_meta_name_label"><?php echo $inputTitle;?></label>
	</th>
	<td>
        <div id="<?php echo "asdb_".str_replace(' ','_',$inputName);?>_selected_image" class="asdb_selected_image">
            <?php if ($current_image_url != '') echo '<img src="'.$current_image_url.'" style="max-width:100%;"/>';?>
        </div>
        <input type="regular-text" name="<?php echo "asdb_".str_replace(' ','_',$inputName);?>" id="<?php echo "asdb_".str_replace(' ','_',$inputName);?>" value="<?php echo $current_image_url;?>" />
        <a href="media-upload.php?type=image&#038;asdb_send_label=<?php echo str_replace(' ','_',$inputName); ?>&#038;TB_iframe=1&#038;tab=library&#038;height=500&#038;width=640" onclick="image_photo_url_add('<?php echo "asdb_".str_replace(' ','_',$inputName);?>')" class="thickbox" title="Add an Image">
        <input type='button' class="button-primary" value="Upload Image" id="uploadImage_<?php echo $inputName;?>"/>
		</a>
		<br />
		<span class="description"><?php echo $inputDescription; ?></span>
		<br />

    </td>



<tr class="form-field">
<?php $inputType = 'image'; ?>
<?php $inputName = 'title_background'; ?>
<?php $inputTitle = 'Фон заголовка'; ?>
<?php $inputDescription = 'Загрузите изображение'; ?>
<?php $current_image_url = get_term_meta( $term->term_id, $inputName, true); ?>

	<td>
<div id="asdb_upload_image_thumb" class="asdb-file">
	<?php if ($current_image_url != '') echo '<img src="'.$current_image_url.'" style="max-width:100%;"/>';?>
</div>
	<input id="asdb_upload_image" type="regular-text" size="36" name="asdb_upload_image" value="" class="asdb_text asdb-file" />
	<input id="asdb_upload_image_button" type="button" value="Upload Image" class="button-primary" />


    </td>
</tr>




jQuery.noConflict();
jQuery(document).ready(function ($) {

	jQuery('#asdb_upload_image_button').click(function() {
	 	formfield = jQuery('#asdb_upload_image').attr('name');
	 	tb_show('', 'media-upload.php?type=image&TB_iframe=true');
	 	return false;
	});

	window.send_to_editor = function(html) {
	 imgurl = jQuery('img',html).attr('src');
	 //consolelog(imgurl);
	 jQuery('#asdb_upload_image').val(imgurl);
	 tb_remove();

	 jQuery('#asdb_upload_image_thumb').html("<img height='65' src='"+imgurl+"'/>");
	}

});


<tr>

<?php $inputType = 'image'; ?>
<?php $inputName = 'tax_flag'; ?>
<?php $inputTitle = 'Флаг'; ?>
<?php $inputDescription = 'Загрузите изображение'; ?>
<?php $current_image_url = get_term_meta( $term->term_id, $inputName, true); ?>

<tr class="form-field">
	<th scope="row" valign="top">
        <label for="<?php echo "asdb_".str_replace(' ','_',$inputName);?>" class="asdb_meta_name_label"><?php echo $inputTitle;?></label>
	</th>
	<td>
        <div id="<?php echo "asdb_".str_replace(' ','_',$inputName);?>_selected_image" class="asdb_selected_image">
            <?php if ($current_image_url != '') echo '<img src="'.$current_image_url.'" style="max-width:100%;"/>';?>
        </div>
        <input type="regular-text" name="<?php echo "asdb_".str_replace(' ','_',$inputName);?>" id="<?php echo "asdb_".str_replace(' ','_',$inputName);?>" value="<?php echo $current_image_url;?>" />
        <a href="media-upload.php?type=image&#038;asdb_send_label=<?php echo str_replace(' ','_',$inputName); ?>&#038;TB_iframe=1&#038;tab=library&#038;height=500&#038;width=640" onclick="image_photo_url_add('<?php echo "asdb_".str_replace(' ','_',$inputName);?>')" class="thickbox" title="Add an Image">
        <input type='button' class="button-primary" value="Upload Image" id="uploadImage_<?php echo $inputName;?>"/>
		</a>
		<br />
		<span class="description"><?php echo $inputDescription; ?></span>
		<br />

    </td>
</tr>



	<th scope="row" valign="top">
        <label for="<?php echo "asdb_".str_replace(' ','_',$inputName);?>" class="asdb_meta_name_label"><?php echo $inputTitle;?></label>
	</th>
	<td>
        <div id="<?php echo "asdb_".str_replace(' ','_',$inputName);?>_selected_image" class="asdb_selected_image">
            <?php if ($current_image_url != '') echo '<img src="'.$current_image_url.'" style="max-width:100%;"/>';?>
        </div>
        <input type="regular-text" name="<?php echo "asdb_".str_replace(' ','_',$inputName);?>" id="<?php echo "asdb_".str_replace(' ','_',$inputName);?>" value="<?php echo $current_image_url;?>" />
        <a href="media-upload.php?type=image&#038;asdb_send_label=<?php echo str_replace(' ','_',$inputName); ?>&#038;TB_iframe=1&#038;tab=library&#038;height=500&#038;width=640" onclick="image_photo_url_add('<?php echo "asdb_".str_replace(' ','_',$inputName);?>')" class="thickbox" title="Add an Image">
        <input type='button' class="button-primary" value="Upload Image" id="uploadImage_<?php echo $inputName;?>"/>
		</a>
		<br />
		<span class="description"><?php echo $inputDescription; ?></span>
		<br />
