<?php require "../includes/header.php"; ?>

<main>
    <div class="events-page-textonly">
        <div class="events-header-textonly">
            <h1>Events</h1>
            <p class="events-intro-textonly">Ontmoet andere Rydr-gebruikers en leer meer over mobiliteit tijdens onze events.</p>
        </div>

        <section class="events-section-textonly">
            <h2>Komende Events</h2>
            <ul class="events-list">
                <li>
                    <strong>Elektrisch Rijden Workshop</strong><br>
                    <span class="event-date">25 maart</span> – <span class="event-location">Amsterdam, Rydr HQ</span><br>
                    <span class="event-description">Leer alles over elektrisch rijden en ontdek de voordelen voor jouw dagelijks gebruik.</span>
                </li>
                <li>
                    <strong>Netwerkborrel</strong><br>
                    <span class="event-date">15 april</span> – <span class="event-location">Rotterdam, Rydr Hub</span><br>
                    <span class="event-description">Ontmoet andere Rydr-gebruikers en deel je ervaringen in een ontspannen sfeer.</span>
                </li>
            </ul>
        </section>

        <section class="events-section-textonly">
            <h2>Afgelopen Events</h2>
            <ul class="events-list">
                <li>
                    <strong>Duurzaamheidssymposium</strong><br>
                    <span class="event-date">10 maart</span> – <span class="event-location">Utrecht, Rydr Center</span><br>
                    <span class="event-description">Een dag vol inspirerende sprekers over duurzame mobiliteit en de toekomst van transport.</span>
                </li>
                <li>
                    <strong>Tech Meetup</strong><br>
                    <span class="event-date">28 februari</span> – <span class="event-location">Den Haag, Rydr Lab</span><br>
                    <span class="event-description">Ontdek de nieuwste technologieën in de autowereld en hun impact op autohuur.</span>
                </li>
            </ul>
        </section>

        <div class="events-cta-textonly">
            <h2>Organiseer je eigen event?</h2>
            <p>Wil je een event organiseren met Rydr? Neem contact met ons op voor de mogelijkheden.</p>
            <a href="/contact" class="contact-link">Contact opnemen</a>
        </div>
    </div>
</main>

<style>
.events-page-textonly {
    max-width: 700px;
    margin: 0 auto;
    padding: 2rem 1rem 2rem 1rem;
    font-family: 'Segoe UI', Arial, sans-serif;
    color: #2B2B2B;
}
.events-header-textonly {
    text-align: center;
    margin-bottom: 2rem;
}
.events-header-textonly h1 {
    font-size: 2rem;
    margin-bottom: 0.3rem;
}
.events-intro-textonly {
    color: #888;
    font-size: 1.05rem;
}
.events-section-textonly {
    margin-bottom: 2.2rem;
}
.events-section-textonly h2 {
    color: #0099ff;
    font-size: 1.15rem;
    margin-bottom: 0.7rem;
}
.events-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.events-list li {
    background: #f8faff;
    border-radius: 8px;
    padding: 1rem 1.2rem;
    margin-bottom: 1.1rem;
    box-shadow: 0 1px 4px rgba(44, 62, 80, 0.06);
}
.event-date {
    color: #007acc;
    font-weight: 600;
}
.event-location {
    color: #666;
}
.event-description {
    display: block;
    color: #888;
    margin-top: 0.2rem;
    font-size: 0.97rem;
}
.events-cta-textonly {
    text-align: center;
    margin-top: 2.5rem;
}
.events-cta-textonly h2 {
    color: #2B2B2B;
    margin-bottom: 0.3rem;
    font-size: 1.15rem;
}
.events-cta-textonly p {
    color: #666;
    margin-bottom: 1rem;
    font-size: 1rem;
}
.contact-link {
    color: #fff;
    background: #0099ff;
    padding: 0.6rem 1.5rem;
    border-radius: 5px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1rem;
    transition: background 0.2s;
    display: inline-block;
}
.contact-link:hover {
    background: #007acc;
}
@media (max-width: 600px) {
    .events-page-textonly {
        padding: 1.2rem 0.3rem;
    }
    .events-list li {
        padding: 0.8rem 0.7rem;
    }
}
</style>

<?php require "../includes/footer.php"; ?> 
