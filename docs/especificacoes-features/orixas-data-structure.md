# Estrutura de Dados dos Orixás

Este documento descreve a estrutura de dados utilizada para os Orixás no sistema Cacaloo, incluindo as atualizações recentes (v2.2).

## Visão Geral

A entidade `Orisha` representa as divindades cultuadas na casa. Ela armazena informações essenciais para o estudo e culto, além de metadados para o sistema.

## Campos do Banco de Dados

A tabela `orishas` possui os seguintes campos principais:

| Campo | Tipo | Descrição |
| :--- | :--- | :--- |
| `id` | UUID | Identificador único do Orixá. |
| `name` | String | Nome do Orixá (ex: Oxalá, Ogum). |
| `description` | Text | Breve descrição introdutória. |
| `text` | Text | Texto detalhado sobre o Orixá, incluindo qualidades, atributos e atribuições. |
| `type_orisha` | String | Classificação do Orixá (ex: Universal, Cósmico). |
| `throne` | String | Trono Divino associado (ex: Fé, Lei, Justiça). **(Novo na v2.2)** |
| `oferings` | Text | Instruções e itens para oferendas. |
| `is_right` | Boolean | Indica se atua na Direita. |
| `is_left` | Boolean | Indica se atua na Esquerda. |
| `active` | Boolean | Status de ativação no sistema. |

## Fonte de Dados (Seeding)

Os dados iniciais dos Orixás são populados através do `OrishaSeeder`.

-   **Origem**: Os textos detalhados foram extraídos de arquivos Markdown localizados em `docs/orixas/`.
-   **Estrutura**: O seeder utiliza um array associativo contendo todos os dados para cada Orixá, garantindo consistência e facilidade de manutenção.
-   **Atualização**: Para atualizar os dados de um Orixá, recomenda-se alterar o `OrishaSeeder` e rodar o comando `php artisan db:seed --class=OrishaSeeder` (ou `migrate:fresh --seed` para um reset completo).

## Visualização (UI)

A visualização dos detalhes do Orixá (`admin.orishas.show`) foi atualizada para exibir:

1.  **Informações Básicas**: Nome, Tipo, Trono, Status.
2.  **Indicadores Visuais**: Badges para "Direita" e "Esquerda".
3.  **Conteúdo Rico**:
    -   **Descrição**: Texto introdutório.
    -   **Oferendas**: Lista formatada de oferendas.
    -   **Texto Detalhado**: Conteúdo completo sobre o Orixá.

## Manutenção

Ao adicionar novos campos ou modificar a estrutura, lembre-se de:

1.  Criar uma migration para alterar a tabela.
2.  Atualizar o array `$fillable` no Model `Orisha`.
3.  Atualizar o `OrishaSeeder` com os novos dados.
4.  Atualizar as views (`create`, `edit`, `show`) para refletir as mudanças.
