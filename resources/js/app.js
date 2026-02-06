import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

// js cho trang sản phẩm
document.addEventListener('click', function (e) {

    const thumb = e.target.closest('.thumb');
    if (!thumb) return;

    const type = thumb.dataset.type;
    const mainViewer = document.getElementById('mainViewer');
    const mainImage  = document.getElementById('mainImage');

    // remove active
    document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
    thumb.classList.add('active');

    if (type === 'image') {
        mainImage.src = thumb.dataset.src;
        mainImage.style.display = 'block';
        mainViewer.style.display = 'none';
    }

    if (type === 'model') {
        mainViewer.style.display = 'block';
        mainImage.style.display = 'none';
    }
});

function initDetailTabs() {
  const tabs = document.querySelectorAll('.detail__tab');
  const tabContents = document.querySelectorAll('.details__tab-content');

  if (!tabs.length || !tabContents.length) return;

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      // remove active
      tabs.forEach(t => t.classList.remove('active-tab'));
      tabContents.forEach(c => c.classList.remove('active-tab'));

      // add active
      tab.classList.add('active-tab');
      const target = document.querySelector(tab.dataset.target);
      if (target) {
        target.classList.add('active-tab');
      }
    });
  });
}

document.addEventListener('DOMContentLoaded', () => {
  initDetailTabs();
});
