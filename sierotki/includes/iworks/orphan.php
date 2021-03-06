<?php
/*
Copyright 2011-2021 Marcin Pietrzak (marcin@iworks.pl)

this program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

 */

class iworks_orphan {

	private $options;
	private $admin_page;
	private $settings;
	private $plugin_file;

	/**
	 * terms cache
	 */
	private $terms = array();

	/**
	 * Filter post meta.
	 *
	 * @since 2.7.0
	 */
	private $meta_keys = null;

	public function __construct() {
		/**
		 * basic settings
		 */
		$file = dirname( dirname( dirname( __FILE__ ) ) ) . '/sierotki.php';
		/**
		 * options
		 */
		$this->options = get_orphan_options();
		/**
		 * plugin ID
		 */
		$this->plugin_file = plugin_basename( $file );
		/**
		 * actions
		 */
		add_action( 'init', array( $this, 'init' ) );
		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_action( 'iworks_rate_css', array( $this, 'iworks_rate_css' ) );
		add_action( 'plugins_loaded', array( $this, 'load_translation' ) );
		/**
		 * filters
		 */
		add_filter( 'orphan_replace', array( $this, 'orphan_replace_filter' ) );
		/**
		 * iWorks Rate Class
		 */
		add_filter( 'iworks_rate_notice_logo_style', array( $this, 'filter_plugin_logo' ), 10, 2 );
	}

	/**
	 * Load Translation
	 *
	 * @since 2.7.3
	 */
	public function load_translation() {
		load_plugin_textdomain( 'sierotki', false, dirname( $this->plugin_file ) . '/languages' );
	}

