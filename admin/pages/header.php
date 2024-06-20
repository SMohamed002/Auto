<nav class="navbar navbar-dark bg-dark" aria-label="Dark offcanvas navbar">
    <div class="container-fluid">
        <a class="navbar-brand flex-grow-1" href=""><img src="/assets/images/favicon/favicon-32x32.png" /> Auto Pharmacy</a>
        <button class="navbar-toggler flex-shrink-0" type="button" onclick="window.open(`/`);" style="margin-right: 10px;">
            <i class="bi bi-eye"></i>
        </button>
        <button class="navbar-toggler flex-shrink-0" type="button" onclick="logout();" style="margin-right: 10px;">
            <i class="bi bi-power"></i>
        </button>
        <button class="navbar-toggler flex-shrink-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbarDark" aria-controls="offcanvasNavbarDark" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbarDark" aria-labelledby="offcanvasNavbarDarkLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarDarkLabel">Main Menu</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link" id="home_link" aria-current="page" href="/admin/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="acc_link" href="/admin/account/">Account Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="doc_link" href="/admin/doctors/">Doctors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="cats_link" href="/admin/Categories/">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="products_link" href="/admin/products/">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="emails_link" href="/admin/emails/">News Emails</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="reviews_link" href="/admin/reviews/">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact_link" href="/admin/contact_us/">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="clients_link" href="/admin/clients/">Clients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="orders_link" href="/admin/orders/">Orders</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<div id="ext_code"></div>