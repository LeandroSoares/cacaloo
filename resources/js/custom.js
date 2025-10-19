/**
 * Casa de Caridade Legião de Oxóssi e Ogum
 * JavaScript Principal
 *
 * Este arquivo contém toda a funcionalidade JavaScript
 * do website, seguindo padrões modernos e acessíveis.
 */

// ===== CONFIGURAÇÃO GLOBAL =====
const Config = {
  headerHeight: 80,
  scrollThreshold: 100,
  animationDuration: 300,
  debounceTime: 150,
  breakpoints: {
    mobile: 768,
    tablet: 1024,
    desktop: 1440
  }
};

// ===== UTILIDADES =====
const Utils = {
  // Debounce function para otimizar performance
  debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
      const later = () => {
        clearTimeout(timeout);
        func(...args);
      };
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
    };
  },

  // Throttle function para scroll events
  throttle(func, limit) {
    let inThrottle;
    return function() {
      const args = arguments;
      const context = this;
      if (!inThrottle) {
        func.apply(context, args);
        inThrottle = true;
        setTimeout(() => inThrottle = false, limit);
      }
    };
  },

  // Verificar se elemento está na viewport
  isInViewport(element, threshold = 0.2) {
    const rect = element.getBoundingClientRect();
    const windowHeight = window.innerHeight || document.documentElement.clientHeight;
    return (
      rect.top <= windowHeight * (1 - threshold) &&
      rect.bottom >= windowHeight * threshold
    );
  },

  // Smooth scroll para elemento
  smoothScrollTo(element, offset = 0) {
    if (!element) return;

    const elementPosition = element.getBoundingClientRect().top;
    const offsetPosition = elementPosition + window.pageYOffset - offset;

    // Usar scroll nativo se suportado
    if ('scrollBehavior' in document.documentElement.style) {
      window.scrollTo({
        top: offsetPosition,
        behavior: 'smooth'
      });
    } else {
      // Fallback para navegadores mais antigos
      this.animateScroll(offsetPosition);
    }
  },

  // Animação de scroll personalizada (fallback)
  animateScroll(targetPosition) {
    const startPosition = window.pageYOffset;
    const distance = targetPosition - startPosition;
    const duration = 800;
    let start = null;

    function step(timestamp) {
      if (!start) start = timestamp;
      const progress = timestamp - start;
      const percent = Math.min(progress / duration, 1);

      // Easing function (ease-out)
      const easeOut = 1 - Math.pow(1 - percent, 3);

      window.scrollTo(0, startPosition + distance * easeOut);

      if (progress < duration) {
        window.requestAnimationFrame(step);
      }
    }

    window.requestAnimationFrame(step);
  }
};

// ===== GERENCIADOR DE NAVEGAÇÃO =====
class NavigationManager {
  constructor() {
    this.header = document.querySelector('.site-header');
    this.navToggle = document.querySelector('.nav-toggle');
    this.navMenuMobile = document.querySelector('.nav-menu-mobile');
    this.navLinks = document.querySelectorAll('.nav-link');
    this.lastScrollY = 0;
    this.isMenuOpen = false;

    this.init();
  }

  init() {
    if (!this.header) return;

    this.bindEvents();
    this.handleScroll(); // Executar uma vez para estado inicial
  }

