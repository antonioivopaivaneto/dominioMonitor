<script setup>
import LandingLayout from '@/Layouts/LandingLayout.vue'
import axios from 'axios'
import { ref } from 'vue'

const email = ref('')
const loading = ref(false)

const baixarPdf = async () => {
  loading.value = true

  try {
    // 1️⃣ Salva o lead
    await axios.post('/baixar-pdf', {
      email: email.value,
    })

    // 2️⃣ Faz download do PDF
    const response = await axios.get('/download-pdf', {
      responseType: 'blob',
    })

    const blob = new Blob([response.data], {
      type: 'application/pdf',
    })

    const url = window.URL.createObjectURL(blob)

    const link = document.createElement('a')
    link.href = url
    link.setAttribute('download', 'Guia_Notiflow_Agencias.pdf')
    document.body.appendChild(link)
    link.click()

    link.remove()
    window.URL.revokeObjectURL(url)

  } catch (error) {
    alert('Erro ao baixar o PDF')
  } finally {
    loading.value = false
  }
}
</script>

<template>
  <LandingLayout>

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
              class="inline-flex items-center justify-center px-6 py-3 rounded-xl
                     bg-sky-500 hover:bg-sky-400 text-slate-900 font-semibold transition"
            >
              Testar gratuitamente
            </a>

            <a
              href="/login"
              class="inline-flex items-center justify-center px-6 py-3 rounded-xl
                     border border-slate-700 hover:border-slate-500 text-white transition"
            >
              Começar agora
            </a>
          </div>
        </div>

        <!-- VISUAL / MOCK -->
<div class="relative group">

  <!-- GLOW -->
  <div
    class="pointer-events-none absolute -inset-6
           bg-sky-500/40
           blur-3xl
           rounded-3xl
           opacity-30
           group-hover:opacity-100
           transition-opacity duration-300"
  />

  <!-- CARD -->
  <div
    class="relative bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-xl
           transition-all duration-300 ease-out
           group-hover:-translate-y-2
           group-hover:rotate-1
           group-hover:shadow-2xl"
  >
    <div class="flex items-center justify-between mb-4">
      <span class="text-sm text-slate-400">
        Alertas em tempo real
      </span>

      <span
        class="text-xs bg-red-500/20 text-red-400 px-3 py-1 rounded-full
               transition-transform duration-300
               group-hover:scale-105"
      >
        Site fora do ar
      </span>
    </div>

    <div class="space-y-3 text-sm">
      <div class="flex justify-between transition-all group-hover:translate-x-1">
        <span>cliente-site.com.br</span>
        <span class="text-red-400 font-semibold">Offline</span>
      </div>

      <div class="flex justify-between transition-all delay-75 group-hover:translate-x-1">
        <span>meucliente.net</span>
        <span class="text-yellow-400 font-semibold">
          Domínio vence em 5 dias
        </span>
      </div>

      <div class="flex justify-between transition-all delay-100 group-hover:translate-x-1">
        <span>agenciaxyz.com</span>
        <span class="text-green-400 font-semibold">Online</span>
      </div>
    </div>
  </div>

</div>


      </div>
    </section>

    <!-- PROBLEMA / CONSEQUÊNCIA -->
