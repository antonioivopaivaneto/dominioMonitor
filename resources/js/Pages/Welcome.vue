<template>

<body class="bg-slate-950 text-white antialiased">

  <!-- HERO SECTION -->
  <section class="min-h-screen flex items-center">
    <div class="max-w-6xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-12 items-center">

      <!-- TEXTO -->
      <div>
        <span class="inline-block mb-4 text-sm font-semibold text-sky-400 uppercase tracking-wide">
          Para agências que gerenciam vários sites
        </span>

        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight mb-6">
          Antes do cliente reclamar,<br />
          <span class="text-sky-400">o Notiflow avisa.</span>
        </h1>

        <p class="text-lg text-slate-300 mb-8 max-w-xl">
          Monitore todos os sites e domínios dos seus clientes em um só lugar e receba alertas automáticos quando algo sair do ar ou estiver perto do vencimento.
        </p>

        <!-- CTAs -->
        <div class="flex flex-col sm:flex-row gap-4">
          <a
            href="/register"
            class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-sky-500 hover:bg-sky-400 text-slate-900 font-semibold transition"
          >
            Testar gratuitamente
          </a>

          <a
            href="/login"
            class="inline-flex items-center justify-center px-6 py-3 rounded-xl border border-slate-700 hover:border-slate-500 text-white transition"
          >
            Começar agora
          </a>
        </div>
      </div>

      <!-- VISUAL / MOCK -->
      <div class="relative">
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-xl">
          <div class="flex items-center justify-between mb-4">
            <span class="text-sm text-slate-400">Alertas em tempo real</span>
            <span class="text-xs bg-red-500/20 text-red-400 px-3 py-1 rounded-full">
              Site fora do ar
            </span>
          </div>

          <div class="space-y-3 text-sm">
            <div class="flex justify-between">
              <span>cliente-site.com.br</span>
              <span class="text-red-400 font-semibold">Offline</span>
            </div>
            <div class="flex justify-between">
              <span>meucliente.net</span>
              <span class="text-yellow-400 font-semibold">Domínio vence em 5 dias</span>
            </div>
            <div class="flex justify-between">
              <span>agenciaxyz.com</span>
              <span class="text-green-400 font-semibold">Online</span>
            </div>
          </div>
        </div>

        <!-- Glow -->
        <div class="absolute -inset-1 bg-sky-500/20 blur-2xl rounded-2xl -z-10"></div>
      </div>

    </div>
  </section>

  <!-- FOOTER SIMPLES -->
  <footer class="border-t border-slate-800 py-6 text-center text-sm text-slate-500">
    © 2026 Notiflow. Todos os direitos reservados.
  </footer>

</body>
</template>
