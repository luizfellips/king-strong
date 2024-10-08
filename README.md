<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# King Strong
É um aplicativo responsivo em processo de construção que englobará diversas funcionalidades que facilitem a eficiência na construção e análise de blocos de treinos voltados para powerlifting / hipertrofia máxima, análise de divisões de treinos e busca por redundâncias e opções mais eficazes.

![image](https://github.com/luizfellips/powermaromba/assets/110192027/6cbd2572-7d57-4309-8966-8cebab8aadfa)

# Instalação
1. Clone este repositório através de `git clone https://github.com/luizfellips/king-strong.git`
2. Execute o comando `npm i` no diretório do projeto.
3. Instale as dependências de composer através de `composer install`.
4. Rode as migrações de banco de dados através de `php artisan migrate`
5. Rode o servidor principal através de `php artisan serve`
6. Rode o servidor de desenvolvimento através de `npm run dev`

# Tecnologias
- Laravel
- Javascript
- Laravel Blade
- MySQL
- Tailwind CSS
- JQuery

# Funcionalidades

## One Rep Max: 
**Cálculo de 1RM e Categorização de Nível de Força**

Este projeto apresenta uma funcionalidade robusta para o cálculo do máximo de repetição (1RM) e categorização de nível de força com base em diversos parâmetros fornecidos pelo usuário. 
A funcionalidade permite uma análise detalhada de aproximações de cargas por porcentagem e personalizada do desempenho em exercícios de força.

**Funcionalidades Principais:**


Entrada de Dados do Usuário:

- Nome
- Altura
- Peso
- Tempo de treino
- Seleção de Exercício:

O usuário pode escolher um exercício específico de uma lista pré-definida.
Informações detalhadas sobre o exercício selecionado são exibidas.

### Registro de Desempenho no Exercício:

Quantidade máxima de repetições realizadas.
Repetições em reserva.
Peso utilizado.

**Cálculo do 1RM:**

Utiliza os dados fornecidos para calcular o 1RM (one-repetition maximum) do exercício selecionado, com base em cálculos matemáticos como Equação de Epley.
Geração de uma tabela com porcentagens de 50% a 100% do 1RM, indicando as cargas aproximadas para cada porcentagem.

### Análise de Nível de Força:

- Com base na proporção entre peso corporal, carga, repetições e tempo de treino, a funcionalidade categoriza o usuário em um nível de força pré-definido com base em diversos estudos.
- Comparação com padrões de desempenho para fornecer uma classificação precisa.

### Benefícios:
- Personalização: Considera múltiplos fatores individuais para fornecer resultados precisos e personalizados.
- Informações Detalhadas: Exibe informações detalhadas sobre os exercícios, auxiliando na escolha e entendimento dos mesmos.
- Monitoramento de Progresso: Facilita o acompanhamento do progresso do usuário ao longo do tempo.
- Motivação e Objetividade: Oferece uma categorização clara do nível de força, incentivando o usuário a atingir novos objetivos.

### Como Utilizar:
- Inserir Dados Pessoais: Preencha as informações básicas sobre você.
- Selecionar Exercício: Escolha um exercício da lista e visualize suas informações.
- Registrar Desempenho: Insira os dados sobre seu desempenho no exercício.
- Calcular 1RM: Veja seu 1RM calculado e a tabela de porcentagens com cargas correspondentes e suas respectivas faixas de repetições.
- Verificar Nível de Força: Confira sua categorização de nível de força baseada nos dados fornecidos.

Esta funcionalidade visa proporcionar uma ferramenta completa e fácil de usar para atletas, treinadores e entusiastas de fitness que desejam acompanhar e melhorar seu desempenho em exercícios de força.
## Galeria de Imagens

| ![image](https://github.com/luizfellips/king-strong/assets/110192027/aa03c386-4e55-4944-a1eb-36f6d531fdc4) | ![image](https://github.com/luizfellips/king-strong/assets/110192027/5d67fd78-176c-43f5-ad9f-c7beaaf24438) |
| ----------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------- |
| ![image](https://github.com/luizfellips/king-strong/assets/110192027/a92b983d-3ae3-4661-bf52-ccab4045cd11) | ![image](https://github.com/luizfellips/king-strong/assets/110192027/43edab0d-2fcd-4554-ab76-204dea9a9ca0) |
| ![image](https://github.com/luizfellips/king-strong/assets/110192027/ab000456-6317-4a34-b010-fa01abb19f59) | ![image](https://github.com/luizfellips/king-strong/assets/110192027/cc6a02e1-1995-4458-8b53-c662237efd0c) |


