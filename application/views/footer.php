<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <!-- Navigation -->
            <div class="col-sm-4">
                <aside class="widget">
                    <h4>Navigation</h4>
                    <ul class="list-unstyled">
                        <li><a href="<?= base_url() ?>">Home</a></li>
                        <?php foreach ($categories as $cat): ?>
                            <?php $has_sub = !empty($cat['subcategories']); ?>
                            <li class="<?= $has_sub ? 'accordion' : '' ?>">
                                <a href="<?= base_url('category?cid=' . $cat['id']) ?>"><?= $cat['category_name'] ?></a>
                                <?php if ($has_sub): ?>
                                    <ul style="display: none;">
                                        <?php foreach ($cat['subcategories'] as $sub): ?>
                                            <li><a href="<?= base_url('category?cid=' . $cat['id'] . '&sid=' . urlencode($sub['id'])) ?>"><?= $sub['name'] ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </aside>
            </div>

            <!-- Contact Info -->
            <div class="col-sm-4">
                <aside class="widget">
                    <h4>CONTACT US</h4>
                    <p><i class="fa fa-paper-plane"></i> &nbsp; Ballinahowen, Athlone, Co. Westmeath</p>
                    <p style="font-size:18px;"><i class="fa fa-phone"></i> &nbsp; (090) 6430244</p>
                    <p><i class="fa fa-envelope"></i> &nbsp; <a href="mailto:agriexpress@outlook.com"><em>agriexpress@outlook.com</em></a></p>
                    <div class="social-link">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                        <a href="#"><i class="fa fa-rss"></i></a>
                    </div>
                </aside>
            </div>

            <!-- Opening Hours -->
            <div class="col-sm-4">
                <aside class="widget">
                    <h4>OPENING HOURS</h4>
                    <p>Our opening hours are as follows:<br>
                    Monday-Saturday: 9a.m. - 6p.m.<br>
                    Sunday: Closed<br>
                    Bank Holidays: Closed</p>
                    <p><strong>WE ACCEPT</strong></p>
                    <img src="<?= base_url('images/cart.png') ?>" alt="">
                </aside>
            </div>
        </div>
    </div>
</footer>

<!-- Footer Bottom -->
<div class="footer-bottom">
    <div class="container">
        <div class="footer-logos"><img src="<?= base_url('images/logo-footer.png') ?>" alt=""></div>
        <div class="copyright">
            Copyright 2016 agridirect | All Rights Reserved ::
            Department of Agriculture, Food and the Marine
        </div>
    </div>
</div>
</body>
</html>
