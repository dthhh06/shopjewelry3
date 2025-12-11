    // ===== header scrolled class =====
    (function() {
        const hdr = document.getElementById('tiffanyHeader');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 40) hdr.classList.add('scrolled');
            else hdr.classList.remove('scrolled');
        });
    })();

    // ===== product dropdown: show on hover of the nav-item (only when pointer available) =====
    function handleDropdownChild() {
        const dropdownChild = $(".child-list-items").closest(".dropdown");
        console.log(dropdownChild);
        dropdownChild.removeClass("dropend");
        if (window.matchMedia("(max-width: 767px)").matches) {
            dropdownChild.addClass("dropend");
        }
    }

    // ===== user dropdown: toggle on click; close when clicking outside =====
    (function() {
        const userBtn = document.getElementById('userBtn');
        const userDropdown = document.getElementById('userDropdown');

        if (!userBtn || !userDropdown) return;

        function closeUserDropdown() {
            userDropdown.classList.remove('show');
            userDropdown.setAttribute('aria-hidden', 'true');
            userBtn.setAttribute('aria-expanded', 'false');
        }

        function openUserDropdown() {
            userDropdown.classList.add('show');
            userDropdown.setAttribute('aria-hidden', 'false');
            userBtn.setAttribute('aria-expanded', 'true');
        }

        userBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            if (userDropdown.classList.contains('show')) closeUserDropdown();
            else openUserDropdown();
        });

        // close when clicking outside
        document.addEventListener('click', function(e) {
            const isClickInside = userBtn.contains(e.target) || userDropdown.contains(e.target);
            if (!isClickInside) closeUserDropdown();
        });

        // optional: close on ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeUserDropdown();
        });
    })();