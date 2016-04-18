<?php
class modules {
    var $post;

    var $title_attribute;
    var $title;
    var $href;


    //constructor
    function __construct($post) {
        $this->post = $post;
        $this->title = get_the_title($post->ID);
        $this->title_attribute = esc_attr(strip_tags($this->title));
        $this->href = get_permalink($post->ID);

        if (has_post_thumbnail($this->post->ID)) {
            $this->post_has_thumb = true;
        } else {
            $this->post_has_thumb = false;
        }

    }

    function get_item_scope() { //@todo - refactor this not used anymore
        //all the links are articles - google doesn't like multiple reviews on one page
        return 'itemscope itemtype="' . as_global::$http_or_https . '://schema.org/Article"';
    }

    //used only on single post, we have it empty for future improvements
    function get_item_scope_meta() {
        $assa = '';
        $author_id = $this->post->post_author;
        $assa .= '<meta itemprop="author" content = "' . get_the_author_meta('display_name', $author_id) . '">';
        return $assa;
    }

    function get_author() {
        $assa = '';
            $article_date_unix = get_the_time('U', $this->post->ID);
            $assa .= '<span class="meta-author">';
                $assa .= '<i class="fa fa-user"></i>';
                $assa .= '&nbsp;';
                $assa .= '<a itemprop="author" href="' . get_author_posts_url($this->post->post_author) . '">' . get_the_author_meta('display_name', $this->post->post_author) . '</a>' ;
            $assa .= '</span>';
        return $assa;
    }


    function get_date() {
        $assa = '';
            $article_date_unix = get_the_time('U', $this->post->ID);
            $assa .= '<span class="meta-date">';
            $assa .= '<i class="fa fa-calendar"></i>';
            $assa .= '&nbsp;';
            $assa .= '<time  itemprop="dateCreated" class="entry-date updated" datetime="' . date(DATE_W3C, $article_date_unix) . '" >' . get_the_time(get_option('date_format'), $this->post->ID) . '</time>';
            $assa .= '</span>';
        return $assa;
    }

    function get_time_date() {
        $assa = '';
        $article_date_unix = get_the_time('U', $this->post->ID);
        $assa .= '<span class="meta-date">';
        $assa .= '<time  itemprop="dateCreated" class="entry-date updated" datetime="' . date(DATE_W3C, $article_date_unix) . '" >' . get_the_time(get_option('G:i'), $this->post->ID) . ' / ' . get_the_time(get_option('date_format'), $this->post->ID) . '</time>';
        $assa .= '</span>';
        return $assa;
    }


    function get_cat() {
        $assa = '';
        $assa .= '<span class="meta-category">';
		$assa .= '<i class="fa fa-folder-open"></i>';
		$assa .= '&nbsp;';
        $assa .= get_the_category_list(' / ', 'single',  $this->post->ID );
        $assa .= '</span>';
        return $assa;
    }



    function get_views() {
        $assa = '';
        	$assa .= '<span class="meta-views">';
            $assa .= '<i class="fa fa-eye"></i>';
            $assa .= '&nbsp;';
        	$assa .= '<span class="views-post-' . $this->post->ID . '">' . get_post_meta($this->post->ID, 'views', true) .'</span>';
        	$assa .= '</span>';
        return $assa;
    }

    function get_comments() {
        $assa = '';
        $assa .= '<span class="meta-comments">';
            $assa .= '<i class="fa fa-comments"></i>';
            $assa .= '&nbsp;';
            $assa .= '<a href="' . get_comments_link($this->post->ID) . '">';
            $assa .= get_comments_number($this->post->ID);
            $assa .= '</a>';
        $assa .= '</span>';
        return $assa;
    }

    function get_image($thumbsize) {
        $assa = '';
        $placeholder = ot_get_option('placeholder');
        if ($this->post_has_thumb or ($placeholder == 'on')) {
            if ($this->post_has_thumb) {
                $attach_id = get_post_thumbnail_id($this->post->ID);
                $temp_image_url = wp_get_attachment_image_src($attach_id, $thumbsize);
                $attach_alt = get_post_meta($attach_id, '_wp_attachment_image_alt', true );
                $attach_alt = 'alt="' . esc_attr(strip_tags($attach_alt)) . '"';
                $attach_title = ' title="' . $this->title . '"';
                if (empty($temp_image_url[0])) {
                    $temp_image_url[0] = '';
                }
                if (empty($temp_image_url[1])) {
                    $temp_image_url[1] = '';
                }
                if (empty($temp_image_url[2])) {
                    $temp_image_url[2] = '';
                }
            } else {
                  global $_wp_additional_image_sizes;
                $temp_image_url[1] = $_wp_additional_image_sizes[$thumbsize]['width'];
                $temp_image_url[2] = $_wp_additional_image_sizes[$thumbsize]['height'];

                $temp_image_url[0] = get_template_directory_uri() . '/assets/images/no-thumb/' . $thumbsize . '.png';
                $attach_alt = '';
                $attach_title = '';
            } //end    if ($this->post_has_thumb) {

            $assa .= '<div class="thumb-wrap">';
                if (current_user_can('edit_posts')) {
                    $assa .= '<small class="edit-link"><a class="post-edit-link" href="' . get_edit_post_link($this->post->ID) . '"><i class="fa fa-edit"></i></a></small>';
                }

                $assa .='<a href="' . $this->href . '" rel="bookmark" title="' . $this->title_attribute . '">';
                $assa .= '<img width="' . $temp_image_url[1] . '" height="' . $temp_image_url[2] . '" itemprop="image" class="entry-thumb" src="' . $temp_image_url[0] . '" ' . $attach_alt . $attach_title . '/>';
                $assa .= '</a>';
            $assa .= '</div>'; //end wrapper

            return $assa;
        }
    }




    function get_title($excerpt_lenght = '') {
        $assa = '';
        $assa .= '<h3 class="entry-title" itemprop="name">';
        $assa .='<a itemprop="url" href="' . $this->href . '" rel="bookmark" title="' . $this->title_attribute . '">';
        if (!empty($excerpt_lenght)) {
            $assa .= util::excerpt($this->title, $excerpt_lenght, 'show_shortcodes');
        } else {
            $assa .= $this->title;
        }
        $assa .='</a>';
        $assa .= '</h3>';
        return $assa;
    }


    function get_excerpt($lenght = 25, $show_shortcodes = '') {
        if ($this->post->post_excerpt != '') {
            return $this->post->post_excerpt;
        }

        if (empty($lenght)) {
            $lenght = 25;
        }

        $assa = '';

        //remove [caption .... [/caption] from $this->post->post_content
        $post_content = preg_replace("/\[caption(.*)\[\/caption\]/i", '', $this->post->post_content);

        $assa .= util::excerpt($post_content, $lenght, $show_shortcodes);
        return $assa;
    }

}
