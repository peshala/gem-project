<?php
/**
 * Pricing table heading template
 */
?>
<div class="pricing-table__heading">
	<?php $this->__html( 'icon', '<div class="pricing-table__icon"><i class="%s"></i></div>' ); ?>
	<?php $this->__html( 'title', '<h5 class="pricing-table__title">%s</h5>' ); ?>
	<?php $this->__html( 'subtitle', '<h6 class="pricing-table__subtitle">%s</h6>' ); ?>
</div>