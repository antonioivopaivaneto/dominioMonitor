<template>


                <div
                    class="bg-[#111] p-2 rounded-md mt-10 text-gray-400 flex flex-col"
                >
                    <div class="">Domain:wwwteste.com.br</div>
                    <div class="">Register in:20/20/2025</div>
                    <div class="">Expiration:20/20/2025</div>
                </div>

                <div class="mt-6">
                    <h4 class="text-lg font-semibold text-gray-200 mb-4">
                        Configuração de Notificação
                    </h4>
                    <form>
                        <div class="flex flex-col gap-4">
                            <div class="">
                                <label
                                    class="block text-sm font-medium text-gray-200"
                                    >Responsável</label
                                >
                                <TextInput
                                    placeholder="Nome do Responsável"
                                    class="bg-[#121212] w-96"
                                />
                            </div>
                            <div class="">
                                <label
                                    class="block text-sm font-medium text-gray-200"
                                    >Avisar quantos dias de antecedência</label
                                >
                                <TextInput
                                    type="number"
                                    min="1"
                                    placeholder="Ex: 30 dias"
                                    class="bg-[#121212] w-96"
                                />
                            </div>
                            <div class="">
                                <label
                                    class="block text-sm font-medium text-gray-200"
                                    >E-mail para notificação</label
                                >
                                <TextInput
                                    type="email"
                                    placeholder="email@examplo.com"
                                    class="bg-[#121212] w-96"
                                />
                            </div>

                            <div class="mt-6 flex gap-5">
                                <button
                                    type="submit"
                                    class="px-4 py-2 rounded-md bg-orange-600 text-white hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2"
                                >Salvar</button>
                                <button
                                    type="submit"
                                    class="px-4 py-2 rounded-md bg-gray-600 text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                                >Fechar</button>
                            </div>
                        </div>
                    </form>
                </div>

</template>

<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import formDomain from "./formDomain.vue";
</script>
