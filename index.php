<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NovaWeb Digital - Agence Web & E-Commerce</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>

    <!-- Barre de Navigation Haute (Sombre) -->
    <header class="navbar">
        <div class="main-container">
            <div class="nav-brand">
                <div class="logo-icon">&lt;/&gt;</div>
                <div class="logo-text">
                    <h2>NovaWeb Digital</h2>
                    <span>Agence de création web & e-commerce haute performance</span>
                </div>
            </div>
            <div class="nav-actions">
                <button class="btn-secondary" id="open-api-console">⚙ Console API / Webhook</button>
                <button class="btn-primary-head" id="btn-request-quote">Demander un devis</button>
            </div>
        </div>
    </header>

    <!-- Conteneur Principal -->
    <main class="main-container">

        <!-- Colonne Gauche (Contenu Principal) -->
        <section class="content-left">
            <div class="hero-card">
                <span class="badge">EXPERTISE DIGITAL</span>
                <h1>Nous concevons des expériences web d'exception.</h1>
                <p class="hero-desc">
                    De la création de sites vitrines sur-mesure sous WordPress au développement de plateformes e-commerce évolutives, notre équipe vous accompagne dans chaque étape de votre transformation numérique.
                </p>

                <!-- Grille des cartes de services -->
                <div class="services-grid">
                    <div class="service-box">
                        <div class="service-icon wp-icon">W</div>
                        <h3>WordPress Sur-Mesure</h3>
                        <p>Sites ultra-rapides, sécurisés et simples à administrer.</p>
                    </div>

                    <div class="service-box">
                        <div class="service-icon ecom-icon">🛒</div>
                        <h3>E-Commerce Performant</h3>
                        <p>WooCommerce & Shopify configurés pour la conversion.</p>
                    </div>
                </div>
            </div>

            <!-- Bannière d'appel à l'action -->
            <div class="cta-banner">
                <div class="cta-text">
                    <h3>Besoin d'un conseil pour votre projet ?</h3>
                    <p>Discutez en direct avec notre assistant virtuel "NovaBot" disponible 24/7.</p>
                </div>
                <button class="btn-cta-chat" id="banner-open-chat">
                    Ouvrir le Chatbot 💬
                </button>
            </div>
        </section>

        <!-- Colonne Droite (Sidebar Widgets) -->
        <aside class="content-right">
            <!-- Widget Services Inclus -->
            <div class="sidebar-card">
                <h3><span class="check-circle">✓</span> Services Inclus</h3>
                <ul class="check-list">
                    <li><span class="check-mark">✓</span> Audit & Cahier des charges</li>
                    <li><span class="check-mark">✓</span> Webdesign UI/UX Figma</li>
                    <li><span class="check-mark">✓</span> Optimisation SEO & Vitesse</li>
                    <li><span class="check-mark">✓</span> Maintenance & Support 7/7</li>
                </ul>
            </div>

            <!-- Widget À propos de l'Assistant -->
            <div class="sidebar-card info-card">
                <h3>🤖 À propos de l'Assistant</h3>
                <p>Ce chatbot utilise un moteur de règles d'intention avec correspondance sémantique et arbre de décision pour la qualification de leads.</p>
            </div>
        </aside>

    </main>

    <!-- Bouton Flottant Fixe en bas à droite -->
    <button id="chat-toggle-btn">
        <span class="chat-icon">💬</span> Un projet ? Discutons !
    </button>

    <!-- Fenêtre Tiroir du Chatbot -->
    <div id="chat-container">
        <div class="chat-header">
            <div class="brand-info">
                <h3>NovaBot Assistant</h3>
                <span class="status-online">● En ligne | NovaWeb Digital</span>
            </div>
            <button class="close-btn" id="close-chat">&times;</button>
        </div>

        <div class="chat-messages" id="chat-messages">
            <div class="message bot">
                Bonjour ! Je suis NovaBot, l'assistant virtuel de <strong>NovaWeb Digital</strong>. Comment puis-je vous aider aujourd'hui ?
                <div class="faq-chips">
                    <span class="faq-chip">Création WordPress</span>
                    <span class="faq-chip">E-Commerce</span>
                    <span class="faq-chip">Tarifs & Devis</span>
                </div>
            </div>
        </div>

        <div class="chat-input-area">
            <input type="text" id="user-input" placeholder="Posez une question sur nos services...">
            <button id="send-btn">Envoyer</button>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="footer">
        © 2026 NovaWeb Digital - Démonstration Chatbot d'Agence Web
    </footer>

    <script src="js/script.js"></script>
</body>

</html>