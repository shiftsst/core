// 2019-10-03
// «Finder block should be present on the page for filtering to work»:
// https://github.com/shiftsst/core/issues/18
define([
	'jquery', 'mage/utils/wrapper', 'domReady!'
], function($, w) {'use strict'; return function(sb) {$.extend(sb.prototype, {
	initialize: w.wrap(sb.prototype.initialize, function(_super) {
		var cc = $('body').attr('class').split(' ');
		if (-1 !== cc.indexOf('checkout-cart-index') && -1 !== cc.indexOf('catalog-product-view')) {
			_super();
		}
	})
});
return sb;};});