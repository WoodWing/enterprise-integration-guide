/**
 * toc-nav.js
 *
 * Intercepts TOC link clicks to load only the main content area via fetch(),
 * leaving the <aside> / div.toc DOM node untouched so its scroll position is
 * preserved naturally across navigations.
 *
 * Additionally saves the TOC scroll position to sessionStorage so it is also
 * restored correctly on hard refreshes or direct-URL loads.
 *
 * Falls back to a regular full-page navigation if fetch fails or if the fetched
 * page does not contain a .main-content section (e.g. guide landing pages).
 */
(function () {
    'use strict';

    var TOC_SCROLL_KEY = 'ww-toc-scroll';

    /* ------------------------------------------------------------------ */
    /* Helpers                                                              */
    /* ------------------------------------------------------------------ */

    function getToc() {
        return document.querySelector('div.toc');
    }

    function getMainContent() {
        return document.querySelector('section.main-content');
    }

    /** Persist the current TOC scroll offset so it survives a hard refresh. */
    function saveTocScroll() {
        var toc = getToc();
        if (toc) {
            try {
                sessionStorage.setItem(TOC_SCROLL_KEY, String(toc.scrollTop));
            } catch (_) { /* sessionStorage may be unavailable (private mode, etc.) */ }
        }
    }

    /** Apply a previously saved TOC scroll offset. */
    function restoreTocScroll() {
        var toc = getToc();
        if (!toc) return;
        try {
            var saved = sessionStorage.getItem(TOC_SCROLL_KEY);
            if (saved !== null) {
                toc.scrollTop = parseInt(saved, 10) || 0;
            }
        } catch (_) { /* ignore */ }
    }

    /**
     * Scroll the TOC container just enough to make the currently selected
     * `li.ww-menu-item-selected` element visible.
     *
     * Uses getBoundingClientRect() so that nested-list offsetTop chains are
     * avoided and the result is always relative to the current viewport.
     * Does nothing when the item is already fully within the visible area.
     */
    function scrollActiveItemIntoView() {
        var toc = getToc();
        if (!toc) return;

        var activeItem = toc.querySelector('li.ww-menu-item-selected');
        if (!activeItem) return;

        var PADDING = 8; // px of breathing room above / below the item

        var tocRect  = toc.getBoundingClientRect();
        var itemRect = activeItem.getBoundingClientRect();

        var isAbove = itemRect.top    < tocRect.top    + PADDING;
        var isBelow = itemRect.bottom > tocRect.bottom - PADDING;

        if (!isAbove && !isBelow) return; // Already visible — do nothing

        // Center the item in the TOC viewport.
        // Delta = (item's center in viewport) − (toc's center in viewport).
        // Adding that delta to scrollTop moves the item to the middle of the container.
        var itemCenter = itemRect.top  + itemRect.height / 2;
        var tocCenter  = tocRect.top   + toc.clientHeight / 2;
        toc.scrollTop += itemCenter - tocCenter;
    }

    /**
     * Update the active TOC item by toggling ww-menu-item-selected /
     * ww-menu-item classes to match the new target URL.
     *
     * @param {string} targetHref  The href of the newly active page
     *   (root-relative, e.g. "/enterprise-integration-guide/1234-placeObject")
     */
    function updateTocActiveItem(targetHref) {
        var toc = getToc();
        if (!toc) return;

        // Normalise: strip trailing slashes for comparison
        var normalised = targetHref.replace(/\/$/, '');

        toc.querySelectorAll('li').forEach(function (li) {
            var anchor = li.querySelector('a');
            if (!anchor) return;

            var linkHref = (anchor.getAttribute('href') || '').replace(/\/$/, '');

            if (linkHref === normalised) {
                li.classList.remove('ww-menu-item');
                li.classList.add('ww-menu-item-selected');
            } else if (li.classList.contains('ww-menu-item-selected')) {
                li.classList.remove('ww-menu-item-selected');
                li.classList.add('ww-menu-item');
            }
        });
    }

    /* ------------------------------------------------------------------ */
    /* Navigation                                                           */
    /* ------------------------------------------------------------------ */

    /**
     * Load a new page partially: fetch `url`, extract its .main-content,
     * swap it into the current DOM, and update history + TOC state.
     *
     * @param {string}  url        Full or root-relative URL to navigate to
     * @param {boolean} pushState  When true, push a new history entry
     */
    function navigate(url, pushState) {
        // Snapshot the TOC scroll so it can be recovered after the fetch
        // even if the browser briefly resets layout during innerHTML replacement.
        saveTocScroll();

        var currentContent = getMainContent();
        if (!currentContent) {
            // No .main-content on this page; fall back to regular navigation.
            window.location.href = url;
            return;
        }

        // Provide a visual hint that navigation is in progress.
        currentContent.style.opacity = '0.4';

        fetch(url)
            .then(function (response) {
                if (!response.ok) {
                    throw new Error('HTTP ' + response.status);
                }
                return response.text();
            })
            .then(function (html) {
                var parser = new DOMParser();
                var fetchedDoc = parser.parseFromString(html, 'text/html');

                var newContent = fetchedDoc.querySelector('section.main-content');
                if (!newContent) {
                    // Target page has a different layout (e.g. guide intro).
                    // Fall back to a full navigation so nothing breaks.
                    window.location.href = url;
                    return;
                }

                // ---- Swap content ----
                currentContent.innerHTML = newContent.innerHTML;
                currentContent.style.opacity = '';
                currentContent.scrollTop = 0; // always start at the top of new content

                // ---- Update page title ----
                var newTitle = fetchedDoc.title;
                if (newTitle) {
                    document.title = newTitle;
                }

                // ---- Update browser URL ----
                if (pushState !== false) {
                    history.pushState({ url: url }, newTitle || '', url);
                }

                // ---- Update TOC selection ----
                // Use a root-relative href for the comparison (strip origin).
                var rootRelative = url.replace(window.location.origin, '');
                updateTocActiveItem(rootRelative);

                // ---- Ensure the active TOC item is visible ----
                // Scroll the TOC only if the newly highlighted item has ended
                // up outside the visible portion of div.toc (e.g. after a
                // back/forward navigation where the saved scroll offset belonged
                // to a different page). Does nothing when already visible.
                scrollActiveItemIntoView();
            })
            .catch(function (err) {
                console.warn('toc-nav: fetch failed (' + err.message + '), falling back to full navigation.');
                currentContent.style.opacity = '';
                window.location.href = url;
            });
    }

    /* ------------------------------------------------------------------ */
    /* Event wiring                                                         */
    /* ------------------------------------------------------------------ */

    document.addEventListener('DOMContentLoaded', function () {

        // Restore persisted TOC scroll on every initial page load, then ensure
        // the active item is visible. scrollActiveItemIntoView() only overrides
        // the restored position when the active item would otherwise be hidden.
        restoreTocScroll();
        scrollActiveItemIntoView();

        // Register initial page in history so the back button works from
        // the very first page a visitor lands on.
        if (!history.state || !history.state.url) {
            history.replaceState(
                { url: window.location.href },
                document.title,
                window.location.href
            );
        }

        // ----- Intercept TOC link clicks -----
        var toc = getToc();
        if (toc) {
            toc.addEventListener('click', function (e) {
                // Walk up from the click target to find an <a>, in case
                // the user clicked a child element (e.g. a span inside the link).
                var anchor = e.target.closest('a');
                if (!anchor) return;

                var href = anchor.getAttribute('href');
                if (!href) return;

                // Only intercept same-origin links.
                var isSameOrigin =
                    href.startsWith('/') ||
                    href.startsWith(window.location.origin);

                if (!isSameOrigin) return;

                // External links (http/https to a different host) should open normally.
                if (href.startsWith('http') &&
                        !href.startsWith(window.location.origin)) {
                    return;
                }

                e.preventDefault();
                navigate(href, true);
            });

            // Save the TOC scroll position whenever the user scrolls it,
            // so a subsequent hard refresh still lands in the right place.
            toc.addEventListener('scroll', saveTocScroll, { passive: true });
        }

        // ----- Handle browser back / forward -----
        window.addEventListener('popstate', function (e) {
            if (e.state && e.state.url) {
                navigate(e.state.url, false);
            } else {
                // No state attached (e.g. navigated back to a non-SPA page).
                location.reload();
            }
        });
    });

}());
