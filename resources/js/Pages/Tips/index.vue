<template>
    <authenticated-layout>
      <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold text-center text-gray-800 mb-6">Possiveis Erros do Site</h1>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
          <table class="min-w-full text-sm text-left text-gray-500">
            <thead class="bg-gray-100">
              <tr>
                <th class="py-3 px-6 font-medium text-gray-700">ID</th>
                <th class="py-3 px-6 font-medium text-gray-700">Erro</th>
                <th class="py-3 px-6 font-medium text-gray-700">Nivel</th>
                <th class="py-3 px-6 font-medium text-gray-700">Sugestão</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(error, index) in errors" :key="index" class="border-b">
                <td class="py-3 px-6">{{ error.id }}</td>
                <td class="py-3 px-6">{{ error.error }}</td>
                <td class="py-3 px-6">
                  <span :class="getStatusClass(error.status)">
                    {{ error.status }}
                  </span>
                </td>
                <td class="py-3 px-6">{{ error.suggestion }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </authenticated-layout>
  </template>

  <script setup>
  import { ref } from 'vue';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

  // Estrutura de dados para erros (com 20 erros)
  const errors = ref([
    { id: 1, error: "Erro de Conexão", status: "Crítico", suggestion: "Verifique sua conexão com a internet ou o servidor." },
    { id: 2, error: "Página Não Encontrada", status: "Moderado", suggestion: "Verifique a URL ou se a página foi removida." },
    { id: 3, error: "Erro de Formulário", status: "Baixo", suggestion: "Verifique os campos obrigatórios e os tipos de dados." },
    { id: 4, error: "Erro no Banco de Dados", status: "Crítico", suggestion: "Verifique a conexão com o banco de dados e as permissões." },
    { id: 5, error: "Erro 500 - Erro Interno no Servidor", status: "Crítico", suggestion: "Verifique o log do servidor para detalhes sobre a falha." },
    { id: 6, error: "Erro 404 - Página Não Encontrada", status: "Moderado", suggestion: "Verifique se o link da página está correto ou se a página foi removida." },
    { id: 7, error: "Erro 403 - Acesso Negado", status: "Moderado", suggestion: "Verifique as permissões de acesso para o usuário." },
    { id: 8, error: "Erro de Timeout", status: "Baixo", suggestion: "Verifique a conexão com o servidor e a configuração de tempo de resposta." },
    { id: 9, error: "Erro de Validação de Formulário", status: "Baixo", suggestion: "Verifique se os dados inseridos estão corretos e completos." },
    { id: 10, error: "Erro 503 - Serviço Indisponível", status: "Crítico", suggestion: "Verifique se o servidor está em manutenção ou se há problemas de carga." },
    { id: 11, error: "Erro de JavaScript", status: "Moderado", suggestion: "Verifique o console do navegador para mensagens de erro." },
    { id: 12, error: "Erro de CSS", status: "Moderado", suggestion: "Verifique se os estilos estão sendo aplicados corretamente ou se há conflitos." },
    { id: 13, error: "Erro 401 - Não Autorizado", status: "Moderado", suggestion: "Verifique as credenciais de autenticação do usuário." },
    { id: 14, error: "Erro de Rede", status: "Baixo", suggestion: "Verifique se a rede está funcionando corretamente e sem interrupções." },
    { id: 15, error: "Erro de Certificado SSL", status: "Moderado", suggestion: "Verifique a validade do certificado SSL do servidor." },
    { id: 16, error: "Erro de Banco de Dados Desconhecido", status: "Crítico", suggestion: "Consulte os logs do banco de dados para identificar o erro." },
    { id: 17, error: "Erro de CORS", status: "Moderado", suggestion: "Verifique as configurações de CORS no servidor." },
    { id: 18, error: "Erro de Importação de Módulo", status: "Baixo", suggestion: "Verifique se o módulo está corretamente instalado e importado." },
    { id: 19, error: "Erro de Memory Leak", status: "Crítico", suggestion: "Revise o código para encontrar e corrigir vazamentos de memória." },
    { id: 20, error: "Erro de API Externa", status: "Moderado", suggestion: "Verifique a disponibilidade e a resposta da API externa." },
  ]);

  // Função para determinar a classe de status
  const getStatusClass = (status) => {
    if (status === 'Crítico') {
      return 'text-red-600 font-semibold';
    } else if (status === 'Moderado') {
      return 'text-orange-500 font-semibold';
    } else {
      return 'text-green-500 font-semibold';
    }
  };
  </script>

  <style scoped>
  .container {
    max-width: 900px;
    margin: 0 auto;
  }
  </style>