<section class="bg-slate-950 py-24 border-t border-slate-800 -mt-40">
  <div class="max-w-6xl mx-auto px-6 text-center">

    <h2 class="text-3xl md:text-4xl font-extrabold mb-6">
      Sites fora do ar <span class="text-red-400">custam clientes.</span>
    </h2>

    <p class="text-slate-400 max-w-3xl mx-auto mb-12 text-lg">
      Quando um site cai ou um domínio vence, o prejuízo vai muito além do técnico.
      Ele afeta diretamente a confiança e a decisão de compra.
    </p>

    <div class="grid md:grid-cols-3 gap-8">

      <div class="bg-slate-900 border border-slate-800 rounded-2xl p-8">
        <h3 class="text-4xl font-extrabold text-red-400 mb-2">60%</h3>
        <p class="text-slate-300">
          dos usuários <strong>não voltam</strong> a um site que ficou fora do ar.
        </p>
      </div>

      <div class="bg-slate-900 border border-slate-800 rounded-2xl p-8">
        <h3 class="text-4xl font-extrabold text-yellow-400 mb-2">1 clique</h3>
        <p class="text-slate-300">
          é tudo o que o cliente precisa para ir para o concorrente.
        </p>
      </div>

      <div class="bg-slate-900 border border-slate-800 rounded-2xl p-8">
        <h3 class="text-4xl font-extrabold text-sky-400 mb-2">Agências</h3>
        <p class="text-slate-300">
          perdem credibilidade quando descobrem o problema <em>depois</em> do cliente.
        </p>
      </div>

    </div>
  </div>
</section>

<!-- RESULTADOS / ESTATÍSTICAS -->
<section class="bg-slate-900 py-24 border-t border-slate-800">
  <div class="max-w-6xl mx-auto px-6">

    <!-- TÍTULO -->
    <div class="text-center mb-16">
      <h2 class="text-3xl md:text-4xl font-extrabold mb-4">
        O que o Notiflow ajuda sua agência a evitar
      </h2>

      <p class="text-slate-400 text-lg max-w-3xl mx-auto">
        Não é sobre controlar tudo.
        É sobre **ser avisado antes do prejuízo acontecer**.
      </p>
    </div>

    <!-- NÚMEROS -->
    <div class="grid md:grid-cols-4 gap-8 mb-20">

      <div class="bg-slate-950 border border-slate-800 rounded-2xl p-8 text-center">
        <p class="text-4xl font-extrabold text-sky-400 mb-2">-72%</p>
        <p class="text-slate-300 text-sm">
          menos riscos de perder clientes por sites fora do ar
        </p>
      </div>

      <div class="bg-slate-950 border border-slate-800 rounded-2xl p-8 text-center">
        <p class="text-4xl font-extrabold text-yellow-400 mb-2">100%</p>
        <p class="text-slate-300 text-sm">
          dos vencimentos de domínio monitorados automaticamente
        </p>
      </div>

      <div class="bg-slate-950 border border-slate-800 rounded-2xl p-8 text-center">
        <p class="text-4xl font-extrabold text-green-400 mb-2">24/7</p>
        <p class="text-slate-300 text-sm">
          monitoramento contínuo sem depender de verificação manual
        </p>
      </div>

      <div class="bg-slate-950 border border-slate-800 rounded-2xl p-8 text-center">
        <p class="text-4xl font-extrabold text-red-400 mb-2">0</p>
        <p class="text-slate-300 text-sm">
          sustos causados por “cliente avisando o problema”
        </p>
      </div>


    </div>

    <!-- GUIA -->
    <div class="grid md:grid-cols-2 gap-12 items-center">

      <!-- TEXTO -->
      <div>
        <h3 class="text-2xl md:text-3xl font-bold mb-6">
          Você continua sendo a agência.<br />
          <span class="text-sky-400">O Notiflow é o seu alerta antecipado.</span>
        </h3>

        <p class="text-slate-400 mb-6">
          O Notiflow não substitui sua operação.
          Ele garante que você saiba dos problemas antes que
          eles virem reclamações, perda de contratos ou crises desnecessárias.
        </p>

        <ul class="space-y-4 text-slate-300">
          <li class="flex gap-3">
            <span class="text-sky-400">✔</span>
            Detecta quedas de sites automaticamente
          </li>
          <li class="flex gap-3">
            <span class="text-sky-400">✔</span>
            Avisa sobre vencimento de domínios com antecedência
          </li>
          <li class="flex gap-3">
            <span class="text-sky-400">✔</span>
            Centraliza tudo em um painel simples
          </li>
          <li class="flex gap-3">
            <span class="text-sky-400">✔</span>
            Protege a credibilidade da sua agência
          </li>
        </ul>
