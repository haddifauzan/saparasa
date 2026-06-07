/**
 * Admin Panel JavaScript — Saparasa
 */

const sidebar = document.getElementById('sidebar');
const topbar  = document.getElementById('topbar');
const mainContent = document.getElementById('main-content');
const overlay = document.getElementById('sidebar-overlay');

function isMobile() {
  return window.innerWidth < 992;
}

// Toggle sidebar
function toggleSidebar() {
  if (isMobile()) {
    sidebar.classList.toggle('mobile-open');
    document.body.classList.toggle('sidebar-open');
  } else {
    sidebar.classList.toggle('collapsed');
    topbar.classList.toggle('sidebar-collapsed');
    mainContent.classList.toggle('sidebar-collapsed');
    localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
  }
}

// Restore sidebar state on desktop
window.addEventListener('DOMContentLoaded', () => {
  if (!isMobile() && localStorage.getItem('sidebarCollapsed') === 'true') {
    sidebar.classList.add('collapsed');
    topbar.classList.add('sidebar-collapsed');
    mainContent.classList.add('sidebar-collapsed');
  }

  // Animate stat numbers
  animateCounters();

  // Animate progress bars
  animateProgressBars();
});

// Close sidebar on resize to desktop
window.addEventListener('resize', () => {
  if (!isMobile()) {
    sidebar.classList.remove('mobile-open');
    document.body.classList.remove('sidebar-open');
  }
});

// Counter animation
function animateCounters() {
  const counters = document.querySelectorAll('[data-count]');
  counters.forEach(el => {
    const target = parseInt(el.getAttribute('data-count'));
    const prefix = el.getAttribute('data-prefix') || '';
    const suffix = el.getAttribute('data-suffix') || '';
    let current = 0;
    const step = Math.ceil(target / 60);
    const timer = setInterval(() => {
      current += step;
      if (current >= target) { current = target; clearInterval(timer); }
      el.textContent = prefix + current.toLocaleString('id-ID') + suffix;
    }, 16);
  });
}

// Progress bar animation
function animateProgressBars() {
  const bars = document.querySelectorAll('.progress-fill[data-width]');
  setTimeout(() => {
    bars.forEach(bar => {
      bar.style.width = bar.getAttribute('data-width') + '%';
    });
  }, 300);
}

// Update live time
function updateTime() {
  const el = document.getElementById('live-time');
  if (!el) return;
  const now = new Date();
  el.textContent = now.toLocaleString('id-ID', {
    weekday: 'long', year: 'numeric', month: 'long',
    day: 'numeric', hour: '2-digit', minute: '2-digit'
  });
}
updateTime();
setInterval(updateTime, 60000);
