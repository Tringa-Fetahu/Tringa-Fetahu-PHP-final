<footer class="bg-dark text-white py-4 mt-5">
    <div class="container text-center">
        <div class="mb-3">
            <img src="https://upload.wikimedia.org/wikipedia/commons/3/33/F1.svg" alt="F1 Logo" style="height: 40px;">
        </div>
        <p class="mb-2">🏎️ Fasten your seatbelts – Experience the thrill of Formula 1!</p>
        <div class="d-flex justify-content-center gap-3 mb-3">
            <a href="#" class="text-white text-decoration-none">Home</a>
            <a href="#" class="text-white text-decoration-none">Races</a>
            <a href="#" class="text-white text-decoration-none">Tickets</a>
            <a href="#" class="text-white text-decoration-none">Contact</a>
        </div>
        <small>&copy; <?= date("Y") ?> F1 Tickets. All rights reserved.</small>
    </div>
</footer>
<style>
  footer a:hover {
    text-decoration: underline;
    color: #ff4c4c;
}
footer img {
    filter: brightness(0) invert(1);
}
</style>