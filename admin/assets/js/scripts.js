/*!
    * Start Bootstrap - SB Admin v7.0.7[](https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT[](https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
// 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

// === THÊM PHẦN NÀY ĐỂ ACTIVE MENU KHI DÙNG ?act= ===
document.addEventListener('DOMContentLoaded', function() {
    // Lấy giá trị act từ URL
    const urlParams = new URLSearchParams(window.location.search);
    const currentAct = urlParams.get('act');

    // Nếu act tồn tại, tìm link có href chứa "act=" + currentAct (hoặc bắt đầu bằng currentAct- cho trang con)
    if (currentAct) {
        const selector = `#layoutSidenav_nav .sb-sidenav a.nav-link[href*="act=${currentAct}"]`;
        const activeLink = document.querySelector(selector);

        if (activeLink) {
            // Thêm class active cho nav-link
            activeLink.classList.add('active');

            // Nếu có menu cha collapse, mở nó ra (nếu bạn dùng submenu sau này)
            const parentCollapse = activeLink.closest('.collapse');
            if (parentCollapse) {
                parentCollapse.classList.add('show');
                const parentLink = parentCollapse.previousElementSibling;
                if (parentLink) parentLink.classList.add('active');
            }
        }
    }
});