  bindEvents() {
    // Toggle do menu mobile
    if (this.navToggle && this.navMenuMobile) {
      this.navToggle.addEventListener('click', () => this.toggleMobileMenu());

      // Fechar menu com ESC
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && this.isMenuOpen) {
          this.closeMobileMenu();
        }
      });
    }

    // Scroll event com throttle
    window.addEventListener('scroll', Utils.throttle(() => this.handleScroll(), 16));

    // Smooth scroll para links de âncora
    this.navLinks.forEach(link => {
      link.addEventListener('click', (e) => this.handleAnchorClick(e));
    });

    // Fechar menu ao redimensionar tela
    window.addEventListener('resize', Utils.debounce(() => {
      if (window.innerWidth >= Config.breakpoints.mobile && this.isMenuOpen) {
        this.closeMobileMenu();
      }
    }, Config.debounceTime));
  }

  toggleMobileMenu() {
    if (this.isMenuOpen) {
      this.closeMobileMenu();
    } else {
      this.openMobileMenu();
    }
  }

  openMobileMenu() {
    this.isMenuOpen = true;
    this.navMenuMobile.classList.remove('hidden');
    this.navToggle.setAttribute('aria-expanded', 'true');
    this.navToggle.setAttribute('aria-label', 'Fechar menu de navegação');

    // Prevenir scroll do body
    document.body.style.overflow = 'hidden';

    // Focus no primeiro link do menu
    const firstLink = this.navMenuMobile.querySelector('a');
    if (firstLink) {
      firstLink.focus();
    }
  }

  closeMobileMenu() {
    this.isMenuOpen = false;
    this.navMenuMobile.classList.add('hidden');
    this.navToggle.setAttribute('aria-expanded', 'false');
    this.navToggle.setAttribute('aria-label', 'Abrir menu de navegação');

    // Restaurar scroll do body
    document.body.style.overflow = '';

    // Retornar focus para o botão toggle
    this.navToggle.focus();
  }

  handleScroll() {
    const currentScrollY = window.pageYOffset;

    // Adicionar classe quando rolar mais que o threshold
    if (currentScrollY > Config.scrollThreshold) {
      this.header.classList.add('header--scrolled');
    } else {
      this.header.classList.remove('header--scrolled');
    }

    // Esconder/mostrar header baseado na direção do scroll
    if (currentScrollY > this.lastScrollY && currentScrollY > 500) {
      // Rolando para baixo
      this.header.classList.add('header--hidden');
    } else {
      // Rolando para cima
      this.header.classList.remove('header--hidden');
    }

    this.lastScrollY = currentScrollY;
  }

  handleAnchorClick(e) {
    const href = e.currentTarget.getAttribute('href');

    if (!href || !href.startsWith('#')) return;

    e.preventDefault();

    // Fechar menu mobile se estiver aberto
    if (this.isMenuOpen) {
      this.closeMobileMenu();
    }

    const targetId = href.substring(1);
    const targetElement = document.getElementById(targetId);

    if (targetElement) {
      Utils.smoothScrollTo(targetElement, Config.headerHeight);

      // Atualizar URL sem recarregar página
      if (history.pushState) {
        history.pushState(null, null, href);
      }
    }
  }
}

// ===== GERENCIADOR DE ANIMAÇÕES =====
class AnimationManager {
  constructor() {
    this.animatedElements = document.querySelectorAll('.animate');
    this.observer = null;

    this.init();
  }

  init() {
    // Verificar se usuário prefere movimento reduzido
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (prefersReducedMotion) {
      // Mostrar todos os elementos imediatamente
      this.animatedElements.forEach(el => {
        el.classList.add('animate-in');
      });
      return;
    }

    this.setupIntersectionObserver();
  }

  setupIntersectionObserver() {
    // Verificar suporte ao Intersection Observer
    if (!('IntersectionObserver' in window)) {
      // Fallback: mostrar todos os elementos
      this.animatedElements.forEach(el => {
        el.classList.add('animate-in');
      });
      return;
    }

    const observerOptions = {
      threshold: 0.2,
      rootMargin: '0px 0px -100px 0px'
    };

    this.observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('animate-in');
          this.observer.unobserve(entry.target);
        }
      });
    }, observerOptions);

    // Observar todos os elementos animados
    this.animatedElements.forEach(el => {
      this.observer.observe(el);
    });
  }
}

// ===== GERENCIADOR DE FORMULÁRIOS =====
class FormManager {
  constructor() {
    this.forms = document.querySelectorAll('form');
    this.init();
  }

  init() {
    this.forms.forEach(form => {
      this.bindFormEvents(form);
    });
  }

