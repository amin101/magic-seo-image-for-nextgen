<?php
defined( 'ABSPATH' ) or die( 'Sorry,you are not allowd to access this file!' );

session_start();
require_once 'PictureListTable.php';
require_once 'Repo.php';

class OptionPage {

// class instance
	static $instance;

// customer WP_List_Table object
	protected $pictureListTable;

// class constructor
	public function __construct() {

		add_action( 'admin_menu', [ $this, 'plugin_menu' ] );
		$this->pictureListTable = new PictureListTable();


	}


	public function plugin_menu() {

		$hook = add_menu_page(
			_x('SEO alt nextgen','page title',TXD),
			_x('SEO alt nextgen','menu title',TXD),
			'manage_options',
			'wp_seo_alt_nextgen',
			[ $this, 'plugin_settings_page' ]
		);

	}


	/**
	 * Plugin settings page
	 */

	public function plugin_settings_page() {

		?>

		<div class="wrap">
			<h2><?php _e('SEO nextGallery images',TXD); ?></h2>
			<?php $fail_or_success = $this->pictureListTable->prepare_items();?>
			<?php $this->pictureListTable->repo->flashMessage(); ?>
			<div id="poststuff">

				<div id="post-body" class="metabox-holder columns-2">

					<div id="post-body-content">
						<div class="meta-box-sortables ui-sortable">
							<div class="gallery-select-div">
								<h3><?php _e('Please select a gallery',TXD); ?></h3>
								<?php $this->pictureListTable->repo->showGalleries(); ?>
							</div>
							<form method="post">
								<?php $this->pictureListTable->repo->showTags('checkbox_alt',$fail_or_success); ?>
								<div id="js-div-tag-container"><h3><?php _e('your custom tags :',TXD); ?></h3></div>
								<div class="custom-alt-input">
									<h3><?php _e('add your custom alt:',TXD); ?> </h3>
									<span><?php _e('Separate each alt with comma',TXD); ?></span>
									<?php $this->pictureListTable->repo->inputHtml('custom-alt',$fail_or_success); ?>
									<?php $this->pictureListTable->repo->buttonHtml(__('add to tags',TXD),'tag-button',true); ?>
								</div>


							<?php $this->pictureListTable->display(); ?>
							</form>
						</div>
					</div>
				</div>
				<br class="clear">
			</div>
		</div>

		<?php
	}

	/** Singleton instance */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

}

add_action( 'plugins_loaded', function () {

	OptionPage::get_instance();

} );