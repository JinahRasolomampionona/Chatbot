// script.js
document.addEventListener('DOMContentLoaded', () => {

    // 15 Questions FAQ locales
    const faqData = [
        { keywords: ["services", "proposez", "faites"], answer: "Nous proposons : Création WordPress sur-mesure, E-Commerce (WooCommerce/Shopify), SEO, Webdesign UI/UX et Maintenance." },
        { keywords: ["wordpress"], answer: "Nos sites WordPress sont ultra-rapides, sécurisés, responsive et très simples à prendre en main." },
        { keywords: ["e-commerce", "boutique", "shopify"], answer: "Nous créons des boutiques e-commerce optimisées pour la conversion avec paiement sécurisé." },
        { keywords: ["prix", "tarif", "devis"], answer: "Nos tarifs s'adaptent à vos besoins. Pour obtenir une estimation gratuite, transmettez-nous votre Nom et E-mail !" },
        { keywords: ["etapes", "projet", "processus"], answer: "Notre processus comprend 4 étapes : Audit & Cahier des charges, Design Figma, Développement, puis Recette & Mise en ligne." },
        { keywords: ["delai", "temps"], answer: "Comptez 2 à 4 semaines pour un site vitrine, et 4 à 8 semaines pour un e-commerce complet." },
        { keywords: ["seo", "referencement"], answer: "Tous nos projets intègrent l'optimisation SEO technique et la rapidité de chargement." },
        { keywords: ["refonte", "redesign"], answer: "Nous modernisons votre site existant pour booster vos conversions et votre image de marque." },
        { keywords: ["maintenance", "support"], answer: "Nous proposons une assistance et maintenance 7j/7 avec sauvegardes et sécurité." },
        { keywords: ["mobile", "responsive"], answer: "Toutes nos réalisations sont 100% optimisées pour smartphones et tablettes." },
        { keywords: ["contact", "email"], answer: "Vous pouvez nous joindre par e-mail à contact@novaweb-digital.fr ou directement via ce chat !" },
        { keywords: ["figma", "design", "maquette"], answer: "Nous créons des maquettes UI/UX personnalisées sous Figma avant tout développement." },
        { keywords: ["hebergement", "domaine"], answer: "Nous vous conseillons et configurons votre hébergement haut de gamme et votre nom de domaine." },
        { keywords: ["audit"], answer: "Nous réalisons un audit technique et SEO complet avant le démarrage du projet." },
        { keywords: ["equipe", "agence"], answer: "NovaWeb Digital est une agence passionnée spécialisée dans la création web haute performance." }
    ];

    const toggleBtn = document.getElementById('chat-toggle-btn');
    const bannerBtn = document.getElementById('banner-open-chat');
    const quoteBtn = document.getElementById('btn-request-quote');
    const chatContainer = document.getElementById('chat-container');
    const closeBtn = document.getElementById('close-chat');
    const sendBtn = document.getElementById('send-btn');
    const userInput = document.getElementById('user-input');
    const chatMessages = document.getElementById('chat-messages');

    // Ouverture/Fermeture
    const openChat = () => chatContainer.classList.add('active');
    toggleBtn.addEventListener('click', () => chatContainer.classList.toggle('active'));
    bannerBtn.addEventListener('click', openChat);
    quoteBtn.addEventListener('click', () => {
        openChat();
        appendMessage("Je souhaite obtenir un devis personnalisé.", 'user');
        appendMessage("Avec plaisir ! Veuillez me communiquer votre Nom, votre E-mail et votre besoin.", 'bot');
    });
    closeBtn.addEventListener('click', () => chatContainer.classList.remove('active'));

    // Envoi de messages
    sendBtn.addEventListener('click', handleSend);
    userInput.addEventListener('keypress', (e) => { if (e.key === 'Enter') handleSend(); });

    document.addEventListener('click', (e) => {
        if (e.target.classList.contains('faq-chip')) {
            userInput.value = e.target.innerText;
            handleSend();
        }
    });

    async function handleSend() {
        const text = userInput.value.trim();
        if (!text) return;

        appendMessage(text, 'user');
        userInput.value = '';

        const localMatch = checkLocalFAQ(text);

        if (localMatch) {
            appendMessage(localMatch, 'bot');
        } else {
            const loadingMsg = appendMessage("NovaBot analyse votre demande...", 'bot');

            try {
                const response = await fetch('chat.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ message: text })
                });

                const data = await response.json();
                loadingMsg.innerText = data.reply;
            } catch (err) {
                loadingMsg.innerText = "Erreur de connexion. Veuillez réessayer.";
            }
        }

        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function checkLocalFAQ(text) {
        const clean = text.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
        for (let item of faqData) {
            for (let kw of item.keywords) {
                if (clean.includes(kw)) return item.answer;
            }
        }
        return null;
    }

    function appendMessage(text, sender) {
        const div = document.createElement('div');
        div.classList.add('message', sender);
        div.innerHTML = text;
        chatMessages.appendChild(div);
        chatMessages.scrollTop = chatMessages.scrollHeight;
        return div;
    }
});