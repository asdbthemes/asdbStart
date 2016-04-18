<?php
/**
 * Содержание для больших постов.
 * Автор: Тимур Камаев
 * Страница: http://wp-kama.ru/?p=1513
 * Версия: 2.7.3
 */
class Kama_Contents {
	var $margin;    // отступ слева у подразделов в пикселях. 40
	var $rep_tags;  // теги по умолчанию по котором будет строиться содеражние. Порядок имеет значение. array('h2','h3','h4')
	var $to_menu;   // ссылка на возврат к содержанию. '' - убрать ссылку
	var $title;     // Заголовок. '' - убрать заголовок
	var $css;       // css стили. '' - убрать стили
	var $min_found; // минимальное количество найденных тегов, чтобы содержание выводилось.
	var $min_length; // минимальная длина (символов) текста, чтобы содержание выводилось.

	var $temp;

	protected static $instance;

	function __construct( $args = array() ) {
		// параметры по умолчанию
		$def = array(
			'margin'     => 40,
			'rep_tags'   => array('h2','h3','h4'),
			'to_menu'    => 'к содержанию ↑',
			'title'      => 'Содержание:',
			'css'        => '.kc_gotop{ display:block; text-align:right; } .kc-title{ font-style:italic; padding:10px 0 10px; }',
			'min_found'  => 2,
			'min_length' => 4000,
		);
		// установим свойства
		foreach ( array_merge( $def, $args ) as $k => $v ) { $this->$k = $v; }
	}

	static function init( $args = array() ) {
		is_null( self::$instance ) and self::$instance = new self( $args );
		return self::$instance;
	}

	/**
	 * Обрабатывает текст, превращает шоткод в нем в содержание.
     *
	 * @param (string) $content текст, в котором есть шоткод.
	 * @return Обработанный текст с содержанием, если в нем есть шоткод.
	 */
	function shortcode( $content ) {
		// получаем данные о содержании
		if ( ! preg_match('~^(.*)\[contents([^\]]*)\](.*)$~s', $content, $m ) ) {
			return $content; }

		if ( $tags = trim( $m[2] ) ) {
			$tags = array_map('trim', explode(' ', $tags ) ); }

		$contents = $this->make_contents( $m[3], $tags );

		return $m[1] . $contents . $m[3];
	}

	/**
	 * Заменяет заголовки в переданном тексте (по ссылке), создает и возвращает содержание.
     *
	 * @param (string) $content текст на основе которого нужно создать содержание.
	 * @param (array)  $tags    массив тегов, которые искать в переданном тексте.
	 * @return                  html код содержания.
	 */
	function make_contents( & $content, $tags = array() ) {
		if ( mb_strlen( $content ) < $this->min_length ) { return; // выходим если текст короткий
}
		// переменные
		$this->temp    = new stdClass;
		$this->temp->i = 0;

		if ( ! $tags ) { $tags = $this->rep_tags; }

		$this->temp->tag_level = array_flip( $tags ); // перевернем

		// заменяем все заголовки и собираем содержание в $this->temp->contents
		$h_patt = implode('|', $tags );
		$_content = preg_replace_callback('@<('. $h_patt .')([^>]*)>(.*?)</(?:'. $h_patt .')>@is', array( $this, '__make_contents_callback'), $content, -1, $count );

		if ( ! $count || $count < $this->min_found ) { return; }

		$content = $_content; // опять работаем с важной $content

		// html содержания
		$contents = '';
		if ( $this->title ) {
			$contents .= '<div class="kc_title" id="kcmenu">'. $this->title .'</div>'. "\n"; }

		$contents .= '<ul class="contents"'. ( ! $this->title ? ' id="kcmenu"' : '') .'>'. "\n" .
			implode('', $this->temp->contents ) .
		'</ul>'."\n";

		$contents = '<div class="contents-wrap">'. $contents .'</div>';

		$this->temp = new stdClass; // чистим

		static $css;
		$css = ( ! $css && $this->css ) ? '<style>'. $this->css .'</style>' : '';

		return $css . $contents;
	}

	// callback функция для замены и сбора содержания
	private function __make_contents_callback( $match ) {
		$tag    = $match[1];
		$attrs  = $match[2];
		$title  = $match[3];
		$anchor = $this->__sanitaze_anchor( $title );

		if ( 0 < $level = $this->temp->tag_level[ $tag ] ) {
			$sub = ( $this->margin ? ' style="margin-left:'. ($level * $this->margin) .'px;"' : '') . ' class="sub sub_'. $level .'"'; }
		else {
			$sub = ' class="top"'; }

		// собираем содержание
		$this->temp->contents[] = "\t". '<li'. $sub .'><a href="#'. $anchor .'">'. $title .'</a></li>'. "\n";

		// заменяем
		$out = '';
		if ( $this->to_menu ) {
			$out .= $this->temp->i == 1 ? '' : '<a class="kc_gotop" href="#kcmenu">'. $this->to_menu .'</a>'; }
		$out .= '<a class="kc_anchor" name="'. $anchor .'"></a>'."\n".'<'. $tag . $attrs .'>'. $title .'</'. $tag .'>';

		return $out;
	}

	// транслитерация для УРЛ
	function __sanitaze_anchor( $str ) {
		$conv = array(
			'а' => 'a',
'б' => 'b',
'в' => 'v',
'г' => 'g',
'д' => 'd',
'е' => 'e',
'ё' => 'e',
'ж' => 'zh',
'з' => 'z',
			'и' => 'i',
'й' => 'y',
'к' => 'k',
'л' => 'l',
'м' => 'm',
'н' => 'n',
'о' => 'o',
'п' => 'p',
'р' => 'r',
			'с' => 's',
'т' => 't',
'у' => 'u',
'ф' => 'f',
'х' => 'h',
'ц' => 'c',
'ч' => 'ch',
'ш' => 'sh',
'щ' => 'sch',
			'ы' => 'y',
'э' => 'e',
'ю' => 'yu',
'я' => 'ya',

			'А' => 'A',
'Б' => 'B',
'В' => 'V',
'Г' => 'G',
'Д' => 'D',
'Е' => 'E',
'Ё' => 'E',
'Ж' => 'Zh',
'З' => 'Z',
			'И' => 'I',
'Й' => 'Y',
'К' => 'K',
'Л' => 'L',
'М' => 'M',
'Н' => 'N',
'О' => 'O',
'П' => 'P',
'Р' => 'R',
			'С' => 'S',
'Т' => 'T',
'У' => 'U',
'Ф' => 'F',
'Х' => 'H',
'Ц' => 'C',
'Ч' => 'Ch',
'Ш' => 'Sh',
'Щ' => 'Sch',
			'Ы' => 'Y',
'Э' => 'E',
'Ю' => 'Yu',
'Я' => 'Ya',
		);

		$str = strtr( $str, $conv );
		$str = strtolower( $str );
		$str = preg_replace('/[^-a-z0-9_~+=$]+/u', '-', $str ); // все ненужное на "-"
		$str = trim( $str, '-'); // начальные и конечные '-'

		return $str;
	}
}
