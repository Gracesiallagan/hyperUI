<?php $__env->startSection('title', 'Home - GandengTangan'); ?>

<?php $__env->startSection('content'); ?>
<div class="container page">
    
    <section class="hero">
        <div class="hero-grid">
            <div class="hero-left">
                <div class="pill">
                    <span class="dot"></span>
                    FEATURED ARTIST SARAH 12
                </div>

                <h1 class="hero-title">
                    Creativity<br>
                    Without <span class="accent">Limits</span>
                </h1>

                <p class="hero-subtitle">
                    Empower children with disabilities through our inclusive marketplace.
                    Discover unique artworks and support young creators directly.
                </p>

                <div class="hero-cta">
                    <a href="#" class="btn btn-primary">Start Empowering <span class="arrow">→</span></a>
                    <a href="#" class="btn btn-ghost"><span class="play">▶</span> Watch Their Story</a>
                </div>
            </div>

            <div class="hero-right">
                <div class="hero-illustration" role="img" aria-label="Ilustrasi anak melukis (placeholder)">
                    <div class="illustration-center">
                        <div class="illustration-emoji">🎨</div>
                        <div class="illustration-text">Hero Illustration</div>
                        <div class="illustration-note">Nanti diganti gambar asli</div>
                    </div>
                </div>

                <div class="mini-card">
                    <div class="mini-row">
                        <div class="mini-thumb">🖼️</div>
                        <div class="mini-meta">
                            <div class="mini-title">“Colors of Joy”</div>
                            <div class="mini-sub">By Sarah 12yo</div>
                        </div>
                        <div class="mini-price">$120.00</div>
                    </div>
                    <div class="mini-actions">
                        <a href="#" class="mini-link">View Art</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="stats">
        <div class="stat-card">
            <div class="stat-icon">◎</div>
            <div>
                <div class="stat-value">1,200+</div>
                <div class="stat-label">Works Sold</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">◎</div>
            <div>
                <div class="stat-value">350+</div>
                <div class="stat-label">Artists Joined</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">◎</div>
            <div>
                <div class="stat-value">$50k+</div>
                <div class="stat-label">Revenue Generated</div>
            </div>
        </div>
    </section>

    
    <section class="section">
        <div class="section-head">
            <div>
                <h2 class="section-title">Explore Talent by Category</h2>
                <p class="section-subtitle">Find the perfect piece that speaks to you.</p>
            </div>
            <a href="#" class="section-link">View All Categories →</a>
        </div>

        <div class="cards-4">
            <a href="#" class="cat-card">
                <div class="cat-img"><span class="cat-emoji">🖌️</span></div>
                <div class="cat-name">Painting</div>
                <div class="cat-desc">Vibrant expressions on canvas</div>
            </a>

            <a href="#" class="cat-card">
                <div class="cat-img"><span class="cat-emoji">🏺</span></div>
                <div class="cat-name">Crafts</div>
                <div class="cat-desc">Handmade sculptures & pottery</div>
            </a>

            <a href="#" class="cat-card">
                <div class="cat-img"><span class="cat-emoji">💻</span></div>
                <div class="cat-name">Digital Services</div>
                <div class="cat-desc">Graphic design & illustrations</div>
            </a>

            <a href="#" class="cat-card">
                <div class="cat-img"><span class="cat-emoji">🎻</span></div>
                <div class="cat-name">Music</div>
                <div class="cat-desc">Original compositions & audio</div>
            </a>
        </div>
    </section>

    
    <section class="newsletter">
        <div class="newsletter-grid">
            <div>
                <h3 class="newsletter-title">Join the Movement</h3>
                <p class="newsletter-sub">
                    Subscribe to our newsletter to receive updates on new artists, upcoming exhibitions, and impact reports.
                </p>
            </div>

            <form class="newsletter-form" method="post" action="#">
                <input class="newsletter-input" type="email" placeholder="Enter your email address" required>
                <button class="btn btn-primary newsletter-btn" type="submit">Subscribe</button>
            </form>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\hyperUI\resources\views/public/index.blade.php ENDPATH**/ ?>