<header>
    <nav>
        <div class="navdiv">
            <a href="<?= url('app/home') ?>">
                <img class="headerLogo" src="../../storage/images/logo_white.png" alt="header-logo" height="100">
            </a>
            <ul>
                <li>
                    <div class="home-div">
                        <a href="<?= url('app/home') ?>">
                            Página Inicial
                            <img class="homeIcon" src="../../storage/images/icon_home.png" alt="products-icon">
                        </a>
                    </div>
                </li>
                <?php if ($session->has('authSeller')) { ?>
                    <li>
                        <div class="products-div">
                            <a href="<?= url('app/products') ?>">
                                Produtos
                                <img class="productsIcon" src="../../storage/images/icon_products.png" alt="products-icon">
                            </a>
                        </div>
                    </li>
                <?php } ?>
                <li>
                    <div class="cart-div">
                        <a href="<?= url('app/cart') ?>">
                            Carrinho
                            <img class="cartIcon" src="../../storage/images/icon_cart.png" alt="cart-icon">
                        </a>
                    </div>
                </li>
                <li>
                    <div class="dropdown">
                        <div class="profile-div">
                            <h1>Conta</h1>
                            <img class="profileIcon" src="../../storage/images/icon_profile.png" alt="profile-icon">
                        </div>
                        <div class="dropdown-content">
                            <a href="<?= url('app/user-config') ?>">Configurações</a>
                            <a href="<?= url('app/logout') ?>">Sair</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>