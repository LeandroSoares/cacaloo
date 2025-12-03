import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

// Smooth scroll behavior
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute("href"));
    if (target) {
      const headerHeight = document.querySelector("header").offsetHeight;
      const targetPosition = target.offsetTop - headerHeight;

      window.scrollTo({
        top: targetPosition,
        behavior: "smooth"
      });
    }
  });
});

// Intersection Observer para animações
const observerOptions = {
  threshold: 0.1,
  rootMargin: "0px 0px -50px 0px"
};

const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add("animate-fade-in-up");
      observer.unobserve(entry.target);
    }
  });
}, observerOptions);

// Observar elementos quando DOM estiver pronto
document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".observe").forEach(el => {
    observer.observe(el);
  });
});
window.copyInviteLink = function () {
  const input = document.getElementById("inviteLink");
  input.select();
  input.setSelectionRange(0, 99999); // Para dispositivos móveis
  navigator.clipboard.writeText(input.value).then(
    function () {
      const notification = document.createElement("div");
      notification.className =
        "fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50";
      notification.textContent = "✓ Link copiado para a área de transferência!";
      document.body.appendChild(notification);
      setTimeout(() => {
        notification.remove();
      }, 3000);
    },
    function (err) {
      alert("Erro ao copiar link: " + err);
    }
  );
};
window.shareWhatsappMessage = function () {
  const msg = document.getElementById("inviteMessage").value;
  const url = "https://wa.me/?text=" + encodeURIComponent(msg);
  window.open(url, "_blank");
};
