<script setup lang="ts">
import { computed } from 'vue';
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import { SidebarTrigger } from '@/components/ui/sidebar';
import type { BreadcrumbItemType } from '@/types';

const props = withDefaults(
  defineProps<{ breadcrumbs?: BreadcrumbItemType[] }>(),
  { breadcrumbs: () => [] },
);

const pageTitle = computed(() => {
  const last = props.breadcrumbs?.[props.breadcrumbs.length - 1];
  return (last && last.title) || '';
});
</script>

<template>
  <header class="relative isolate overflow-visible">
    <!-- Hintergrund-Gradient -->
    <span aria-hidden="true" class="header-gradient pointer-events-none absolute inset-0 z-0" />

    <!-- Zeile mit Breadcrumbs -->
    <div class="relative z-10 flex h-16 shrink-0 items-center gap-2 border-sidebar-border/70 px-6 transition-[width,height] ease-linear group-has-data-[collapsible=icon]/sidebar-wrapper:h-12 md:px-4">
      <div class="flex items-center gap-2">
        <SidebarTrigger class="-ml-1" />
        <template v-if="breadcrumbs && breadcrumbs.length > 0">
          <Breadcrumbs :breadcrumbs="breadcrumbs" />
        </template>
      </div>
    </div>

    <!-- Zeile mit Seitentitel -->
    <div class="relative z-10 flex items-center gap-2 border-b border-sidebar-border/70 px-6 transition-[width,height] ease-linear md:px-4">
      <h1
        v-if="pageTitle"
        class="my-4 line-clamp-1 text-2xl md:text-3xl font-medium text-foreground/90 tracking-tight"
        :title="pageTitle"
      >
        {{ pageTitle }}
      </h1>
    </div>
  </header>
</template>

<!-- Keyframes ungescoped lassen -->
<style>
@keyframes floaty {
  0%   { transform: translate3d(-20%, -60%, 0)    scale(1.2); }
  100% { transform: translate3d(0%, 0%, 0)  scale(0.8); }
}

@media (prefers-reduced-motion: reduce) {
  .header-gradient::before { animation: none !important; }
}
</style>

<style scoped>
.header-gradient {
  position: absolute;
  inset: 0;
  transform: scale(1.05);
  will-change: transform, filter;
}

.header-gradient::before {
  content: "";
  position: absolute;
  inset: -12% -12% -35% -12%;
  background:
  radial-gradient(58rem 28rem at 68% -10%, hsla(108, 88%, 70%, 0.82) 0, transparent 64%), /* Hellblau */
  radial-gradient(48rem 26rem at 82% 18%,  hsla(138, 77%, 44%, 0.78) 0, transparent 65%), /* Minzgrün */
  radial-gradient(44rem 24rem at 60% 52%,  hsla(115, 76%, 55%, 0.55) 0, transparent 70%),
  radial-gradient(70rem 34rem at 88% 36%,  hsla(194, 77%, 50%, 0.7) 0, transparent 68%); /* Aqua */
background-blend-mode: screen;
filter: blur(55px) saturate(108%) brightness(102%);
  opacity: 0.7;
  animation: floaty 8s ease-in-out infinite alternate;
  will-change: transform;
  backface-visibility: hidden;
}

.header-gradient::after {
  content: "";
  position: absolute;
  inset: 0;
  opacity: 0.035;
  mix-blend-mode: overlay;
  background-image:
    url("data:image/svg+xml;charset=utf-8,\
      <svg xmlns='http://www.w3.org/2000/svg' width='64' height='64'>\
      <filter id='n'><feTurbulence type='fractalNoise' baseFrequency='.9' numOctaves='2' stitchTiles='stitch'/><feColorMatrix type='saturate' values='0'/></filter>\
      <rect width='100%%' height='100%%' filter='url(#n)' opacity='.25'/></svg>");
  background-size: 180px 180px;
  pointer-events: none;
}

/* --- Dark Mode: stärkere Sättigung, etwas mehr Blur, rechts fokussierte Farben --- */
.dark .header-gradient::before {
  /* gleiche Positionierung wie deine helle Variante */
  inset: -12% -12% -35% -12%;
  background:
    /* Electric Blue (oben-rechts) */
    radial-gradient(60rem 30rem at 70% -12%, hsl(210 90% 66% / 0.65) 0, transparent 62%),
    /* Aqua (mittig-rechts) */
    radial-gradient(52rem 26rem at 85% 18%,  hsl(190 85% 60% / 0.60) 0, transparent 66%),
    /* Emerald (mitte-unten-rechts) */
    radial-gradient(46rem 24rem at 62% 56%,  hsla(101, 70%, 52%, 0.55) 0, transparent 70%),
    /* Lilac Akzent (sanft, für mehr Farbraum) */
    radial-gradient(70rem 36rem at 88% 38%,  hsl(265 70% 64% / 0.30) 0, transparent 68%);
  background-blend-mode: screen;
  /* etwas stärkerer Glow auf dunklem Grund, aber nicht zu grell */
  filter: blur(70px) saturate(135%) brightness(115%);
  opacity: 0.5; /* minimal geringer als im Light Mode, sonst wird’s zu hell */
}

.dark .header-gradient::after {
  /* leicht stärkeres Noise + softer Blend auf dunklem Grund */
  opacity: 0.06;
  mix-blend-mode: soft-light;
  background-size: 160px 160px;
}


</style>