	/**
	 * base replacement function
	 */
	public function replace( $content ) {
		/**
		 * Filter to allow skip replacement.
		 *
		 * @since 2.7.7
		 */
		if ( apply_filters( 'orphan_skip_replacement', false ) ) {
			return $content;
		}
		/**
		 * do not replace empty content
		 */
		if ( empty( $content ) ) {
			return $content;
		}
		/**
		 * we do not need this in admin
		 */
		if ( is_admin() ) {
			return $content;
		}
		/**
		 * we do not need this in feed
		 *
		 * @since 2.7.6
		 */
		if ( is_feed() ) {
			return $content;
		}
		/**
		 * we do not need this in REST API
		 *
		 * @since 2.7.6
		 */
		if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
			return $content;
		}
		/**
		 * check post type
		 */
		$entry_related_filters = array( 'the_title', 'the_excerpt', 'the_content' );
		$current_filter        = current_filter();
		if ( in_array( $current_filter, $entry_related_filters ) ) {
			if ( empty( $this->settings['post_type'] ) || ! is_array( $this->settings['post_type'] ) ) {
				return $content;
			}
			global $post;
			if ( is_a( $post, 'WP_Post' ) && ! in_array( $post->post_type, $this->settings['post_type'] ) ) {
				return $content;
			}
		}
		/**
		 * check taxonomy
		 */
		if ( 'term_description' == $current_filter ) {
			if ( empty( $this->settings['taxonomies'] ) || ! is_array( $this->settings['taxonomies'] ) ) {
				return $content;
			}
			$queried_object = get_queried_object();
			if ( ! in_array( $queried_object->taxonomy, $this->settings['taxonomies'] ) ) {
				return $content;
			}
		}
		/**
		 * Allow to ignore language.
		 *
		 * @since 2.6.7
		 */
		$all_languages          = $this->is_on( 'ignore_language' );
		$apply_to_all_languages = apply_filters( 'iworks_orphan_apply_to_all_languages', $all_languages );
		if ( ! $apply_to_all_languages ) {
			/**
			 * apply other rules only for Polish language
			 */
			$locale = apply_filters( 'wpml_current_language', get_locale() );
			if ( ! preg_match( '/^pl/', $locale ) ) {
				return $content;
			}
		}
		/**
		 * finally just replace!
		 */
		return $this->unconditional_replacement( $content );
	}

	/**
	 * Unconditional replacement with super-base check is replacement even
	 * possible.
	 *
	 * @since 2.7.8
	 *
	 * @param string $content String to replace
	 *
	 * @return string $content
	 */
	private function unconditional_replacement( $content ) {
		/**
		 * only super-base check
		 */
		if ( ! is_string( $content ) || empty( $content ) ) {
			return $content;
		}
		/**
		 * Keep numbers together - this is independed of current language
		 */
		$numbers = $this->is_on( 'numbers' );
		if ( $numbers ) {
			preg_match_all( '/(>[^<]+<)/', $content, $parts );
			if ( $parts && is_array( $parts ) && ! empty( $parts ) ) {
				$parts = array_shift( $parts );
				foreach ( $parts as $part ) {
					$to_change = $part;
					while ( preg_match( '/(\d+) ([\da-z]+)/i', $to_change, $matches ) ) {
						$to_change = preg_replace( '/(\d+) ([\da-z]+)/i', '$1&nbsp;$2', $to_change );
					}
					if ( $part != $to_change ) {
						$content = str_replace( $part, $to_change, $content );
					}
				}
			}
		}
		$terms = $this->_terms();
		/**
		 * Avoid to replace inside script or styles tags
		 */
		preg_match_all( '@(<(script|style)[^>]*>.*?(</(script|style)>))@is', $content, $matches );
		$exceptions = array();
		if ( ! empty( $matches ) && ! empty( $matches[0] ) ) {
			$salt = 'kQc6T9fn5GhEzTM3Sxn7b9TWMV4PO0mOCV06Da7AQJzSJqxYR4z3qBlsW9rtFsWK';
			foreach ( $matches[0] as $one ) {
				$key                = sprintf( '<!-- %s %s -->', $salt, md5( $one ) );
				$exceptions[ $key ] = $one;
				$re                 = sprintf( '@%s@', preg_replace( '/@/', '\@', preg_quote( $one, '/' ) ) );
				$content            = preg_replace( $re, $key, $content );
			}
		}
		/**
		 * Chunk terms
		 *
		 * @since 2.7.6
		 */
		$terms_terms = array_chunk( $terms, 10 );
		foreach ( $terms_terms as $terms ) {
			/**
			 * base therms replace
			 */
			$re      = '/^([aiouwz]|' . preg_replace( '/\./', '\.', implode( '|', $terms ) ) . ') +/i';
			$content = preg_replace( $re, '$1$2&nbsp;', $content );
			/**
			 * single letters
			 */
			$re = '/([ >\(]+|&nbsp;|&#8222;|&quot;)([aiouwz]|' . preg_replace( '/\./', '\.', implode( '|', $terms ) ) . ') +/i';
			/**
			 * double call to handle orphan after orphan after orphan
			 */
			$content = preg_replace( $re, '$1$2&nbsp;', $content );
			$content = preg_replace( $re, '$1$2&nbsp;', $content );
		}
		/**
		 * single letter after previous orphan
		 */
		$re      = '/(&nbsp;)([aiouwz]) +/i';
		$content = preg_replace( $re, '$1$2&nbsp;', $content );
		/**
		 * bring back styles & scripts
		 */
		if ( ! empty( $exceptions ) && is_array( $exceptions ) ) {
			foreach ( $exceptions as $key => $one ) {
				$re      = sprintf( '/%s/', $key );
				$content = preg_replace( $re, $one, $content );
			}
		}
		/**
		 * return
		 */
		return $content;
	}

	/**
	 * Add Hlp tab on option page
	 */
	public function add_help_tab() {
		$screen = get_current_screen();
		if ( $screen->id != $this->admin_page ) {
			return;
		}
		// Add my_help_tab if current screen is My Admin Page
		$screen->add_help_tab(
			array(
				'id'      => 'overview',
				'title'   => __( 'Orphans', 'sierotki' ),
				'content' => '<p>' . __( 'Plugin fix some Polish gramary rules with orphans.', 'sierotki' ) . '</p>',
			)
		);
		/**
		 * make sidebar help
		 */
		$screen->set_help_sidebar(
			'<p><strong>' . __( 'For more information:' ) . '</strong></p>' .
			'<p>' . __( '<a href="http://wordpress.org/extend/plugins/sierotki/" target="_blank">Plugin Homepage</a>', 'sierotki' ) . '</p>' .
			'<p>' . __( '<a href="http://wordpress.org/support/plugin/sierotki/" target="_blank">Support Forums</a>', 'sierotki' ) . '</p>' .
			'<p>' . __( '<a href="http://iworks.pl/en/" target="_blank">break the web</a>', 'sierotki' ) . '</p>'
		);
	}

	/**
	 * Inicialize admin area
	 */
	public function admin_init() {
		$this->options->options_init();
		add_filter( 'plugin_action_links_' . $this->plugin_file, array( $this, 'add_settings_link' ) );
		add_filter( 'plugin_action_links_' . $this->plugin_file, array( $this, 'add_donate_link' ) );
	}

	/**
	 * Initialize, but not for admin
	 */
	public function init() {
		/**
		 * Turn off all replacements for admin area - we do not need it!
		 */
		if ( is_admin() ) {
			return;
		}
		$this->settings  = $this->options->get_all_options();
		$allowed_filters = array(
			'the_title',
			'the_excerpt',
			'the_content',
			'comment_text',
			'widget_title',
			'widget_text',
			'term_description',
			'get_the_author_description',
			'widget_block_content',
		);
		foreach ( $this->settings as $filter => $value ) {
			if ( ! in_array( $filter, $allowed_filters ) ) {
				continue;
			}
			if ( is_integer( $value ) && 1 == $value ) {
				add_filter( $filter, array( $this, 'replace' ), PHP_INT_MAX );
				/**
				 * WooCommerce exception: short descripton
				 */
				if ( 'the_excerpt' === $filter ) {
					add_filter( 'woocommerce_short_description', array( $this, 'replace' ), PHP_INT_MAX );
				}
			}
		}
		/**
		 * taxonomies
		 */
		if ( 1 == $this->settings['taxonomy_title'] && ! empty( $this->settings['taxonomies'] ) ) {
			add_filter( 'single_term_title', array( $this, 'replace' ) );
			if ( in_array( 'category', $this->settings['taxonomies'] ) ) {
				add_filter( 'single_cat_title', array( $this, 'replace' ) );
			}
			if ( in_array( 'post_tag', $this->settings['taxonomies'] ) ) {
				add_filter( 'single_tag_title', array( $this, 'replace' ) );
			}
		}
		add_filter( 'iworks_orphan_replace', array( $this, 'replace' ) );
		/**
		 * Filter post meta.
		 *
		 * @since 2.7.0
		 */
		add_filter( 'get_post_metadata', array( $this, 'filter_post_meta' ), 10, 4 );
	}

	/**
	 * Change logo for "rate" message.
	 *
	 * @since 2.6.6
	 */
	public function iworks_rate_css() {
		$logo = plugin_dir_url( dirname( dirname( __FILE__ ) ) ) . 'assets/images/logo.png';
		echo '<style type="text/css">';
		printf( '.iworks-notice-sierotki .iworks-notice-logo{background-color:#fed696;background-image:url(%s);}', esc_url( $logo ) );
		echo '</style>';
	}

	/**
	 * Is key turned on?
	 *
	 * @param string $key Settings key.
	 *
	 * @return boolean Is this key setting turned on?
	 */
	private function is_on( $key ) {
		return isset( $this->settings[ $key ] ) && 1 === $this->settings[ $key ];
	}

	/**
	 * Add settings link to plugin_action_links.
	 *
	 * @since 2.6.8
	 *
	 * @param array  $actions     An array of plugin action links.
	 */
	public function add_settings_link( $actions ) {
		$page      = $this->options->get_pagehook();
		$url       = add_query_arg( 'page', $page, admin_url( 'themes.php' ) );
		$actions[] = sprintf( '<a href="%s">%s</a>', esc_url( $url ), esc_html__( 'Settings', 'sierotki' ) );
		return $actions;
	}

	/**
	 * Add donate link to plugin_row_meta.
	 *
	 * @since 2.6.8
	 *
	 * @param array  $actions An array of the plugin's metadata, including the version, author, author URI, and plugin URI.
	 */
	public function add_donate_link( $actions ) {
		$actions[] = '<a href="https://ko-fi.com/iworks?utm_source=sierotki&utm_medium=plugin-links">' . __( 'Donate', 'sierotki' ) . '</a>';
		return $actions;
	}

	/**
	 * Replace orphans in custom fields.
	 *
	 * @since 2.7.0
	 *
	 * @param null|bool $check      Whether to allow adding metadata for the given type.
	 * @param int       $object_id  Object ID.
	 * @param string    $meta_key   Meta key.
	 * @param mixed     $meta_value Meta value. Must be serializable if non-scalar.
	 * @param bool      $unique     Whether the specified meta key should be unique
	 *                              for the object. Optional. Default false.
	 * @return null|bool|string $value Post meta value with orphans rules.
	 */
	public function filter_post_meta( $check, $object_id, $meta_key, $unique ) {
		if ( ! $unique ) {
			return $check;
		}
		if ( false === $this->meta_keys ) {
			return $check;
		}
		if ( null === $this->meta_keys ) {
			$value = $this->options->get_option( 'post_meta' );
			if ( empty( $value ) || ! is_string( $value ) ) {
				return $check;
			}
			$value           = explode( ',', trim( $value ) );
			$this->meta_keys = array_map( 'trim', $value );
		}
		if ( empty( $this->meta_keys ) ) {
			$this->meta_keys = false;
			return $check;
		}
		if ( ! in_array( $meta_key, $this->meta_keys ) ) {
			return $check;
		}
		remove_filter( 'get_post_metadata', array( $this, 'filter_post_meta' ), 10, 4 );
		$value = get_post_meta( $object_id, $meta_key, true );
		add_filter( 'get_post_metadata', array( $this, 'filter_post_meta' ), 10, 4 );
		if ( ! empty( $value ) ) {
			return $this->replace( $value );
		}
		return $check;
	}

	/**
	 * get terms array
	 *
	 * @since 2.7.1
	 *
	 * @return $terms array Array of terms to replace.
	 */
	private function _terms() {
		if ( ! empty( $this->terms ) ) {
			$terms = $this->terms;
			$terms = apply_filters( 'iworks_orphan_therms', $terms );
			$terms = apply_filters( 'iworks_orphan_terms', $terms );
			return $terms;
		}
		$terms = array(
			'al.',
			'albo',
			'ale',
			'ale??',
			'b.',
			'bez',
			'bm.',
			'bp',
			'br.',
			'by',
			'bym',
			'by??',
			'b??.',
			'cyt.',
			'cz.',
			'czy',
			'czyt.',
			'dn.',
			'do',
			'doc.',
			'dr',
			'ds.',
			'dyr.',
			'dz.',
			'fot.',
			'gdy',
			'gdyby',
			'gdybym',
			'gdyby??',
			'gdy??',
			'godz.',
			'im.',
			'in??.',
			'jw.',
			'kol.',
			'komu',
			'ks.',
			'kt??ra',
			'kt??rego',
			'kt??rej',
			'kt??remu',
			'kt??ry',
			'kt??rych',
			'kt??rym',
			'kt??rzy',
			'lecz',
			'lic.',
			'm.in.',
			'max',
			'mgr',
			'min',
			'moich',
			'moje',
			'mojego',
			'mojej',
			'mojemu',
			'mych',
			'm??j',
			'na',
			'nad',
			'nie',
			'niech',
			'np.',
			'nr',
			'nr.',
			'nrach',
			'nrami',
			'nrem',
			'nrom',
			'nrowi',
			'nru',
			'nry',
			'nrze',
			'nrze',
			'nr??w',
			'nt.',
			'nw.',
			'od',
			'oraz',
			'os.',
			'p.',
			'pl.',
			'pn.',
			'po',
			'pod',
			'pot.',
			'prof.',
			'przed',
			'przez',
			'pt.',
			'pw.',
			'pw.',
			'tak',
			'tamtej',
			'tamto',
			'tej',
			'tel.',
			'tj.',
			'to',
			'twoich',
			'twoje',
			'twojego',
			'twojej',
			'twych',
			'tw??j',
			'tylko',
			'ul.',
			'we',
			'wg',
			'woj.',
			'wi??c',
			'za',
			'ze',
			'??p.',
			'??w.',
			'??e',
			'??eby',
			'??eby??',
			'???',
		);
		/**
		 * get own orphans
		 */
		$own_orphans = trim( get_option( 'iworks_orphan_own_orphans', '' ), ' \t,' );
		if ( $own_orphans ) {
			$own_orphans = preg_replace( '/\,\+/', ',', $own_orphans );
			$terms       = array_merge( $terms, preg_split( '/,[ \t]*/', strtolower( $own_orphans ) ) );
		}
		/**
		 * remove duplicates
		 */
		$terms = array_unique( $terms );
		/**
		 * decode
		 */
		$a = array();
		foreach ( $terms as $t ) {
			$a[] = html_entity_decode( $t );
		}
		$terms = $a;
		/**
		 * remove empty elements
		 */
		$terms       = array_filter( $terms );
		$this->terms = $terms;
		/**
		 * filter it
		 */
		$terms = apply_filters( 'iworks_orphan_therms', $terms );
		$terms = apply_filters( 'iworks_orphan_terms', $terms );
		return $terms;
	}

	/**
	 * Filter to use Orphans on any string
	 *
	 * @since 2.7.8
	 *
	 * @param string $content String to replace
	 *
	 * @return string $content
	 */
	public function orphan_replace_filter( $content ) {
		if ( ! is_string( $content ) ) {
			return $content;
		}
		if ( empty( $content ) ) {
			return $content;
		}
		return $this->unconditional_replacement( $content );
	}

	/**
	 * Plugin logo for rate messages
	 *
	 * @since 2.7.9
	 *
	 * @param string $logo Logo, can be empty.
	 * @param object $plugin Plugin basic data.
	 */
	public function filter_plugin_logo( $logo, $plugin ) {
		if ( is_object( $plugin ) ) {
			$plugin = (array) $plugin;
		}
		if ( 'sierotki' === $plugin['slug'] ) {
			return plugin_dir_url( dirname( dirname( __FILE__ ) ) ) . '/assets/images/logo.png';
		}
		return $logo;
	}

}
