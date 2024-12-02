# Teste para à vaga de Desenvolvedor PHP AlhambraIT
## Instruções
O desafio consiste em implementar uma aplicação web utilizando o framework PHP Laravel e um banco de dados relacional MySQL, que terá como finalidade a inscrição de usuários em uma plataforma. Sua aplicação deve possuir as seguintes características:

## Funcionalidades
- Formulário de Cadastro:
  - O formulário deve ser um wizard com 3 passos:  - 
    1. Dados Pessoais: O usuário deve informar CPF, nome e email.
    2. Endereço: O usuário deve informar seu endereço (pode ser fictício), utilizando a API ViaCEP para auto-completar os dados do endereço.
    3. Confirmação: O usuário deve revisar e confirmar as informações fornecidas.
- Recurso de Autenticação:
  - O usuário deve ser capaz de se autenticar utilizando o cadastro criado no passo anterior.
  - A página inicial autenticada pode ser simples; não iremos avaliar a complexidade da home.
  - Ao informar o CPF no campo de cadastro, deve ser possível verificar se o cliente já possui um cadastro não finalizado e possibilitar que ele continue do ponto em que parou.
- Crud de clientes
    - Criar recurso de listagem/edição/criação e exclusão de clientes
    - Um cliente deverá ter os seguintes campos: Nome, Número de Telefone, E-mail e um Anexo do Contrato. O contrato pode ser de qualquer tipo de arquivo.
    - 
#### Migrations:
- O banco de dados é criado utilizando Migrations do framework Laravel.
///////Nome do banco de dados: 'cliente-vue'
Puerto:3307
Usuário:'root'
