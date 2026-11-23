/*
 * EljayMedia Admin Theme: small markup tidy-ups that CSS can't reach.
 * Safe to fail: if any selector is missing, the stock behaviour stays.
 */
(function () {
    function tidy() {
        // Edit pages render "<span class=label>Title</span>: Name". The label is
        // shown as an eyebrow above the title, so drop the dangling colon.
        var h = document.querySelector('#thirdLevelHeader div.breadcrumb h3');
        if (h) {
            var label = h.querySelector('span.label');
            var next = label && label.nextSibling;
            if (next && next.nodeType === 3) {
                next.nodeValue = next.nodeValue.replace(/^\s*:\s*/, ' ');
            }
        }
        if (document.querySelector('form.login')) {
            document.body.className += ' em-login';
        }
    }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', tidy);
    } else {
        tidy();
    }
})();
