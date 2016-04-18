<?php

/*
  Обрезка текста - excerpt
maxchar = количество символов.
text = какой текст обрезать (по умолчанию берется excerpt поста, если его нету, то content, если есть тег <!--more-->, то maxchar игнорируется и берется все, что до него, с сохранением HTML тегов )
save_format = Сохранять перенос строк или нет. По умолчанию сохраняется. Если в параметр указать определенные теги, то они НЕ будут вырезаться из обрезанного текста (пример: save_format=<strong><a> )
echo = выводить на экран или возвращать (return) для обработки.
П.с. Шоткоды вырезаются. Минимальное значение maxchar может быть 22.
*/
function kama_excerpt( $args = '' ) {
	global $post;
	$readmore = '<i class="fa fa-angle-double-right"></i>'; // Читать далее »
		$mxchar = ot_get_option('excerpt-length');
		parse_str($args, $i);
		$maxchar 	 = isset($i['maxchar']) ?  (int) trim($i['maxchar'])		: (int) $mxchar;
		// isset($i['maxchar']) ?  (int)trim($i['maxchar'])		: 350;
		$text 		 = isset($i['text']) ? 			trim($i['text'])		: '';
		$save_format = isset($i['save_format']) ?	trim($i['save_format'])			: false;
		$echo		 = isset($i['echo']) ? 			false		 			: true;

	if ( ! $text ) {
		$out = $post->post_excerpt ? $post->post_excerpt : $post->post_content;
		$out = preg_replace('!\[/?.*\]!U', '', $out ); // убираем шоткоды, например:[singlepic id=3]
		// для тега <!--more-->
		if ( ! $post->post_excerpt && strpos($post->post_content, '<!--more-->') ) {
			preg_match('/(.*)<!--more-->/s', $out, $match);
			$out = str_replace("\r", '', trim($match[1], "\n"));
			$out = preg_replace( "!\n\n+!s", '</p><p>', $out );
			//$out .= '<p>'. str_replace( "\n", '<br />', $out ) .' <a class ="readmore pull-right" href="'. get_permalink($post->ID) .'#more-'. $post->ID.'">'.$readmore.'</a></p>';
			$out .= '...';
			$out .= '<a class ="readmore pull-right" href="'. get_permalink($post->ID) .'">'.$readmore.'</a>';
			if ($echo ) {
				return print $out; }
			return $out;
		}
	}

	$out = $text.$out;
	if ( ! $post->post_excerpt ) {
		$out = strip_tags($out, $save_format); }

	if ( iconv_strlen($out, 'utf-8') > $maxchar ) {
		$out = iconv_substr( $out, 0, $maxchar, 'utf-8' );
		$out = preg_replace('@(.*)\s[^\s]*$@s', '\\1 ', $out); // убираем последнее слово, ибо оно в 99% случаев неполное
		$out .= '...';
		$out .= '<a href="'. get_permalink($post->ID) .'" class ="readmore pull-right"><i class="fa fa-angle-double-right"></i></a>';
//		$out .= '<p><a href="'. get_permalink($post->ID) .'" class ="readmore" / >'.$readmore.'</a></p>';
	}

	if ($save_format ) {
		$out = str_replace( "\r", '', $out );
		$out = preg_replace( "!\n\n+!", '</p><p>', $out );
		$out = '<p>'. str_replace( "\n", '<br />', trim($out) ) .'</p>';
	}

	if ($echo ) { return print $out; }
	return $out;
}