<a
              href="/register"
              class="inline-flex items-center justify-center px-6 py-3 rounded-xl
                     bg-sky-500 hover:bg-sky-400 text-slate-900 font-semibold transition mt-5 z-50"
            >
              Testar gratuitamente
            </a>
      </div>

      <!-- CARD RESUMO -->

      <div class="relative group">

        <div
          class="absolute -inset-6 bg-sky-500/20 blur-3xl rounded-3xl
                 opacity-30 group-hover:opacity-60 transition"
        />

        <div class="relative bg-slate-950 border border-slate-800 rounded-2xl p-8">
          <h4 class="text-lg font-semibold mb-4 text-white">
            Em resumo:
          </h4>

          <p class="text-slate-400 mb-6">
            Menos apagão, menos esquecimento,
            menos desgaste com cliente.
          </p>

          <p class="text-slate-300 font-semibold">
            Mais controle. Mais confiança. Mais profissionalismo.
          </p>
        </div>

      </div>


    </div>
  </div>
</section>


<!-- LEAD MAGNET -->
<section class="bg-slate-950 py-24 border-t border-slate-800">
  <div class="max-w-4xl mx-auto px-6 text-center">

    <h2 class="text-3xl md:text-4xl font-extrabold mb-6">
      Evite problemas antes que eles aconteçam.
    </h2>

    <p class="text-slate-400 mb-10 text-lg max-w-2xl mx-auto">
      Baixe gratuitamente um PDF com dicas práticas para agências evitarem
      quedas de sites, vencimento de domínios e crises com clientes.
    </p>





      <input
        type="email"
        name="email"
           v-model="email"


        placeholder="Digite seu melhor email"
        class="flex-1 px-5 py-3 rounded-xl
               bg-slate-900 border border-slate-700
               text-white placeholder-slate-400
               focus:border-sky-500 focus:ring-sky-500 mx-2"
        required
      />

      <button
      @click="baixarPdf"
      :disabled="loading"
      class="px-6 py-3 rounded-xl
             bg-sky-500 hover:bg-sky-400
             text-slate-900 font-semibold transition
             disabled:opacity-50"
    >
      {{ loading ? 'Baixando...' : 'Quero o PDF' }}
    </button>


    <p class="mt-4 text-sm text-slate-500">
      Sem spam. Conteúdo direto para quem gerencia vários sites.
    </p>
  </div>
</section>


<!-- CONVERSA HUMANA -->
<section class="bg-slate-900 py-20 border-t border-slate-800">
  <div class="max-w-5xl mx-auto px-6 text-center">

    <h2 class="text-3xl md:text-4xl font-extrabold mb-6">
      Aqui você fala com <span class="text-sky-400">pessoas de verdade.</span>
    </h2>

    <p class="text-slate-400 max-w-2xl mx-auto mb-10 text-lg">
      A gente acredita que boas ferramentas não substituem boas conversas.
      Se quiser entender melhor se o Notiflow faz sentido para sua agência,
      é só chamar no WhatsApp.
    </p>

    <a
      href="https://wa.me/5511980985640?text=Oi%2C%20vi%20o%20Notiflow%20e%20quero%20conversar%20com%20voc%C3%AAs"
      target="_blank"
      class="inline-flex items-center gap-3 px-8 py-4 rounded-xl
             bg-green-500 hover:bg-green-400
             text-slate-900 font-semibold text-lg transition"
    >
      💬 Conversar no WhatsApp
    </a>

    <p class="mt-4 text-sm text-slate-500">
      Sem bots. Sem formulários infinitos. Só conversa direta.
    </p>
  </div>
</section>



    <!-- FOOTER -->
    <footer class="border-t border-slate-800 py-6 text-center text-sm text-slate-500">
      © 2026 Notiflow. Todos os direitos reservados.
    </footer>

  </LandingLayout>
</template>
