<hr class="p-0 m-0">
<footer>
    <div class="footer d-flex justify-content-between mx-5">
        <section class="social_media">
            <div class="section--title">
                <h3>Social Media</h3>
                <div class="divider"></div>
            </div>
            <p class="text--stay-connected">Stay Connected With Us</p>
            <a href="#" aria-label="facebook"><i class='bx bxl-facebook'></i></a>
            <a href="#" aria-label="instagram"><i class='bx bxl-instagram'></i></a>
            <a href="#" aria-label="twitter"><i class='bx bxl-twitter'></i></a>
            <a href="#" aria-label="youtube"><i class='bx bxl-youtube'></i></a>
        </section>

        <section class="contact-us">
            <div class="section--title">
                <h3>Contact Us</h3>
                <div class="divider"></div>
            </div>
            <ul>
                <li>
                    <i class='bx bxs-phone'></i>
                    <a href="tel:+9779800000000" class="text-decoration-none">+977 9800000000</a>
                </li>
                <li>
                    <i class='bx bxs-envelope'></i>
                    <a href="mailto:contact@mukeshmahato.com.np"
                        class="text-decoration-none">contact@mukeshmahato.com.np</a>
                </li>
                <li>
                    <i class='bx bxs-map'></i>
                    <p class="d-inline">Koteshwor, Kathmandu</p>
                </li>
            </ul>
        </section>

        <div class="map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2418.1653060747926!2d85.34983581196356!3d27.684070706701537!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19f2804a02bf%3A0x85468199859b2d8d!2sKoteshwor%2C%20Kathmandu%2044600!5e0!3m2!1sen!2snp!4v1711724403147!5m2!1sen!2snp"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

    <div class="copyright copyright-text m-0 p-2 text-black fw-bold fs-6">
        © 2024 All rights reserved
    </div>
</footer>

<script>
    document.querySelectorAll(".nav-link").forEach((link) => {
        if (link.href === window.location.href) {
            link.classList.add("active");
            
            link.setAttribute("aria-current", "page");
        }
    });
</script>

<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
@stack('script')
