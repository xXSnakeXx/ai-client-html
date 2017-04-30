<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2013
 * @copyright Aimeos (aimeos.org), 2015-2016
 */

$enc = $this->encoder();

$optTarget = $this->config( 'client/jsonapi/url/options/target' );
$optController = $this->config( 'client/jsonapi/url/options/controller', 'jsonapi' );
$optAction = $this->config( 'client/jsonapi/url/options/action', 'index' );
$optConfig = $this->config( 'client/jsonapi/url/options/config', [] );


?>
<section class="aimeos catalog-session" data-jsonurl="<?= $enc->attr( $this->url( $optTarget, $optController, $optAction, [], [], $optConfig ) ); ?>">

	<?php if( isset( $this->sessionErrorList ) ) : ?>
		<ul class="error-list">
			<?php foreach( (array) $this->sessionErrorList as $errmsg ) : ?>
				<li class="error-item"><?= $enc->html( $errmsg ); ?></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>

	<?= $this->block()->get( 'catalog/session/pinned' ); ?>
	<?= $this->block()->get( 'catalog/session/seen' ); ?>

</section>
