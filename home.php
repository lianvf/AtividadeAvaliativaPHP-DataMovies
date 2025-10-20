<link rel="stylesheet" href="/components/home/home.css">

<section class="hero-section">
    <div class="hero-background"></div>
    <div class="hero-content">
        <h1>Seus filmes favoritos, em um só lugar.</h1>
        <p>Explore um universo de filmes, descubra novos atores e mergulhe em suas categorias preferidas.</p>
        <a href="/categorias" class="cta-button">Explorar Categorias</a>
    </div>
</section>

<style>
/* Estilos essenciais para a seção principal */
.hero-section {
    position: relative;
    height: 80vh; /* Aumentado para ocupar mais espaço na tela */
    min-height: 500px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: #fff;
    padding: 2em;
}

.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('/img/home_background.jpg');
    background-size: cover;
    background-position: center;
    filter: brightness(0.4);
    z-index: -1;
}

.hero-content h1 {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 0.5em;
    text-shadow: 2px 2px 8px rgba(0,0,0,0.7);
}

.hero-content p {
    font-size: 1.2rem;
    max-width: 600px;
    margin: 0 auto 1.5em auto;
    text-shadow: 1px 1px 4px rgba(0,0,0,0.7);
}

.cta-button {
    display: inline-block;
    padding: 12px 30px;
    background-color: #fb9680;
    color: #905e64;
    font-size: 1.1rem;
    font-weight: bold;
    text-decoration: none;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.cta-button:hover {
    background-color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}
</style>