  bindFormEvents(form) {
    // Validação em tempo real
    const inputs = form.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
      input.addEventListener('blur', () => this.validateField(input));
      input.addEventListener('input', Utils.debounce(() => this.validateField(input), 300));
    });

    // Submit do formulário
    form.addEventListener('submit', (e) => this.handleSubmit(e));
  }

  validateField(field) {
    const value = field.value.trim();
    const fieldName = field.name || field.id;
    let isValid = true;
    let errorMessage = '';

    // Limpar erros anteriores
    this.clearFieldError(field);

    // Validações básicas
    if (field.hasAttribute('required') && !value) {
      isValid = false;
      errorMessage = `${fieldName} é obrigatório`;
    }

    // Validação de email
    if (field.type === 'email' && value) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(value)) {
        isValid = false;
        errorMessage = 'Por favor, insira um email válido';
      }
    }

    // Validação de telefone
    if (field.type === 'tel' && value) {
      const phoneRegex = /^[\d\s\-\(\)\+]+$/;
      if (!phoneRegex.test(value)) {
        isValid = false;
        errorMessage = 'Por favor, insira um telefone válido';
      }
    }

    if (!isValid) {
      this.showFieldError(field, errorMessage);
    }

    return isValid;
  }

  showFieldError(field, message) {
    field.classList.add('error');
    field.setAttribute('aria-invalid', 'true');

    // Criar ou atualizar mensagem de erro
    let errorElement = field.parentNode.querySelector('.error-message');
    if (!errorElement) {
      errorElement = document.createElement('div');
      errorElement.className = 'error-message text-red-600 text-sm mt-1';
      errorElement.setAttribute('role', 'alert');
      field.parentNode.appendChild(errorElement);
    }

    errorElement.textContent = message;
    field.setAttribute('aria-describedby', errorElement.id || 'error-' + field.name);
  }

  clearFieldError(field) {
    field.classList.remove('error');
    field.setAttribute('aria-invalid', 'false');

    const errorElement = field.parentNode.querySelector('.error-message');
    if (errorElement) {
      errorElement.remove();
    }
  }

  handleSubmit(e) {
    e.preventDefault();

    const form = e.target;
    const inputs = form.querySelectorAll('input, textarea, select');
    let isFormValid = true;

    // Validar todos os campos
    inputs.forEach(input => {
      if (!this.validateField(input)) {
        isFormValid = false;
      }
    });

    if (isFormValid) {
      this.submitForm(form);
    } else {
      // Focar no primeiro campo com erro
      const firstError = form.querySelector('.error');
      if (firstError) {
        firstError.focus();
      }
    }
  }

  submitForm(form) {
    // Aqui você implementaria a lógica de envio
    // Por enquanto, apenas mostrar mensagem de sucesso

    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;

    submitBtn.textContent = 'Enviando...';
    submitBtn.disabled = true;

    // Simular envio
    setTimeout(() => {
      alert('Mensagem enviada com sucesso!');
      form.reset();
      submitBtn.textContent = originalText;
      submitBtn.disabled = false;
    }, 1000);
  }
}

// ===== GERENCIADOR DE ACESSIBILIDADE =====
class AccessibilityManager {
  constructor() {
    this.init();
  }

  init() {
    this.setupKeyboardNavigation();
    this.setupFocusManagement();
    this.setupARIALiveRegions();
  }

  setupKeyboardNavigation() {
    // Navegação por Tab melhorada
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Tab') {
        document.body.classList.add('keyboard-navigation');
      }
    });

    // Remover classe quando usar mouse
    document.addEventListener('mousedown', () => {
      document.body.classList.remove('keyboard-navigation');
    });
  }

  setupFocusManagement() {
    // Melhorar indicadores de focus
    const focusableElements = document.querySelectorAll(
      'a, button, input, textarea, select, [tabindex]:not([tabindex="-1"])'
    );

    focusableElements.forEach(element => {
      element.addEventListener('focus', () => {
        element.classList.add('focused');
      });

      element.addEventListener('blur', () => {
        element.classList.remove('focused');
      });
    });
  }

  setupARIALiveRegions() {
    // Criar região live para anúncios dinâmicos
    const liveRegion = document.createElement('div');
    liveRegion.setAttribute('aria-live', 'polite');
    liveRegion.setAttribute('aria-atomic', 'true');
    liveRegion.className = 'sr-only';
    liveRegion.id = 'live-announcements';
    document.body.appendChild(liveRegion);
  }

  announce(message) {
    const liveRegion = document.getElementById('live-announcements');
    if (liveRegion) {
      liveRegion.textContent = message;

      // Limpar após 5 segundos
      setTimeout(() => {
        liveRegion.textContent = '';
      }, 5000);
    }
  }
}

// ===== GERENCIADOR DE PERFORMANCE =====
class PerformanceManager {
  constructor() {
    this.lazyImages = document.querySelectorAll('img[loading="lazy"]');
    this.init();
  }

  init() {
    this.setupLazyLoading();
    this.preloadCriticalResources();
  }

