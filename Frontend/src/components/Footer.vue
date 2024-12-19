<template>
  <footer class="footer">
    <div class="footer-content">
      <div class="footer-section">
        <h2 class="footer-title">Roadmap AI</h2>
        <p class="footer-description">
          A free and open-source resume builder that simplifies the process of creating, updating, and sharing your resume.
        </p>
        <p class="footer-rights">All rights reserved</p>
        <div class="footer-icons">
          <a href="#" class="icon"><i class="fab fa-instagram"></i></a>
          <a href="#" class="icon"><i class="fab fa-twitter"></i></a>
          <a href="#" class="icon"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
      <div class="footer-section">
        <h3 class="footer-title">About</h3>
        <ul class="footer-links">
          <li><a href="#">About us</a></li>
          <li><a href="#">Testimonials</a></li>
          <li><a href="#">FAQs</a></li>
          <li><a href="#">Contact us</a></li>
        </ul>
      </div>
      <div class="footer-section">
        <h3 class="footer-title">Stay up to date</h3>
        <div class="subscribe-form">
          <input
            type="email"
            placeholder="Your email address"
            class="subscribe-input"
          />
          <button class="subscribe-button">
            <i class="fas fa-paper-plane"></i>
          </button>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  name: "Footer",
};
</script>

<style src="./Footer.css"></style>
