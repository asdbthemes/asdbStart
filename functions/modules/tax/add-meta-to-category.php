<?php
// Edit term page
function asdb_category_add_meta_columns($term) {

?>


<tr class="form-field">
<th scope="row" valign="top">
	<label for="fslider"><?php _e( 'Featured Slider', 'asdbBase' ); ?></label>
</th>
	<td>

	<select name="fslider" id="fslider" class="option-tree-ui-select ">
		<option <?php if (esc_attr( get_term_meta( $term->term_id, 'fslider', true ) )==0 ) {echo 'selected="selected"';} ?> value="0">No</option>
		<option <?php if (esc_attr( get_term_meta( $term->term_id, 'fslider', true ) )==1 ) {echo 'selected="selected"';} ?> value="1">Style 1</option>
	</select>
		<p class="description"><?php _e( 'Show Featured slider for category','asdbBase' ); ?></p>
	</td>
</tr>

<tr class="form-field">
<th scope="row" valign="top">
	<label for="cat_col"><?php _e( 'Columns number', 'asdbBase' ); ?></label>
</th>
	<td>

	<select name="cat_col" id="cat_col" class="option-tree-ui-select ">
		<option <?php if (esc_attr( get_term_meta( $term->term_id, 'cat_col', true ) )==0 ) {echo 'selected="selected"';} ?> value="0">Global Settings</option>
		<option <?php if (esc_attr( get_term_meta( $term->term_id, 'cat_col', true ) )==1 ) {echo 'selected="selected"';} ?> value="1">One columns</option>
		<option <?php if (esc_attr( get_term_meta( $term->term_id, 'cat_col', true ) )==2 ) {echo 'selected="selected"';} ?> value="2">Two columns</option>
		<option <?php if (esc_attr( get_term_meta( $term->term_id, 'cat_col', true ) )==3 ) {echo 'selected="selected"';} ?> value="3">Three columns</option>
	</select>
		<p class="description"><?php _e( 'Select number columns','asdbBase' ); ?></p>
	</td>
</tr>

<tr class="form-field">
<th scope="row" valign="top">
	<label for="cat_style"><?php _e( 'Style', 'asdbBase' ); ?></label>
</th>
	<td>

	<select name="cat_style" id="cat_style" class="option-tree-ui-select ">
		<option <?php if (esc_attr( get_term_meta( $term->term_id, 'cat_style', true ) )=='cat-style-1' ) {echo 'selected="selected"';} ?> value="cat-style-1">Style 1</option>
		<option <?php if (esc_attr( get_term_meta( $term->term_id, 'cat_style', true ) )=='cat-style-2' ) {echo 'selected="selected"';} ?> value="cat-style-2">Style 2</option>
	</select>
		<p class="description"><?php _e( 'Style for Category','asdbBase' ); ?></p>
	</td>
</tr>

<tr class="form-field">
<?php $inputType = 'image'; ?>
<?php $inputName = 'title_background'; ?>
<?php $inputTitle = 'Фон заголовка'; ?>
<?php $inputDescription = 'Загрузите изображение'; ?>
<?php $current_image_url = get_term_meta( $term->term_id, $inputName, true); ?>
<script type="text/javascript">
jQuery(document).ready(function($){
    $('#uploadImage_<?php echo str_replace(' ','_',$inputName); ?>').click(function(e) {
        e.preventDefault();
        var image = wp.media({
            title: 'Upload Image',
            // mutiple: true if you want to upload multiple files at once
            multiple: false
        }).open()
        .on('select', function(e){
            // This will return the selected image from the Media Uploader, the result is an object
            var uploaded_image = image.state().get('selection').first();
            // We convert uploaded_image to a JSON object to make accessing it easier
            // Output to the console uploaded_image
            console.log(uploaded_image);
            var image_url = uploaded_image.toJSON().url;
            // Let's assign the url value to the input field
            $('#<?php echo "asdb_".str_replace(' ','_',$inputName);?>').val(image_url);
        });
    });
});
</script>

	<th scope="row" valign="top">
        <label for="<?php echo "asdb_".str_replace(' ','_',$inputName);?>" class="asdb_meta_name_label"><?php echo $inputTitle;?></label>
	</th>
	<td>
        <div id="<?php echo "asdb_".str_replace(' ','_',$inputName);?>_selected_image" class="asdb_selected_image">
            <?php if ($current_image_url != '') echo '<img src="'.$current_image_url.'" style="max-width:100%;"/>';?>
        </div>
        <input type="regular-text" name="<?php echo str_replace(' ','_',$inputName);?>" id="<?php echo "asdb_".str_replace(' ','_',$inputName);?>" value="<?php echo $current_image_url;?>" />
        <input type='button' class="button-primary" value="Upload Image" id="uploadImage_<?php echo str_replace(' ','_',$inputName); ?>"/>
		<br />
		<span class="description"><?php echo $inputDescription; ?></span>
   </td>
</tr>

<?php
}

// Save extra taxonomy fields callback function.
function save_category_custom_meta( $term_id ) {
   	$term_id  = $_POST['tag_ID'];

	if ( isset( $_POST['cat_col'] ) ) {
	delete_term_meta( $term_id, 'cat_col' );
	add_term_meta( $term_id, 'cat_col', $_POST['cat_col'], true );
	}
	if ( isset( $_POST['cat_style'] ) ) {
	delete_term_meta( $term_id, 'cat_style' );
	add_term_meta( $term_id, 'cat_style', $_POST['cat_style'], true );
	}
	if ( isset( $_POST['fslider'] ) ) {
	delete_term_meta( $term_id, 'fslider' );
	add_term_meta( $term_id, 'fslider', $_POST['fslider'], true );
	}
	if ( isset( $_POST['title_background'] ) ) {
	delete_term_meta( $term_id, 'title_background' );
	add_term_meta( $term_id, 'title_background', $_POST['title_background'], true );
	}
}

add_action( 'category_add_form_fields', 'asdb_category_add_meta_columns', 10 );
add_action( 'category_edit_form_fields', 'asdb_category_add_meta_columns', 10, 2 );
add_action( 'edited_category', 'save_category_custom_meta', 10, 2 );
add_action( 'create_category', 'save_category_custom_meta', 10, 2 );

function enqueue_admin_cat() {
	wp_enqueue_script( 'thickbox' );
	wp_enqueue_style('thickbox');
	wp_enqueue_script('media-upload');
}
add_action( 'admin_enqueue_scripts', 'enqueue_admin_cat' );