  setupLazyLoading() {
    // Fallback para navegadores que não suportam loading="lazy"
    if ('loading' in HTMLImageElement.prototype) {
      return; // Navegador suporta lazy loading nativo
    }

    // Implementar lazy loading com Intersection Observer
    if ('IntersectionObserver' in window) {
      const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const img = entry.target;
            img.src = img.dataset.src || img.src;
            img.classList.remove('lazy');
            imageObserver.unobserve(img);
          }
        });
      });

      this.lazyImages.forEach(img => {
        img.classList.add('lazy');
        imageObserver.observe(img);
      });
    } else {
      // Fallback: carregar todas as imagens
      this.lazyImages.forEach(img => {
        img.src = img.dataset.src || img.src;
      });
    }
  }

  preloadCriticalResources() {
    // Preload de recursos críticos
    const criticalImages = [
      'assets/images/logo.png',
      'assets/images/floresta-bg.jpg'
    ];

    criticalImages.forEach(src => {
      const link = document.createElement('link');
      link.rel = 'preload';
      link.as = 'image';
      link.href = src;
      document.head.appendChild(link);
    });
  }
}

// ===== INICIALIZAÇÃO =====
class App {
  constructor() {
    this.navigationManager = null;
    this.animationManager = null;
    this.formManager = null;
    this.accessibilityManager = null;
    this.performanceManager = null;

    this.init();
  }

  init() {
    // Aguardar DOM estar pronto
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', () => this.initializeManagers());
    } else {
      this.initializeManagers();
    }
  }

  initializeManagers() {
    try {
      // Inicializar gerenciadores em ordem de prioridade
      this.accessibilityManager = new AccessibilityManager();
      this.performanceManager = new PerformanceManager();
      this.navigationManager = new NavigationManager();
      this.animationManager = new AnimationManager();
      this.formManager = new FormManager();

      // Log de inicialização bem-sucedida
      console.log('🌿 Casa de Caridade - Sistema inicializado com sucesso');

      // Anunciar carregamento para screen readers
      if (this.accessibilityManager) {
        setTimeout(() => {
          this.accessibilityManager.announce('Página carregada com sucesso');
        }, 1000);
      }

    } catch (error) {
      console.error('Erro na inicialização:', error);
      this.handleInitializationError(error);
    }
  }

  handleInitializationError(error) {
    // Fallback gracioso em caso de erro
    console.warn('Modo de compatibilidade ativado devido a erro:', error.message);

    // Funcionalidade básica de navigation
    this.setupBasicNavigation();
  }

  setupBasicNavigation() {
    // Implementação básica sem recursos avançados
    const navLinks = document.querySelectorAll('a[href^="#"]');

    navLinks.forEach(link => {
      link.addEventListener('click', (e) => {
        const href = link.getAttribute('href');
        const target = document.querySelector(href);

        if (target) {
          e.preventDefault();
          target.scrollIntoView({ behavior: 'smooth' });
        }
      });
    });
  }
}

// ===== UTILITÁRIOS GLOBAIS =====
window.CasaDeCaridade = {
  // Função para anunciar mensagens para screen readers
  announce: function(message) {
    if (window.app && window.app.accessibilityManager) {
      window.app.accessibilityManager.announce(message);
    }
  },

  // Função para scroll suave para elemento
  scrollTo: function(selector, offset = 80) {
    const element = document.querySelector(selector);
    if (element) {
      Utils.smoothScrollTo(element, offset);
    }
  },

  // Verificar se está em modo de alta acessibilidade
  isHighContrastMode: function() {
    return window.matchMedia('(prefers-contrast: high)').matches;
  },

  // Verificar se prefere movimento reduzido
  prefersReducedMotion: function() {
    return window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  }
};

// ===== INICIALIZAR APLICAÇÃO =====
window.app = new App();

// ===== SERVICE WORKER (OPCIONAL) =====
if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    navigator.serviceWorker.register('/sw.js')
      .then(registration => {
        console.log('SW registrado com sucesso:', registration);
      })
      .catch(error => {
        console.log('Falha no registro do SW:', error);
      });
  });
}

// ===== EXPORT PARA MÓDULOS (SE NECESSÁRIO) =====
if (typeof module !== 'undefined' && module.exports) {
  module.exports = {
    NavigationManager,
    AnimationManager,
    FormManager,
    AccessibilityManager,
    PerformanceManager,
    Utils
  };
}
